<?php

/**
 * ContentAttachment form base class.
 *
 * @method ContentAttachment getObject() Returns the current form's model object
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
abstract class BaseContentAttachmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'content_id' => new sfWidgetFormPropelChoice(array('model' => 'Content', 'add_empty' => false)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'ContentSequence', 'column' => 'id', 'required' => false)),
      'content_id' => new sfValidatorPropelChoice(array('model' => 'Content', 'column' => 'id')),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('content_attachment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContentAttachment';
  }

  public function getI18nModelName()
  {
    return 'ContentAttachmentI18n';
  }

  public function getI18nFormClass()
  {
    return 'ContentAttachmentI18nForm';
  }

}
