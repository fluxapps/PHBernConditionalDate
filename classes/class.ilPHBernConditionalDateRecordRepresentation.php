<?php
require_once('./Modules/DataCollection/classes/Fields/Datetime/class.ilDclDatetimeRecordRepresentation.php');

/**
 * Class ilPHBernConditionalDateRecordRepresentation
 *
 * @author  Michael Herren <mh@studer-raimann.ch>
 * @version 1.0.0
 */
class ilPHBernConditionalDateRecordRepresentation extends ilDclDatetimeRecordRepresentation {

	/**
	 * @inheritDoc
	 */
	public function getConfirmationHTML() {
		if($this->record_field->getValue() == '') {
			return false;
		}
		return parent::getConfirmationHTML();
	}
}