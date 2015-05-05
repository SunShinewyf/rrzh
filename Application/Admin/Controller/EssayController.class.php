<?php
/**
 * 管理文章的页面
 * Created by shhider（734459639）.
 * Date: 14-3-31
 */
namespace Admin\Controller;
use Think\Controller;
class EssayController extends CommonController {
    public function AllEssay(){
        $this->setPageOption('文章列表');
        //============================ 得到'code'=>'cname'
        $colArr = array();
        $column = M('column');
        $cols = $column->field('`code`,`cname`')->select();
        foreach ($cols as $name){
            $colArr[$name['code']] = $name['cname'];
        }
        //============================= 处理get参数
        $where = '';                 // 查询条件字符串
        $order = '`ebuild` desc';    // 排序方式，默认按文章添加的时间
        $offset = 0;                 // limit中的offset
        $limit = '';
        $CurFilte = '';              // 提示当前的搜索条件
        $OrderUrl = '';              // 按XX排序的url
        //============================= 直接选择的栏目
        if( isset($_GET['code']) ){
            $code = $_GET['code'];
            $where = "`code` = '$code'";
            $CurFilte = '栏目：“'.$colArr[$code].'”';
            $OrderUrl = 'code='.$code;
        }
        //============================ 填写的搜索关键字
        if( isset($_GET['filteby']) ){
            $filter = $_GET['filteby'];
            $kw = $_GET['kw'];
            $OrderUrl = 'filteby='.$filter.'&kw='.$kw;
            switch ($filter) {
                case 'title':
                    $filter = '标题';
                    $where = "`etitle` like '%$kw%'";
                    break;
                case 'from':
                    $filter = '作者/来源';
                    $where = "`efrom` like '%$kw%'";
                    break;
                case 'admin':
                    $filter = '发布者';
                    $where = "`aname` like '%$kw%'";
                    break;
                default:
                    break;
            }
            $CurFilte = "$filter :“ $kw ”";
        }
        
        //////////////////// 排序方式
        if( !empty($OrderUrl) ){
            $OrderUrl .= '&';
        }
        $PageParam = $OrderUrl;
        if( isset($_GET['order']) ){
            $PageParam .= ('order='.$_GET['order'].'&');
            switch ($_GET['order']) {
                case 'read':
                    $order = '`etimes` desc';
                    break;
                case 'revise':
                    $order = '`erevise` desc';
                    break;
                case 'build':
                default:
                    break;
            }
        }

        $PageParam = '';        // 分页链接的url，$PageParam = $OrderUrl.'&order=X'
        $PageSize = 10;         // 每页记录数量
        $count = 0;
        $CurPage = 1;           // 当前页码，默认 1
        $PageStr = '';          // 最终输出到模版
        if( isset($_GET['p']) && is_numeric($_GET['p']) ){
            $CurPage = intval($_GET['p']);
        }
        $offset = ($CurPage-1)*$PageSize;
        $limit = "$offset , $PageSize";
        
        
        // 对get条件进行相应的查询
        $essay = M('essay');

        $count = $essay->where($where)->count();
        $PageNum = intval( $count/$PageSize ) + 1;

        $PageStr = "$count 条记录 $CurPage / $PageNum 页";
        if( $CurPage > 1 ){
            $PageStr .= '<a href="AllEssay?'.$PageParam.'p='.($CurPage-1).'">上一页</a>';
        }
        if( $CurPage < $PageNum ){
            $PageStr .= '<a href="AllEssay?'.$PageParam.'p='.($CurPage+1).'">下一页</a>';
        }
        if( $PageNum > 1 ){
            for( $i=1; $i <= $PageNum; $i++ ){
                if($i == $CurPage){
                    $PageStr .= "$i";
                }else{
                    $PageStr .= '<a href="AllEssay?'.$PageParam.'p='.$i."\">$i</a>";
                }
            }
        }

        $list = $essay->where($where)->order($order)->limit($limit)->select();
        // 接下来对查询出来，符合条件的记录进行处理
        foreach( $list as &$val ){
            $val['code'] = $colArr[$val['code']];

            $val['ebuild'] = date('Y-m-d', strtotime($val['ebuild']));
            $val['erevise'] = date('Y-m-d', strtotime($val['erevise']));
        }

        $this->assign('CurFilte', $CurFilte);
        $this->assign('orderUrl', $OrderUrl);
        $this->assign('page', $PageStr);
        $this->assign('count', $count);     // 输出筛选出多少条记录
        $this->assign('list',$list);
        $this->getColumn();
        $this->display();
    }

