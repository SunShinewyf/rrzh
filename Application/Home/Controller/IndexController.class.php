<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
        $this->getEssay('hdch');
        $this->getEssay('qwhd');
        $this->getEssay('sscb');
        $this->getEssay('zspx');
        $this->getInfo();
        $this->getColumn();
        $this->getLink();
        $this->display();
    }


    ////////////////////////////文章标题的展示
    public function EssayList($code){
        if( empty($code) ){
            header('HTTP/1.1 404 Not Found');
            header("status: 404 Not Found");
        }else{
              // 获取栏目信息
            $column = M('column');
            $essay = M('Essay');
            $CurCol = $column->where("code = '$code'")->find();
            // dump($CurCol);
           // exit;
            if( empty($CurCol) ){
                header('HTTP/1.1 404 Not Found');
                header("status: 404 Not Found");
            }else{
                $parent = $CurCol['cparent'];
                if($parent == '0')
                {
                    $where['cparent'] = $code;
                    $SubCols = $column->where($where)->order('cprior')->select();


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
                    $condition['ejin'] = '0';
                    $count = $essay->where($condition)->count();
                    $p = getpage($count,15);
                    $list = $essay->where($condition)->order('ebuild desc')->limit($p->firstRow, $p->listRows)->select();
                    $this->assign('ParCol',$CurCol);
                }else{
                    $ParCol = $column->where("code = '".$CurCol['cparent']."'")->find();
                    $SubCols = $column->where("cparent = '".$ParCol['code']."'")->order('cprior')->select();
                    $where['code'] = $code;
                    $where['ejin'] = '0';
                    $count = $essay->where($where)->count();
                    $p = getpage($count,15);
                    $list = $essay->where($where)->order('ebuild desc')->limit($p->firstRow, $p->listRows)->select();
                    $this->assign('ParCol',$ParCol); 
                }
            }
           
            $this->assign('select', $list); // 赋值数据集
            $this->assign('page', $p->show()); // 赋值分页输出
            $parent = $CurCol['cparent'];  //通过该变量进行一级和二级栏目的判断标准
            $this->assign('parent',$parent);
            $this->assign('CurCol',$CurCol);
            $this->assign('SubCols',$SubCols);
            $this->getInfo();
            $this->getColumn();
            $this->getLink();
            $this->display();

      }
    }


    ////////////////////////////显示文章详细内容
    public function EssayDetail(){
         if( isset($_GET['e']) && is_numeric($_GET['e']) ){
            /////////////// 获取文章
            $eid = $_GET['e'];
            $essay = M('essay');
            $essay->where("eid = $eid")->setInc('etimes');  //阅读次数+1
            $theOne = $essay->field('eid, etitle, efrom, code, edetail, etimes, ebuild')->where("eid = $eid")->find();
            $this->assign('essay', $theOne);
            $this->assign('PageTitle', $theOne['etitle']);

            ////////////// 获取栏目信息
            $column = M('column');
            $code = $theOne['code'];
            $CurCol = $column->where("code = '".$theOne['code']."'")->find();
            $this->assign("CurCol", $CurCol);   //当前栏目
            $parent = $CurCol['cparent'];
            if($parent == '0')
                {
                    $where['cparent'] = $code;
                    $SubCols = $column->where($where)->order('cprior')->select();
                    $this->assign('ParCol',$CurCol);
                }else{
                    $ParCol = $column->where("code = '".$CurCol['cparent']."'")->find();
                    $SubCols = $column->where("cparent = '".$ParCol['code']."'")->order('cprior')->select();
                    $this->assign('ParCol',$ParCol); 
                }
            $parent = $CurCol['cparent'];  //通过该变量进行一级和二级栏目的判断标准
            $this->assign('parent',$parent);
            $this->assign('CurCol',$CurCol);
            $this->assign('SubCols',$SubCols);
            $this->getInfo();
            $this->getColumn();
            $this->getLink();
            $this->display();
        }
    }
}

