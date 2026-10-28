<?php
/*randomlize picture*/
srand ((double) microtime( )*1000000);
$random_number = rand(1,4);
switch ($random_number) {
    case 1:
		echo "<a href=\"http://www.vigorgems.com/exhibitions/ \">";
        echo "<img src=\"http://www.vigorgems.com/images/bg_index_summer110.jpg\" alt=\"Stretch Bracelet\" />";
		echo "</a>";
        break;
    case 2:
		echo "<a href=\"http://maps.google.com/maps/place?q=vigor+gems&hl=en&cid=11156732773998742906\">";
        echo "<img src=\"http://www.vigorgems.com/images/bg_index_summer110.jpg\" alt=\"Stretch Bracelet\" /> ";
		echo "</a>";
        break;
    case 3:
		echo "<a href=\"http://maps.google.com/maps/place?q=vigor+gems&hl=en&cid=11156732773998742906\">";
        echo "<img src=\"http://www.vigorgems.com/images/bg_index_summer110.jpg\" alt=\"Stretch Bracelet\" />";
		echo "</a>";
        break;
	case 4:
		echo "<a href=\"http://maps.google.com/maps/place?q=vigor+gems&hl=en&cid=11156732773998742906\">";
        echo "<img src=\"http://www.vigorgems.com/images/bg_index_summer110.jpg\" alt=\"Tucson Show\" />";
		echo "</a>";
        break;
}

?>