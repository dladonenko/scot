<?php


/**
 * Skeleton subclass for representing a row from the 'content_attachment' table.
 *
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 04/14/11 16:05:02
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ContentAttachment extends BaseContentAttachment {

	protected $source;

	public static function getBaseDirPath() {
		//var_dump(sfConfig::get('app_content_attachments_path'));
	    return sfConfig::get('sf_upload_dir').sfConfig::get('app_content_attachments_path');

	}


	public function getFullFilePath() {
	    return self::getBaseDirPath().$this->getFilename();

	}

	public function getIsFree() {
		return $this->getContent()->getIsFree();
	}

	public function setSource($source) {
		$this->source=$source;
	}

	public function preInsert(PropelPDO $con = null) {

		$sequence=new ContentSequence();
		$sequence->setType(ContentSequence::CONTENT_TYPE_ATTACHMENT);
		$sequence->save();

		$this->setId($sequence->getId());
		$this->setUpdatedAt(time());

		$this->rename();
		$this->copyFile();
		return true;

	}

	public function __toString() {
		return $this->getFilename();
	}

	protected function rename() {
		$this->setOriginalFilename($this->getFilename());
		$this->setFilename($this->getId().'_'.$this->getCulture().'_'.$this->getFilename());

	}

	protected function copyFile() {
		if($this->source && is_file($this->source)) {
		 	$destination=self::getBaseDirPath().$this->getFilename();
		 	copy($this->source, $destination);

			return true;
		} else {
			return false;
		}
	}

} // ContentAttachment
