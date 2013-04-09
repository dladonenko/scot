<?php

/**
 * freeContent module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage freeContent
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseFreeContentGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'freeContent' : 'freeContent_'.$action;
  }
}
