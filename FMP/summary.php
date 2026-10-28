<?php

/**
	* FileMaker PHP Site Assistant Generated File
	*/
require_once 'fmview.php';
require_once 'FileMaker.php';

// Summary Report

interface Summary {
	public function update(FileMaker_Record $eachRecord);
	public function getData();
};
abstract class PrintSummary {
	public function getGroupLabel() {
		return "Group Summary";
	}
	public function getGrandLabel() {
		return "Grand Summary";
	}
	public function printGroupSummary($colSpanVal) {
		echo "<tr><td class='group_total_title'>" . $this->getGroupLabel() . ":</td><td class='group_total' colspan=".($colSpanVal-1).">" . $this->getData() . "</td></tr>";
	}
	public function printGrandSummary($colSpanVal) {
		echo "<tr><td class='grand_total_title'>". $this->getGrandLabel() . ":</td><td class='grand_total' colspan=".($colSpanVal-1).">" . $this->getData() . "</td></tr>";
	}
};
class Total extends PrintSummary implements Summary{
	private $_summaryField;
	private $_total;

	public function getGroupLabel() {
		return "Group Total";
	}
	public function getGrandLabel() {
		return "Grand Total";
	}
	function __construct($summaryField) {
		$this->_summaryField = $summaryField;
	}
	public function update(FileMaker_Record $eachRecord) {
		$this->_total += $eachRecord->getField($this->_summaryField);
	}
	public function getData() {
		return $this->_total;
	}
};

class Count extends PrintSummary implements Summary{
	private $_summaryField;
	private $_count;

	public function getGroupLabel() {
		return "Group Count";
	}
	public function getGrandLabel() {
		return "Overall Count";
	}
	function __construct($summaryField) {
		$this->_summaryField = $summaryField;
		$this->_count = 0;
	}
	public function update(FileMaker_Record $eachRecord) {
		$this->_count++;
	}
	public function getData() {
		return $this->_count;
	}
};

class Median extends PrintSummary implements Summary{
	private $_summaryField;
	private $_values = array();
	private $_count;
		
	public function getGroupLabel() {
		return "Group Median";
	}
	public function getGrandLabel() {
		return "Overall Median";
	}
	function __construct($summaryField) {
		$this->_summaryField = $summaryField;
		$this->_count = 0;
	}
	
	public function update(FileMaker_Record $eachRecord) {
		$currentValue = $eachRecord->getField($this->_summaryField);
		array_push($this->_values, $currentValue);
		$this->_count++;
	}
	
	public function getData() {
		sort($this->_values);
		if ($this->_count%2 == 0) {
			$lowmedian = $this->_values[$this->_count/2-1];
			$highmedian = $this->_values[$this->_count/2];
			$median = ($lowmedian + $highmedian)/2;
		} else {
			$median = $this->_values[($this->_count-1)/2];
		}
		
		return $median;
	}
};
class Average extends PrintSummary implements Summary{
	private $_summaryField;
	private $_count;
	private $_total;

	public function getGroupLabel() {
		return "Group Average";
	}
	public function getGrandLabel() {
		return "Overall Average";
	}
	function __construct($summaryField) {
		$this->_summaryField = $summaryField;
		$this->_count = 0;
	}
	public function update(FileMaker_Record $eachRecord) {
		$currentValue = $eachRecord->getField($this->_summaryField);
		$this->_total += $currentValue;
		$this->_count ++;
	}
	public function getData() {
		return $this->_total / $this->_count;
	}
};

class Report {
	private $_groupField;
	private $_summaryField;
	private $_summaryFunction;
	private $_numberTableColumns;
	private $_firstGroup = true;
	private $_totalName = "Total";
	private $_averageName = "Average";
	private $_medianName = "Median";
	private $_countName = "Count";

	function makeSummary() {
		switch ($this->_summaryFunction) {
			case $this->_totalName:
				return new Total($this->_summaryField);
				break;

			case $this->_averageName:
				return new Average($this->_summaryField);
				break;

			case $this->_medianName:
				return new Median($this->_summaryField);
				break;

			case $this->_countName:
				return new Count($this->_summaryField);
				break;
				
			default:
				return new Count($this->_summaryField);
				break;
		}
	}

	function Report($groupField, $summaryField, $summaryFunction, $numberTableColumns) {
		$this->_groupField = $groupField;
		$this->_summaryField = $summaryField;
		$this->_summaryFunction = $summaryFunction;
		$this->_numberTableColumns = $numberTableColumns;
	}

