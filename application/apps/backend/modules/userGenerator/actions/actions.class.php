<?php

/**
 * userGenerator actions.
 *
 * @package    Scotworks
 * @subpackage userGenerator
 * @author     Y.Goncharuck
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userGeneratorActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	$this->form = new sfForm();
  	$this->form->setWidgets(array(
    	'login_prefix'    => new sfWidgetFormInputText(array('default' => 'attendee')),
    	'start_number'   => new sfWidgetFormInputText(array('default' => '1')),
    	'amount'   => new sfWidgetFormInputText(array('default' => '10')),
	));
	$this->form->getWidgetSchema()->setNameFormat('generate[%s]');
	$this->form->setValidators(array(
    	'login_prefix'    => new sfValidatorString(array('min_length' => 5, 'required' => true)),
    	'start_number'   => new sfValidatorInteger(array('min' => 1, 'required' => true)),
    	'amount'   => new sfValidatorInteger(array('min' => 1, 'max'=>1000, 'required' => true)),
	));

	if($request->isMethod('post')) {
		$this->form->bind($request->getParameter('generate'));

  		if($this->form->isValid()) {
			$params = $this->form->getValues();
			UserPeer::generateUsers($params['login_prefix'], $params['start_number'], $params['amount']);
			$this->getUser()->setFlash('notice', $params['amount'].' users have been generated.', false);
			$this->redirect('user');
		} else {
			$this->getUser()->setFlash('error', 'Users has not been generated due to some errors.', false);
		}

	}
  }
}
