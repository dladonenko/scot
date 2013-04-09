<?php

/**
 * Config filter form base class.
 *
 * @package    Scotworks
 * @subpackage filter
 * @author     Y.Goncharuck
 */
abstract class BaseConfigFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'value' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'code'  => new sfValidatorPass(array('required' => false)),
      'value' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('config_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Config';
  }

  public function getFields()
  {
    return array(
      'id'    => 'Number',
      'code'  => 'Text',
      'value' => 'Number',
    );
  }
}
