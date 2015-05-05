<?php
   namespace Home\Controller;
   use Think\Controller;
   class CommonController extends Controller {
        protected function getColumn(){
        $column = M('Column');
        $where['cparent'] = '0';
        $condition['cparent'] != '0';
        
        $Parcols = $column->where($where)->order('cprior asc')->select();
        $Subcols = $column->where($condition)->select();

        $this->assign('Subcols',$Subcols);
        $this->assign('Parcols',$Parcols);
    }

    //获得一级和二级栏目的所有符合要求的文章
        protected function getEssay($code = "")
        {
            if(isset($code)){
              $column = M('Column');
              $essay = M('Essay');
              $where['cparent'] = $code;
              $where['code'] = $code;
              $where['_logic'] = 'or';
              $result = $column->where($where)->field('code')->select();
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
              $list = $essay->where($condition)->limit(6)->select();
             }
           $this->assign($code,$list);
        }
      

      ///////////////////////////////////获取公司的相关信息
         protected function getInfo(){
             $info = M('Info');
             $Infolist = $info->select();
             $this->assign('Infolist',$Infolist);
         }
      ///////////////////////////////获取连接联系公司信息
        protected function getLink(){
            $link = M('Link');
            $Linklist = $link->select();
            $this->assign('Linklist',$Linklist);
        }
   }
  
?>