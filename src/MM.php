<?php

class MM{
	
	private $app_id;
	private $private_key;
	private $secret_key;
	
	public function __construct($app_id, $private_key, $secret_key){
		 $this->app_id=$app_id;
		 $this->private_key=$private_key;
		 $this->secret_key=$secret_key;
	}
	
	public function app_id(){
		return $this->app_id;
	}	
}
