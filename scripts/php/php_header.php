	<div id="staticbar">
		<div id="logoholder">
			<a href="/"><img src="/images/header_logo@2x.png" alt="vigor gems and jewelry ltd" width="450" height="64"/></a>
		</div>
		<div id="searchholder">
			<ul id="headnav">
				
				<li>Hi,<span style="font-weight:bold"> 
					<?php
						if (!isset($_SESSION['MM_Username'])) { 
							echo "Guest ";
						} else {
							$colname_Recordset1 = $_SESSION['MM_Username'];
							echo "<a href=\"/crm/\">" .$colname_Recordset1 ."</a>";
						}
					?>
				</span> </li>
				<li class="press"><a href="/news/">Press</a></li>
				<!-- <li class="miscnav">Register</li> -->
				<li class="miscnav">
				<?php
				if (!isset($_SESSION['MM_Username'])) { 
					echo "<a href=\"https://www.vigorgems.com/signin.awz\">Account</a>";
					
				} else {
					echo "<a href=\"https://www.vigorgems.com/scripts/php/php_logout.php\">Log out</a>";
				}
					
				?>
				</li>
				<?php
					include($_SERVER["DOCUMENT_ROOT"] . "/scripts/php/php_navigation.php");
				?>
				<li class="miscnav"><a href="//t2.phplivesupport.com/atropos/phplive.php?d=1" target="new"><img src="//t2.phplivesupport.com/atropos/ajax/image.php?d=1" border="0" align="middle" alt="livehelp"/> Live help</a>
					<div id="d3" style="display:none;">
						<div style="background-color:#ffffff;width:650px;border:1px solid gray;padding:1px;z-index:10000;">
							<iframe src="/sendquestion.html" style="border:none; width:650px; height:375px; z-index:10001;"></iframe>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>