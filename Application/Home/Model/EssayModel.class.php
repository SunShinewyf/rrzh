<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class PictureModel extends RelationModel{
     protected $tableName = 'Picture';
     protected $_link = array(
       'Column' => array(
       'mapping_type'  => self::BELONGS_TO,
       'foreign_key'   => 'code',
       'mapping_fields'=>'cname,cparent',
      ),
    );
}
?>