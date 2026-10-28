<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php

    /**
    * FileMaker PHP Site Assistant Generated File
    */

    require_once 'fmview.php';
    require_once 'FileMaker.php';
    require_once 'error.php';

    $cgi = new CGI();
    $cgi->storeFile();
    
    $databaseName = 'FMServer_Sample';
    $layoutName = 'English_Form_View';

    $userName = $cgi->get('userName');
    $passWord = $cgi->get('passWord');

    $fm = & new FileMaker();
    $fm->setProperty('database', $databaseName);
    $fm->setProperty('username', $userName);
    $fm->setProperty('password', $passWord);
    
    ExitOnError($fm);
    $layout = $fm->getLayout($layoutName);
    ExitOnError($layout);

    // formats for dates and times
    $displayDateFormat = '%m/%d/%Y';
    $displayTimeFormat = '%I:%M:%S %P';
    $displayDateTimeFormat = '%m/%d/%Y %I:%M:%S %P';
    $submitDateOrder = 'mdy';

    $record = NULL;
    $response = NULL;
    $action = $cgi->get('-action');
    $recid = $cgi->get('-recid');

    switch ($action) {
        case "delete" :
            {
                $pageRedirect = true;
                include "deleterecord.php";
                break;
            }
        case "duplicate" :
            {

                //  create a new duplicate command
                $duplicateCommand = $fm->newDuplicateCommand($layoutName, $recid);
                $result = $duplicateCommand->execute();
                ExitOnError($result);

                //  the result contains the record
                $records = $result->getRecords();
                $record = $records[0];

                //  store the recid so we can display the duplicated record in the browse page
                $cgi->store('-recid', $record->getRecordId());
                $recid = $cgi->get('-recid');
                break;
            }
        case "edit" :
            {
                $recid = $cgi->get('-recid');

                // create an edit command for the record specified by the '-recid'
                $editCommand = $fm->newEditCommand($layoutName, $recid);
                ExitOnError($editCommand);

                // get the posted record data from the edit page
                $recorddata = $cgi->get('recorddata');
                if (isset ($recorddata)) {
                    //The following block of code will only submit fields that have changed.
                    // Get the current record being edited. 
                    $currentRecord = $fm->getRecordById($layoutName, $recid);
                    // Get a list of fields on the layout.
                    $listofFields = $layout->listFields();
                    $fieldEditRecords = $cgi->get("fieldEditRecords");
                    
                    $counter = 0;
                    if($listofFields != null ){
                        // for each field check to see if the new value entered by the user is equivalent
                        // to the old value. If it is remove it from the array so it does not get committed. 
                        foreach ($listofFields as $aField){
                            $fieldObj = $currentRecord->getLayout()->getField($aField);
                            $resultType = $fieldObj->getResult();
                            $originalValue = $currentRecord->getField($aField);
       
                            if ($resultType == "date")
                                $originalValue = displayDate($originalValue, $displayDateFormat);
                            else if ($resultType == "time")
                                $originalValue = displayTime($originalValue, $displayTimeFormat);
                            else if ($resultType == "timestamp")
                                $originalValue = displayTimeStamp($originalValue, $displayDateTimeFormat);
                            
                            // The field's value is in the same position in the $recorddata array as the field's name is in the 
                            // $listofFields array.  
                            if(isset ( $recorddata[$counter]) && array_key_exists($aField, $fieldEditRecords)){ 
                                 if ( $originalValue === $recorddata[$counter] ){
                                        unset($recorddata[$counter]);
                                    }
                              $counter++;
                            }
                        }
                    }   
                
                    $onlyCheckBoxField = false;
                    if (sizeof($recorddata) == 0){
                        if(isset($fieldEditRecords[0]) && $fieldEditRecords[0]->isCheckBox()){
                            $onlyCheckBoxField = true;
                        }
                    }   
                
                    //After the proper set of fields have been identified submit the record data.
                    //This check is to ensure that if no fields have been modified code does not submit any changes. 
                    if( sizeof($recorddata) > 0 || $onlyCheckBoxField){
                    
                     //Convert any time/date formatted field 
                    if (isset($fieldEditRecords)) {
    
                        foreach ($recorddata as $field => $value) {
    
                            if(array_key_exists($field, $fieldEditRecords)){
                                $fieldEditRecord = $fieldEditRecords[$field];
                            }
    
                            if (is_null($fieldEditRecord) === false && $fieldEditRecord->isEditBox()){
                            
                                $resultType = $fieldEditRecord->getResultType();
                                        if ($resultType == "date")
                                            $value = submitDate($value, $displayDateFormat);
                                        else if ($resultType == "time")
                                            $value = submitTime($value);
                                        else if ($resultType == "timestamp")
                                            $value = submitTimeStamp($value, $displayDateFormat);
                                
                                     $recorddata[$field] =$value;
                             }
                         }
                     }
                    
                        $response = submitRecordData($recorddata, $editCommand, $cgi, $layout->listFields());
                        $cgi->clear('recorddata');
                        ExitOnError($response);
                        
                        $firstRecord = $response->getFirstRecord();
                        ExitOnError($firstRecord);
                        $cgi->store('-recid', $firstRecord->getRecordId());
                        $recid = $cgi->get('-recid');
            
        
                        // now get the record we just edited
                        $record = $fm->getRecordById($layoutName, $recid);
                    }else{
                        $recid = $cgi->get('-recid');
                        if (!isset ($recid))
                            $recid = 1;
                        $record = $fm->getRecordById($layoutName, $recid);
                        $cgi->clear('recorddata');
                        ExitOnError($record);
                        
                    }
                }   
                break;
            }
        case "new" :
            {

                // create the new add command
                $newrecordrequest = $fm->newAddCommand($layoutName);
                ExitOnError($newrecordrequest);

                // get the submitted record data
                $recorddata = $cgi->get('recorddata');
                if (isset ($recorddata)) {
                
                 //Convert any time/date formatted field 
                    $fieldEditRecords = $cgi->get("fieldEditRecords");
                    if (isset($fieldEditRecords)) {
    
                        foreach ($recorddata as $field => $value) {
    
                            if(array_key_exists($field, $fieldEditRecords)){
                                $fieldEditRecord = $fieldEditRecords[$field];
                            }
    
                            if (isset($fieldEditRecord) && is_null($fieldEditRecord) === false && $fieldEditRecord->isEditBox()){
                                $resultType = $fieldEditRecord->getResultType();
               
                                    if ($resultType == "date")
                                        $value = submitDate($value, $displayDateFormat);
                                    else if ($resultType == "time")
                                        $value = submitTime($value);
                                    else if ($resultType == "timestamp")
                                        $value = submitTimeStamp($value, $displayDateFormat);
                            
                                 $recorddata[$field] =$value;
                             }
                         }
                     }

                    //  submit the data to the db
                    $result = submitRecordData($recorddata, $newrecordrequest, $cgi, $layout->listFields());

                    //  clear the stored record data
                    $cgi->clear('recorddata');
                    
                    if( $result === NULL ){
                        DisplayErrorandExit("commit failed!");
                    }else{
                        ExitOnError($result);
                    }
                } else {
                    $findallCommand = $fm->newFindAllCommand($layoutName);
                    $result = $findallCommand->execute();
                }
                if ($result->getFetchCount() > 0) {
                    $records = $result->getRecords();
                    $record = $records[0];
                    $recid = $record->getRecordId();
                } else {
                    DisplayError('No Records are present.');
                }

                break;
            }
        case "browse" :
        default :
            {
                $recid = $cgi->get('-recid');
                if (!isset ($recid))
                    $recid = 1;
                $record = $fm->getRecordById($layoutName, $recid);
                ExitOnError($record);
                break;
            }
    }   
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>
            Browse Record
        </title>
        <link rel="stylesheet" type="text/css" media="screen" href="linea.css">
    </head>
    <body>
        <div id="header">
            <!-- HEADER -->
            <div id="headerlogo">
                FMServer_Sample 
                <div id="headercaption">
                    <!--Caption for the Company-->
                </div>
            </div>
        </div>
        <div id="content">
            <!--Navigation Menu-->
            <?php include_once 'navigation.php' ?><!--PAGE BODY-->
            <table cellpadding="0" cellspacing="0" class="contentbg">
                <tr>
                    <td class="contentbgleft">
                    </td>
                    <td class="contentmidrecords">
                        <div id="contenttitlebg">
                            <h1>
                                Browse Record
                            </h1>
                        </div>
                        <table class="curvedbg">
                            <tr>
                                <td>
                                </td>
                            </tr>
                        </table>
                        <div class="scrolladd">
                            <table cellpadding="1" cellspacing="0" class="recwidth">
                                <tr>
                                    <td valign="top">
                                        <form method="post" action="editrecord.php">
                                            <div>
                                                <?php $dbName = "FMServer_Sample";?><?php $layName = "English_Form_View";?><input type="hidden" name="-db" value=
                                                "<?php echo htmlentities($dbName,ENT_NOQUOTES,'UTF-8',false);?>"> <input type="hidden" name="-lay" value=
                                                "<?php echo htmlentities($layName,ENT_NOQUOTES,'UTF-8',false);?>"> <input type="hidden" name="-recid" value="<?php echo $recid ?>">
                                            </div>
                                            <table cellpadding="1" cellspacing="6" class="record">
                                                <!-- Display record field values -->
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Title',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php echo nl2br(str_replace(' ', '&nbsp; ', storeFieldNames('Title', 0, $record, true, 'EDITTEXT', 'text')))?>
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Status',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php echo nl2br(str_replace(' ', '&nbsp; ', storeFieldNames('Status', 0, $record, true, 'POPUPLIST', 'text')))?>
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Author',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php echo nl2br(str_replace(' ', '&nbsp; ', storeFieldNames('Author', 0, $record, true, 'EDITTEXT', 'text')))?>
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Publisher',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php echo nl2br(str_replace(' ', '&nbsp; ', storeFieldNames('Publisher', 0, $record, true, 'EDITTEXT', 'text')))?>
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Cover Photo Credit',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php echo nl2br(str_replace(' ', '&nbsp; ', storeFieldNames('Cover Photo Credit', 0, $record, true, 'EDITTEXT', 'text')))?>
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Description',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php echo nl2br(str_replace(' ', '&nbsp; ', storeFieldNames('Description', 0, $record, true, 'SCROLLTEXT', 'text')))?>
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Img',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <img src="<?php echo getImageURL(storeFieldNames('Img', 0, $record, true, 'EDITTEXT', 'container'))?>"> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Quantity in Stock',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php echo nl2br(str_replace(' ', '&nbsp; ', storeFieldNames('Quantity in Stock', 0, $record, true, 'EDITTEXT', 'number')))?>
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Number of Pages',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php echo nl2br(str_replace(' ', '&nbsp; ', storeFieldNames('Number of Pages', 0, $record, true, 'EDITTEXT', 'number')))?>
                                                    </td>
                                                </tr>
                                                <!--Display record form controls-->
                                                <tr class="submit_btn">
                                                    <td width="100">
                                                    </td>
                                                    <td>
                                                        <input type="submit" class="buttons" name="-find" value="Edit Record">
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td class="contentbgright">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="contentbgfooterleft">
                        &nbsp;
                    </td>
                    <td class="contentfooter">
                        &nbsp;
                    </td>
                    <td class="contentbgfotterright">
                        &nbsp;
                    </td>
                </tr>
            </table>
        </div>
        <!-- Footer-->
        <table class="footerwidth" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <?php include_once 'footer.php' ?>
                </td>
            </tr>
        </table>
    </body>
</html>

