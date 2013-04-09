<?php

class EncryptorAES extends EncryptorAbstract {

	const ALGHORITHM='rijndael-128';
	const MODE=MCRYPT_MODE_ECB;

	protected $initVector;

	public function __construct() {
		$this->descriptor = mcrypt_module_open(self::ALGHORITHM, '', self::MODE, '');
   		//$this->initVector = mcrypt_create_iv(mcrypt_enc_get_iv_size($this->descriptor), MCRYPT_RAND);

	}

	public function __destruct() {
		 mcrypt_module_close($this->descriptor);
	}


	protected function doEncrypt(&$text) {
         $this->doPadding($text);
      	 @mcrypt_generic_init($this->descriptor, $this->secretKey, 0);
		 $text=mcrypt_generic($this->descriptor, $text);
		 mcrypt_generic_deinit($this->descriptor);

	}

	protected function doEncrypt2(&$text) {
		 $text=mcrypt_encrypt(self::ALGHORITHM, $this->secretKey, $text, self::MODE);

	}

	protected function doDecrypt(&$text) {
		 mcrypt_generic_init($this->descriptor, $this->secretKey, 0);
		 $text=mdecrypt_generic($this->descriptor, $text);
		 mcrypt_generic_deinit($this->descriptor);

    }


}
