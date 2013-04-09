<?php

/**
 * paidContent module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage paidContent
 * @author     ##AUTHOR_NAME##
 */
abstract class BasePaidContentGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'paidContent' : 'paidContent_'.$action;
  }
}
