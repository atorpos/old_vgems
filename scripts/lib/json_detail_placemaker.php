<div id="thumbs" class="navigation"></div>
		<script type="text/javascript">
			$.getJSON('<?php echo $jsonurl; ?>', function(data) {
        		var output="<ul class=\"thumbs noscript\">";
        		for (var i in data.beads) {
        									output+="<li><a class=\"thumb\" name=\"leaf\" href=\"" +data.beads[i].imgurl+ "\" title=\""+data.beads[i].name "\"><img src=\""+data.beads[i].thumimg+ "\" alt=\""+data.beads[i].name " in " +data.beads[i].stonename+ "\" />
							</a>
							<div class=\"caption\">
								
								<div class=\"image-title\">"+data.beads[i].name+ " in " +data.beads[i].stonename+ "</div>
								<div class=\"image-desc\"><strong>Details</strong>
									<ul>
										<li><div class=\"detcola\">Stone</div><div class=\"detcolb\">"+data.beads[i].stonename+"</div></li>
										<li><div class=\"detcola\">Necklace Type</div><div class=\"detcolb\">"+data.beads[i].type+"</div></li>
										<li><div class=\"detcola\">Length</div><div class=\"detcolb\">"+data.beads[i].length+"</div></li>
										<li><div class=\"detcola\">Beads Size</div><div class=\"detcolb\">"+data.beads[i].size+"</div></li>
										<li><div class=\"detcola\">Additional Info.</div><div class=\"detcolb\">"+data.beads[i].info+"</div></li>
									</ul>
								</div>
							</div>
						</li>";
        	}
        output+="</ul>";
        document.getElementById("thumbs").innerHTML=output;
  });
		</script>