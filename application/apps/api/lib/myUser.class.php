<?php

class myUser extends sfBasicSecurityUser {

	private $user;
	private $isAuthorized=false;

	public function getUser() {
		return $this->user;
	}

	public function signIn(User $user) {
		$this->user=$user;
		$this->isAuthorized=true;
	}

	public function isAuthorized() {
		return $this->isAuthorized;
	}
}
