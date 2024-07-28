<?php ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADTC System | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" href="css/styles.css">

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
                <li class="nav-item">
                    <a href="home.php" class="nav-link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="home.php" class="nav-link">
                        <i class="fas fa-user"></i>Usuario
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="home.php" class="brand-link">
                <img src="../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ADTC System</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="home.php" class="nav-link active">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="cadastro.php" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Cadastro</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="lista.php" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Lista</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>Carteira</p>
                            </a>
                        </li>
                        >
                        <li class="nav-item">
                            <a href="../sair.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Sair</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Membros</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <main class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-eye"></i> Visualizar</h3>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Visualizar todos os filiados cadastrados.
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-primary">Entrar <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="nav-icon fas fa-coins"> </i>Cadastro</h3>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Realizar cadastro de novo filiado.
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <a href="" class="btn btn-primary">Entrar <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- /.content -->

            <!-- Footer -->
            <footer class="main-footer">
                <div class="float-right d-none d-sm-inline">
                    <b>Version</b> 1.2.0
                </div>
                <strong>Copyright &copy; 2021-2025 <a href="#">ADTC II - Maranguape</a>.</strong>
                Todos os direitos reservados.
            </footer>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>