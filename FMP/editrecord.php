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

    $recid = $cgi->get('-recid');
    if (!isset($recid))
        $recid = 1;
    $record = $fm->getRecordById($layoutName, $recid);
    ExitOnError($record);
    
    class EmptyRecord {
        function getRelatedSet($relationName) {
            return array(new EmptyRecord());
        }

        function getField($field, $repetition = 0) {
        }

        function getRecordId() {
        }
    }
    
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>
            Edit
        </title>
        <link rel="stylesheet" type="text/css" media="screen" href="linea.css">
    </head>
    <body>
        <div id="header">
            <!--HEADER-->
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
                                Edit
                            </h1>
                        </div>
                        <table class="curvedbg">
                            <tr>
                                <td>
                                </td>
                            </tr>
                        </table>
                        <div class="scrolladd">
                            <table cellpadding="1" cellspacing="0" align="center" class="recwidth">
                                <tr>
                                    <td valign="top">
                                        <form method="post" action="browserecord.php">
                                            <div>
                                                <?php $dbName = "FMServer_Sample";?><?php $layName = "English_Form_View";?><input type="hidden" name="-db" value=
                                                "<?php echo htmlentities($dbName,ENT_NOQUOTES,'UTF-8',false);?>"> <input type="hidden" name="-lay" value=
                                                "<?php echo htmlentities($layName,ENT_NOQUOTES,'UTF-8',false);?>"> <input type="hidden" name="-recid" value="<?php echo $recid ?>">
                                                <input type="hidden" name="-action" value="edit">
                                            </div>
                                            <table cellpadding="0" cellspacing="6" class="record">
                                                <!--Display record field values-->
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Title',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Title';?><?php $fieldValue =          $record->getField('Title', 0) ; ?><input class="fieldinput" type=
                                                        "text" size="30" name="<?php echo getFieldFormName($fieldName, 0, $record, true, 'EDITTEXT', 'text');?>" value=
                                                        "<?php echo $fieldValue;?>"> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Status',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Status';?><?php $fieldValue =          $record->getField('Status', 0) ; ?><select class="fieldinput"
                                                        name="<?php echo getFieldFormName($fieldName, 0, $record, true, 'POPUPLIST', 'text');?>">
                                                            <?php $menuOptions = getMenu($layout->getValueListTwoFields('Status - ENGLISH', (isset($master_record)) ? $master_record->getRecordId() : $record->getRecordId()), $fieldValue, $fieldName, 'text', $submitDateOrder);
                                                                              if ($fieldValue == "") {
                                                                                $selected = "selected";
                                                                              } else {
                                                                                $selected = "";
                                                                              } 
                                                                              if (($cgi->get('menuSelectedFound') == false) && ($selected == "")) {
                                                                                $menuOptions = "<option value='$fieldValue' selected>$fieldValue</option>".$menuOptions; 
                                                                              } 
                                                                              $menuOptions .= "<option value='' $selected></option>";
                                                                              echo $menuOptions;?>
                                                        </select> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Author',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Author';?><?php $fieldValue =          $record->getField('Author', 0) ; ?><input class="fieldinput"
                                                        type="text" size="30" name="<?php echo getFieldFormName($fieldName, 0, $record, true, 'EDITTEXT', 'text');?>" value=
                                                        "<?php echo $fieldValue;?>"> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Publisher',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Publisher';?><?php $fieldValue =          $record->getField('Publisher', 0) ; ?><input class=
                                                        "fieldinput" type="text" size="30" name="<?php echo getFieldFormName($fieldName, 0, $record, true, 'EDITTEXT', 'text');?>"
                                                        value="<?php echo $fieldValue;?>"> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Cover Photo Credit',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Cover Photo Credit';?><?php $fieldValue =          $record->getField('Cover Photo Credit', 0) ; ?><input
                                                         class="fieldinput" type="text" size="30" name=
                                                        "<?php echo getFieldFormName($fieldName, 0, $record, true, 'EDITTEXT', 'text');?>" value="<?php echo $fieldValue;?>"> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Description',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Description';?><?php $fieldValue =          $record->getField('Description', 0) ; ?><?php echoTextArea($fieldName, 0, $record, true, 'SCROLLTEXT', 'text', $fieldValue)?>
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Img',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Img';?>
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Quantity in Stock',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Quantity in Stock';?><?php $fieldValue =          $record->getField('Quantity in Stock', 0) ; ?><input
                                                        class="fieldinput" type="text" size="30" name=
                                                        "<?php echo getFieldFormName($fieldName, 0, $record, true, 'EDITTEXT', 'number');?>" value="<?php echo $fieldValue;?>"> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Number of Pages',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Number of Pages';?><?php $fieldValue =          $record->getField('Number of Pages', 0) ; ?><input
                                                        class="fieldinput" type="text" size="30" name=
                                                        "<?php echo getFieldFormName($fieldName, 0, $record, true, 'EDITTEXT', 'number');?>" value="<?php echo $fieldValue;?>"> 
                                                    </td>
                                                </tr>
                                                <!--Display record form controls-->
                                                <tr class="submit_btn">
                                                    <td width="100">
                                                        &nbsp;
                                                    </td>
                                                    <td>
                                                        <input type="submit" class="buttons" name="-edit" value="Save Record"> <input type="reset" class="buttons" name="reset"
                                                        value="Reset"> <input type="button" class="buttons" onclick=
                                                        '<?php echo ("window.location=\"browserecord.php?-action=browse&amp;-recid=$recid\"") ?>' name="cancel" value="Cancel">
                                                        <input type="submit" class="buttons" name="-delete" value="Delete Record" onclick=
                                                        "return confirm('Permanently delete this ENTIRE record?')"> 
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

