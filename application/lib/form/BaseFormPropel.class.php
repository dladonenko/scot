<?php

/**
 * Project form base class.
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
abstract class BaseFormPropel extends sfFormPropel
{
  public function setup()
  {
  }

  public function embedSingleI18n($formName, $culture, $decorator = null)
  {
    if (!$this->isI18n())
    {
      throw new sfException(sprintf('The model "%s" is not internationalized.', $this->getModelName()));
    }

    $class = $this->getI18nFormClass();

   	$method = sprintf('getCurrent%s', $this->getI18nModelName($culture));
    $i18nObject = $this->getObject()->$method($culture);
    $i18n = new $class($i18nObject);

    if ($i18nObject->isNew())
    {
      unset($i18n['id'], $i18n['culture']);
    }

    $this->embedForm($formName, $i18n, $decorator);
  }
}
