<?php
/**
 * Created by shhider.
 * Date: 14-3-31
 * To change this template use File | Settings | File Templates.
 */
namespace Admin\Controller;
use Think\Controller;
class HomepageController extends CommonController{
    ////////////////////// 更新首页大图
    public function UpdateSlider(){
        $this->setPageOption();
        $this->chkLogin();
        $slider = D('Picture');
        $sliders = $slider->relation(true)->select();
        $count = $slider->count();
        $p = getpage($count,6);
        $list = $slider->field(true)->order('pid desc')->limit($p->firstRow, $p->listRows)->select();
        foreach( $sliders as &$sval ){
            $sval['ptime'] = date('Y-m-d', strtotime($sval['sdate']));
        }
        // dump($sliders);
        // exit;

        
        $this->assign('sliderItem', $sliders);
        $this->assign('page', $p->show()); // 赋值分页输出
        $this->getColumn();
        $this->display();
    }
    //////////////////////////////// 保存
    public function SaveSlider(){
        // dump($_POST);
        // exit;
        $this->chkLogin();
        if( $_POST ){
            import('ORG.Net.UploadFile');
            $upload = new \Think\Upload();// 实例化上传类
            $upload->saveRule = '';	// 保持上传的文件名不变
            $upload->maxSize = 3145728 ;// 设置上传大小限制，3M
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            if($_POST['code'] == '0'){
            $upload->savePath = './slider/';// 设置上传目录，注意写法
             }else{
                 $upload->savePath = './column/';// 设置上传目录，注意写法
             }
            $fileInfo = $upload->upload();
            if(!$fileInfo) {// 上传错误提示错误信息
                $this->setError($upload->getError());
            }else{// 上传成功 获取上传文件信息
               
             //   dump($fileInfo);
                // 信息存入数据库
                $slider = M('Picture');
                $data['pname'] = $fileInfo['sfile']['savename'];	//因为支持多文件，所以这里是二维数组
                $data['pinfo'] = $_POST['scaption'];

                $data['code'] = $_POST['code'];

                $data['pfrom'] = session('adminName');
                $data['ptime'] = date("Y-m-d H:i:s",time());
                if($slider->add($data)){
                    $this->setSuccess('图片上传成功！<a href="__ROOT__" target="_blank">去首页看看</a>');
                }else{
                    unlink( $upload->savePath.$fileInfo[0]['name'] );
                    $this->setError('数据保存错误！请重试……');
                }
            }
        }
        $this->redirect('UpdateSlider');
    }
    ////////////////// 删除幻灯片
    public function DeleteSlider(){
        $this->chkLogin();
        if( isset($_GET['pid']) && is_numeric($_GET['pid']) ){	// 防止直接访问
            $slider = M('Picture');
            $pid = $_GET['pid'];
            $theOne = $slider->where("pid = '$pid'")->find();
            // dump($theOne);
            // exit;
            if( $slider->where("pid = $pid")->delete() != false ){
                if($theOne['code'] == '0'){
                    unlink( $upload->savePath.$fileInfo[0]['name'] );
              }else{
               unlink('./Uploads/column/'.$theOne['pname']);
             }
                $this->setSuccess('文件'.$theOne['pname'].'删除成功！');
            }else{
                $this->setError('删除失败！请确认参数重试……');
            }
        }
        $this->redirect('UpdateSlider');
    }


}