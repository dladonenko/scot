<?php

/**
 * freeContent module configuration.
 *
 * @package    Scotworks
 * @subpackage freeContent
 * @author     Y.Goncharuck
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class freeContentGeneratorConfiguration extends BaseFreeContentGeneratorConfiguration
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

  /*
    public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }
  */

  public function getImportTitle()
  {
    return 'Import content %%name%%';
  }

  /*
    public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'is_free' => array(),
      'created_at' => array(  'attributes' =>   array(    'disabled' => true,  ),),
      'updated_at' => array(),
    );
  }
  */


}
