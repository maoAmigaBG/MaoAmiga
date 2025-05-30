<template>
    <l-map id="map" 
        :style="{
            height: props.height,
            width: props.width
        }"
        :center="props.center"
        :zoom="props.zoom"
    >
        <l-tile-layer 
            :url="props.url" 
            :attribution="props.attribution" 
        />
        <l-marker :lat-lng="props.center"></l-marker>
    </l-map>
</template>

<script setup>
import { LMap, LTileLayer, LMarker } from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";
import L from "leaflet";

delete L.Icon.Default.prototype._getIconUrl;

L.Icon.Default.mergeOptions({
    iconRetinaUrl: new URL('leaflet/dist/images/marker-icon-2x.png', import.meta.url).href,
    iconUrl: new URL('leaflet/dist/images/marker-icon.png', import.meta.url).href,
    shadowUrl: new URL('leaflet/dist/images/marker-shadow.png', import.meta.url).href,
});

const props = defineProps({
    height: { type: String, default: '300px' },
    width: { type: String, default: '300px' },
    center:  { type: Array, default: () => [-29.1667739, -51.5300031] },
    zoom: { type: Number, default: 13 },
    url: { type: String, default: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png' },
    attribution: { type: String, default: '&copy; OpenStreetMap contributors' },
})



</script>