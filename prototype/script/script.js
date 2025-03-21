var map = L.map('map').setView([-29.1674979, -51.5144969], 13); // San Francisco
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

var search_data = []
var markers_list = []
var locations_list = document.getElementById("locations_list")
var adress_list = [
    "Rua+Osíris+Ferreira+Martuscelli+40,São+Roque,Bento+Gonçalves,RS,Brazil",
    "Rua+Avelino+Luiz+Zat+95,Fenavinho,Bento+Gonçalves,RS,Brazil"
]
async function data_taker() {
    for (let adress of adress_list) {
        console.log(`https://nominatim.openstreetmap.org/search?q=${adress}&format=json&limit=1`);
        
        let data = await fetch(`https://nominatim.openstreetmap.org/search?q=${adress}&format=json&limit=1`)
        data = await data.json()
        search_data.push(data[0])
        console.log(data[0]);
        
    }/*
    for (let idx in search_data) {
        let location = search_data[idx]
        
        let location_lat = location.lat ? location.lat : location.center.lat
        let location_lon = location.lon ? location.lon : location.center.lon
        let location_name = location.name ? location.name : "ong"
        let location_link = `https://www.google.com/maps/search/${location_name}/@${location_lat},${location_lon},15z/`
        var marker = L.marker([location_lat, location_lon], { opacity: 1 }).addTo(map) //criação do marker
        marker.addEventListener("click", function () {
            window.location.href = location_link
        })
        markers_list.push(marker)
    }*/
}
/*
<div class="map_location">
    <div>
        <i class="fa-solid fa-location-dot"></i>
        <h3>Nome da localização</h3>
    </div>
    <div>
        <div class="cordinate">
            <h4>Latitude:</h4>
            <p>-29.1680718</p>
        </div>
        <div class="cordinate">
            <h4>Longitude:</h4>
            <p>-51.515084</p>
        </div>
    </div>
</div>
*/
data_taker()