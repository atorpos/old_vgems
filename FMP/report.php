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
    require_once 'summary.php';

    $record = NULL;
    $findCom = NULL;
    
    // get the report attributes

    $groupField = 'Title';
    $summaryFunction = 'Count';
    $summaryField = 'Number of Pages';

    // handle the cgi
    $action = $cgi->get('-action');
    switch ($action) {
        case "findall": {
           $cgi->clear('skip');
           $findCom = & $fm->newFindAllCommand($layoutName);
           break;
        }
        case "find": {
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
           break;
        }
        default: {
           $findCom = & $fm->newFindAllCommand($layoutName);
           break;
        }
    }
    ExitOnError($findCom);

    // read and set, or clear the sort criteria
    $sortfield = "Title";
    if (isset($sortfield)) {
        $findCom->addSortRule($sortfield, 1, FILEMAKER_SORT_ASCEND);
    } 

    // store the number of columns in this report table
    $numCols = 0;

    // get the skip and max values
    $skip = 0;

    // set skip and max values
    $findCom->setRange($skip, null);

    // perform the find
    $result = $findCom->execute();
    ExitOnError($result);

    // get the records
    $records = $result->getRecords();   
    $fields = array(
                    'Title',
                    'Status',
                    'Author',
                    'Publisher',
                    'Cover Photo Credit',
                    'Description',
                    'Img',
                    'Quantity in Stock',
                    'Number of Pages'
    );
    
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>
            Summary Report
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
            <?php include_once 'navigation.php' ?><!-- PAGE BODY -->
            <table cellpadding="0" cellspacing="0" class="contentbg">
                <tr>
                    <td class="contentbgleft">
                    </td>
                    <td class="contentmidrecords">
                        <div id="contenttitlebg">
                            <h1>
                                Summary Report
                            </h1>
                        </div>
                        <table class="curvedbg">
                            <tr>
                                <td>
                                </td>
                            </tr>
                        </table>
                        <div class="scrolladd">
                            <table cellpadding="0" cellspacing="0" class="browse_records">
                                <thead>
                                    <tr>
                                        <th class="browse_header left">
                                            <?php $numCols++; echo str_replace(' ', '&nbsp; ',htmlentities('Title',ENT_NOQUOTES,'UTF-8',false)); ?>
                                        </th>
                                        <th class="browse_header left">
                                            <?php $numCols++; echo str_replace(' ', '&nbsp; ',htmlentities('Status',ENT_NOQUOTES,'UTF-8',false)); ?>
                                        </th>
                                        <th class="browse_header left">
                                            <?php $numCols++; echo str_replace(' ', '&nbsp; ',htmlentities('Author',ENT_NOQUOTES,'UTF-8',false)); ?>
                                        </th>
                                        <th class="browse_header left">
                                            <?php $numCols++; echo str_replace(' ', '&nbsp; ',htmlentities('Publisher',ENT_NOQUOTES,'UTF-8',false)); ?>
                                        </th>
                                        <th class="browse_header left">
                                            <?php $numCols++; echo str_replace(' ', '&nbsp; ',htmlentities('Cover Photo Credit',ENT_NOQUOTES,'UTF-8',false)); ?>
                                        </th>
                                        <th class="browse_header left">
                                            <?php $numCols++; echo str_replace(' ', '&nbsp; ',htmlentities('Description',ENT_NOQUOTES,'UTF-8',false)); ?>
                                        </th>
                                        <th class="browse_header center">
                                            <?php $numCols++; echo str_replace(' ', '&nbsp; ',htmlentities('Img',ENT_NOQUOTES,'UTF-8',false)); ?>
                                        </th>
                                        <th class="browse_header right">
                                            <?php $numCols++; echo str_replace(' ', '&nbsp; ',htmlentities('Quantity in Stock',ENT_NOQUOTES,'UTF-8',false)); ?>
                                        </th>
                                        <th class="browse_header right">
                                            <?php $numCols++; echo str_replace(' ', '&nbsp; ',htmlentities('Number of Pages',ENT_NOQUOTES,'UTF-8',false)); ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                                            $report = new Report($groupField, $summaryField, $summaryFunction, $numCols);
                                                            $report->printReport($records, $fields, $layout);
                                                            ?>
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

