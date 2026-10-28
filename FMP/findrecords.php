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

    class EmptyRecord {
        function getRelatedSet($relationName) {
            return array(new EmptyRecord());
        }

        function getField($field, $repetition = 0) {
        }

        function getRecordId() {
        }
    }

    $record = new EmptyRecord();    
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>
            Find
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
            <!-- Navigation Menu -->
            <?php include_once 'navigation.php' ?><!-- PAGE BODY -->
            <table cellpadding="0" cellspacing="0" class="contentbg">
                <tr>
                    <td class="contentbgleft">
                    </td>
                    <td class="contentmidrecords">
                        <div id="contenttitlebg">
                            <h1>
                                Find
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
                                        <form method="post" action="recordlist.php">
                                            <div>
                                                <input type="hidden" name="-lay" value="<?php echo '$layoutName'?>"> <input type="hidden" name="-action" value="find"> <input type=
                                                "hidden" name="-skip" value="0">
                                            </div>
                                            <table cellpadding="0" cellspacing="6" class="record">
                                                <!--Display search field input controls-->
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Title',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Title';?><?php $fieldName = 'Title';?><select name=
                                                        "<?php echo getFieldFormName($fieldName.'.op', 0, $record, true, 'EDITTEXT', 'text');?>">
                                                            <option value="cn" selected>
                                                                Contains
                                                            </option>
                                                            <option value="bw">
                                                                Begins With
                                                            </option>
                                                            <option value="ew">
                                                                Ends With
                                                            </option>
                                                            <option value="eq">
                                                                Equals
                                                            </option>
                                                            <option value="lt">
                                                                Less Than
                                                            </option>
                                                            <option value="lte">
                                                                Less Than or Equals
                                                            </option>
                                                            <option value="gt">
                                                                Greater Than
                                                            </option>
                                                            <option value="gte">
                                                                Greater Than or Equals
                                                            </option>
                                                        </select> <?php $fieldValue =          $record->getField('Title', 0) ; ?> <input class="fieldinput" type="text" size="30"
                                                        name="<?php echo getFieldFormName($fieldName, 0, $record, true, 'EDITTEXT', 'text');?>" value="<?php echo $fieldValue;?>"> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Status',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Status';?><?php $fieldName = 'Status';?><select name=
                                                        "<?php echo getFieldFormName($fieldName.'.op', 0, $record, true, 'POPUPLIST', 'text');?>">
                                                            <option value="cn" selected>
                                                                Contains
                                                            </option>
                                                            <option value="bw">
                                                                Begins With
                                                            </option>
                                                            <option value="ew">
                                                                Ends With
                                                            </option>
                                                            <option value="eq">
                                                                Equals
                                                            </option>
                                                            <option value="lt">
                                                                Less Than
                                                            </option>
                                                            <option value="lte">
                                                                Less Than or Equals
                                                            </option>
                                                            <option value="gt">
                                                                Greater Than
                                                            </option>
                                                            <option value="gte">
                                                                Greater Than or Equals
                                                            </option>
                                                        </select> <?php $fieldValue =          $record->getField('Status', 0) ; ?> <select class="fieldinput" name=
                                                        "<?php echo getFieldFormName($fieldName, 0, $record, true, 'POPUPLIST', 'text');?>">
                                                            <?php echo getMenu($layout->getValueListTwoFields('Status - ENGLISH', $record->getRecordId()), $fieldValue, $fieldName, 'text', $submitDateOrder);?>
                                                            <option value='' selected>
                                                            </option>
                                                        </select> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Author',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Author';?><?php $fieldName = 'Author';?><select name=
                                                        "<?php echo getFieldFormName($fieldName.'.op', 0, $record, true, 'EDITTEXT', 'text');?>">
                                                            <option value="cn" selected>
                                                                Contains
                                                            </option>
                                                            <option value="bw">
                                                                Begins With
                                                            </option>
                                                            <option value="ew">
                                                                Ends With
                                                            </option>
                                                            <option value="eq">
                                                                Equals
                                                            </option>
                                                            <option value="lt">
                                                                Less Than
                                                            </option>
                                                            <option value="lte">
                                                                Less Than or Equals
                                                            </option>
                                                            <option value="gt">
                                                                Greater Than
                                                            </option>
                                                            <option value="gte">
                                                                Greater Than or Equals
                                                            </option>
                                                        </select> <?php $fieldValue =          $record->getField('Author', 0) ; ?> <input class="fieldinput" type="text" size="30"
                                                        name="<?php echo getFieldFormName($fieldName, 0, $record, true, 'EDITTEXT', 'text');?>" value="<?php echo $fieldValue;?>"> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Publisher',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Publisher';?><?php $fieldName = 'Publisher';?><select name=
                                                        "<?php echo getFieldFormName($fieldName.'.op', 0, $record, true, 'EDITTEXT', 'text');?>">
                                                            <option value="cn" selected>
                                                                Contains
                                                            </option>
                                                            <option value="bw">
                                                                Begins With
                                                            </option>
                                                            <option value="ew">
                                                                Ends With
                                                            </option>
                                                            <option value="eq">
                                                                Equals
                                                            </option>
                                                            <option value="lt">
                                                                Less Than
                                                            </option>
                                                            <option value="lte">
                                                                Less Than or Equals
                                                            </option>
                                                            <option value="gt">
                                                                Greater Than
                                                            </option>
                                                            <option value="gte">
                                                                Greater Than or Equals
                                                            </option>
                                                        </select> <?php $fieldValue =          $record->getField('Publisher', 0) ; ?> <input class="fieldinput" type="text" size=
                                                        "30" name="<?php echo getFieldFormName($fieldName, 0, $record, true, 'EDITTEXT', 'text');?>" value=
                                                        "<?php echo $fieldValue;?>"> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Cover Photo Credit',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Cover Photo Credit';?><?php $fieldName = 'Cover Photo Credit';?><select name=
                                                        "<?php echo getFieldFormName($fieldName.'.op', 0, $record, true, 'EDITTEXT', 'text');?>">
                                                            <option value="cn" selected>
                                                                Contains
                                                            </option>
                                                            <option value="bw">
                                                                Begins With
                                                            </option>
                                                            <option value="ew">
                                                                Ends With
                                                            </option>
                                                            <option value="eq">
                                                                Equals
                                                            </option>
                                                            <option value="lt">
                                                                Less Than
                                                            </option>
                                                            <option value="lte">
                                                                Less Than or Equals
                                                            </option>
                                                            <option value="gt">
                                                                Greater Than
                                                            </option>
                                                            <option value="gte">
                                                                Greater Than or Equals
                                                            </option>
                                                        </select> <?php $fieldValue =          $record->getField('Cover Photo Credit', 0) ; ?> <input class="fieldinput" type=
                                                        "text" size="30" name="<?php echo getFieldFormName($fieldName, 0, $record, true, 'EDITTEXT', 'text');?>" value=
                                                        "<?php echo $fieldValue;?>"> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Description',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Description';?><?php $fieldName = 'Description';?><select name=
                                                        "<?php echo getFieldFormName($fieldName.'.op', 0, $record, true, 'SCROLLTEXT', 'text');?>">
                                                            <option value="cn" selected>
                                                                Contains
                                                            </option>
                                                            <option value="bw">
                                                                Begins With
                                                            </option>
                                                            <option value="ew">
                                                                Ends With
                                                            </option>
                                                            <option value="eq">
                                                                Equals
                                                            </option>
                                                            <option value="lt">
                                                                Less Than
                                                            </option>
                                                            <option value="lte">
                                                                Less Than or Equals
                                                            </option>
                                                            <option value="gt">
                                                                Greater Than
                                                            </option>
                                                            <option value="gte">
                                                                Greater Than or Equals
                                                            </option>
                                                        </select> <?php $fieldValue =          $record->getField('Description', 0) ; ?>
                                                        <?php echoTextArea($fieldName, 0, $record, true, 'SCROLLTEXT', 'text', $fieldValue)?> 
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
                                                        <?php $fieldName = 'Quantity in Stock';?><?php $fieldName = 'Quantity in Stock';?><select name=
                                                        "<?php echo getFieldFormName($fieldName.'.op', 0, $record, true, 'EDITTEXT', 'number');?>">
                                                            <option value="eq">
                                                                Equals
                                                            </option>
                                                            <option value="lt">
                                                                Less Than
                                                            </option>
                                                            <option value="lte">
                                                                Less Than or Equals
                                                            </option>
                                                            <option value="gt">
                                                                Greater Than
                                                            </option>
                                                            <option value="gte">
                                                                Greater Than or Equals
                                                            </option>
                                                        </select> <?php $fieldValue =          $record->getField('Quantity in Stock', 0) ; ?> <input class="fieldinput" type="text"
                                                        size="30" name="<?php echo getFieldFormName($fieldName, 0, $record, true, 'EDITTEXT', 'number');?>" value=
                                                        "<?php echo $fieldValue;?>"> 
                                                    </td>
                                                </tr>
                                                <tr class="field">
                                                    <td class="field_name">
                                                        <?php echo str_replace(' ', '&nbsp; ',htmlentities('Number of Pages',ENT_NOQUOTES,'UTF-8',false));?>
                                                    </td>
                                                    <td class="field_data">
                                                        <?php $fieldName = 'Number of Pages';?><?php $fieldName = 'Number of Pages';?><select name=
                                                        "<?php echo getFieldFormName($fieldName.'.op', 0, $record, true, 'EDITTEXT', 'number');?>">
                                                            <option value="eq">
                                                                Equals
                                                            </option>
                                                            <option value="lt">
                                                                Less Than
                                                            </option>
                                                            <option value="lte">
                                                                Less Than or Equals
                                                            </option>
                                                            <option value="gt">
                                                                Greater Than
                                                            </option>
                                                            <option value="gte">
                                                                Greater Than or Equals
                                                            </option>
                                                        </select> <?php $fieldValue =          $record->getField('Number of Pages', 0) ; ?> <input class="fieldinput" type="text"
                                                        size="30" name="<?php echo getFieldFormName($fieldName, 0, $record, true, 'EDITTEXT', 'number');?>" value=
                                                        "<?php echo $fieldValue;?>"> 
                                                    </td>
                                                </tr>
                                                <!--Display search form controls-->
                                                <tr class="submit_btn">
                                                    <td>
                                                    </td>
                                                    <td>
                                                        <input value="or" type="radio" name="-lop">Find records if any fields match<br>
                                                         <input value="and" type="radio" name="-lop" checked>Find records if all fields match<br>
                                                         
                                                    </td>
                                                </tr>
                                                <tr class="submit_btn">
                                                    <td>
                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    Display:
                                                                </td>
                                                                <td>
                                                                    <select name="-max">
                                                                        <option value="10">
                                                                            10
                                                                        </option>
                                                                        <option value="25" selected>
                                                                            25
                                                                        </option>
                                                                        <option value="50">
                                                                            50
                                                                        </option>
                                                                        <option value="100">
                                                                            100
                                                                        </option>
                                                                        <option value="all">
                                                                            Max
                                                                        </option>
                                                                    </select> 
                                                                </td>
                                                                <td>
                                                                    Records
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr class="submit_btn">
                                                    <td width="100">
                                                    </td>
                                                    <td>
                                                        <input type="submit" class="buttons" name="-find" value="Find Records"> <input type="reset" class="buttons" name="Reset"
                                                        value="Reset">
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

