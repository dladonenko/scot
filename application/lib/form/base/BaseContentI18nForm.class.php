<?php

/**
 * ContentI18n form base class.
 *
 * @method ContentI18n getObject() Returns the current form's model object
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
abstract class BaseContentI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'    => new sfWidgetFormInputText(),
      'version' => new sfWidgetFormInputText(),
      'text'    => new sfWidgetFormTextarea(),
      'id'      => new sfWidgetFormInputHidden(),
      'culture' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'name'    => new sfValidatorString(array('max_length' => 255)),
      'version' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'text'    => new sfValidatorString(),
      'id'      => new sfValidatorPropelChoice(array('model' => 'Content', 'column' => 'id', 'required' => false)),
      'culture' => new sfValidatorChoice(array('choices' => array($this->getObject()->getCulture()), 'empty_value' => $this->getObject()->getCulture(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('content_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContentI18n';
  }


}
