<?php

/**
 * ContentI18n filter form base class.
 *
 * @package    Scotworks
 * @subpackage filter
 * @author     Y.Goncharuck
 */
abstract class BaseContentI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'version' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'text'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'    => new sfValidatorPass(array('required' => false)),
      'version' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'text'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('content_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContentI18n';
  }

  public function getFields()
  {
    return array(
      'name'    => 'Text',
      'version' => 'Number',
      'text'    => 'Text',
      'id'      => 'ForeignKey',
      'culture' => 'Text',
    );
  }
}
