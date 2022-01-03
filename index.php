<?php
require_once('adwordscloaker.php');
?>
<html>
    <head>
        <title>Blog</title>
        <meta name="description" value="Açıklama" />
        <!-- Bootstrap core CSS -->
        <link href="<?php echo $baseur; ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="<?php echo $baseur; ?>/assets/css/style.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="<?php echo $baseur; ?>">Blog</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo $baseur; ?>">Anasayfa
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Hakkımızda
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Gizlilik Politikası
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">İletişim
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Content -->
        <div class="container">
            <p>&nbsp;</p>
            <div class="row mb-2">
                <?php
                for($i = 0; $i <= 2; $i++){
                ?>
                <div class="col-md-12">
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <a href="#" class="text-center p-3"><h4>&rsaquo; <?php echo $s->apiReturn[0]->$i->title; ?></h4></a>
                        <img class="bd-placeholder-img col-md-12" style="height: 400px !important;" src="<?php echo $s->apiReturn[0]->$i->image; ?>" alt="<?php echo $s->apiReturn[0]->$i->title; ?>" />
                        <div class="col p-4 d-flex flex-column position-static">
                            <p class="card-text mb-auto"><?php echo $s->apiReturn[0]->$i->content; ?></p>
                        </div>
                    </div>
                </div>
                <?php                    
                }
                ?>
            </div>
        </div>
        <!-- /.container -->
        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; <?php echo date('Y'); ?>.</p>
            </div>
            <!-- /.container -->
        </footer>
        <!-- Bootstrap core JavaScript -->
        <script src="<?php echo $baseur; ?>/assets/jquery/jquery.min.js"></script>
        <script src="<?php echo $baseur; ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>