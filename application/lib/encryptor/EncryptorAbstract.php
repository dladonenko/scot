<?php

abstract class EncryptorAbstract implements EncryptorInterface {

	protected $descriptor;
	protected $secretKey;

	public function setSecretKey($key) {
		$this->secretKey=$key;
	}

	public function encrypt(&$text) {
		return $this->doEncrypt($text);

	}

	public function decrypt(&$text) {
		return $this->doDecrypt($text);

	}

	protected function getBlockSize() {
		return mcrypt_enc_get_block_size($this->descriptor);
	}

	protected function doPadding(&$text, $paddingSymbol=' ') {
		$blockSize=$this->getBlockSize();
		$bytesToPad=$blockSize - (strlen($text) % $blockSize);
		$text.=str_repeat($paddingSymbol, $bytesToPad);
   	}

	abstract protected function doEncrypt(&$text);

	abstract protected function doDecrypt(&$text);

}
