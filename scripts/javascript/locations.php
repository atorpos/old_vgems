<?php
Header("cotent-type: application/x-javascript");

$sidebarname = $_GET["name"];

if($sidebarname == "office") {
echo "function initialize() {if (GBrowserIsCompatible()) {";
echo "var map = new GMap2(document.getElementById(\"map_canvas\"));
        map.addControl(new GSmallMapControl());
        map.setCenter(new GLatLng(22.310000, 114.189510), 17);
          var marker = new GMarker(new GLatLng(22.310000, 114.189510));
          GEvent.addListener(marker, 'click', function(){
            marker.openInfoWindowHtml('Office Location');
        });
          map.addOverlay(marker);";
          echo "}}";
          $sidebarname = 0;
          break;
} else if($sidebarname == "factory") {
echo "function initialize() {if (GBrowserIsCompatible()) {";
echo "var map = new GMap2(document.getElementById(\"map_canvas\"));
        map.addControl(new GSmallMapControl());
        map.setCenter(new GLatLng(22.962258, 115.459378), 13);
          var marker = new GMarker(new GLatLng(22.962258,
                                  115.459378));
          GEvent.addListener(marker, 'click', function(){
            marker.openInfoWindowHtml('Factory Location');
        });
          map.addOverlay(marker);";
        echo "}}";
        $sidebarname = 0;
        break;
} else {
    break;
}
?>