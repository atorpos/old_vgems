<!--check and fill the products-->
<div id="internal_adv"><img src="/images/bg_right_special.png" /><p><?php include('../scripts/php/random.php');?></p></div>
<div id="rightcontents" align="left">
<img src="/images/bg_right_sort.png" /><br />
<?php 
	switch($sidebarname) {
		case "Gemstone Beads":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Beads Style
			<ul>
				<li><a href=\"index.php?code=C\">Smooth</a></li>
				<li><a href=\"index.php?code=F\">Faceted</a></li>
			</ul><img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Beads Shape
			<ul>
				<li>Apple</li>
				<li>Abcus</li>
				<li>Ball</li>
				<li>Bell</li>
				<li>Cube</li>
				<li>Dice</li>
				<li>Dish</li>
				<li>Donut</li>
				<li>Flower</li>
				<li></li>
			</ul>";
			break;
		case "Accessory Products":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Style
				<ul>
					<li><a href=\"index.php?code=S\">Silver</a></li>
					<li><a href=\"index.php?code=F\">Gemstone</a></li>
				</ul>
				";
				break;
		case "Gemstone Bracelets":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Style
				<ul>
					<li><a href=\"index.php?code=C\">Smooth</a></li>
					<li><a href=\"index.php?code=F\">Faceted</a></li>
				</ul><img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Design
				<ul>
					<li>From beads</li>
					<li>From others</li>
					<li>From silver</li>
					<li>Muiltple</li>
					
				</ul>";
				break;
		case "Gemstone Cabochon":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Cabochon Style
				<ul>
					<li><a href=\"index.php?code=C\">Smooth</a></li>
					<li><a href=\"index.php?code=F\">Faceted</a></li>
				</ul>";
				break;	
		case "Earring Products":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Earring Style
				<ul>
					<li><a href=\"index.php?code=C\">Embedded</a></li>
					<li><a href=\"index.php?code=F\">Loose</a></li>
				</ul>";
				break;
		case "Necklace Products":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Necklace Style
				<ul>
					<li><a href=\"index.php?code=C\">Silver</a></li>
					<li><a href=\"index.php?code=F\">Gemstone</a></li>
				</ul><img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Design
				<ul>
					<li>From beads</li>
					<li>From pendants</li>
					<li>Muiltple</li>
					
				</ul>";
				break;
		case "Ring Products":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Earring Style
				<ul>
					<li><a href=\"index.php?code=RS\">Silver</a></li>
					<li><a href=\"index.php?code=F\">Gemstone</a></li>
				</ul>";
				break;	
		default:
		echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Style
				<ul>
					<li><a href=\"index.php?code=C\">Round</a></li>
					<li><a href=\"index.php?code=F\">Faceted</a></li>
				</ul><img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Shape
				<ul>
					<li>Apple</li>
					<li>Abcus</li>
					<li>Ball</li>
					<li>Bell</li>
					<li>Cube</li>
					<li>Dice</li>
					<li>Dish</li>
					<li>Donut</li>
					<li>Flower</li>
					<li></li>
				</ul>";
				break;
	}
?>
<?php
	echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Stone
				<ul>
					<li><div  class=\"bubbleInfo\"><div><img src=\"/images/button_side_clickstone.png\" height=\"25px\" width=\"150px\" class=\"trigger\" id=\"download\"></div>
					<table id=\"dpop\" class=\"popup\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
								<tbody><tr>
										<td id=\"topleft\" class=\"corner\"></td>
										<td class=\"top\"></td>
										<td id=\"topright\" class=\"corner\"></td>
								</tr>
				
								<tr>
										<td class=\"left\"></td>
										<td><table class=\"popup-contents\">
										<tbody><tr><th></th><td></td></tr>";
	include ('../scripts/php/php_sidepanel_stonename.php');
	echo "<tr id=\"release-notes\">
                                        <th>View Our Stone List Page</th>
                                        <td><a title=\"View Stone List\" href=\"/stonelist.php\">Stone List Page</a></td>
                                </tr>
                        </tbody></table>

                        </td>
                        <td class=\"right\"></td>    
                </tr>

                <tr>
                        <td class=\"corner\" id=\"bottomleft\"></td>
                        <td class=\"bottom\"><img width=\"30\" height=\"29\" alt=\"popup tail\" src=\"/images/bg_bubble_tail2.png\"/></td>
                        <td id=\"bottomright\" class=\"corner\"></td>
                </tr>
        </tbody></table></div>
    </li>
</ul>"; 
?>
<?php 
	switch($sidebarname) {
		case "Gemstone Beads":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Bead Size
				<ul>
					<li>03 - 06 mm</li>
					<li>07 - 10 mm</li>
					<li>11 - 14 mm</li>
					<li>15 - 18 mm</li>
					<li>19 + mm</li>
				</ul><img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Bead Color
				<ul>
					<li>Warm</li>
					<li>Cold</li>
					<li>Transparent </li>
				</ul>";
				break;
		case "Accessory Products":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Size
				<ul>
					<li>03 - 06 mm</li>
					<li>07 - 10 mm</li>
					<li>11 - 14 mm</li>
					<li>15 - 18 mm</li>
					<li>19 + mm</li>
				</ul><img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Color
				<ul>
					<li>Warm</li>
					<li>Cold</li>
					<li>Transparent </li>
				</ul>";
				break;
		case "Gemstone Bracelets":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Bracelet Size
				<ul>
					<li>04 - 09 mm</li>
					<li>10 - 15 mm</li>
					<li>16 - 21 mm</li>
					<li>22 - 27 mm</li>
					<li>28 + mm</li>
				</ul><img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Bracelet Color
				<ul>
					<li>Warm</li>
					<li>Cold</li>
					<li>Transparent </li>
				</ul>";
				break;
		case "Gemstone Cabochon":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Cabochon Size
				<ul>
					<li>04 - 09 mm</li>
					<li>10 - 15 mm</li>
					<li>16 - 21 mm</li>
					<li>22 - 27 mm</li>
					<li>28 + mm</li>
				</ul><img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Cabochon Color
				<ul>
					<li>Warm</li>
					<li>Cold</li>
					<li>Transparent </li>
				</ul>";
				break;
		case "Earring Products":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Earring Color
				<ul>
					<li>Warm</li>
					<li>Cold</li>
					<li>Transparent </li>
				</ul>";
				break;
		case "Necklace Products":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Necklace Color
				<ul>
					<li>Warm</li>
					<li>Cold</li>
					<li>Transparent </li>
				</ul>";
				break;
		case "Ring Products":
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/>Ring Color
				<ul>
					<li>Warm</li>
					<li>Cold</li>
					<li>Transparent </li>
				</ul>";
				break;

		default:
			echo "<img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Size
			<ul>
				<li>03 - 06 mm</li>
				<li>07 - 10 mm</li>
				<li>11 - 14 mm</li>
				<li>15 - 18 mm</li>
				<li>19 + mm</li>
			</ul><img src=\"/images/button_arrow.png\" width=\"12\" height=\"12\"/> Color
			<ul>
				<li>Warm</li>
				<li>Cold</li>
				<li>Transparent </li>
			</ul>";
			break;
		
	}
?>
</div>