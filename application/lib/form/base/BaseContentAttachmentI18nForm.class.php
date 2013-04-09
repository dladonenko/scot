<?php

/**
 * ContentAttachmentI18n form base class.
 *
 * @method ContentAttachmentI18n getObject() Returns the current form's model object
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
abstract class BaseContentAttachmentI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'filename'          => new sfWidgetFormInputText(),
      'original_filename' => new sfWidgetFormInputText(),
      'id'                => new sfWidgetFormInputHidden(),
      'culture'           => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'filename'          => new sfValidatorString(array('max_length' => 255)),
      'original_filename' => new sfValidatorString(array('max_length' => 255)),
      'id'                => new sfValidatorPropelChoice(array('model' => 'ContentAttachment', 'column' => 'id', 'required' => false)),
      'culture'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getCulture()), 'empty_value' => $this->getObject()->getCulture(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('content_attachment_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContentAttachmentI18n';
  }


}
