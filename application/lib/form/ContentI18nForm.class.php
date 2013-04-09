<?php

/**
 * ContentI18n form.
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
class ContentI18nForm extends BaseContentI18nForm
{
	public function configure() {
		$this->setWidget('text', new sfWidgetFormTextareaTinyMCE(array('theme'=>'simple', 'width'=>300, 'height'=>50)));
		$this->setWidget('version', new myWidgetFormPlainText());

		unset($this->validatorSchema['version']);

		$this->validatorSchema->setOption('allow_extra_fields', true);
		//$this->validatorSchema->setOption('filter_extra_fields', false);

	}
}
