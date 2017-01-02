function initMap() {
    var srcImage = location.protocol + '//fredriksdal.dev/parkmap.svg';

    // Initialize the map
    var map = new google.maps.Map(document.getElementById('park-map'), {
        zoom: 16,
        center: {lat: 56.0574959, lng: 12.7108654},
        mapTypeId: 'satellite',
        scrollwheel: false,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: true,
        streetViewControl: false,
        rotateControl: true,
        fullscreenControl: false
    });

    // Add park map
    var imageBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(56.052568, 12.707661),
        new google.maps.LatLng(56.058804, 12.718831)
    );

    var mapOverlay = new google.maps.GroundOverlay(
        srcImage,
        imageBounds
    );

    mapOverlay.setMap(map);
}

$(document).ready(function () {
    if (document.getElementById('park-map')) {
        google.maps.event.addDomListener(window, 'load', initMap);
    }
});
