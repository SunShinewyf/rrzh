<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    ////////////////////////// 管理员空间
    public function index(){
         $this->setPageOption('欢迎使用');
        $auth = array(
            ROOT_AUTH => 'root管理员',
            SUPER_AUTH => '超级管理员',
            ORDINARY_AUTH => '普通管理员',
        );
         $admin = M('Admin');
         $myid = session('admin');
         $myinfo = $admin->where("aid = $myid")->find();
         $this->assign('Iam', $auth[$myinfo['auth']]);
		$this->display();
	}

    /////////////////////////// 登录、登出部分
    public function login(){
        $this->assign('pagetitle','人人众合后台管理系统');
        $this->setPageOption('管理员登录',false);
        $this->display();
    }
    /**
     * ajax方式管理员登录
     * 返回值data：
     * 0：验证正确，登录成功
     * 1：用户名不存在
     * 2：密码与用户名不匹配
     */
    public function SubmLogin(){
        if($_POST){
            $aname = $_POST['aname'];
            $apwd = md5($_POST['apwd']);
            $result = array();

            $admin = M('Admin');
            $theAdmin = $admin->where("aname='$aname'")->find();
            // dump($theAdmin);
            // exit;
            if( empty($theAdmin) ){
                $result['data'] = 1;
                $result['info'] = "登录失败，您输入的帐号不存在！";
            }
            elseif( $theAdmin['apwd'] != $apwd ){
                $result['data']  = 2;
                $result['info'] = "登录失败，您输入的密码不正确！";
            }
            else{
                session('admin',$theAdmin['aid']);
                session('adminName',$theAdmin['aname']);
                $result['data']  = 0;
                $result['info']  = "index";
            }
            $this->ajaxReturn($result, 'JSON');
        }
    }

    public function logout(){
        session(null);
        redirect("login");
    }

    public function noAuth(){
        $this->setPageOption('权限不足');
        $this->display();
    }

    public function UpdateOwnInfo(){
        $this->setPageOption('修改个人信息');
        $this->display();
    }
    public function SaveOwnInfo(){
        $this->setPageOption('保存个人信息');
        if( isset($_POST) ){
            $curpwd = md5($_POST['curpwd']);
            $pwd = md5($_POST['pwd']);
            $aid = session('admin');

            $admin = M('admin');
            $theOne = $admin->where("aid = $aid")->find();
            if( empty($theOne) || $theOne['apwd'] != $curpwd ){
                $this->setError('原密码错误！');
            }else{
                $result = $admin->where("aid = $aid")->save( array('apwd'=>$pwd) );
                if( $result === false ){
                    $this->setError('保存新密码失败，请重试！');
                }else{
                    $this->setSuccess('修改密码成功！');
                }
            }
        }
        $this->redirect('UpdateOwnInfo');
    }
}