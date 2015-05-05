<?php

  namespace Admin\Controller;
  use Think\Controller;
  class OtherController extends CommonController{
  	   public function allLink()
  	   {
           $this->setPageOption('所有链接',true,true);
  	   	   $link = M('Link');
            
  	   	   $list = $link->select();
           if(isset($_GET['lid']) && is_numeric($_GET['lid']))
              {
                 $lid = $_GET['lid'];
                 $where['lid'] = $lid;
                 $theOne = $link->where($where)->find();
                 $this->assign('link',$theOne);
              }
           $this->assign('list',$list);
  	   	   $this->display();

  	   }

      ////////////////////////// 保存新链接
    public  function SaveLink(){
        $this->setPageOption('保存链接',true,true);
        if( empty($_POST['ltitle']) || empty($_POST['lhref']) ){
            $this->setError('请将相关信息填写完整！');
        }else{
            $data['lname'] = $_POST['ltitle'];
            $data['lurl'] = $_POST['lhref'];
            if( stripos( $data['lurl'], 'http://') === 0 ){}
            else{
                $data['lurl'] = 'http://'.$data['lurl'];
            }
            $data['ltime'] = date("Y-m-d H:i:s",time());

            $link = M('link');
            $link->create($data);
            if( $link->add() === false ){
                $this->setError('保存失败！请重试……');
            }else{
                $this->setSuccess('保存成功！');
            }
        }
        $this->redirect('AllLink');
    }

        ///////////////////////////////// 删除
    public function DeleteLink(){
        $this->setPageOption('删除链接',true,true);
        if( isset($_GET['lid']) && is_numeric($_GET['lid']) ){
            $lid = $_GET['lid'];
            $link = M('link');
            if( $link->where("lid = $lid")->delete() === false ){
                $this->setError('删除时发生错误！请重试……');
            }else{
                $this->setSuccess('删除成功！');
            }
        }
        $this->redirect('AllLink');
    }

      //公司联系信息管理

      public function AllInfo(){
          $this->setPageOption('公司所有信息',true,true);
          $result = M('Info');
           if(isset($_GET['iid']) && is_numeric($_GET['iid']))
              {
                  $iid = $_GET['iid'];
                  $where['iid'] = $iid;
                  $info = $result->where($where)->find();
                  $this->assign("info",$info);
              }
          $info = $result->select();
          $this->assign('result',$info);
          $this->display();
      }
      
      //公司信息保存
       public function SaveInfo(){
        // dump($_POST);
        // exit;
        $this->setPageOption('保存公司信息',true,true);
        if( empty($_POST['iname']) || empty($_POST['icontactor']) || empty($_POST['iphone']) ){
            $this->setError('请将相关信息填写完整！');
        }else{
           
            $data['iname'] = I('iname');
            $data['icontactor'] = I('icontactor');
            $data['iphone'] = I('iphone');
            $data['iqq'] = I('iqq');
            $data['iemail'] = I('iemail');
            $data['iaddress'] = I('iaddress');
            $info = M('Info');
            if(isset($_GET['iid']) && is_numeric($_GET['iid']))
            {
                $info->create($data);
                $result = $info->save();
            }else{

               $id = $info->create($data);
               dump($id);
               
                $result = $info->add();

            }

            if( $result === false ){
                $this->setError('保存失败！请重试……');
            }else{
                $this->setSuccess('保存成功！');
            }
        }
        $this->redirect('AllInfo');
       }
  }