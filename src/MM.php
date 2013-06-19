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

    public function api($method, $params){
        $params['app_id'] = $this->app_id;
        $params['method'] = $method;
        $params['format'] = 'json';
        $params['secure'] = 1;
        $params['sig']=$this->sign($params);

        $response=file_get_contents('http://www.appsmail.ru/platform/api?'.http_build_query($params));
        if(!$response=json_decode($response)){
            throw new MMException('MM API error');
        }
        return $response;
    }



    public function sign($params){
        $sign='';
        ksort($params);
        foreach($params as $key=>$value){
            if('sig' == $key){
                continue;
            }
            $sign.=$key.'='.$value;
        }
        $sign.=$this->secret_key;
        return md5($sign);
    }
}
