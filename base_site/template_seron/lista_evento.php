    <?php

    include('session.php');
    include_once "Classes/evento.php";

   

    $evento = new Evento();

    // Verifica se o formulário foi enviado

    if (isset($_POST['Editar'])) {
        // Criando variáveis para receber as informações do formulário
        $data = $_POST['data'];
        $hora = $_POST['hora'];
        $local = $_POST['local'];
        $tipo_esporte = $_POST['tipo_esporte'];
        $faixa_etaria = $_POST['faixa_etaria'];
    }
  
?>

<!DOCTYPE php>
<php>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Eventos</title>
        
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/fontAwesome.css">
        <link rel="stylesheet" href="css/hero-slider.css">
        <link rel="stylesheet" href="css/owl-carousel.css">
        <link rel="stylesheet" href="css/style.css">

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>

<body>
    <div class="wrap">
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <button id="primary-nav-button" type="button">Menu</button>
                        <a href="index.php"><div class="logo">
                            <img src="img/logo2.png" alt="Venue Logo" width="220" height="100">
                        </div></a>
                        <nav id="primary-nav" class="dropdown cf">
                        <ul class="dropdown menu">
                                <li class='active'><a href="index.php">Página Inicial</a></li>

                                <li><a href="eventos.php">Eventos</a></li>

                                <li><a href="about-us.php">Sobre Nós</a></li>
                                
                                <li>
                                    <?php if($status == 'Logado'){
                                        
                                       echo '<a> Logado:' .  $_SESSION['user'] . ' </a>';
                                    }else{
                                        echo '<a href="cadastro.php">'  . $status . '</a>';
                                    } ?>
                                </li>
                                <?php
                                   if($status == 'Logado'){
                                    if($colaborador == TRUE) 
                                        echo '<li> <a href="Criar_evento.php"> Criar Evento </a> </li>';
                                        echo '<li> <a href="logout.php"> Sair </a> </li>';
                                }          
                                ?>
                                
                            </ul>
                        </nav><!-- / #primary-nav -->
                    </div>
                </div>
            </div>
        </header>
    </div>
      
    <section class="banner banner-secondary" id="top" style="background-image: url(img/banner_eventos.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="banner-caption">
                        <div class="line-dec"></div>
                        <h2>Listagem de Eventos</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="featured-places">
        <div class="container">
        <hr>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Local</th>
                        <th>Esporte</th>
                        <th>Idade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($evento->read($session_id) as $eventoItem) : ?>
                        <tr>
                            <td><?= $eventoItem->getId() ?></td>
                            <td><?= $eventoItem->getData() ?></td>
                            <td><?= $eventoItem->getHora() ?></td>
                            <td><?= $eventoItem->getLocal() ?></td>
                            <td><?= $eventoItem->getTipo_esporte() ?></td>
                            <td><?= $eventoItem->getFaixa_etaria() ?></td>
                            <td class="text-center">
                                <button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar<?= $eventoItem->getId() ?>">
                                    Editar
                                </button>
                                <a href="deleteEvento.php?id=<?= $eventoItem->getId() ?>" >
                                    <button class="btn btn-danger btn-sm" type="button">Excluir</button>
                                </a>

                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editar<?= $eventoItem->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="updateEvento.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Data</label>
                                                    <input type="date" name="data" value="<?= $eventoItem->getData() ?>" class="form-control" required />
                                                </div>
                                                <div class="col-md-7">
                                                    <label>Hora</label>
                                                    <input type="time" name="hora" value="<?= $eventoItem->getHora() ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Local</label>
                                                    <input type="text" name="local" value="<?= $eventoItem->getLocal() ?>" class="form-control" required />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Esporte</label>
                                                    <input type="text" name="tipo_esporte" value="<?= $eventoItem->getTipo_esporte() ?>" class="form-control" required />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Idade</label>
                                                    <input type="number" name="faixa_etaria" value="<?= $eventoItem->getFaixa_etaria() ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <br>
                                                    <input type="hidden" name="id" value="<?= $eventoItem->getId() ?>" />
                                                    <button class="btn btn-primary" type="submit" name="editar">Editar</button>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        
        <div class="blue-button">
            <a href="Criar_evento.php">Voltar</a>
        </div>  
                    </div>
        </section>
    </main>


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="about-veno">
                        <div class="logo">
                            <img src="img/logo2.png" alt="Venue Logo" width="200" height="100">
                        </div>
                        <p>Nosso objetivo é incentivar o antii-sedentarismo, visando a saúde e bem estar da população mais jovem.</p>
                </div>
                </div>
                <div class="col-md-4">
                    <div class="useful-links">
                        <div class="footer-heading">
                            <h4>Links rápidos</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="index.php"><i class="fa fa-stop"></i>Página Inicial</a></li>
                                    <li><a href="about.php"><i class="fa fa-stop"></i>Sobre Nós</a></li>
                                    <li><a href="contact.php"><i class="fa fa-stop"></i>Fale Conosco</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="team.php"><i class="fa fa-stop"></i>Autores</a></li>
                                    <li><a href="blog.php"><i class="fa fa-stop"></i>Eventos</a></li>
                                    <li><a href="terms.php"><i class="fa fa-stop"></i>Termos</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="footer-heading">
                            <h4>Informações de contato</h4>
                        </div>
                        <p><i class="fa fa-map-marker"></i> Fatec Araras, SP</p>
                        <ul>
                            <li><span>Phone:</span><a href="#">+55 19 99999-9999</a></li>
                            <li><span>Email:</span><a href="#">sac@seron.com.br</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="sub-footer">
        <p>Copyright © 2023 SERON - Conheça mais sobre: <a href="https://periodic-word-7f5.notion.site/SERON-4ab5a4c87629464c9faf2b9417301042">Seron.com</a></p>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="js/vendor/bootstrap.min.js"></script>
    
    <script src="js/datepicker.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
