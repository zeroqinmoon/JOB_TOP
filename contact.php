<?php

// Verifica se o POST existe antes de inserir um novo contato
if(isset($_POST["acao"])){
    if ($_POST["acao"]=="inserir"){
        inserirContato();
    }
    if ($_POST["acao"]=="atualizar"){
        atualizarContato();
    }
    if($_POST["acao"]=="excluir"){
        excluirContato();
    }
}


function abrirBanco() {
    $conexao = new mysqli("localhost", "root", "", "agenda");
    if ($conexao->connect_error) {
        echo "deu ruim";
        die("Connection failed: " . $conexao->connect_error);
    }
    return $conexao;
}

function inserirContato() {
    $banco = abrirBanco();
    $sql = "INSERT INTO contato(nome, email, objetivo) 
    VALUES ('{$_POST["nome"]}','{$_POST["email"]}','{$_POST["objetivo"]}')";
    $banco->query($sql);
    $banco->close();
    voltarIndex();
}

function atualizarContato() {
    $banco = abrirBanco();
    $sql = "UPDATE contato SET nome='{$_POST["nome"]}',email='{$_POST["email"]}',objetivo='{$_POST["objetivo"]}' WHERE id='{$_POST["id"]}'";
    $banco->query($sql);
    $banco->close();
    voltarIndex();
}

function excluirContato() {
    $banco = abrirBanco();
    $sql = "DELETE FROM contato WHERE id='{$_POST["id"]}'";
    $banco->query($sql);
    $banco->close();
    voltarIndex();
}

function selectAllContato() {
    $banco = abrirBanco();
    $sql = "SELECT * FROM contato ORDER BY nome";
    $resultado = $banco->query($sql);
    $banco->close();
    
    while($row = mysqli_fetch_array($resultado)) {
        $dados[] = $row;
    }
    return $dados;
}

function selectIdContato($id) {
    $banco = abrirBanco();
    $sql = "SELECT * FROM contato WHERE id=".$id;
    $resultado = $banco->query($sql);
    $banco->close();

    $contato = mysqli_fetch_assoc($resultado);
    return $contato;
}

function voltarIndex(){
    header("Location:contact.php");
}

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job Top - Contato</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- php code link-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="user/index.html">
                                        <img src="img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="user/index.html">home</a></li>
                                            <li><a href="user/jobs.html">Navegue pelo trabalho</a></li>
                                            <li><a href="#">Páginas<i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="user/candidate.html">Candidatos</a></li>
                                                    <li><a href="user/jobs.html">Vagas de Trabalho</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="user/blog.html">blog</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.php">Contato</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    <div class="d-none d-lg-block">
                                        <a class="boxed-btn3" href="contact.php">Publicar um emprego</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>contato</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->
    <!-- ================ contact section start ================= // maps not found, api invalid problem-->
    <section class="contact-section section_padding">
        <div class="container">
            <div class="d-none d-sm-block mb-5 pb-4">
                <!--<div id="map" style="height: 480px;"></div>
        <script>
          function initMap() {
            var uluru = {lat: -25.363, lng: 131.044};
            var grayStyles = [
              {
                featureType: "all",
                stylers: [
                  { saturation: -90 },
                  { lightness: 50 }
                ]
              },
              {elementType: 'labels.text.fill', stylers: [{color: '#ccdee9'}]}
            ];
            var map = new google.maps.Map(document.getElementById('map'), {
              center: uluru,
              zoom: 9,
              styles: grayStyles,
              scrollwheel:  false
            });
          }
          
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&callback=initMap"></script>
        
      </div>-->

                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Envie sua Solicitacao Para Nossa Central</h2>
                    </div>
                    <div class="container">
                        <form name="dadosContato" action="contact.php" method="post">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Nome: </td>
                                        <td><input type="text" name="nome" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>Email: </td>
                                        <td><input type="text" name="email" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>Links/Objetivo: </td>
                                        <td><input type="text" name="objetivo" value=""></td>
                                    </tr>
                                    <tr>
                                        <td><input type="hidden" name="acao" value="inserir"></td>
                                        <td><input type="submit" name="Enviar" value="Enviar"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>Bahia, Brasil.</h3>
                                <p>Euclides da Cunha, CEP 48500-000</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>55 (99) 9999 9999</h3>
                                <p>Telefone, Entre em contato</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>JOB_TOP1@suporte.com</h3>
                                <p>Envie sua solicitacao para nossos especialistas!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- ================ contact section end ================= -->
    <!-- footer start -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_logo">
                                <a href="user/index.html">
                                    <img src="img/logo.png" alt="">
                                </a>
                            </div>
                            <p>
                                nineyota@support.com <br>
                                +55 9 9999 9999 <br>
                                999, São Paulo, Brasil
                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".4s">
                            <h3 class="footer_title">
                                Empresa
                            </h3>
                            <ul>
                                <li><a href="user/index.html">Sobre </a></li>
                                <li><a href="user/jobs.html"> Trabalhos</a></li>
                                <li><a href="user/candidate.html">Candidatos/a></li>
                                <li><a href="contact.php">FAQ</a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".5s">
                            <h3 class="footer_title">
                                Categoria
                            </h3>
                            <ul>
                                <li><a href="jobs/design.html">Design & Art </a></li>
                                <li><a href="jobs/software_enginer.html">Engenharia Software</a></li>
                                <li><a href="jobs/marketing.html"> Vendas e marketing</a></li>
                                <li><a href="jobs/dev_wordpress.html">Vagas para DEV </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".6s">
                            <h3 class="footer_title">
                                Se inscrever
                            </h3>
                            <form action="#" class="newsletter_form">
                                <input type="text" placeholder="Enter your mail">
                                <button type="submit">Se inscrever</button>
                            </form>
                            <p class="newsletter_text"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".3s">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ footer end  -->
    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/gijgo.min.js"></script>

    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>

    <script src="js/main.js"></script>
</body>

</html>
