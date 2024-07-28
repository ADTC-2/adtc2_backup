<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('location:login.php');
    exit(); // Garante que o script pare de executar aqui
}

// Verifica se o nível de acesso é "financeiro" ou "admin"
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] != 'financeiro' && $_SESSION['nivel'] != 'admin')) {
    // Redireciona para uma página de acesso negado ou outra página adequada
    header('location:acesso_negado.php');
    exit(); // Garante que o script pare de executar aqui
}

require '../../db/config.php';

$id_dizimo = $_GET['id_dizimo'];

$sql = "SELECT * FROM dizimo WHERE id_dizimo = '$id_dizimo' LIMIT 1";
$result = $pdo->query($sql);
$linhas = $result->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="css/dizimo.css">
    <title>Comprovante</title>
</head>
<body>
<style>
    @media print {
        nav {
            display: none;
        }
    }

    .comprovante {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center; /* centraliza o conteúdo */
    }

    .comprovante img {
        display: block;
        margin: 0 auto; /* centraliza a imagem */
        max-width: 100%; /* garante que a imagem não ultrapasse a largura do comprovante */
        margin-bottom: 20px; /* espaço abaixo da imagem */
    }

    .comprovante-header h4 {
        margin-top: 20px; /* espaço acima do título */
    }

    .comprovante-details {
        margin-bottom: 20px;
    }

    .comprovante-details p {
        margin: 5px 0;
    }
</style>

<nav style="margin-left:50px;">
    <a href="#" onclick="window.print();" style="text-decoration:none;">
        <p id="texto_imprimir"><?php echo rand(1, 10) . "   |  " . "Imprimir"; ?></p>
    </a>
      <a href="../dizimo/lancamentos.php" class="navbar-brand"><i class="fas fa-arrow-left"></i></a>
</nav>

<div class="comprovante">
    <div class="comprovante-header">
        <img src="../../imagens/diversas_imagens/logAdtcII.png" alt="">
        <h4>Comprovante de Dízimo</h4>
    </div>

    <div class="comprovante-details">
        <p><strong>Data:</strong> <?php echo date("d/m/Y", strtotime($linhas['dataCaptura'])); ?></p>
        <p><strong>Nome do dizimista:</strong> <?php echo $linhas['nome']; ?></p>
        <p><strong>Valor:</strong> R$ <?php echo number_format($linhas['valor'], 2, ',', '.'); ?></p>
        <p><strong>Responsável:</strong> <?php echo $linhas['responsavel']; ?></p>
        <p><strong>Congregação:</strong> <?php echo $linhas['congregacao']; ?></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

 