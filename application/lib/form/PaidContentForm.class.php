<?php

/**
 * Paid Content form.
 *
 * @package    Scotworks
 * @subpackage form
 * @author     Y.Goncharuck
 */
class PaidContentForm extends ContentForm
{
	protected function doUpdateObject($values) {
		parent::doUpdateObject($values);
		$this->getObject()->setIsFree(false);
	}

}
