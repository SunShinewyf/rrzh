<?php
namespace Admin\Controller;
use Think\Controller;
class ExpertController extends CommonController {
    public function index(){
        $this->allExpert();
    }
    public function allExpert(){
        $this->setPageOption('所有专家');
        
        $teacher = M('teacher');
        $list = $teacher->order('ttime asc')->select();
        // dump($list);
        // exit;
        $this->assign('experts',$list);
        $this->display();
    }

     //添加新教练
     public function ExpertAdd(){
        $this->display();
     }

     ////////////////保存教练信息
    public function saveFile(){
        // dump($_POST);
        // exit;
         $this->chkLogin();
        if($_POST){
             if( empty($_POST['name']) ){
                  $this->setError('请填写教练名!');
             }else{
            import('ORG.Net.UploadFile');
            $upload = new \Think\Upload();// 实例化上传类
            $upload->saveRule = ''; // 保持上传的文件名不变
            $upload->maxSize = 3145728 ;// 设置上传大小限制，3M
            $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath = './coach/';// 设置上传目录，注意写法
            $fileInfo = $upload->upload();
            if(!$fileInfo) {// 上传错误提示错误信息
                $this->setError($upload->getError());
            }else{
            $teacher = M('Teacher');
            $data['tpic'] = $fileInfo['sfile']['savename']; //因为支持多文件，所以这里是二维数组
            $data['tname'] = $_POST['name'];
            $data['tdetail'] = $_POST['edetail'];
            $data['ttime'] = date("Y-m-d H:i:s",time());

             if( isset($_GET['tid']) && is_numeric($_GET['tid']) ){
                $tid = $_GET['tid'];
                $result = $teacher->where("tid = $tid")->save($data);
            }else{
                $data['ttime'] = date("Y-m-d H:i:s",time());
                // dump($data);
                // exit;
                $re=$teacher->create($data);
                // dump($re);

                $result= $teacher->add();
                //       dump($teacher->getLastSql());
                // dump($result);
                // exit;
            }
           
            if($result === false){
                 unlink( $upload->savePath.$fileInfo[0]['name'] );
                 $this->setError("数据保存失败!请重试...");
            }else{
                $this->setSuccess('数据保存成功!');
            }
            
        }
     }

    }
       $this->redirect('allExpert');
}
       //删除专家
     public function DeleteExpert(){
       // dump($_GET);
        $this->setPageOption('删除教练', true, true);

         if( isset($_GET['id']) && is_numeric($_GET['id']) ){
             $teacher = M('Teacher');
             $tid = $_GET['id'];
             $where['tid'] = $tid;
             $list = $teacher->where($where)->find();
             // dump($list);
             // exit;
             $result = $teacher->where($where)->delete();
             if($result === false){
                $this->setError("删除失败!");
             }else{
                $this->setSuccess("删除成功!");
                unlink('./Uploads/coach/'.$list['tpic']);
             }
         }

         $this->redirect('allExpert');
     }

    
}