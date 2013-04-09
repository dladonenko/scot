<?php

class commonComponents extends sfComponents
{
	public function executeLanguage(sfWebRequest $request) {
		$culture=$this->getUser()->getAttribute('culture', sfConfig::get('app_culture_default'), 'backend');
		$this->form = new myFormLanguage(
			$culture,
			array('languages' => sfConfig::get('app_culture_list'),
				 'redirect_uri'=> $request->getUri())
		);

	}
}
