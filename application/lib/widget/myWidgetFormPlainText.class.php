<?php

/**
 * Widget class for displaying plain text data in the form
 *
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
class myWidgetFormPlainText extends myWidgetFormPlain
{
  /**
   * Configures the current widget.
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    //$this->setAttribute('rows', 4);
    //$this->setAttribute('cols', 30);
  }

  protected function formatValue($value)
  {
  	return $value;
  }
}
