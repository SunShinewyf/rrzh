<?php
namespace Admin\Controller;
use Think\Controller;
class FileController extends CommonController{
    public function index(){
        $this->allFile();
    }

    public function allFile(){
        $this->setPageOption('所有文件');

        $admin = M('admin');
        $admins = $admin->getField('aid, aname');

        $file = M('file');
        $files = $file->order('`fbuild` desc')->select();
        foreach( $files as &$val){
            $val['aid'] = $admins[$val['aid']];
        }
        $this->assign('files', $files);
        $this->display();
    }

    public function saveFile(){
        if (!empty($_POST)) {
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();    // 实例化上传类
            $upload->maxSize = 8388608;    // 最大8M
            $upload->saveRule = '';
            // $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
            $upload->savePath = './Upload/file/'; // 设置附件上传目录
            if (!$upload->upload()) { // 上传错误提示错误信息
                $this->error($upload->getErrorMsg());
            } else { // 上传成功 获取上传文件信息
                $info = $upload->getUploadFileInfo();
            }

            $file = M("file"); // 实例化User对象
            $data = array();
            $data['fname'] = $info[0]['savename'];
            $data['fsize'] = $info[0]['size'];
            $data['fdescrib'] = $_POST['describ'];
            $data['aid'] = session('admin');
            $data['fbuild'] = date('Y-m-d H:i:s', time());
            $file->create($data);
            if( $file->add() === false ){
                $this->setError('上传失败！');
                unlink($upload->savePath.$info[0]['savename']);
            }else{
                $this->setSuccess('上传成功！');
            }
        }
        $this->redirect('allFile');
    }

    public function DeleteFile(){
        $this->setPageOption('删除文件');
        if( isset($_GET['id']) && is_numeric($_GET['id']) ){	// 防止直接访问
            $file = M('file');
            $fid = $_GET['id'];
            $theOne = $file->where("`fid` = '$fid'")->find();
            if( $file->where("`fid` = $fid")->delete() != false ){
                unlink('./Upload/file/'.$theOne['fname']);
                $this->setSuccess('文件'.$theOne['fname'].'删除成功！');
            }else{
                $this->setError('删除失败！请确认参数重试……');
            }
        }
        $this->redirect('allFile');
    }
}