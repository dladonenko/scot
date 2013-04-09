<?php

/**
 * Widget class for displaying plain text data in the form
 *
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
class myWidgetFormPlainDate extends myWidgetFormPlain
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
    $this->addOption('date_format', 'f');
  }

  protected function formatValue($value)
  {
  	return format_date($value, $this->getOption('date_format'));
  }
}
