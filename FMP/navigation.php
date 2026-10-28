<?php
/**
	* FileMaker PHP Site Assistant Generated File
	*/
	$navURLs =  array(
		'Home' => '<a href="home.php?-link=Home"><b>Home</b></a>',
		'Add Record' => '<a href="addrecord.php?-link=Add Record"><b>Add Record</b></a>',
		'Find' => '<a href="findrecords.php?-link=Find"><b>Find</b></a>',
		'Record List' => '<a href="recordlist.php?-max=25&amp;-skip=0&amp;-link=Record List"><b>Record List</b></a>',
		'Find All' => '<a href="recordlist.php?-max=25&amp;-action=findall&amp;-skip=0&amp;-link=Find All"><b>Find All</b></a>',
		'Summary Report' => '<a href="report.php?-max=25&amp;-skip=0&amp;-link=Summary Report"><b>Summary Report</b></a>'
);
?>
<div id="page_nav" >
   
    <?php  if (isset($cgi)) {
    		$activelink = $cgi->get('-link');
    		$cgi->clear('-link'); }?>

    <ul>
        <?php foreach ($navURLs as $name => $link) {
        	$loginlink = ($name == 'Log In' && array_key_exists('userName',  $_SESSION));
        	$logoutlink = ($name == 'Log Out' && !array_key_exists('userName',  $_SESSION));
        	
        	if(!$loginlink && !$logoutlink) {
	        	if (isset($activelink) && (strcmp($name, $activelink) === 0)) { ?>
		        		<li class="activelink"><?php echo $link; ?></li>
		        <?php 
		        	unset($activelink);
		        } else { ?>
		        		<li><?php echo $link; ?></li>
		        <?php } // else
	        } // if
        }// foreach link ?>
    </ul>
</div>