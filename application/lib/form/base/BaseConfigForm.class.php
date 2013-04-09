<?php

/**
 * Config form base class.
 *
 * @method Config getObject() Returns the current form's model object
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
abstract class BaseConfigForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'    => new sfWidgetFormInputHidden(),
      'code'  => new sfWidgetFormInputText(),
      'value' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'code'  => new sfValidatorString(array('max_length' => 50)),
      'value' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('config[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Config';
  }


}
