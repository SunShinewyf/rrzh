<?php
/**
 * Created by shhider.
 * Date: 14-3-31
 * To change this template use File | Settings | File Templates.
 */
namespace Admin\Controller;
use Think\Controller;
class SystemController extends CommonController{
    ////////////////////////////////////////// 系统设置
    public function AdminList(){
        $this->setPageOption('管理员列表',true,true);
        $admin = M('admin');
        $myid = session('admin');
        $myinfo = $admin->where("aid = $myid")->find();
        $IamRoot = ( $myinfo['auth'] == ROOT_AUTH ) ? true : false;
        $this->assign('IamRoot', $IamRoot);

        $where = "aid <> $myid";
        if( !$IamRoot ){
            $where .= ' and auth <> '.ROOT_AUTH;   // 如果不是root，不显示权限为999的root
        }

        $admins = $admin->order('abuild desc')->select();   // 超级管理员是999
        // dump($admins);
        // exit;
        foreach( $admins as &$val ){
            $val['auth'] = ($val['auth'] == SUPER_AUTH )?'超级管理员':'普通管理员';
            if( $IamRoot ){
                $val['AllowOperate'] = true;
            }else{
                $val['AllowOperate'] = ( $val['abuildby']== $myid )? true : false;
            }
        }
        $this->assign('admins', $admins);

        $this->assign('super', SUPER_AUTH);
        $this->assign('ordinary', ORDINARY_AUTH);
        $this->assign('root',ROOT_AUTH);
        $this->display();
    }

    public function BuildAdmin(){
        $this->setPageOption('添加管理员',true,true);
        if( !empty($_POST) ){
            $data = array();    // 存放数据
            $admin = M('admin');
            $myid = session('admin');
            $myinfo = $admin->where("aid = $myid")->find();
            $IamRoot = ( $myinfo['auth'] == ROOT_AUTH ) ? true : false;
                if( empty($_POST['name']) )
                    throw new Exception("请指定用户名");
                if( empty($_POST['pwd']) )
                    throw new Exception("请填写初始密码");
                
                $auth = intval($_POST['auth']);
                $data['auth'] = ( $auth == SUPER_AUTH ) ? $auth : ORDINARY_AUTH;    //只能指定超级或普通
                if( $data['auth'] == SUPER_AUTH && !$IamRoot )
                    throw new Exception($_POST['auth']."你的权限不足，无法添加超级管理员");

                $existed = $admin->where("aname = '".$_POST['name']."'" )->find();
                if( !empty($existed) ){
                    $this->setError('该昵称已经被使用，请换一个');
                }else{
                    
                $data['aname'] = $_POST['name'];
                $data['apwd'] = md5($_POST['pwd']);
                $data['amsg'] = $_POST['msg'];
                $data['abuildby'] = $myid;

                $admin->create($data);
                if( $admin->add() === false )
                    throw new Exception("添加失败，请重试...");
                else
                    $this->setSuccess('添加成功！');
            }
        }
        $this->redirect('AdminList');
    }
    ///////////////////////
    public function DeleteAdmin(){
        $this->setPageOption('删除管理员', true, true);
        if( isset($_GET['id']) && is_numeric($_GET['id']) ){
            $id = $_GET['id'];
            $admin = M('admin');

            $myid = session('admin');
            $myinfo = $admin->where("aid = $myid")->find();
            $IamRoot = ( $myinfo['auth'] == ROOT_AUTH ) ? true : false;

            $theOne = $admin->where("aid = $id")->find();
            try {
                if( empty($theOne) )
                    throw new Exception('要删除的管理员不存在');
                if( $theOne['auth'] == ROOT_AUTH )
                    throw new Exception('root管理员不允许删除');
                if( !$IamRoot && $theOne['abuildby'] != $myid )
                    throw new Exception('你不能删除该管理员，因为他不是你添加的');
                
                $result = $admin->delete($id);
                if( $result === false )
                    throw new Exception('删除失败，请重试...');
                else
                    $this->setSuccess('删除成功');
            } catch (Exception $e) {
                $this->setError($e->getMessage());
            }
        }
        $this->redirect('AdminList');
    }
    ////////////////////////////////////////// 栏目设置
    public function SetColumn(){
        $this->setPageOption('设置栏目',true,true);
       
        $cols = array();
        $column = M('Column');
        $ParCol = $column->where("cparent = '0'")->select();
        foreach( $ParCol as $val ){
            $val['cname'] = '+ <strong>'.$val['cname'].'</strong>';
            $cols[] = $val;
            $cpa = $val['code'];
            $SubCol = $column->where("cparent = '$cpa'")->order('cprior')->select();
            if( isset($SubCol) ){
                foreach($SubCol as $subval){
                    $subval['cname'] = '&nbsp;&nbsp;&nbsp;-&nbsp;'.$subval['cname'];
                    $cols[] = $subval;
                }
            }
        }
        $this->assign("cols", $cols);

        $this->assign('parcol', $ParCol);
        $this->display();
    }

