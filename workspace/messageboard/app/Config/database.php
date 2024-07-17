<?php
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'db',
		'login' => 'user',
		'password' => 'user',
		'database' => 'messageboard',
	);
	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'db',
		'login' => 'user',
		'password' => 'user',
		'database' => 'messageboard',
	);
	public $cakephp_db = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'db',
		'port' => 3306,
		'login' => 'user',
		'password' => 'user',
		'database' => 'messageboard',
	);
}
