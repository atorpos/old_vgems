<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<?php

/**
    * FileMaker PHP Site Assistant Generated File
    */
    require_once 'fmview.php';
    require_once 'FileMaker.php';
    require_once 'error.php';

    $cgi = new CGI();
    $db = "FMServer_Sample";
    $lay = "English_Form_View";
    
    $userName = $cgi->get('userName');
    $passWord = $cgi->get('passWord');

    $fm = & new FileMaker();
    $fm->setProperty('database', $db);
    $fm->setProperty('username', $userName);
    $fm->setProperty('password', $passWord);
    
    ExitOnError($fm);

    //  get the recid of the record to delete
    $recid = $cgi->get('-recid');
    $deleteCommand = $fm->newDeleteCommand($lay, $recid);
    $result = $deleteCommand->execute();
    ExitOnError($result);

    //  goto recordlist
    $cgi->store('-action', 'findall');
    include ('recordlist.php');
    exit;   
?>
