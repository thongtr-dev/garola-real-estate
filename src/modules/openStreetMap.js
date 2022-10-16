import L, { marker } from 'leaflet';

class OpenStreetMap {
    constructor() {
        this.mapContainer = document.querySelector('#acf-map');

        if (this.mapContainer === null) return;
        
        this.zoom = this.mapContainer.getAttribute('data-zoom');

        const map = this.initMap('acf-map');

        this.addTileLayer(map);

        const markers = this.addMarkers(map);

        const arrayOfLatLngs = markers.map(el => el.getLatLng());

        const bounds = L.latLngBounds(arrayOfLatLngs);

        map.fitBounds(bounds);
    }

    initMap(mapID) {
        const map = L.map(mapID, {
            center: [0, 0],
            zoom: this.zoom,
            maxZoom: 18,
        });
        return map;
    }

    addTileLayer(map) {
        const osmTileURL = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        L.tileLayer(osmTileURL, {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    }

    addMarkers(map) {
        const markerDetails = document.querySelectorAll('.marker-details');

        const icon = L.icon({
            iconUrl: '/wp-content/themes/garola-real-estate/images/marker-icon.png',
            iconAnchor: [10, 40]
        });

        const markers = [];

        for (let i = 0; i < markerDetails.length; i++) {
            const lat = markerDetails[i].dataset.lat;
            const lng = markerDetails[i].dataset.lng;
            // const title = markerDetails[i].dataset.title;
            const address = markerDetails[i].dataset.address;

            const latlng = L.latLng(lat, lng);

            const marker = L.marker(latlng, { icon: icon }).addTo(map);

            // add marker popup
            if (markerDetails.length === 1) {
                marker
                    .bindPopup(`<p>${address}</p>`)
                    .on('click', () => marker.openPopup());
            }
            else {
                // get more data if has more than 1 marker
                const title = markerDetails[i].dataset.title;
                const price = markerDetails[i].dataset.price;
                const link = markerDetails[i].dataset.link;
                const rentOrSale = markerDetails[i].dataset.rent_sale;
                const bedrooms = markerDetails[i].dataset.bedroom;
                marker
                    .bindPopup(`${(title !== null) ? `
                    <h4><a href="${link}">${title}</a></h4>` : ''}
                <p>${address}</p>
                <ul class="property-meta-map">
                <li><i class="fas fa-map-marker-alt" style="color: #0bd99e"></i> ${rentOrSale}</li>
                <li><span style="color: #0bd99e">$ </span>${price}${(rentOrSale === "For Rent") ? " / Month" : ""}</li>
                <li><span class="property-info-icon icon-bed">
                <i class="fas fa-bed" style="color: #0bd99e"></i>
            </span> ${bedrooms} bedrooms</li>
                </ul>
                `)
                    .on('click', () => marker.openPopup());
            }
            markers.push(marker);
        }
        return markers;
    }

}

export default OpenStreetMap