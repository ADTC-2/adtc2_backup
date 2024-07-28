<?php
session_start();
if (!isset($_SESSION['nome']) and !isset($_SESSION['senha']) )
 {  
  //Limpa
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
  header('location:login.php'); 
  }
?>
<?php
// Função para construir condições da consulta SQL
function buildConditions(&$conditions, &$parameters, $key, $value) {
    if (!empty($value)) {
        $conditions[] = "$key = :$key";
        $parameters[$key] = $value;
    }
}

// Condições do GET
$conditions = [];
$parameters = [];

buildConditions($conditions, $parameters, 'matricula', $_GET['matricula']);
buildConditions($conditions, $parameters, 'nome', $_GET['nome']);
$funcao = $_GET['funcao'];

if ($funcao === 'membro' || $funcao === 'congregado') {
    header('Location: impressao_carteira.php?' . http_build_query($_GET));
    exit;
} else {
    buildConditions($conditions, $parameters, 'funcao', $funcao);
    header('Location: impressao_carteira_obreiro.php?' . http_build_query($_GET));
    exit;
}

// Montar a consulta SQL
$sql = "SELECT * FROM filiado";
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}

$stmt = $pdo->prepare($sql);
$stmt->execute($parameters);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Agora $result contém os resultados da consulta
?>
