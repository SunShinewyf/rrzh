<?php
/**
 * 公共类，在之后的其他控制器继承这个类，以统一验证登录
 * Created by shhider
 * Date: 14-3-31
 */
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {

    ///////////////// 验证登录
    protected function chkLogin(){
        $uid = session('admin');      // 登录成功后会把管理员对应id写入admin的session中
        if( empty($uid) ){
            session(null);      // 尚未登录，清楚该用户所有session
            $this->redirect('Index/login');
        }
    }

    ////////////// 验证是否是根管理员
    protected function chkAuth(){
        $aid = session('admin');      // 取到当前管理员的id
        $admin = M('admin');
        $adminer = $admin->where("aid=$aid")->find();
        if( empty($adminer) ){
            $this->chkLogin();
        }elseif( $adminer['auth'] != ROOT_AUTH && $adminer['auth'] != SUPER_AUTH ){
            $this->setError('您没有使用该模块的权限，如有需要请联系根管理员');
            $this->redirect('Index/noAuth');
        }
        return true;
    }

    ////////////// 设置错误信息
    protected function setError($info){
        if(isset($info))
            session("pageError",$info);
    }

    //设置成功信息
    protected function setSuccess($info){
        if(isset($info))
            session("pageSuccess",$info);
    }

    /**
     * @param $pagetitle 页面的标题
     * @param bool $chklogin 是否验证登录，默认为true，进行验证
     * @param bool $chkauth 是否需要管理员权限，默认为false，不验证
     * 另外还设置页面的成功和错误信息
     */
    protected function setPageOption( $pagetitle='FdManager管理系统', $chklogin=true, $chkauth=false ){
        $this->assign('adminName',session('adminName'));
        if( isset($pagetitle) )
            $this->assign('PageTitle',$pagetitle);      //
        if($chklogin)       // 默认是要求验证登录的
            $this->chkLogin();
        if($chkauth)        // 默认不检查是否是高级管理员，需要验证时将chkauth置为true
            $this->chkAuth();

        /*成功、失败提示*/
        $pageError=session('pageError');
        if(isset($pageError)){
            $this->assign('pageError',$pageError);
            session('pageError',null);
        }
        $pageSuccess=session('pageSuccess');
        if(isset($pageSuccess)){
            $this->assign('pageSuccess',$pageSuccess);
            session('pageSuccess',null);
        }
        /*-------*/
    }

    /**
     * 把栏目信息组织成json形式，已经赋给模版，不要再用sublist、parcol变量了
     * 两个模版变量：sublist，json格式的子栏目信息，键名是相应父栏目的code；parcol是父栏目数组
     */
    protected function getColumn(){
        $column = M('column');
        $ParCol = $column->field('code, cname')->where("cparent = '0'")->select();    //父级栏目

        $SubList = array();
        foreach( $ParCol as $ParVal){
            $theCode = $ParVal['code'];
            $arr = array();
            $SubCol = $column->field('code, cname')->where("cparent = '$theCode'")->select();
            foreach( $SubCol as $SubVal){
                $arr[$SubVal['code']] = $SubVal['cname'];
            }
            $SubList[$theCode] = $arr;
        }
        $json_SubList = json_encode($SubList);
        $this->assign('sublist', $json_SubList);
        $this->assign('parcol', $ParCol);   //用来选择父级栏目
    }

}