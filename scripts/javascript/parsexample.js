$.getJSON('product_nor.json', function(data) {
        var output="<div id=\"specialitems\" align=\"left\">";
        for (var i in data.bracelets) {
        	output+="<div class=\"itemcola\"><div class=\"imgcontainer\"><img src=\"" + data.bracelets[i].imgurl + "\"></div><div class=\"subline\"><span class=\"headline\">" + " " + data.bracelets[i].name + "--" + data.bracelets[i].size + "</span><span class=\"sku\">" + data.bracelets[i].code + "</span><span class=\"regprice\">" + data.bracelets[i].price + "</span></div></div>";
        }
        output+="</div>";
        document.getElementById("placeholder").innerHTML=output;
  });

