<?php

class Debug {
	protected $data;

	public function __construct() {
		array_shift($this->data);
	}

	public function show($paramsToDisplay) {

			foreach($paramsToDisplay as $paramName) {
			}
			echo '</hr>';
		}
	}
}

?>