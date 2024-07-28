<?php
session_start();

function checkAuth() {
    if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
        header('Location: login.php');
        exit();
    }

    if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] != 'apoio' && $_SESSION['nivel'] != 'admin')) {
        header('Location: acesso_negado.php');
        exit();
    }
}
?>
