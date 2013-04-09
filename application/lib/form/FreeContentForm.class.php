<?php

/**
 * Free Content form.
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
class FreeContentForm extends ContentForm
{
	protected function doUpdateObject($values) {
		parent::doUpdateObject($values);
		$this->getObject()->setIsFree(true);
	}

}
