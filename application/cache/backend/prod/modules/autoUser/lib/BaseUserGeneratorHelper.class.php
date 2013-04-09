<?php

/**
 * user module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage user
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseUserGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'user' : 'user_'.$action;
  }
}
