<?php

/**
 * Content form.
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
class ContentForm extends BaseContentForm
{
  public function configure()
  {

  	 $this->setWidget('created_at', new myWidgetFormPlainDate());
  	 $this->setWidget('updated_at', new myWidgetFormPlainDate());
  	 $this->setWidget('zip_archieve', new sfWidgetFormInputFile());
  	 //$this->setWidget('is_free', new sfWidgetFormInputCheckbox());

 	 unset($this->validatorSchema['created_at']);
  	 unset($this->validatorSchema['updated_at']);

	 if ($this->getObject()->isNew()) {

  	 	$this->setValidator('zip_archieve', new sfValidatorFile(array(
  	 		'required'=>true,
  	 		'path'=>ContentAttachment::getBaseDirPath(),
  	 		'max_size'=>sfConfig::get('app_content_import_max_size'),
  	 		'mime_types'=>array('application/zip'))));

  	 } else {

  	 	$this->embedSingleI18n('i18n', $this->getOption('culture'));

  	 	$attachmentsFiles=$this->getObject()->getAttachmentsFiles($this->getOption('culture'));
  	 	foreach($attachmentsFiles as &$file) {
  	 		$file=sfConfig::get('app_upload_dir_name').sfConfig::get('app_content_attachments_path').$file;
  	 	}
  	 	$this->setWidget('attachments', new myWidgetFormInputFilesEditable(array('file_src'=>$attachmentsFiles)));

  	 }

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

      if ($archieve) {
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



}
