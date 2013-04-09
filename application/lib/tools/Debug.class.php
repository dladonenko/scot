<?php

class Debug {
	protected $data;

	public function __construct() {		$this->data=debug_backtrace();
		array_shift($this->data);
	}

	public function show($paramsToDisplay) {
		foreach($this->data as $index=>&$values) {			echo '<b>Call '.$index.'</b></br>';
			foreach($paramsToDisplay as $paramName) {	        	echo $paramName.': '.$values[$paramName].'</b></br>';
			}
			echo '</hr>';
		}
	}
}

?>