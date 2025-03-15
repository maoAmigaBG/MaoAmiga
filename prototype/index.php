<?php require_once("includes/head.html")?>
    <title>Biomed - homepage</title>
</head>
<body>
<?php require_once("includes/header.html")?>
    <main>
        <h1>Adicionados recentemente</h1>
        <section id="search_options">
            <button id="list_style_btn"> <!--como não é func principal, creio que não precise programar o estilo de tabela-->
                <i class="fa-solid fa-table-cells-large"></i> <!--estilo card-->
                <i class="fa-solid fa-table-list"></i> <!--estilo tabela-->
            </button>
            <a id="photo_search" href="camera.php">
                <i class="fa-solid fa-camera"></i> <!-- me avisa quando a api de gato e cachorro estiver pronta, por favor-->
                <p>Procurar por foto</p>
            </a>
            <div id="search_bar">
                <input type="text" name="" id="" placeholder="Pesquise por texto">
                <a id="search_bar_btn" href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a>
                <!--como é um protótipo, quando o user clicar,
                vamo enviar ele para uma página que apenas mostre algumas cards,
                sem programar a funcionalidade de search me si
                (por isso escrevi o button como link)-->
            </div>
        </section>
        <section id="card_list">
            <a class="card" href="animal.php">
                <div class="card_img">
                    <img src="https://www.worldatlas.com/r/w1200/upload/fb/2a/02/shutterstock-548965408.jpg" alt="">
                </div>
                <div class="card_desc">
                    <div class="main_desc">
                        <h2>Iguana-azul</h2>
                        <h3>Cyclura lewisi</h3> <!--nome científico-->
                    </div>
                    <div class="aditional_info">
                        <div class="card_info">
                            <h4>Nível de ameaça:</h4>
                            <p>5/10</p>
                        </div>
                        <div class="card_info">
                            <h4>Nível de estinção:</h4>
                            <p>5/10</p>
                        </div>
                        <div class="card_info">
                            <h4>Classe:</h4>
                            <p>Réptil</p>
                        </div>
                        <div class="card_info">
                            <h4>Local de residência:</h4>
                            <p>random_country</p>
                        </div>
                    </div>
                </div>
            </a>
        </section>
    </main>
<?php require_once("includes/footer.html")?>
<?php require_once("includes/aside.html")?>
</body>
</html>