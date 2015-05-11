<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class JlfcController extends CommonController {
    public function index(){
           $expert = M('Teacher');
           $name = $expert->field("tname")->select();

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
            $this->assign('name',$name);
            $this->assign('parent',$parent);
            $this->assign('CurCol',$CurCol);
            $this->assign('SubCols',$SubCols);
            $this->getInfo();
            $this->getColumn();
            $this->getLink();
            $this->display();
    }


}