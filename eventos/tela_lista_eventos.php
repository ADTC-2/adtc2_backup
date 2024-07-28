<?php
session_start();

if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('location:login.php');
}

require_once "../db/config.php";

$porPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$totalRegistros = $pdo->query("SELECT COUNT(*) FROM eventos")->fetchColumn();
$totalPaginas = ceil($totalRegistros / $porPagina);
$indiceInicio = ($paginaAtual - 1) * $porPagina;

$ordenar = isset($_GET['ordenar']) ? $_GET['ordenar'] : 'mes_asc';
$mesSelecionado = isset($_GET['mes']) ? $_GET['mes'] : null;

switch ($ordenar) {
    case 'mes_asc':
        $sql = "SELECT * FROM eventos WHERE MONTH(dt_evento) = :mesSelecionado ORDER BY DAY(dt_evento) ASC LIMIT $indiceInicio, $porPagina";
        break;
    case 'mes_desc':
        $sql = "SELECT * FROM eventos WHERE MONTH(dt_evento) = :mesSelecionado ORDER BY DAY(dt_evento) DESC LIMIT $indiceInicio, $porPagina";
        break;
    default:
        $sql = "SELECT * FROM eventos LIMIT $indiceInicio, $porPagina";
        break;
}

$query = $pdo->prepare($sql);
$query->bindParam(':mesSelecionado', $mesSelecionado, PDO::PARAM_INT);
$query->execute();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventos ADTC2</title>
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap/main.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0-beta3/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.js"></script>

    <!-- Bootstrap 5 scripts and styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #333;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f7f7f7;
            font-weight: bold;
        }

        .table tbody tr:hover {
            background-color: #f0f0f0;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination li {
            margin: 0 5px;
            list-style: none;
        }

        .pagination li.active a {
            background-color: #007bff;
            color: #fff;
            border-radius: 50%;
            padding: 8px 12px;
        }

        .pagination li a {
            padding: 8px 12px;
            text-decoration: none;
            color: #007bff;
            border: 1px solid #007bff;
            border-radius: 4px;
        }

        .pagination li a:hover {
            background-color: #007bff;
            color: #fff;
        }

        #calendar {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center">Secretaria Geral</h1>
    <div class="text-end mb-3">
        <a href="tela_cadastro.php" class="btn btn-primary">Cadastro</a>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4">Calendário de Eventos</h2>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-12 text-center">
                </div>
            </div>
            <form action="" method="get" class="mb-12">
                <div class="row d-flex align-items-end">
                    <div class="col-md-6">
                        <label for="mes" class="form-label">Selecionar Mês:</label>
                        <select name="mes" id="mes" class="form-select">
                            <option value="00"></option>
                            <option value="01">Janeiro</option>
                            <option value="02">Fevereiro</option>
                            <option value="03">Março</option>
                            <option value="04">Abril</option>
                            <option value="05">Maio</option>
                            <option value="06">Junho</option>
                            <option value="07">Julho</option>
                            <option value="08">Agosto</option>
                            <option value="09">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Aplicar</button>
                    </div>
                </div>
            </form>
            <br>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Evento</th>
                        <th>Informações</th>
                        <th>Congregação</th>
                        <th>Data Evento</th>
                        <th>Status</th>
                        <th>Alterar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($query->rowCount() > 0) {
                        foreach ($query->fetchAll() as $linhas) {
                            ?>
                            <tr>
                                <td><?php echo $linhas['id']; ?></td>
                                <td><?php echo $linhas['evento']; ?></td>
                                <td><?php echo $linhas['anotacoes']; ?></td>
                                <td><?php echo $linhas['congregacao']; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($linhas['dt_evento'])); ?></td>
                                <td><?php echo $linhas['situacao']; ?></td>
                                <td>
                                    <a href="tela_alterar_eventos.php?id=<?php echo $linhas['id']; ?>"><img src="../imagens/diversas_imagens/editar.png" width="25" height="20"></a>
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

    <div class="row">
        <div class="col-md-12">
            <ul class="pagination">
                <?php
                for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
                    echo "<li";
                    if ($pagina == $paginaAtual) {
                        echo " class='active'";
                    }
                    echo "><a href='?pagina=$pagina'>$pagina</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">           
            <div id="calendar"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'UTC',
            themeSystem: 'bootstrap5',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            weekNumbers: true,
            dayMaxEvents: true,
            events: 'https://fullcalendar.io/api/demo-feeds/events.json'
        });

        calendar.render();
    });
</script>
</body>
</html>











