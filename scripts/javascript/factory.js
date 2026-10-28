function initialize() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map_canvas"));
        map.addControl(new GSmallMapControl());
        map.setCenter(new GLatLng(22.962258, 115.459378), 13);
 
        // Add 10 markers to the map at random locations
          var marker = new GMarker(new GLatLng(22.962258,
                                  115.459378));
          GEvent.addListener(marker, 'click', function(){
            marker.openInfoWindowHtml('Factory Location');
        });
          map.addOverlay(marker);
          
        
        var map2 = new GMap2(document.getElementById("office"));
        map2.addControl(new GSmallMapControl());
        map2.setCenter(new GLatLng(22.406083,114.120154), 13);
 
        // Add 10 markers to the map at random locations
          var marker2 = new GMarker(new GLatLng(22.406083,114.120154));
          GEvent.addListener(marker2, 'click', function(){
            marker2.openInfoWindowHtml('Factory Location');
        });
          map2.addOverlay(marker2);
          
        
        }
      }
