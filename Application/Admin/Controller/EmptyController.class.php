<?php
/**
 *
 * Created by shhider(734459639)
 * Date: 14-3-31
 */
namespace Admin\Controller;
use Think\Controller;
class EmptyController extends Controller{
    public function index(){
        echo '404';
        //$this->display('Public:404');
    }
}