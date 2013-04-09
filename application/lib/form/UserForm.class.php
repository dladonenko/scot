<?php

/**
 * User form.
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
class UserForm extends BaseUserForm
{
  public function configure()
  {
	$this->setWidget('created_at', new myWidgetFormPlainDate());
	$this->setWidget('updated_at', new myWidgetFormPlainDate());

	$this->widgetSchema->setHelp('login', 'Login should contain from 5 to 50 characters');
	$this->widgetSchema->setHelp('password', 'Password should contain from 6 to 50 characters');

	$this->setValidator('login', new sfValidatorString(array('min_length' => 5, 'max_length' => 50)));
    $this->setValidator('password', new sfValidatorString(array('min_length' => 6, 'max_length' => 50)));

    $this->validatorSchema->setPostValidator(new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('login'))));

	unset($this->validatorSchema['created_at']);
	unset($this->validatorSchema['updated_at']);

	$this->validatorSchema->setOption('allow_extra_fields', true);


  }
}
