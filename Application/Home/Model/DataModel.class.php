<?php
namespace Home\Model;
use Think\Model;
class DataModel extends Model{
	protected $tablePrefix = 'tbl_';
	
	protected $connection = array (
			'db_type' => 'mysql',
			'db_user' => 'root',
			'db_pwd' => '',
			'db_port' => '3306',
			'db_prefix' => 'tbl_', // 数据库表前缀
			'db_dsn'    => 'mysql:host=localhost;dbname=dedecms;charset=utf8',
	);
}