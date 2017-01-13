<?php
require_once('./Modules/DataCollection/classes/Fields/Datetime/class.ilDclDatetimeRecordFieldModel.php');

/**
 * Class ilPHBernConditionalDateRecordFieldModel
 *
 * @author  Michael Herren <mh@studer-raimann.ch>
 * @version 1.0.0
 */
class ilPHBernConditionalDateRecordFieldModel extends ilDclDatetimeRecordFieldModel {
	// requires class because it extends Datetime-Field
	/**
	 * @inheritDoc
	 */
	public function __construct(ilDclBaseRecordModel $record, ilDclBaseFieldModel $field) { parent::__construct($record, $field); }
}