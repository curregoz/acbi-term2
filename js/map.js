mapboxgl.accessToken = 'pk.eyJ1IjoiY3VycmVnbyIsImEiOiJjbGlsN25zM28wMXV5M2Z0aGM0cXdocjE2In0.RYVRLDE9b0YxNNDoTLK_Tw';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [151.2080391,-33.8666203],
    zoom: 14
});

const marker1 = new mapboxgl.Marker().setLngLat([151.2080391,-33.8666203]).addTo(map);