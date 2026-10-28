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
<div id="footer" >
<div id="footertext" >
<br>
    <ul class="secondary_links">
        <?php
		echo ("<li> | </li>");
		 foreach ($navURLs as $name => $link) {
        	$loginlink = ($name == 'Log In' && array_key_exists('userName',  $_SESSION));
        	$logoutlink = ($name == 'Log Out' && !array_key_exists('userName',  $_SESSION));
        	
        	if(!$loginlink && !$logoutlink) {
		      echo("<li> $link  | </li>");
	        } // if
        }// foreach link 
        ?>
    </ul>
</div> </div>