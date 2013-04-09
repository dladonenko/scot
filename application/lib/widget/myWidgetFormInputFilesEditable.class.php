<?php

/**
 * Abstract widget class for displaying plain text data in the form
 *
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
class myWidgetFormInputFilesEditable extends myWidgetFormInputFileEditable
{
	protected function configure($options = array(), $attributes = array()) {
		parent::configure($options, $attributes);

		$this->addOption('files_divider', '<br/><br/>');

	}


	public function render($name, $value = null, $attributes = array(), $errors = array()) {
        $files=$this->getOption('file_src');
        $returnPlain='';
    	foreach($files as $i=>$file) {
    	   	$nestedWigdetOptions=$this->getOptions();
    		$nestedWigdetOptions['file_src']=$file;
    		unset($nestedWigdetOptions['files_divider']);
    		$nestedWidget=new myWidgetFormInputFileEditable($nestedWigdetOptions);
    		$nestedWidgetName=$name.'['.$i.']';
    		$nestedWidgetPlain=$nestedWidget->render($nestedWidgetName, $value, $attributes, $errors);

    		$returnPlain.=$nestedWidgetPlain.$this->getOption('files_divider');
    	}
    	return $returnPlain;
	}
}
