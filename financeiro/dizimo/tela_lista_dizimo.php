<?PHP
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
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] != 'financeiro')) {
    // Redireciona para uma página de acesso negado ou outra página adequada
    header('location:acesso_negado.php');
    exit(); // Garante que o script pare de executar aqui
}

require '../../db/config.php';

$porPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$congregacao = isset($_GET['congregacao']) ? $_GET['congregacao'] : '';
$dataFiltro = isset($_GET['data']) ? $_GET['data'] : '';

// Consulta total de registros
$totalRegistros = $pdo->query("SELECT COUNT(*) FROM dizimo")->fetchColumn();
$totalPaginas = ceil($totalRegistros / $porPagina);
$indiceInicio = ($paginaAtual - 1) * $porPagina;

function getDizimoQuery($pdo, $indiceInicio, $porPagina, $congregacao = '', $dataFiltro = '') {
    if ($dataFiltro) {
        $sql = "SELECT * FROM dizimo WHERE DATE(dataCaptura) = :dataFiltro";
        if ($congregacao !== '') {
            $sql .= " AND congregacao = :congregacao";
        }
        $sql .= " LIMIT :indiceInicio, :porPagina";
        $query = $pdo->prepare($sql);
        $query->bindParam(':dataFiltro', $dataFiltro, PDO::PARAM_STR);
        if ($congregacao !== '') {
            $query->bindParam(':congregacao', $congregacao, PDO::PARAM_STR);
        }
        $query->bindParam(':indiceInicio', $indiceInicio, PDO::PARAM_INT);
        $query->bindParam(':porPagina', $porPagina, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }

    if ($congregacao === "Alves" || $congregacao === "Marcos") {
        return $pdo->query("SELECT * FROM dizimo LIMIT $indiceInicio, $porPagina");
    } else {
        $sql = "SELECT * FROM dizimo WHERE congregacao = :congregacao LIMIT :indiceInicio, :porPagina";
        $query = $pdo->prepare($sql);
        $query->bindParam(':congregacao', $congregacao, PDO::PARAM_STR);
        $query->bindParam(':indiceInicio', $indiceInicio, PDO::PARAM_INT);
        $query->bindParam(':porPagina', $porPagina, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }
}

$query = getDizimoQuery($pdo, $indiceInicio, $porPagina, $congregacao, $dataFiltro);

// Consulta para a soma dos valores
function getTotalSum($pdo, $congregacao = '', $dataFiltro = '') {
    if ($dataFiltro) {
        $sql = "SELECT SUM(valor) as total FROM dizimo WHERE DATE(dataCaptura) = :dataFiltro";
        if ($congregacao !== '') {
            $sql .= " AND congregacao = :congregacao";
        }
        $query = $pdo->prepare($sql);
        $query->bindParam(':dataFiltro', $dataFiltro, PDO::PARAM_STR);
        if ($congregacao !== '') {
            $query->bindParam(':congregacao', $congregacao, PDO::PARAM_STR);
        }
        $query->execute();
    } else if ($congregacao === "Alves" || $congregacao === "Marcos") {
        $sql = "SELECT SUM(valor) as total FROM dizimo";
        $query = $pdo->query($sql);
    } else {
        $sql = "SELECT SUM(valor) as total FROM dizimo WHERE congregacao = :congregacao";
        $query = $pdo->prepare($sql);
        $query->bindParam(':congregacao', $congregacao, PDO::PARAM_STR);
        $query->execute();
    }
    return $query->fetch(PDO::FETCH_ASSOC)['total'];
}

$totalSum = getTotalSum($pdo, $congregacao, $dataFiltro);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <style>
        /* Estilização da tabela */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            align-items: center;
        }

        /* ... (restante do CSS) ... */
    </style>
</head>

<body>
    <div class="container">
        <h1><a href="../dizimo/lancamentos.php" class="navbar-brand"><i class="fas fa-arrow-left"></i></a></h1>
        <a href="tela_cadastro.php">Cadastro</a>
        <hr style="border: 1px solid #008000;">

        <div class="row">
            
            <div class="col-md-6 d-flex align-items-center">
                <label for="dataFiltro" class="mr-2">Filtrar por data:</label>
                <input type="date" id="dataFiltro" class="form-control">
                <button class="btn btn-primary ml-2" onclick="filtrarPorData()">Filtrar</button>
            </div>
            <?php if ($congregacao === "Alves" || $congregacao === "Marcos") { ?>
            <div class="col-md-6 d-flex align-items-center">
                <label for="congregacao" class="mr-2">Filtrar por congregação:</label>
                <select id="congregacao" class="form-control">
                    <option value="">Todas as Congregações</option>
                    <option>SEDE</option>
                    <option>ALEGRIA</option>
                    <option>JUBAIA</option>
                    <option>LAGES</option>
                    <option>NOVO MARANGUAPE 1</option>
                    <option>NOVO MARANGUAPE 2</option>
                    <option>NOVO MARANGUAPE 3</option>
                    <option>NOVO MARANGUAPE 4</option>                     
                    <option>OUTRA BANDA</option>
                    <option>PARQUE SÃO JOÃO</option>
                    <option>NOVO PARQUE IRACEMA</option>
                    <option>SITIO SÃO LUIZ</option>
                    <option>TABATINGA</option>
                    <option>UMARIZEIRAS</option>
                    <option>VITÓRIA</option>
                    <option>VIÇOSA</option>
                    <option>PAPARA</option>
                    <option>PLANALTO</option>
                    <option>SERRA JUBAIA</option>
                    <option>IRACEMA</option>
                    <option>PARAISO</option>
                    <option>CASTELO</option>
                    <option>LAMEIRÃO</option>
                    <!-- Adicione outras opções conforme necessário -->
                </select>
                <button class="btn btn-primary ml-2" onclick="filtrarPorDataECongregacao()">Filtrar</button>
            </div>
            <?php } ?>
        </div>

        <!-- Tabela de registros -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <!-- Cabeçalho da tabela -->
                        <thead>
                            <tr>
                                <th>Transação</th>
                                <th>Nome</th>
                                <th>Congregação</th>
                                <th>Valor</th>
                                <th>Data Lançamento</th>
                                <?php if ($congregacao === "Alves" || $congregacao === "Marcos") { ?>
                                    <th>Excluir</th>
                                <?php } ?>
                                <th>Alterar</th>
                                <th>Comprovante</th>
                            </tr>
                        </thead>
                        <!-- Corpo da tabela -->
                        <tbody>
                            <?php
                            if (isset($query) && $query->rowCount() > 0) {
                                foreach ($query->fetchAll() as $linha) {
                                    ?>
                                    <tr>
                                        <td><?php echo $linha['id_dizimo']; ?></td>
                                        <td><?php echo $linha['nome']; ?></td>
                                        <td><?php echo $linha['congregacao']; ?></td>
                                        <td><?php echo 'R$ ' . number_format($linha['valor'], 2, ',', '.'); ?></td>
                                        <td><?php echo date("d/m/Y", strtotime($linha['dataCaptura'])); ?></td>
                                        <?php if ($congregacao === "Alves" || $congregacao === "Marcos") { ?>
                                            <td>
                                                <a href="procedimento_excluir_dizimo.php?id_dizimo=<?php echo $linha['id_dizimo']; ?>">
                                                    <img src="../../imagens/diversas_imagens/excluir.png" width="25" height="20">
                                                </a>
                                            </td>
                                        <?php } ?>
                                        <td>
                                            <a href="tela_alterar_dizimo.php?id_dizimo=<?php echo $linha['id_dizimo']; ?>">
                                                <img src="../../imagens/diversas_imagens/editar.png" width="25" height="20">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="tela_comprovante_dizimo.php?id_dizimo=<?php echo $linha['id_dizimo']; ?>">
                                                <img src="../../imagens/diversas_imagens/download.png" width="25" height="20">
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <!-- Paginação -->
        <div class="row">
            <div class="col-md-12">
                <ul class="pagination">
                    <?php
                    $maxLinks = 5; // número de links a serem exibidos ao redor da página atual
                    $start = max(1, $paginaAtual - $maxLinks);
                    $end = min($totalPaginas, $paginaAtual + $maxLinks);

                    if ($paginaAtual > 1) {
                        echo "<li class='page-item'><a class='page-link' href='?pagina=1&congregacao=$congregacao&data=$dataFiltro'>Primeiro</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?pagina=" . ($paginaAtual - 1) . "&congregacao=$congregacao&data=$dataFiltro'>Anterior</a></li>";
                    }

                    for ($pagina = $start; $pagina <= $end; $pagina++) {
                        $active = ($pagina == $paginaAtual) ? "active" : "";
                        echo "<li class='page-item $active'><a class='page-link' href='?pagina=$pagina&congregacao=$congregacao&data=$dataFiltro'>$pagina</a></li>";
                    }

                    if ($paginaAtual < $totalPaginas) {
                        echo "<li class='page-item'><a class='page-link' href='?pagina=" . ($paginaAtual + 1) . "&congregacao=$congregacao&data=$dataFiltro'>Próximo</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?pagina=$totalPaginas&congregacao=$congregacao&data=$dataFiltro'>Último</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function filtrarPorData() {
            const dataFiltro = document.getElementById('dataFiltro').value;
            window.location.href = `?data=${dataFiltro}`;
        }

        function filtrarPorDataECongregacao() {
            const dataFiltro = document.getElementById('dataFiltro').value;
            const congregacao = document.getElementById('congregacao').value;
            window.location.href = `?data=${dataFiltro}&congregacao=${congregacao}`;
        }
    </script>
</body>

</html>














