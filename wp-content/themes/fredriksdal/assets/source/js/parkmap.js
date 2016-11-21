function initMap() {
    var srcImage = location.protocol + '//fredriksdal.dev/parkmap.svg';

    // Initialize the map
    var map = new google.maps.Map(document.getElementById('park-map'), {
        zoom: 16,
        center: {lat: 56.0574959, lng: 12.7108654},
        mapTypeId: 'roadmap',
        scrollwheel: false
    });

    // Add park map
    var imageBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(56.05357504224284, 12.707661319732551),
        new google.maps.LatLng(56.06076274162973, 12.71944792938234)
    );

    var mapOverlay = new google.maps.GroundOverlay(
        srcImage,
        imageBounds
    );

    console.log(mapOverlay);

    mapOverlay.setMap(map);
}

$(document).ready(function () {
    if (document.getElementById('park-map')) {
        google.maps.event.addDomListener(window, 'load', initMap);
    }
});
