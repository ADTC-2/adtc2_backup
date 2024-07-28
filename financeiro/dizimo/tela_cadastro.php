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
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <title>Lançamento | Dizimos</title>
  <style>
    /* Estilos personalizados */
    body {
      padding-top: 20px;
    }
    .navbar {
      margin-bottom: 20px;
    }
    .container {
      max-width: 600px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .btn-block {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <a href="../dizimo/lancamentos.php" class="navbar-brand"><i class="fas fa-arrow-left text-white"></i></a>

  </nav>
  <div class="container">
   <form novalidate class="needs-validation" action="procedimento_cad_dizimo.php"  method="POST" enctype="multipart/form-data">

    <div class="form-row">        
    <div class="col form-group">
      <label for="nome">Nome</label>
      <input type="text" name="nome" class="form-control is-valid" id="descricao" required oninput="this.value = this.value.toUpperCase();">
    </div>

    </div><!-- end div-form-row-->  
    <div class="form-row">        
        <div class="col form-group">
            <label for="nome">Congregação</label>
            <select name="congregacao" id="tipo_evento" class="custom-select is-valid"required >                     
                <option><?php echo $_SESSION['congregacao']; ?></option>                      
           </select>             
        </div>
    </div><!-- end div-form-row-->
    <div class="form-row">
        <div class="col form-group">
            <label for="nome">Valor</label>
            <input type="text" name="valor" class="form-control is-valid" id="valorInput"  required>
        </div>
    </div>
    <div class="form-row">     
    <div class="col form-group">
            <label for="nome">Responsável</label>
            <select name="responsavel" id="tipo_evento" class="custom-select is-valid"required >                     
            <option value="Tesoureiro: <?php echo htmlspecialchars($_SESSION['congregacao'], ENT_QUOTES, 'UTF-8'); ?>">
              Tesoureiro: <?php echo htmlspecialchars($_SESSION['congregacao'], ENT_QUOTES, 'UTF-8'); ?>
            </option>                      
              </select> 
            
        </div>
    </div><!-- end div-form-row-->

</div>        
 
    </div><!-- end div-form-group-row-->  

    <button type="submit" class="btn btn-primary btn-block">Gravar</button>  
    <a  href="tela_pesquisar_dizimo.php"class="btn btn-info btn-block">Listar Dízimos</a>  
    <a  href="tela_relatorio_dizimo.php"class="btn btn-primary btn-block">Relatório</a>           
   </form><!-- end form-->
  </div><!-- end div-container-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>














