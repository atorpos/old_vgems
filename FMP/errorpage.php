<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php

	/**
	* FileMaker PHP Site Assistant Generated File
	*/
	global $errormessage;
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Error</title>
    <link rel="stylesheet" type="text/css" media="screen" href="linea.css" />
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
		<!-- PAGE BODY -->
		
		<?php include_once 'navigation.php' ?>

			<table cellpadding="0" cellspacing="0" class="contentbg">
   <tr>
    <td class="contentbgleft"></td>
    <td class="contentmid"> 
               <div id="contenttitlebg">
               
                <h1>Error</h1>
                </div>

                <div id="contentleft">
                </div>

                <div id="contentmid">
                </div>
                
            <div id="error">
                    <table border="0" cellpadding="2"
                    cellspacing="2">
                        <tr>
                            <td height="35" colspan="2"></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                            <?php echo $errormessage ?></td>
                        </tr>

                        <tr>
                            <td colspan="2" align="center"></td>
                        </tr>
                    </table>
                </div></td>
    <td class="contentbgright">&nbsp;</td>
  </tr>
   <tr>
     <td class="contentbgfooterleft">&nbsp;</td>
     <td class="contentfooter">&nbsp;</td>
     <td class="contentbgfotterright">&nbsp;</td>
   </tr>
</table>
            </div>
  			  <!-- Footer-->
<table class="footerwidth" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php include_once 'footer.php' ?></td>
  </tr>
</table>
    </body>
</html>
