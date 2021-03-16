<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="https://upload.wikimedia.org/wikipedia/commons/thumb/0/01/Blason73-Savoie.svg/164px-Blason73-Savoie.svg.png">
    <title>Projet gîte</title>
</head>

<body>
    <header>
        <section class="zoom">
            <img src="media/mountain1.png" id="layer1" alt="montagne">
            <img src="media/mountain2.png" id="layer2" alt="montagne">
            <img src="media/GIte-LOGO.png" alt="" id="text">
        </section>
        <section class="content">
            <form action="resultat.php" method="post">
                <div class="formReach">
                    <span  class="desti">
                        <label class="case" for="desti">Destination: </label>
                        <input type="search" id="place" name="place" placeholder="Destination">
                    </span >
                    <span  class="arriv">
                        <label class="case" for="arrive">Arrivée:</label>                    
                        <input type="date" id="start" name="start" min="<?= date('Y-m-d') ?>">
                    </span >
                    <span  class="depart">
                        <label class="case" for="departure">Départ:</label>
                        <input type="date" id="leave" name="leave" min="<?= date('Y-m-d') ?>">
                    </span >
                    <span  class="button">
                        <button>Rechercher</button>
                    </span >
                </div>
            </form>
        </section>
    </header>
    <main >
    <section class="photo">
<div class="gallery">
    <div class="gallery__item gallery__item--1">
    <img src="media/slider3d-1.jpg" alt="" class="photomosa" width="610px" height="405px">
    
    </div>
    <div class="gallery__item gallery__item--2">
    <img src="media/SAVOIE-002.jpg" alt="" class="photomosa" width="300px" height="200px">
    
    </div>
    <div class="gallery__item gallery__item--3">
    <img src="media/slider3d-2.jpg" alt=""class="photomosa" width="300px" height="200px">
    
    </div>
    <div class="gallery__item gallery__item--4">
    <img src="media/thural-home.jpg" alt="" class="photomosa" width="300px" height="200px">
    
    </div>
    <div class="gallery__item gallery__item--5">
    <img src="media/chalet.jpg" alt="" class="photomosa" width="300px" height="200px">
    
    </div>
    <div class="gallery__item gallery__item--6">
    <img src="media/slider3d-3.jpg" alt="" class="photomosa" width="610px" height="405px">
    
    </div>
</div>
</section>
    </main>   
    <footer>
        <div>Réseaux</div>
        <div>Copyright</div>
        <div>Contact</div>
    </footer>   
    <script type="text/javascript">
        var layer1 = document.getElementById('layer1')
        scroll = window.pageYOffset;
        document.addEventListener('scroll', function(e) {
            var offset = window.pageYOffset;
            scroll = offset;
            layer1.style.width = (100 + scroll / 5) + '%';
        });
        var layer2 = document.getElementById('layer2')
        scroll = window.pageYOffset;
        document.addEventListener('scroll', function(e) {
            var offset = window.pageYOffset;
            scroll = offset;
            layer2.style.width = (100 + scroll / 5) + '%';
            layer2.style.left = scroll / 50 + '%';
        });

        var text = document.getElementById('text')
        scroll = window.pageYOffset;
        document.addEventListener('scroll', function(e) {
            var offset = window.pageYOffset;
            scroll = offset;
            layer2.style.width = (100 + scroll / 5) + '%';
            text.style.top = -scroll / 20 + '%';
        });
    </script>
</body>

</html>