<?php

/**
 * Singleton pattern restricts the instantiation of a class to one object
 * This is only useful when exaclly one object is needed
 */


class Singleton {


	private static $instance;


	public static function getInstance()
	{
		if(self::$instance === null){
			self::$instance = new static;
		}


		return self::$instance;
	}

	protected function __construct(){}
	protected function __clone(){}

}


class Config extends Singleton {

	public  $data = [
		'db' => [
			'host'	=>	'127.0.0.1'
		]

	];
}




$configOne = Config::getInstance();
$configTwo = Config::getInstance();


// This will throw an error
//$configThree = new Config();
//$configThree = clone $configOne;

var_dump($configOne === $configTwo);