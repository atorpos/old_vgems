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
    $cgi->store('-link', 'Home');
    
    $userName = $cgi->get('userName');
    $passWord = $cgi->get('passWord');

    $fm = & new FileMaker();
    $fm->setProperty('database', 'FMServer_Sample');
    $fm->setProperty('username', $userName);
    $fm->setProperty('password', $passWord);
    
    ExitOnError($fm);
    $layoutList = $fm->listLayouts();
    ExitOnError($layoutList);
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" media="screen" href="linea.css">
        <title>
            Home
        </title>
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
            <?php $storedLink = $cgi->get('-link');
                          if (is_null($storedLink)) $cgi->store('-link', 'Home'); 
                          include_once 'navigation.php' ?><!-- PAGE BODY -->
            <table cellpadding="0" cellspacing="0" class="contentbg">
                <tr>
                    <td class="contentbgleft">
                    </td>
                    <td class="contentmid">
                        <div id="contenttitlebg">
                            <h1>
                                Home
                            </h1>
                        </div>
                        <div id="contentleft">
                        </div>
                        <div id="contentmid">
                        </div>
                        <table class="message" cellpadding="2" cellspacing="2">
                            <tr>
                                <td>
                                    <p>
                                        &nbsp;
                                    </p>
                                </td>
                            </tr>
                        </table>
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

