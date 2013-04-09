<?php

/**
 * Abstract widget class for displaying plain text data in the form
 *
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
abstract class myWidgetFormPlain extends sfWidgetForm
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

  /**
   * Renders the widget.
   *
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $value=$this->formatValue($value);
    $plainName=$name.'_plain';
    return $this->renderContentTag('span', self::escapeOnce($value), array_merge(array(), $attributes)).$this->getHiddenInput($name, $value);
  }

  protected function getHiddenInput($name, $value)
  {
    $input=new sfWidgetFormInputHidden();
    return $input->render($name, $value);
  }

  abstract protected function formatValue($value);
}
