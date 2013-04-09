<?php

/**
 * paidContent module configuration.
 *
 * @package    Scotworks
 * @subpackage paidContent
 * @author     Y.Goncharuck
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class paidContentGeneratorConfiguration extends BasePaidContentGeneratorConfiguration
{
  public function getForm($object = null, $options = array())
  {
    $culture=sfContext::getInstance()->getUser()->getAttribute('culture', sfConfig::get('app_culture_default'), 'backend');
    $options=array_merge($options, array('culture'=>$culture));
    return parent::getForm($object, $options);
  }

  public function getImportDisplay()
  {
    return array(  0 => 'zip_archieve',);
  }

  public function getImportActions()
  {
    return array();
  }

  public function getImportTitle()
  {
    return 'Import content %%name%%';
  }

}
