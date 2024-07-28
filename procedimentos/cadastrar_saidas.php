<?php
session_start();
if ( !isset($_SESSION['nome']) and !isset($_SESSION['senha']) ) {
  //Destrói
  session_destroy();

  //Limpa
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
  header('location:../login.php');
}

require'../db/config.php';

if (isset($_POST['datasaida']) && empty($_POST['datasaida']) == false) {
$dados=array(
addslashes($_POST["datasaida"]),
addslashes($_POST["valor"]),
addslashes($_POST["responsavel"]),
addslashes($_POST["congregacao"]),
addslashes($_POST["descricao"])

);

}



$sql = "INSERT INTO saidas (datasaida,valor,responsavel,congregacao,descricao) VALUES('$dados[0]','$dados[1]','$dados[2]','$dados[3]','$dados[4]')";
$sql = $pdo->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		if ($sql->rowCount() > 0 ){	
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_cad_saidas.php'>
				<script type=\"text/javascript\">
					alert(\"Saida cadastrada com Sucesso.\");
				</script>
			";		   
		}
		 else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_cad_saidas.php'>
				<script type=\"text/javascript\">
					alert(\"Saida não foi cadastrada com Sucesso.\");
				</script>
			";		   

		}

		?>
	</body>
</html>
