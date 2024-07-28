<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói a sessão e limpa as variáveis de sessão
    session_destroy();
    session_unset();

    // Redireciona para a página de autenticação
    header('Location: ../login.php');
    exit;
}

require '../db/config.php'; // Verifique se o arquivo de configuração do banco de dados está correto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $evento = !empty($_POST['evento']) ? trim($_POST['evento']) : '';
    $anotacoes = !empty($_POST['anotacoes']) ? trim($_POST['anotacoes']) : '';
    $congregacao = !empty($_POST['congregacao']) ? trim($_POST['congregacao']) : '';
    $dt_evento = !empty($_POST['dt_evento']) ? trim($_POST['dt_evento']) : '';

    // Verifica se o evento já existe no banco de dados
    $existingEventQuery = "SELECT COUNT(*) FROM servico WHERE evento = ? AND dt_evento = ?";
    $stmtExistingEvent = $pdo->prepare($existingEventQuery);
    $stmtExistingEvent->execute([$evento, $dt_evento]);
    $count = $stmtExistingEvent->fetchColumn();

    if ($count == 0) {
        // O evento não existe, podemos inseri-lo
        try {
            $sql = "INSERT INTO servico (evento, anotacoes, congregacao, dt_evento) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$evento, $anotacoes, $congregacao, $dt_evento]);

            // Redireciona com uma mensagem de sucesso
            echo "<script>alert('Serviço cadastrado com sucesso.');</script>";
            echo "<script>window.location.href = 'servico/tela_cadastro.php';</script>";
            exit;
        } catch (PDOException $e) {
            // Lidar com erros no banco de dados
            error_log("Erro no banco de dados: " . $e->getMessage());
            echo "<script>alert('Ocorreu um erro ao cadastrar o serviço. Por favor, tente novamente mais tarde.');</script>";
            echo "<script>window.location.href = 'servico/tela_cadastro.php';</script>";
            exit;
        }
    } else {
        // Evento já cadastrado
        echo "<script>alert('Evento já cadastrado.');</script>";
        echo "<script>window.location.href = 'servico/tela_cadastro.php';</script>";
        exit;
    }
}
?>




