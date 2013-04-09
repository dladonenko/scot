<?php

/**
 * freeContent module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage freeContent
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFreeContentGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array(  '_edit' => NULL,  'import' =>   array(    'label' => 'Import',    'action' => 'import',  ),  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%id%% - %%name%% - %%version%% - %%created_at%% - %%updated_at%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Free content';
  }

  public function getEditTitle()
  {
    return 'Edit free content %%name%%';
  }

  public function getNewTitle()
  {
    return 'Create free content';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'created_at',  1 => 'updated_at',);
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array(  'General' =>   array(    0 => 'i18n',  ),  'Info' =>   array(    0 => 'created_at',    1 => 'updated_at',  ),  'Attachments' =>   array(    0 => 'attachments',  ),);
  }

  public function getNewDisplay()
  {
    return array(  0 => 'zip_archieve',);
  }

  public function getListDisplay()
  {
    return array(  0 => 'id',  1 => 'name',  2 => 'version',  3 => 'created_at',  4 => 'updated_at',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'is_free' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'is_free' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'is_free' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'is_free' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'i18n' => array(  'label' => 'Content',),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'is_free' => array(),
      'created_at' => array(  'attributes' =>   array(    'disabled' => true,  ),),
      'updated_at' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'is_free' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'FreeContentForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'contentFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfPropelPager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getPeerMethod()
  {
    return 'getFreeOfCulture';
  }

  public function getPeerCountMethod()
  {
    return 'getFreeCount';
  }
}
