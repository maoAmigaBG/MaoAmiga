var map = L.map('map').setView([-29.1674979, -51.5144969], 13); // San Francisco
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

var search_data
var markers_list = []
var locations_list = document.getElementById("locations_list")
async function data_taker() {
    let data = await fetch("https://overpass-api.de/api/interpreter?data=[out:json];area[name=\"Bento Gonçalves\"]->.searchArea;(node[\"amenity\"=\"hospital\"](area.searchArea);way[\"amenity\"=\"hospital\"](area.searchArea);relation[\"amenity\"=\"hospital\"](area.searchArea););out center;")
    data = await data.json()
    search_data = data["elements"]

    for (let idx in search_data) {
        let location = search_data[idx]
        let location_lat = location.lat ? location.lat : location.center.lat
        let location_lon = location.lon ? location.lon : location.center.lon
        let location_name = location.tags.name ? location.tags.name : "hospital"
        let location_link = `https://www.google.com/maps/search/${location_name}/@${location_lat},${location_lon},15z/`
        var marker = L.marker([location_lat, location_lon], {opacity: 1}).addTo(map) //criação do marker
        marker.addEventListener("click", function() {
            window.location.href = location_link
        })
        markers_list.push(marker)

        //criação dos cards de localização
        let map_location = document.createElement("a")
        let div0 = document.createElement("div")
        let div1 = document.createElement("div")
        let cordinate0 = document.createElement("div")
        let cordinate1 = document.createElement("div")
        let i = document.createElement("i")
        let h3 = document.createElement("h3")
        let h40 = document.createElement("h4")
        let h41 = document.createElement("h4")
        let p0 = document.createElement("p")
        let p1 = document.createElement("p")
        map_location.classList.add("map_location")
        cordinate0.classList.add("cordinate")
        cordinate1.classList.add("cordinate")
        i.className = "fa-solid fa-location-dot"
        h3.innerHTML = location_name
        h40.innerHTML = "Latitude"
        h41.innerHTML = "Longitude"
        p0.innerHTML = location_lat
        p1.innerHTML = location_lon
        cordinate0.appendChild(h40)
        cordinate0.appendChild(p0)
        cordinate1.appendChild(h41)
        cordinate1.appendChild(p1)
        div0.appendChild(i)
        div0.appendChild(h3)
        div1.appendChild(cordinate0)
        div1.appendChild(cordinate1)
        map_location.appendChild(div0)
        map_location.appendChild(div1)
        map_location.dataset.location_id = idx
        map_location.setAttribute("href", location_link)
        locations_list.appendChild(map_location)
    }
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
