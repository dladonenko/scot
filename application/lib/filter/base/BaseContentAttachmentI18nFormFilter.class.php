<?php

/**
 * ContentAttachmentI18n filter form base class.
 *
 * @package    Scotworks
 * @subpackage filter
 * @author     Y.Goncharuck
 */
abstract class BaseContentAttachmentI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'filename'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'original_filename' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'filename'          => new sfValidatorPass(array('required' => false)),
      'original_filename' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('content_attachment_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContentAttachmentI18n';
  }

  public function getFields()
  {
    return array(
      'filename'          => 'Text',
      'original_filename' => 'Text',
      'id'                => 'ForeignKey',
      'culture'           => 'Text',
    );
  }
}
