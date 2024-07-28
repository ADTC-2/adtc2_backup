<?php
session_start();

// Validação de sessão
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    header('location:../login.php');
    exit;
}

require '../db/config.php';

// Validação de entrada
$required_fields = ['nome', 'nome_carteira', 'funcao', 'congregacao', 'documento', 'dataNascimento', 'dataBatismo',  'estadoCivil', 'mae'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios.'); window.location='../view/tela_cad_filiado.php';</script>";
        exit;
    }
}

// Prevenção de injeção SQL e verificação de duplicatas
$nome = $_POST['nome'];
$documento = $_POST['documento'];
$stmt = $pdo->prepare("SELECT * FROM filiado WHERE nome = :nome OR documento = :documento");
$stmt->execute(['nome' => $nome, 'documento' => $documento]);
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row['nome'] == $nome) {
        echo "<script>alert('Nome já cadastrado!'); window.location='../view/tela_cad_filiado.php';</script>";
    } elseif ($row['documento'] == $documento) {
        echo "<script>alert('Documento já cadastrado!'); window.location='../view/tela_cad_filiado.php';</script>";
    }
    exit;
}

// Upload de imagem
$upload_dir = '../imagens/';
$upload_file = $upload_dir . basename($_FILES['arquivo']['name']);

if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], $upload_file)) {
    echo "<script>alert('Erro ao enviar a imagem.'); window.location='../view/tela_cad_filiado.php';</script>";
    exit;
}

// Inserção no banco de dados
$sql = "INSERT INTO filiado (nome, nome_carteira, funcao, congregacao, documento, dataNascimento, dataBatismo, data_Consagracao, estadoCivil, mae, pai, logradouro, endereco, numero, bairro, cep, cidade, uf, telefone, email, status, arquivo, datCadastro) VALUES (:nome, :nome_carteira, :funcao, :congregacao, :documento, :dataNascimento, :dataBatismo, :data_Consagracao, :estadoCivil, :mae, :pai, :logradouro, :endereco, :numero, :bairro, :cep, :cidade, :uf, :telefone, :email, :status, :arquivo, NOW())";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'nome' => $nome,
    'nome_carteira' => $_POST['nome_carteira'],
    'funcao' => $_POST['funcao'],
    'congregacao' => $_POST['congregacao'],
    'documento' => $documento,
    'dataNascimento' => $_POST['dataNascimento'],
    'dataBatismo' => $_POST['dataBatismo'],
    'data_Consagracao' => $_POST['data_Consagracao'],
    'estadoCivil' => $_POST['estadoCivil'],
    'mae' => $_POST['mae'],
    'pai' => $_POST['pai'],
    'logradouro' => $_POST['logradouro'],
    'endereco' => $_POST['endereco'],
    'numero' => $_POST['numero'],
    'bairro' => $_POST['bairro'],
    'cep' => $_POST['cep'],
    'cidade' => $_POST['cidade'],
    'uf' => $_POST['uf'],
    'telefone' => $_POST['telefone'],
    'email' => $_POST['email'],
    'status' => $_POST['status'],
    'arquivo' => $_FILES['arquivo']['name']
]);

if ($stmt->rowCount() > 0) {
    echo "<script>alert('Filiado cadastrado com sucesso.'); window.location='../view/tela_cad_filiado.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar o filiado.'); window.location='../view/tela_cad_filiado.php';</script>";
}
?>





