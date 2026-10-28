$(document).ready(function() {
	var win = $(window);
	var chovar = "Bracelet";
	var pagecount = 1;
	// Each time the user scrolls
	win.scroll(function() {
		// End of the document reached?
		if ($(document).height() - win.height() == win.scrollTop()) {
			$('#loading').show();
			
			$.ajax({
				url: '../shop/site_parsetypejson.php?catrpost=' + chovar + '&lastitem=' + pagecount,
				type: "GET",
				dataType: 'json',
				async: false,
				success: function(data) {
					var output="";
					for (var i in data.postcontents) {
	        
        	output+="<div class=\"card\"><img data-src=\"images/loading.gif\" src=\"" + data.productimg[i] + "\">" + "<p class=\"card-text\">" + data.productname[i] + "<br />SKU" + pagecount +": " + data.productsku[i] + "</p><a href=\"#\" class=\"btn btn-secondary\">View Details</a></div>";
        }
        output+="";
        			$('#placeholder').append(output);
					$('#loading').hide();
				}
			});
			pagecount++;
		}
	});
});