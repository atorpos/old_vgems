<?php

$hostname_logon = "localhost" ;   

$database_logon = "stockfile" ;  

$username_logon = "vigorgemscom" ;  

$password_logon = "anpanman" ;   

//open database connection

 $connections = mysql_connect($hostname_logon, $username_logon, $password_logon) or die ( "Unabale to connect to the database" );

 //select database

 mysql_select_db($database_logon) or die ( "Unable to select database!" );



//specify how many results to display per page

$limit = 10;



// Get the search variable from URL

  $var = @$_GET['q'] ;

//trim whitespace from the stored variable

  $trimmed = trim($var); 

//separate key-phrases into keywords

  $trimmed_array = explode(" ",$trimmed);



// check for an empty string and display a message.

if ($trimmed == "") {

  $resultmsg =  "<p>Search Error</p><p>Please enter a search...</p>" ;

  }



// check for a search parameter

if (!isset($var)){

  $resultmsg =  "<p>Search Error</p><p>We don't seem to have a search parameter! </p>" ;

  }

// Build SQL Query for each keyword entered

foreach ($trimmed_array as $trimm){

      // EDIT HERE and specify your table and field names for the SQL query

     $query = "SELECT * FROM tablename WHERE field1 LIKE '%$trimm%' OR field2 like '%$trimm%' OR field3 like '%$trimm%' ORDER BY field1  DESC" ; 

     // Execute the query to  get number of rows that contain search kewords

     $numresults=mysql_query ($query);

     $row_num_links_main =mysql_num_rows ($numresults);



     // next determine if 's' has been passed to script, if not use 0.

     // 's' is a variable that gets set as we navigate the search result pages.

     if (empty($s)) {

         $s=0;

     }



      // now let's get results.

      $query .= " LIMIT $s,$limit" ;

      $numresults = mysql_query ($query) or die ( "Couldn't execute query" );

      $row= mysql_fetch_array ($numresults);



      //store record id of every item that contains the keyword in the array we need to do this to avoid display of duplicate search result.

      do{

          $adid_array[] = $row[ 'fieldid' ];

      }while( $row= mysql_fetch_array($numresults));

 } //end foreach



if($row_num_links_main == 0 && $row_set_num == 0){

   $resultmsg = "<p>Search results for: ". $trimmed."</p><p>Sorry, your search returned zero results</p>" ;

}

   //delete duplicate record id's from the array. To do this we will use array_unique function

   $tmparr = array_unique($adid_array);

   $i=0;

   foreach ($tmparr as $v) {

       $newarr[$i] = $v; 

       $i++;

   }



// now you can display the results returned. But first we will display the search form on the top of the page

?>



<form action="search.php" method="get" name="search">

  <div align="center">

      <input name="q" type="text" value=" <?php echo $q; ?> " size="15">

      <input name="search" type="submit" value="Search">

  </div>

</form>



<?php

// display what the person searched for.

 if( isset ($resultmsg)){

  echo $resultmsg;

  exit();

 }else{

  echo "Search results for: " . $var;

 }

 

foreach($newarr as $value){

 // EDIT HERE and specify your table and field names for the SQL query

$query_value = "SELECT * FROM tablename WHERE fieldid = '$value'";

 $num_value=mysql_query ($query_value);

 $row_linkcat= mysql_fetch_array ($num_value);

 $row_num_links= mysql_num_rows ($num_value);



//now let's make the keywods bold. To do that we will use preg_replace function.

//Replace field

  $titlehigh = preg_replace ( "'($var)'si" , "<b> //1</b>" , $row_linkcat[ 'field1' ] );

  $linkhigh = preg_replace ( "'($var)'si" , "<b> //1</b>" , $row_linkcat[ 'field2' ] );

  $linkdesc = preg_replace ( "'($var)'si" , "<b> //1</b>" , $row_linkcat[ 'field3' ] );



foreach($trimmed_array as $trimm){

    if($trimm != 'b' ){

        $titlehigh = preg_replace( "'($trimm)'si" ,  "<b> //1</b>" , $titlehigh);

        $linkhigh = preg_replace( "'($trimm)'si" , "<b> //1</b>" , $linkhigh);

        $linkdesc = preg_replace( "'($trimm)'si" ,  "<b> //1</b>" , $linkdesc); 

     }

//end highlight



?>

 <p>

<?php echo $titlehigh; ?><br>

<?php echo $linkhigh; ?><br>

<?php echo $linkhigh; ?>

</p>

 

<?php

}   //end foreach $trimmed_array 

   if($row_num_links_main > $limit){

   // next we need to do the links to other search result pages

      if ($s>=1) { // do not display previous link if 's' is '0'

        $prevs=($s-$limit);

         echo "<div align='left'><a href='$PHP_SELF?s=$prevs&q=$var&catid=$catid'>Previous " .$limit. "</a></div>";

      }

     // check to see if last page

     $slimit =$s+$limit;

       if (!($slimit >= $row_num_links_main) && $row_num_links_main!=1) {

     // not last page so display next link

          $n=$s+$limit;

           echo "<div align='right'><a href='$PHP_SELF?s=$n&q=$var&catid=$catid'>Next " .$limit. "</a></div>";

        }

    }

}  //end foreach $newarr

?>