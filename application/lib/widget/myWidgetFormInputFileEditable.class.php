<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormInputFileEditable represents an upload HTML input tag with the possibility
 * to remove a previously uploaded file.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormInputFileEditable.class.php 30762 2010-08-25 12:33:33Z fabien $
 */
class myWidgetFormInputFileEditable extends sfWidgetFormInputFileEditable
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * file_src:     The current image web source path (required)
   *  * edit_mode:    A Boolean: true to enabled edit mode, false otherwise
   *  * is_image:     Whether the file is a displayable image
   *  * with_delete:  Whether to add a delete checkbox or not
   *  * delete_label: The delete label used by the template
   *  * template:     The HTML template to use to render this widget when in edit mode
   *                  The available placeholders are:
   *                    * %input% (the image upload widget)
   *                    * %delete% (the delete checkbox)
   *                    * %delete_label% (the delete label text)
   *                    * %file% (the file tag)
   *
   * In edit mode, this widget renders an additional widget named after the
   * file upload widget with a "_delete" suffix. So, when creating a form,
   * don't forget to add a validator for this additional field.
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetFormInputFile
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->setOption('delete_label', 'Remove');

  }

  protected function getFileAsTag($attributes) {
	if ($this->getOption('is_image')) {
    	return false !== $this->getOption('file_src') ? $this->renderTag('img', array_merge(array('src' => $this->getOption('file_src')), $attributes)) : '';

    } elseif($this->getOption('file_src')) {
		$filename=basename($this->getOption('file_src'));
    	return link_to($filename, $this->getOption('file_src'));
    } else {
    	return '';
    }

  }
}
