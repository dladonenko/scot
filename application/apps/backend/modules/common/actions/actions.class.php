<?php

class commonActions extends sfActions
{
	public function executeChangeLanguage(sfWebRequest $request) {
		$culture=$this->getUser()->getAttribute('culture', sfConfig::get('app_culture_default'), 'backend');
		$this->form = new myFormLanguage(
			$culture,
			array('languages' => sfConfig::get('app_culture_list'))
		);

		if($newCulture = $this->form->process($request)) {
        	$this->getUser()->setAttribute('culture', $newCulture, 'backend');
		}

		$redirectUri=$this->form->getValue('redirect_uri');
		return $this->redirect($redirectUri);
	}

}
