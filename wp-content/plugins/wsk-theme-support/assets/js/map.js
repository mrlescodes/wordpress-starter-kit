/**
 * Map colour scheme
 */
const mapStyles = [
  {
    featureType: 'water',
    elementType: 'geometry',
    stylers: [
      {
        color: '#e9e9e9',
      },
      {
        lightness: 17,
      },
    ],
  },
  {
    featureType: 'landscape',
    elementType: 'geometry',
    stylers: [
      {
        color: '#f5f5f5',
      },
      {
        lightness: 20,
      },
    ],
  },
  {
    featureType: 'road.highway',
    elementType: 'geometry.fill',
    stylers: [
      {
        color: '#ffffff',
      },
      {
        lightness: 17,
      },
    ],
  },
  {
    featureType: 'road.highway',
    elementType: 'geometry.stroke',
    stylers: [
      {
        color: '#ffffff',
      },
      {
        lightness: 29,
      },
      {
        weight: 0.2,
      },
    ],
  },
  {
    featureType: 'road.arterial',
    elementType: 'geometry',
    stylers: [
      {
        color: '#ffffff',
      },
      {
        lightness: 18,
      },
    ],
  },
  {
    featureType: 'road.local',
    elementType: 'geometry',
    stylers: [
      {
        color: '#ffffff',
      },
      {
        lightness: 16,
      },
    ],
  },
  {
    featureType: 'poi',
    elementType: 'geometry',
    stylers: [
      {
        color: '#f5f5f5',
      },
      {
        lightness: 21,
      },
    ],
  },
  {
    featureType: 'poi.park',
    elementType: 'geometry',
    stylers: [
      {
        color: '#dedede',
      },
      {
        lightness: 21,
      },
    ],
  },
  {
    elementType: 'labels.text.stroke',
    stylers: [
      {
        visibility: 'on',
      },
      {
        color: '#ffffff',
      },
      {
        lightness: 16,
      },
    ],
  },
  {
    elementType: 'labels.text.fill',
    stylers: [
      {
        saturation: 36,
      },
      {
        color: '#333333',
      },
      {
        lightness: 40,
      },
    ],
  },
  {
    elementType: 'labels.icon',
    stylers: [
      {
        visibility: 'off',
      },
    ],
  },
  {
    featureType: 'transit',
    elementType: 'geometry',
    stylers: [
      {
        color: '#f2f2f2',
      },
      {
        lightness: 19,
      },
    ],
  },
  {
    featureType: 'administrative',
    elementType: 'geometry.fill',
    stylers: [
      {
        color: '#fefefe',
      },
      {
        lightness: 20,
      },
    ],
  },
  {
    featureType: 'administrative',
    elementType: 'geometry.stroke',
    stylers: [
      {
        color: '#fefefe',
      },
      {
        lightness: 17,
      },
      {
        weight: 1.2,
      },
    ],
  },
];

/**
 * Initialises a map marker
 */
const initMarker = ($marker, googleMap) => {
  // Get position from marker.
  const lat = $marker.data('lat');
  const lng = $marker.data('lng');
  const latLng = {
    lat: Number.parseFloat(lat),
    lng: Number.parseFloat(lng),
  };

  // Image directory
  const iconBase = `${wskts.pluginUrl}/dist/img/`;

  // Create marker
  const marker = new google.maps.Marker({
    position: latLng,
    map: googleMap,
    animation: google.maps.Animation.DROP,
    icon: {
      url: `${iconBase}icon-map-pin.png`,
      size: new google.maps.Size(20, 27),
      scaledSize: new google.maps.Size(20, 27),
    },
  });

  // Store the markers on the object
  googleMap.markers.push(marker);
};

/**
 * Centers the map around the markers
 */
const centerMap = (googleMap) => {
  const bounds = new google.maps.LatLngBounds();

  // loop through all markers and create bounds
  googleMap.markers.forEach((marker) => {
    bounds.extend({
      lat: marker.position.lat(),
      lng: marker.position.lng(),
    });
  });

  // only 1 marker?
  if (googleMap.markers.length === 1) {
    // set center of map
    googleMap.setCenter(bounds.getCenter());
    googleMap.setZoom(16);
  } else {
    // fit to bounds
    googleMap.fitBounds(bounds);
  }
};

/**
 * Initialises a google map
 */
const initMap = ($map) => {
  const mapArgs = {
    zoom: 16,
    center: new google.maps.LatLng(0, 0),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControl: false,
    styles: mapStyles,
    disableDefaultUI: true,
  };

  // Grab the markers
  const $markers = $map.find('.marker');

  // Create the map
  const googleMap = new google.maps.Map($map[0], mapArgs);

  // add a markers reference
  googleMap.markers = [];

  // Add markers
  $markers.each(function callback() {
    initMarker($(this), googleMap);
  });

  // Center map
  centerMap(googleMap);

  return googleMap;
};

/**
 * Initialise the maps functionality
 */
const init = () => {
  const $mapEl = $('.map');

  if ($mapEl.length > 0) {
    $mapEl.each(function callback() {
      initMap($(this));
    });
  }
};

jQuery(init);
