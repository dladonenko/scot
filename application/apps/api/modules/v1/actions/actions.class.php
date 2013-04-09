<?php

/**
 * v1 actions.
 *
 * @package    Scotworks
 * @subpackage v1
 * @author     Y.Goncharuck
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class v1Actions extends sfActions
{

   	private $v2Mode = false;

    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
	public function executeIndex(sfWebRequest $request) {
    	$this->forward('default', 'module');
	}

  	public function preExecute() {

		if($this->getActionName()!='login') {
	    	$sessionKey=$this->getRequestParameter('userid');

 			$user=UserPeer::retrieveBySessionKey($sessionKey);

	    	if($user) {
	    		$this->getUser()->signIn($user);
	    	}
	   	}

	   	if($this->getRequestParameter('v2_mode')) $this->v2Mode = true;
	   	//var_dump($this->v2Mode);

		$this->setTemplate('response');
	}

	public function postExecute() {


	}

	public function executeLogin(sfWebRequest $request) {

		$this->apiResponse=array();

 		$userLogin=$this->getRequestParameter('login');

		$this->apiResponse['login']=$userLogin;
		$user=UserPeer::retrieveByLogin($userLogin);

		if($user) {
			if($hash=$this->getRequestParameter('hash')) {
				if($user->checkAuthHash($hash, $this->getUser()->getAttribute('salt'))) {
					$user->generateSessionKey();
					$this->getUser()->signIn($user);
					$this->apiResponse['auth']='ok';
					$this->apiResponse['userid']=$user->getSessionKey();

                    $this->getPaidContentList($this->getRequestParameter('culture', sfConfig::get('app_culture_default')));

                } else {
					$this->apiResponse['auth']='fail';
				}
			}
			else {
				$salt=$user->generateSalt();
				$this->getUser()->setAttribute('salt', $salt);
				$this->apiResponse['salt']=(string)$salt;
				$this->apiResponse['auth']='ok';

			}

		} else {
			$this->apiResponse['auth']='fail';
		}

		$this->apiResponse=json_encode($this->apiResponse);
		return sfView::SUCCESS;
	}

	protected function getPaidContentList($culture) {


		$this->apiResponse['items']=array();
		$items=ContentPeer::getPaid(null, null, true);
		foreach($items as $item) {
		    $item->setCulture($culture);
		    if(!$item->getName()) continue;
		    $itemRecord=&$this->apiResponse['items'][];

      		$itemRecord['id']=$item->getId();
			$itemRecord['name']=$item->getName();

			$attachments=$item->getAttachmentsFiles($culture, null, 'getOriginalFilename');
			if($this->v2Mode) {
				if(count($attachments)==0) $attachments = (object) $attachments;
				$itemRecord['attachments']=$attachments;
			} else {
				foreach($attachments as $id=>$file) {
              		$attachmentRecord=&$itemRecord['attachments'][];
               		$attachmentRecord['id']=$id;
               		$attachmentRecord['filename']=$file;
            	}
			}

		}

	}

	protected function getFreeContentList($culture) {

		$this->apiResponse['items']=array();
		$this->apiResponse['generalversion']=ConfigPeer::getFreeGeneralVersion()->getValue();
		$items=ContentPeer::getFree(null, null, true);
		foreach($items as $item) {
		    $item->setCulture($culture);
			if(!$item->getName()) continue;
		    $itemRecord=&$this->apiResponse['items'][];

      		$itemRecord['id']=$item->getId();
			$itemRecord['name']=$item->getName();
			$itemRecord['version']=$item->getVersion();

			$attachments=$item->getAttachmentsFiles($culture, null, 'getOriginalFilename');
			if($this->v2Mode) {
				if(count($attachments)==0) $attachments = (object) $attachments;
				$itemRecord['attachments']=$attachments;
			} else {
				foreach($attachments as $id=>$file) {
              		$attachmentRecord=&$itemRecord['attachments'][];
               		$attachmentRecord['id']=$id;
               		$attachmentRecord['filename']=$file;
            	}
			}

        }

	}

	public function executeGetFree() {
		$this->apiResponse=array();
		$this->getFreeContentList($this->getRequestParameter('culture', sfConfig::get('app_culture_default')));
		$this->apiResponse=json_encode($this->apiResponse);
		return sfView::SUCCESS;
	}


	public function executeGet(sfWebRequest $request) {

		$this->apiResponse='';

		if($contentId=$this->getRequestParameter('contentid')) {

			$content=ContentPeer::retrieveByPK($contentId);
			$culture=$this->getRequestParameter('culture', sfConfig::get('app_culture_default'));


   			if($content) {

   			    $content->setCulture($culture);

   			    if(!$content->getIsFree()) {
   			     	if(!$this->getUser()->isAuthorized()) {
   			        	$this->redirect404();
   			        }
   			    	$this->apiResponse=$content->getCryptedText($this->getUser()->getUser());
   			    	//var_dump($this->apiResponse);
   			    } else {
   			    	$this->apiResponse=$content->getPlainText();
   			    }

			    $fileName=$content->getId().'.html';
	   			$this->getResponse()->setHttpHeader('Content-Type', 'application/octet-stream');
	   			$this->getResponse()->setHttpHeader('content-disposition', 'attachment; filename="'.$fileName.'"');

	   			return sfView::SUCCESS;
	   		}

	   		$attachment=ContentAttachmentPeer::retrieveByPK($contentId);

	   		if($attachment) {

	   			$attachment->setCulture($culture);
	   			if(!$attachment->getFilename()) {
	   				//$attachment->setCulture(sfConfig::get('app_culture_default'));
	   			}
	   			if(!$attachment->getFilename()) {
	   				$this->redirect404();
	   			}

	   			if(!$attachment->getIsFree() && !$this->getUser()->isAuthorized()) {
					$this->redirect404();
	   			}



	   			//var_dump($attachment->getFullFilePath());
	   			//die();

	   			$this->apiResponse=file_get_contents($attachment->getFullFilePath());

	   		    $fileName=$attachment->getOriginalFilename();
	   			$this->getResponse()->setHttpHeader('Content-Type', 'application/octet-stream');
	   			$this->getResponse()->setHttpHeader('content-disposition', 'attachment; filename="'.$fileName.'"');

	   		    return sfView::SUCCESS;
	   		}

	   		$this->redirect404();
        } else {
	   		$this->redirect404();
	   	}

	}

	public function getRequestParameter($name, $default=null) {
		$value=parent::getRequestParameter($name, $default);
		if($value) {
			$tmp=explode(';', $value);
			$value=$tmp[0];
		}
		return $value;
	}


}
