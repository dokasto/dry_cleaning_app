<?php
class ArrToObj extends ArrayObject{

	public function __get($key){
	return $this[$key];
	}

	public function __set($key,$val){
	$this[$key] = $val;
	}
}
?>