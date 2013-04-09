<?php

/**
 * Content form.
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
class ContentZipForm extends BaseContentForm
{
	public function configure()
  	{

	 	unset($this->widgetSchema['is_free']);
 	 	unset($this->widgetSchema['created_at']);
  	 	unset($this->widgetSchema['updated_at']);

 	 	unset($this->validatorSchema['is_free']);
 	 	unset($this->validatorSchema['created_at']);
  	 	unset($this->validatorSchema['updated_at']);

  	 	$this->setWidget('zip_archieve', new sfWidgetFormInputFile());

		$this->setValidator('zip_archieve', new sfValidatorFile(array(
  	 		'required'=>true,
  	 		'path'=>ContentAttachment::getBaseDirPath(),
  	 		'max_size'=>sfConfig::get('app_content_import_max_size'),
  	 		'mime_types'=>array('application/zip'))));

		$this->validatorSchema->setOption('allow_extra_fields', true);
		$this->validatorSchema->setOption('filter_extra_fields', false);
	}

	protected function doUpdateObject($values)
	{
		//var_dump($values);
		//die();
		$this->getObject()->setCulture($this->getOption('culture'));
		parent::doUpdateObject($values);
		$this->getObject()->setVersion($this->getObject()->getVersion()+1);

		$archieve = $this->getValue('zip_archieve');

		$zip = new ZipArchive();
        if($zip->open($archieve->getTempName()) === TRUE) {
			$importDir=$this->getObject()->createImportDir();
            $zip->extractTo($importDir);
            $zip->close();

   			$finder = sfFinder::type('file')->name('*.htm');
   			$files = $finder->in($importDir);
   			if(isset($files[0])) {
   				$baseFile=$files[0];

   				$finder = sfFinder::type('file')->not_name('*.htm');
   				$attachments=$finder->in($importDir);

   				$this->getObject()->import($baseFile, $attachments, sfConfig::get('app_content_import_text_encoding'));
            }
            //unlink($importDir);
   		}
   	}

}




