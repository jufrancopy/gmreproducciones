<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ipu Paraguay</title>

    <!--FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400&display=swap" rel="stylesheet">

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{ url('/static/css/web/style.css') }}">

    <!-- Timeline -->
    {{-- <link rel="stylesheet" href="{{ url('/static/libs/Responsive-Timeline/css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ url('/static/libs/Responsive-Timeline/css/jquerysctipttop.css') }}">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


    <script>
        window.onload = function () {
            // Variables
            const IMAGENES = [
                '{{ url('/static/images/web/new1.jpeg') }}',
                '{{ url('/static/images/web/new2.jpg') }}',
                '{{ url('/static/images/web/new3.jpg') }}'
            ];
            const TIEMPO_INTERVALO_MILESIMAS_SEG = 3000;
            let posicionActual = 0;
            let $botonRetroceder = document.querySelector('#retroceder');
            let $botonAvanzar = document.querySelector('#avanzar');
            let $imagen = document.querySelector('#imagen');
            let $botonPlay = document.querySelector('#play');
            let $botonStop = document.querySelector('#stop');
            let intervalo;

            // Funciones

            /**
             * Funcion que cambia la foto en la siguiente posicion
             */
            function pasarFoto() {
                if(posicionActual >= IMAGENES.length - 1) {
                    posicionActual = 0;
                } else {
                    posicionActual++;
                }
                renderizarImagen();
            }

            /**
             * Funcion que cambia la foto en la anterior posicion
             */
            function retrocederFoto() {
                if(posicionActual <= 0) {
                    posicionActual = IMAGENES.length - 1;
                } else {
                    posicionActual--;
                }
                renderizarImagen();
            }

            /**
             * Funcion que actualiza la imagen de imagen dependiendo de posicionActual
             */
            function renderizarImagen () {
                $imagen.style.backgroundImage = `url(${IMAGENES[posicionActual]})`;
            }

            /**
             * Activa el autoplay de la imagen
             */
            function playIntervalo() {
                intervalo = setInterval(pasarFoto, TIEMPO_INTERVALO_MILESIMAS_SEG);
                // Desactivamos los botones de control
                $botonAvanzar.setAttribute('disabled', true);
                $botonRetroceder.setAttribute('disabled', true);
                $botonPlay.setAttribute('disabled', true);
                $botonStop.removeAttribute('disabled');

            }

            /**
             * Para el autoplay de la imagen
             */
            function stopIntervalo() {
                clearInterval(intervalo);
                // Activamos los botones de control
                $botonAvanzar.removeAttribute('disabled');
                $botonRetroceder.removeAttribute('disabled');
                $botonPlay.removeAttribute('disabled');
                $botonStop.setAttribute('disabled', true);
            }

            // Eventos
            $botonAvanzar.addEventListener('click', pasarFoto);
            $botonRetroceder.addEventListener('click', retrocederFoto);
            $botonPlay.addEventListener('click', playIntervalo);
            $botonStop.addEventListener('click', stopIntervalo);
            // Iniciar
            renderizarImagen();
        } 
    </script>

</head>

<body>
    <div class="menu-btn">
        <i class="fas fa-bars fa-2x"></i>
    </div>
    <div class="container">
        <div class="background-logo">

        </div>
        <nav class="nav-main">
            <div class="logo">
                <a href="/">
                    <img src="{{ url('/static/images/web/logo.png') }}" alt="Ipu Paraguay - Logo Oficial">
                </a>
            </div>
            <ul class="nav-menu">
                <li>
                    <a href="#">Inicio</a>
                </li>

                <li>
                    <a href="#">Historia</a>
                </li>
                <li>
                    <a href="{{route('timeline-show')}}">Timeline</a>
                </li>
                <li><a href="https://mail.ipuparaguay.org">Webmail</a></li>
                <li>
                    <a href="#">Contactos</a>
                </li>
            </ul>

            <ul class="nav-menu-rigth">
                <li>
                    <a href="#"><i class="fas fa-search"></i>
                        Buscar
                    </a>
                </li>
            </ul>
        </nav>
        <div class="line-red">

        </div>


        {{-- Noticias mas recientes --}}
        <div class="last-news">
            <a href="#">
                <marquee behavior="" direction="">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta omnis
                    tenetur fugiat iusto in maiores eaque quibusdam expedita commodi consequatur voluptate, nemo
                    blanditiis aperiam nostrum laudantium itaque, possimus necessitatibus. Facere?
                </marquee>
            </a>
        </div>

        <!-- Carousel -->

        <header>
            <div class="carousel">
                <button id="retroceder"><i class="fas fa-arrow-left"></i></button>
                <div id="imagen">

                </div>
                <button id="avanzar"><i class="fas fa-arrow-right"></i></button>
            </div>
        </header>
        
        <nav class="align-controls-carousel">
            <div class="controles">
                <button id="play"><i class="fas fa-play"></i></button>
                <button id="stop" disabled><i class="fa fa-stop" aria-hidden="true"></i>
                </button>
            </div>
        </nav>
        <div class="background-cards">

        </div>

        <div class="new-cards">
            <div class="cards-shadows">
                <img src="{{ url('/static/images/web/new1.jpeg') }}" alt="">
                <h3>Lorem, ipsum dolor.</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque quidem odit facere! Odio est
                    doloribus nemo fugiat! Quaerat, amet aliquam?</p>
                <a href="">Learn more <i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="cards-shadows">
                <img src="{{ url('/static/images/web/new2.jpg') }}" alt="">
                <h3>Lorem, ipsum dolor.</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque quidem odit facere! Odio est
                    doloribus nemo fugiat! Quaerat, amet aliquam?</p>
                <a href="">Learn more <i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="cards-shadows">
                <img src="{{ url('/static/images/web/new3.jpg') }}" alt="">
                <h3>Lorem, ipsum dolor.</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque quidem odit facere! Odio est
                    doloribus nemo fugiat! Quaerat, amet aliquam?</p>
                <a href="">Learn more <i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="cards-shadows">
                <img src="{{ url('/static/images/web/new1.jpeg') }}" alt="">
                <h3>Lorem, ipsum dolor.</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque quidem odit facere! Odio est
                    doloribus nemo fugiat! Quaerat, amet aliquam?</p>
                <a href="">Learn more <i class="fas fa-angle-double-right"></i></a>
            </div>
        </div>
        <!-- CAR BANNER UNO -->

        <section class="cards-banner-one">
            <div class="line-red">

            </div>
            <div class="content">
                <h2>Lorem, ipsum dolor.</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam porro, asperiores officia assumenda
                    voluptatum voluptas consequuntur fugiat et nostrum quod?</p>
                <a href="" class="btn">learn More <i class="fas fa-angle-double-right"></i></a>
            </div>
        </section>
    </div>
    <div class="line-red">

    </div>

    <div class="footer-links">
        <div class="footer-container">
            <ul>
                <li>
                    <a href="#">
                        <h3>
                            <i class="fa fa-phone" aria-hidden="true">

                            </i> Teléfono
                        </h3>

                    </a>
                </li>

                <li>
                    <a href="#">
                        <h3>
                            <i class="far fa-envelope"></i>
                            Correo
                        </h3>
                    </a>
                </li>

            </ul>

            <ul>
                <li>
                    <a href="#">
                        <h3><i class="fa fa-map-marker" aria-hidden="true"></i>
                            Dirección
                        </h3>
                    </a>
                </li>
            </ul>

            <ul>
                <li>
                    <a href="#">
                        <h3>Comisión Directiva</h3>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <h3>Presidente</h3>
                        <img src="{{ url('/static/images/cheman.jpeg') }}" class="img-round">
                    </a>
                </li>

                <li>
                    <a href="#">
                        <h3>Dirección Artística</h3>
                        <img src="{{ url('/static/images/lucia.jpeg') }}" class="img-round">
                    </a>
                </li>
            </ul>


            <!-- SOCIAL -->
            <section class="social">
                <p>Follow Ipu Paraguay</p>
                <div class="links">
                    <a href="https://www.facebook.com/IPU-PARAGUAY-Orquesta-Filarm%C3%B3nica-137397589669826">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.instagram.com/orquestaipuparaguay">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </section>

        </div>
    </div>


    <footer class="footer">
        <h3>Ipu Paraugay Copyright | 2020</h3>
    </footer>
    <!-- SCROLL REVEAL -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- CUSTOM JS -->
    <script src="{{ url('/static/js/web/main.js') }}"></script>
    <script src="main.js">
        <script src="https://kit.fontawesome.com/776ed7f2a9.js" crossorigin="anonymous">
    </script>
</body>

</html>