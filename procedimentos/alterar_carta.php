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


require '../db/config.php';

$matricula                      = $_POST['matricula'];

$cartas                        = $_POST['cartas'];





			
			//Pasta onde o arquivo vai ser salvo
			$_UP['pasta'] = '../cartas/';
			
			//Tamanho máximo do arquivo em Bytes
			$_UP['tamanho'] = 1024*1024*100; //5mb
			
			//Array com a extensões permitidas
			$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif','pdf','doc','docx');
			
			//Renomeiar
			$_UP['renomeia'] = false;
			
			//Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
			//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
			if($_FILES['cartas']['error'] != 0){
				die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['cartas']['error']]);
				exit; //Para a execução do script
			}
			
			//Faz a verificação da extensao do arquivo
			$extensao = @strtolower(end(explode('.', $_FILES['cartas']['name'])));
			if(array_search($extensao, $_UP['extensoes'])=== false){		
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_cad_filiado.php'>
					<script type=\"text/javascript\">
						alert(\"A imagem não foi cadastrada extensão válida.\");
					</script>
				";
			}
			
			//Faz a verificação do tamanho do arquivo
			else if($_UP['tamanho'] < $_FILES['cartas']['size']){
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_cad_filiado.php'>
					<script type=\"text/javascript\">
						alert(\"Arquivo muito grande.\");
					</script>
				";
			}
			
			//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
			else{
				//Primeiro verifica se deve trocar o nome do arquivo
				if(@$UP['renomeia'] == true){
					//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
					$nome_final = time().'.jpg';
				}else{
					//mantem o nome original do arquivo
					$nome_final = $_FILES['cartas']['name'];
				}
				//Verificar se é possivel mover o arquivo para a pasta escolhida
				if(move_uploaded_file($_FILES['cartas']['tmp_name'], $_UP['pasta']. $nome_final)){
					//Upload efetuado com sucesso, exibe a mensagem
                     					
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_cad_filiado.php'>
						<script type=\"text/javascript\">
							alert(\"Carta anexada com Sucesso.\");
						</script>
					";	
				}else{
					//Upload não efetuado com sucesso, exibe a mensagem
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_cad_filiado.php'>
						<script type=\"text/javascript\">
							alert(\"Carta não foi anexada !!\");
						</script>
					";
				}
			}
$data		= date('Y-m-d');
$cartas=$_FILES['cartas']['name'];

$sql = "UPDATE filiado SET cartas ='$cartas' WHERE matricula='$matricula'";
$sql=$pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php

		if ($sql->rowCount() !=0 ){	
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_controle_filiado.php'>
				<script type=\"text/javascript\">
					alert(\"Carta anexada com Sucesso.\");
				</script>
			";		   
		}else{ 	
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/tela_controle_filiado.php'>
				<script type=\"text/javascript\">
					alert(\"Carta não foi anexada .\");
				</script>
			";		   

		}

		?>
	</body>
</html>