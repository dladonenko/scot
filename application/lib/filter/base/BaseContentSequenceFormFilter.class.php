<?php

/**
 * ContentSequence filter form base class.
 *
 * @package    Scotworks
 * @subpackage filter
 * @author     Y.Goncharuck
 */
abstract class BaseContentSequenceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'type' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'type' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('content_sequence_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContentSequence';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'type' => 'Number',
    );
  }
}
