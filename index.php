<?php
session_start();
require_once "db/config.php";
// Verificar se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Se não estiver autenticado, redirecionar para a página de login
    header('Location: login.php');
    exit; // Encerrar o script para evitar que o restante da página seja carregado
}

// Verificar se o usuário possui o nível de permissão de administrador
if ($_SESSION['nivel'] !== 'admin') {
    // Se não for um administrador, redirecionar para alguma outra página ou mostrar uma mensagem de erro
    echo "Você não tem permissão para acessar esta página.";
    exit; // Encerrar o script
}
      $total =0;
          $sql ="SELECT COUNT(*) as c FROM filiado";
          $sql = $pdo->query($sql);
          $sql = $sql->fetch();
          $total = $sql['c'];     
?>
<!Doctype html>
<html lang='pt-br'>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADTC System | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="certificado/certificado.php" class="nav-link">Certificado de Criança</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="eventos/tela_cadastro.php" class="nav-link">Cadastro de Eventos</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../adtc2/usuario/home.php" class="nav-link">Gestão de Usuários</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user nav-icon"></i> Usuario: <?php echo $_SESSION['nome']; ?>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">
                    <i class="fas fa-warehouse nav-icon"></i>
                    Congregação: <?php echo $_SESSION['congregacao']; ?>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="sair.php" class="nav-link"><i class="fas fa-sign-out-alt nav-icon"></i></a>
                </li>
            </ul>



        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ADTC System</span>
            </a>



            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="view/tela_cad_filiado.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Secretaria</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Filiados</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../adtc2/gestao_doc/index.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Documentos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="emissao_carta/index.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Emitir Carta</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="carteira/carteira.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cartão de Membro</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="eventos/tela_cadastro.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cadastrar Eventos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="view/tela_controle_filiado.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pesquisar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="envelope/criar_envelope.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Envelope Dizimo</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../adtc2/rel/baixar_arquivo.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Relatórios</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rodizio do campo</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="aniversarios/index.php" class="nav-link">
                                    <i class="far fa-calendar-alt nav-icon"></i>
                                    <p>Aniversariantes do Mês</p>
                                </a>
                            </li>
                        </ul>
                    </li>
            </nav>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4><?php echo $total;?></h4>

                                <p>Total de Filiados</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="#" class="small-box-footer">Campo </i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4>Agendamento Buffet<sup style="font-size: 20px"></sup></h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="../adtc2/agendamentos/tela_lista_agendamento.php"
                                class="small-box-footer">Cadastrar</i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h4>Patrimônio</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-home"></i>
                            </div>
                            <a href="patrimonio/tela_cadastro.php" class="small-box-footer">Cadastrar<i
                                    class="fa-solid fa-arrow-up-right-from-square"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4>Agenda Campo</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="eventos/tela_cadastro.php" class="small-box-footer">Cadastrar<i
                                    class="fas fa"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>


            </div>
            <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2021-2025 <a href="#">ADTC II - Maranguape</a>.</strong>
        Todos os direitos reservados
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.2.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
</body>

</html>