	private function startGroup($groupData, $colspanVal) {
		$displayDateFormat = '%m/%d/%Y';
		$displayTimeFormat = '%I:%M:%S %P';
		$displayDateTimeFormat = '%m/%d/%Y %I:%M:%S %P';
	
		$this->_firstGroup = false;
		$fieldObj = $groupData->getLayout()->getField($this->_groupField);
		$resultType = $fieldObj->getResult();
		$fieldVal = $groupData->getField($this->_groupField);
		
		
		if ($resultType == "date")
			echo "<tr><td class='group_header' colspan=".$colspanVal.">" . displayDate($fieldVal, $displayDateFormat) . "</td></tr>";
		else if ($resultType == "time")
			echo "<tr><td class='group_header' colspan=".$colspanVal.">" . displayTime($fieldVal, $displayTimeFormat) . "</td></tr>";
		else if ($resultType == "timestamp")
			echo "<tr><td class='group_header' colspan=".$colspanVal.">" . displayTimeStamp($fieldVal, $displayDateTimeFormat) . "</td></tr>";
		else
			echo "<tr><td class='group_header' colspan=".$colspanVal.">" . str_replace(' ','&nbsp; ',$fieldVal) . "</td></tr>";
	}

	private function finishGroup($groupSummary, $colspanVal) {
		if ($this->_firstGroup === false) {
			$groupSummary->printGroupSummary($colspanVal);
		}
	}

	public function printReport($records, $fields, $layout) {

		$lastSeenGroup = null;
		$grandSummary = $this->makeSummary();
		$groupSummary = $this->makeSummary();
		foreach ($records as $eachRecord) {
			$grandSummary->update($eachRecord);
			if ($eachRecord->getField($this->_groupField) != $lastSeenGroup) {
				$lastSeenGroup = $eachRecord->getField($this->_groupField);
				$this->finishGroup($groupSummary,$this->_numberTableColumns);
				$groupSummary = $this->makeSummary();
				$this->startGroup($eachRecord, $this->_numberTableColumns);
			}
			$groupSummary->update($eachRecord);
			echo "<tr class='table_row'>";
			echo "<td class='browse_cell'></td>";
			foreach ($fields as $eachFieldName) {
				if (($eachFieldName != $this->_groupField) && ($eachFieldName != $this->_summaryField)) {
					
					if (isPortalField($eachRecord, $eachFieldName)) {
						$colonPos = strpos($eachFieldName, "::");
						$tableName = substr($eachFieldName, 0, $colonPos);
                        $relatedRecords = $eachRecord->getRelatedSet($tableName);
                        $portal = $layout->getRelatedSet($tableName);
						getTableRows($portal, $relatedRecords, $eachFieldName);
                    }
                    else{
                    	formatFieldData($eachRecord, $layout, $eachFieldName);
                    }
				}		
			}
			//Assumed that a summary field cannot be a portal field.
			formatFieldData($eachRecord, $layout, $this->_summaryField);
			echo "</tr>";
		}
		$this->finishGroup($groupSummary,$this->_numberTableColumns);
		$grandSummary->printGrandSummary($this->_numberTableColumns);
	}
};	// Report

function getTableRows($layout, $records, $fieldName) {
	
	if ($records != null && is_array($records) && (FileMaker::isError($records) === false)){
		$record = $records[0];
		formatFieldData($record, $layout, $fieldName);
	}
	else{
		echo "<td class='browse_cell'></td>";
	}
	
}

// 	Formats field data 

function formatFieldData($records, $layout, $fieldName) {
	if (FileMaker::isError($records) === false) {
		$field = $layout->getField($fieldName);
		if (FileMaker::isError($field) === false) {
			$resultType = $field->getResult();
			$isRepeating = $field->getRepetitionCount() > 1;
			
			if($resultType == 'container'){
				echo "<td class='browse_cell center'>";
			}
			else if($resultType == 'number'){
				echo "<td class='browse_cell right'>";
			}
			else{
				echo "<td class='browse_cell left'>";
			}
			
			if ($isRepeating) {
				echo "<div class='repeating'>";
			}
			for ($i = 0; $i < $field->getRepetitionCount(); $i++) {
				if (is_array($records))
					formatFieldRepetition($records[0], $field, $isRepeating, $i);
				else
					formatFieldRepetition($records, $field, $isRepeating, $i);
			}
			if ($isRepeating) {
				echo "</div>";
			}
			
			echo "</td>";
		}
	}
}

function formatFieldRepetition($record, $field, $isRepeating, $repetition) {
	
	// formats for dates and times
	$displayDateFormat = '%m/%d/%Y';
	$displayTimeFormat = '%I:%M:%S %P';
	$displayDateTimeFormat = '%m/%d/%Y %I:%M:%S %P';
	
	$resultType = $field->getResult();
	$fieldName = $field->getName();
	switch($resultType){
		case 'container':
			$recimagedata = $record->getField($fieldName, $repetition);
			if ($recimagedata != NULL) {
				echo ("<img src='img.php?-url=" . urlencode($recimagedata) . "'/>");
			}
			break;
		case 'date':
			echo displayDate($record->getField($fieldName, $repetition), $displayDateFormat);
			break;
		case 'time':
			echo displayTime($record->getField($fieldName, $repetition), $displayTimeFormat);
			break;
		case 'timestamp':
			echo displayTimeStamp($record->getField($fieldName, $repetition), $displayDateTimeFormat);
			break;
		default:
			echo str_replace(' ', '&nbsp; ',$record->getField($fieldName, $repetition));
			break;
	}
}

?>