    public function edit(){
         if(isset($_GET)){
            $cols = array();
            $column = M('Column');
            $ParCol = $column->where("cparent = '0'")->select();
            foreach( $ParCol as $val ){
            $val['cname'] = '+ <strong>'.$val['cname'].'</strong>';
            $cols[] = $val;
            $cpa = $val['code'];
            $SubCol = $column->where("cparent = '$cpa'")->order('cprior')->select();
            if( isset($SubCol) ){
                foreach($SubCol as $subval){
                    $subval['cname'] = '&nbsp;&nbsp;&nbsp;-&nbsp;'.$subval['cname'];
                    $cols[] = $subval;
                }
            }
        }
        $this->assign("cols", $cols);
             $code = $_GET['code'];
             $column = M('Column');
             $where['code'] = $code;
             $result = $column->where($where)->find();
             $this->assign('result',$result);
             $this->assign('parcol', $ParCol);
             $this->display();
        }
    }
    //////////////////////////////////// 保存栏目更新
    public function SaveColumn(){
        $this->setPageOption('保存栏目信息',true,true);
        if( !empty($_POST) ){
            $data = array();
            $data['cid'] = $_POST['cname'];
            $data['cname'] = $_POST['cname'];
            $data['code'] = strtolower($_POST['code']);
            $data['cparent'] = $_POST['cparent'];
            
            // dump($data);
            // exit;
            $col = M('column');

             $col->create($data);
            if( $col->add() === false ){
                $this->setError('添加新栏目失败！请重试……');
            }else{
                $this->setSuccess('添加成功！');
            }
            
        }
        $this->redirect('SetColumn');
    }
    public function SaveEdit(){
        $this->setPageOption('保存栏目信息',true,true);
        if( !empty($_POST) ){
            $data = array();
            $data['cname'] = $_POST['cname'];
            $data['code'] = strtolower($_POST['code']);
            $data['cparent'] = $_POST['cparent'];
     
            $col = M('column');
            $where['code'] = $_POST['code'];
            $result = $col->where($where)->save($data);
            if( $result === false ){
                $this->setError('修改新栏目失败！请重试……');
            }else{
                $this->setSuccess('修改成功！');
            }
            
        }
        $this->redirect('SetColumn');
    }

    /////////////////////////////删除某个栏目,当删除时相应的栏目文章也会删除
    public function delete(){
          if(isset($_GET)){
              $column = M('Column');
              $essay = M('Essay');
              $code = $_GET['code'];
              $where['code'] = $code;
              $curcol = $column->where($where)->find();
              if($curcol['cparent'] == '0')
              {
                 $where1['cparent'] = $code;
                 $where1['code'] = $code;
                 $where1['_logic'] = 'or';
                 $result = $column->where($where1)->field('code')->select();
               
                 $data = array();
                 foreach($result as $key=>$value)
                {
                 foreach($value as $key2=>$value2)
                 {
                     $data[$key]=$value2;
                 }
               }
                $condition['code'] = array('in',$data);
                $es = $essay->where($condition)->setField('ejin','1');
                $re = $column->where($condition)->delete();
              }else{
                $condition1['code'] = $code;
                $es = $essay->where($condition1)->setField('ejin','1');
                $re = $column->where($condition1)->delete();
              }

                 if($re && $es)
                {
                    $this->setSuccess("栏目删除成功!");
                }else{
                    $this->setError("删除失败，请重试");
                }
          }
                $this->redirect('SetColumn');
    }
    ////////////////////////////
    public function getDescribeByCode(){
        $ret = array();
        if( isset($_GET['code']) ){
            $code = $_GET['code'];
            $column = M('column');
            $theOne = $column->field("`cname`,`cdescribe`")
                ->where("`code`= '$code'")->find();
            if( empty($theOne) ){
                $ret['error'] = 2;
                $ret['info'] = 'wrong param';
            }else{
                $ret['error'] = 0;
                $ret['colname'] = $theOne['cname'];
                $ret['describe'] = $theOne['cdescribe'];
            }
        }else{
            $ret['error'] = 1;
            $ret['info'] = 'no param';
        }
        $this->ajaxReturn($ret);
    }
    ///////////////////////////
    public function SaveColDescribe(){
        $this->setPageOption('保存栏目信息',true,true);
        if( !empty($_POST) ){
            $code = $_POST['code'];
            $data = array('cdescribe' => $_POST['describe']);
            $column = M('column');
            $result = $column->where("code = '$code'")->save($data);
            if( $result === false ){
                $this->setError('修改失败，请重试……');
            }else{
                $this->setSuccess('修改成功！');
            }
        }
        $this->redirect('SetColumn');
    }


}