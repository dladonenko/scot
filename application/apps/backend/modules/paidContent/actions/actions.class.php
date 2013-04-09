<?php

require_once dirname(__FILE__).'/../lib/paidContentGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/paidContentGeneratorHelper.class.php';

/**
 * paidContent actions.
 *
 * @package    Scotworks
 * @subpackage paidContent
 * @author     Y.Goncharuck
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class paidContentActions extends autoPaidContentActions
{
	public function executeImport(sfWebRequest $request) {
    	$contentId = $request->getParameter('id');
		$this->content = ContentPeer::retrieveByPK($contentId);
		if(!$this->content) $this->forward404();

		$culture=$this->getUser()->getAttribute('culture', sfConfig::get('app_culture_default'), 'backend');
   		$this->form = new contentZipForm($this->content, array('culture'=>$culture));

		if($request->isMethod('put')) {
  			$this->form->bind($request->getParameter('content'), $request->getFiles('content'));

			if($this->form->isValid())	{
				$this->form->save();
				$this->redirect(array('sf_route' => 'paidContent_edit', 'sf_subject' => $this->content));
			} else {

			}
		}

	}


}
