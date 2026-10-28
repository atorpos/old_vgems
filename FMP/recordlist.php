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
    $findCom = NULL;
    $findAll = NULL;
    
    $value = $cgi->get('-sortfieldone');
    $restore = $cgi->get('-restore');
    if(!isset($value) || $restore == 'true'){
        
        $cgi->clear("-restore");
    }

    //  handle the action cgi
    $action = $cgi->get('-action');
    if ($action == "findall")
    {
        $cgi->clear('skip');
        $findAll = true;
    }
        
    // clear the recid
    $cgi->clear('recid');

    // create a find command
    $findCommand = $fm->newFindCommand($layoutName);
    ExitOnError($findCommand);

    // get the posted record data from the findrecords page
    $findrequestdata = $cgi->get('storedfindrequest');
    if (isset($findrequestdata)) {
       $findCom = prepareFindRequest($findrequestdata, $findCommand, $cgi);

        // set the logical operator
       $logicalOperator = $cgi->get('-lop');
       if (isset($logicalOperator)) {
               $findCom->setLogicalOperator($logicalOperator);
       }
    } else
       $findCom = $fm->newFindAllCommand($layoutName);
    
    ExitOnError($findCom);

    // read and set, or clear the sort criteria
    $sortfield = $cgi->get('-sortfieldone');
    if (isset($sortfield)) {
        addSortCriteria($findCom);
    } else {
        clearSortCriteria($findCom);
    }

    // get the skip and max values
    $skip = $cgi->get('-skip');
    if (isset($skip) === false) {
        $skip = 0;
    }
    $max = $cgi->get('-max');
    if (isset($max) === false) {
        $max = 25;
    }

    // set skip and max values
    $findCom->setRange($skip, $max);

    // perform the find
    $result = $findCom->execute();
    ExitOnError($result);
    
    // get status info; page range, found count, total count, first, prev, next, and last links
    $statusLinks = getStatusLinks("recordlist.php", $result, $skip, $max);

    // get the records
    $records = $result->getRecords();   
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>
            Record List
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
            <!-- Navigation Menu -->
            <?php $storedLink = $cgi->get('-link');
                if (is_null($storedLink)) $cgi->store('-link', 'Record List');  
                include_once 'navigation.php'; ?><!-- PAGE BODY -->
            <table cellpadding="0" cellspacing="0" class="contentbg">
                <tr>
                    <td class="contentbgleft">
                    </td>
                    <td class="contentmidrecords">
                        <div id="contenttitlebg">
                            <h1>
                                Record List
                            </h1>
                        </div>
                        <table class="curvedbg">
                            <tr>
                                <td>
                                    <table class="reclistnavi">
                                        <tr>
                                            <!--  Display record list page navigation controls -->
                                            <!--  Display record list page navigation controls -->
                                            <td class="recordlist_nav">
                                                <span class="recordlist_nav_first"><?php echo $statusLinks['first'] ?></span> &nbsp; | &nbsp; <span class=
                                                "recordlist_nav_prev"><?php echo $statusLinks['prev'] ?></span> &nbsp; | &nbsp; <span class="recordlist_nav_range">Record
                                                <?php echo $statusLinks['records']['rangestart'] ?> - <?php echo $statusLinks['records']['rangeend'] ?> of
                                                <?php echo $statusLinks['records']['foundcount'] ?></span> &nbsp; | &nbsp; <span class=
                                                "recordlist_nav_next"><?php echo $statusLinks['next'] ?></span> &nbsp; | &nbsp; <span class=
                                                "recordlist_nav_last"><?php echo $statusLinks['last'] ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div class="scrolladd">
                            <table cellpadding="0" cellspacing="0" class="browse_records">
                                <thead>
                                    <tr>
                                        <th class="browse_header center">
                                            <a href="recordlist.php?-max=25&-skip=0&-link=Record%20List&-restore=true">Restore Original Sort Order</a>
                                        </th>
                                        <th class="browse_header left">
                                            <?php echo getSortRecordsLink('Title', 'Title')?>
                                        </th>
                                        <th class="browse_header left">
                                            <?php echo getSortRecordsLink('Status', 'Status')?>
                                        </th>
                                        <th class="browse_header left">
                                            <?php echo getSortRecordsLink('Author', 'Author')?>
                                        </th>
                                        <th class="browse_header left">
                                            <?php echo getSortRecordsLink('Publisher', 'Publisher')?>
                                        </th>
                                        <th class="browse_header left">
                                            <?php echo getSortRecordsLink('Cover Photo Credit', 'Cover Photo Credit')?>
                                        </th>
                                        <th class="browse_header left">
                                            <?php echo getSortRecordsLink('Description', 'Description')?>
                                        </th>
                                        <th class="browse_header center">
                                            <?php echo str_replace(' ', '&nbsp; ','Img')?>
                                        </th>
                                        <th class="browse_header right">
                                            <?php echo getSortRecordsLink('Quantity in Stock', 'Quantity in Stock')?>
                                        </th>
                                        <th class="browse_header right">
                                            <?php echo getSortRecordsLink('Number of Pages', 'Number of Pages')?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                                            $recnum = 1;
                                                            foreach ($records as $fmrecord) {
                                                                    $record = new RecordHighlighter($fmrecord, $cgi);

                                                                    $rowclass = ($recnum % 2 == 0) ? "table_row" : "alt_row";
                                                                    $recid = $record->getRecordId();
                                                                    $pos = strpos($recid, "RID_!");
                                                                    if ($pos !== false) {
                                                                         $recid = substr($recid,0,5) . urlencode(substr($recid,strlen("RID_!")));
                                                                    }
                                                            ?>
                                    <tr class="<?php echo $rowclass ?>">
                                        <td class="browse_cell center">
                                            <a href='<?php echo "browserecord.php?-action=browse&amp;-recid=$recid";?>'><?php echo $recnum ?></a>
                                        </td>
                                        <td class="browse_cell left">
                                            <?php echo nl2br(str_replace(' ', '&nbsp; ', $record->getField('Title', 0) ))?>
                                        </td>
                                        <td class="browse_cell left">
                                            <?php echo nl2br(str_replace(' ', '&nbsp; ', $record->getField('Status', 0) ))?>
                                        </td>
                                        <td class="browse_cell left">
                                            <?php echo nl2br(str_replace(' ', '&nbsp; ', $record->getField('Author', 0) ))?>
                                        </td>
                                        <td class="browse_cell left">
                                            <?php echo nl2br(str_replace(' ', '&nbsp; ', $record->getField('Publisher', 0) ))?>
                                        </td>
                                        <td class="browse_cell left">
                                            <?php echo nl2br(str_replace(' ', '&nbsp; ', $record->getField('Cover Photo Credit', 0) ))?>
                                        </td>
                                        <td class="browse_cell left">
                                            <?php echo nl2br(str_replace(' ', '&nbsp; ', $record->getField('Description', 0) ))?>
                                        </td>
                                        <td class="browse_cell center">
                                            <img src="<?php echo getImageURL( $record->getField('Img', 0) )?>" name="test"> 
                                        </td>
                                        <td class="browse_cell right">
                                            <?php echo nl2br(str_replace(' ', '&nbsp; ', $record->getField('Quantity in Stock', 0) ))?>
                                        </td>
                                        <td class="browse_cell right">
                                            <?php echo nl2br(str_replace(' ', '&nbsp; ', $record->getField('Number of Pages', 0) ))?>
                                        </td>
                                    </tr>
                                    <?php $recnum++; } /* foreach record */?>
                                </tbody>
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