    public function BuildEssay(){
        $this->setPageOption('写新文章');
        $isRevise = '0';      // 用于标记是否是修改文章，以通知前台js进行相应处理
        if( isset($_GET['eid']) && is_numeric($_GET['eid']) ){
            $isRevise = '1';
            $eid = $_GET['eid'];
            $essay = M('essay');
            $theOne = $essay->where("eid = $eid")->find();
            $edetail = $theOne['edetail'];
            unset($theOne['edetail']);

            $column = M('column');
            $sub = $theOne['code'];
            $par = $column->where("code = '$sub'" )->find();

            $this->assign('par', $par['cparent']);      // 用于前台选中当前文章所在栏目的父栏目
            $this->assign('sub', $theOne['code']);      // 子栏目
            $this->assign('detail', $edetail);      // 文章正文
            $this->assign('essay', json_encode($theOne));   // 以json格式传递给前台页面，前台js处理
        }
        $this->getColumn();
        $this->assign('isRevise', $isRevise);
        $this->display();
    }

    /**
     * 文章AJAX上传，返回值$ret[]参数如下：
     * error：0，没有错误；1，有错误；
     * info：若正确，返回跳转路径；如错误，为错误信息；
     */
    public function  SaveEssay(){
       // dump($_POST);
        if( $_POST ){
            $ret = array();
            if( empty($_POST['edetail']) || empty($_POST['etitle'])
                || empty($_POST['efrom']) ){

                $ret['error'] = 1;
                $ret['info'] = '请将表单填写完整';
                $this->ajaxReturn($ret,'JSON');
                return;
            }
           $data['edetail'] = $_POST['edetail'];
            $data['etitle'] = $_POST['etitle'];
            $data['efrom'] = $_POST['efrom'];
           // $data['code'] = $_POST['code'];
            $code = $_POST['code'];
            if($code == '0'){
                $data['code'] = $_POST['cpar'];
            }else{
                $data['code'] = $_POST['code'];
            }

            $essay = M('Essay');
            if( isset($_GET['eid']) && is_numeric($_GET['eid']) ){
                $eid = $_GET['eid'];
                $where['eid'] = $eid;
                $result = $essay->where($where)->save($data);
            }else{
                $data['ebuild'] = date("Y-m-d H:i:s",time());
                $data['aname'] = session('adminName');

                $id=$essay->create($data);
               //  dump($id);
                $result= $essay->add();
               // dump($essay->getLastSql());
               //  dump($result);
               //  exit;

            }
           
            //////////////////////////////////////////////////
            if( $result === false ){
                $ret['error'] = 1;
                $ret['info'] = '文章保存失败，请重试！';
            }else{
                $ret['error'] = 0;
                $ret['info'] ='AllEssay';
            }
            $this->ajaxReturn($ret,'JSON');
        }else{
            $this->redirect('AllEssay');
        }
    }

    ////////////////////////////// 删除文章
    public  function DeleteEssay(){
        if( isset($_GET['eid']) && is_numeric($_GET['eid']) ){
            $eid = $_GET['eid'];
            $essay = M('essay');
            if( $essay->where("eid = $eid")->delete() === false ){
                $this->setError('删除时发生错误！请重试……');
            }else{
                $this->setSuccess('删除成功！');
            }
        }
        $this->redirect('AllEssay');
    }

    ///////////////////////////// 编辑器上传图片等内容
    public function upload_json(){
        import('ORG.Net.UploadFile');
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小，3M
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './essay/';// 设置附件上传目录
        $upload->autoSub = true;
        $upload->subType = 'date';
        if(!$upload->upload()) {// 上传错误提示错误信息
            $data['error'] = 1;
            $data['message'] = $upload->getError();
        }else{// 上传成功
            $fileinfo = $upload->getUploadFileInfo();
            $data['error'] = 0;
            $data['url'] = '../../Uploads/essay/'.$fileinfo[0]['savename'];
        }
        $this->ajaxReturn($data,'JSON');
    }
}