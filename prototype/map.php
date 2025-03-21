<?php require_once("includes/head.html")?>
    <title>Biomed - Procurar por hospitais</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> <!--api de mapa-->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    <?php require_once("includes/header.html")?>
    <main>
        <div id="map" style="height: 400px;"></div> <!--deixei 400 para ti conseguir enchergar-->
        <section id="map_description">
            <h2>Lista de localizações</h2>
            <section id="locations_list">
                <!--
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
                -->
            </section>
        </section>
    </main>
    <?php require_once("includes/footer.html")?>
    <?php require_once("includes/aside.html")?>
    <script src="script/map.js"></script>
</body>
</html>