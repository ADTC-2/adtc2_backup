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
  require_once "../db/config.php";
  
      $sql="SELECT * FROM filiado ";
      $sql=$pdo->query($sql);
    	 	   
      $matricula = $_GET['matricula'];
     
     
      $sql = "SELECT * FROM filiado WHERE matricula ='$matricula' LIMIT 1";
      $sql = $pdo->query($sql);	 
    
     

  if($sql->rowCount() > 0) {
      foreach($sql->fetchAll() as $linhas){   
  ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/carteira.css">
    <title>Identificação</title>
</head>
<body>
<style>
    @media print {
        nav {
            display: none;
        }
    }
</style>

<nav style="margin-left:50px;">
    <a href="#" onclick="window.print();" style="text-decoration:none;">
        <p id="texto_imprimir" ><?php echo rand(1,10)."   |  "."Imprimir";?></p>
    </a>
</nav>
    <div class="container">
     
    <img id="frente_card"  onclick="trocar()"  src="imagens/membroGrande_new.png" alt="">

        <div class="col-sm-12">
            
            <p id="doc"><?php echo $linhas['documento'];?></p>
            <p id="nascimento"><?php echo date("d/m/Y",strtotime($linhas['dataNascimento']));?></p>
            <p id="batismo"><?php echo date("d/m/Y",strtotime($linhas['dataBatismo']));?></p>
            <p id="estadoCivil"><?php echo $linhas['estadoCivil'];?></p>
            <p id="mae"> <?php echo $linhas['mae'];?></p>
            <p id="pai"><?php echo $linhas['pai'];?></p>
        </div>
        <div class="col-sm-12">
            <p id="matricula" style="color: white;"><?php echo $linhas['matricula'];?></p>
            <p id="nome" style="color: white;"><?php echo $linhas['nome'];?></p>
            <p id="cargo" style="color: white;"><?php echo $linhas['funcao'];?></p>
            <p id="congregacao" style="color: white;"><?php echo $linhas['congregacao'];?></p>
        </div>

        <div class="circle">
           <img id="foto_carteira_membro"src="../imagens/<?php echo $linhas['arquivo'];?>">
        </div>
        
    </div>
    <script>
         var currentImgIndex=1;
        var ImgSrcArray = [ //caminho das suas imgs aqui
        'imagens/membroGrande_new.png',
        'imagens/obreiroGrande_new.png'      
        ];

        function trocar(){

        if(currentImgIndex == ImgSrcArray.length) //reseta quando o contatador for igual ao tamanho da array e volta a 1° img
        {
            currentImgIndex=0;
        }
        document.getElementById("frente_card").src=ImgSrcArray[currentImgIndex]; //altera a img do elemento "bomdia" de acordo com o indice
            currentImgIndex++; // incrementa a nossa referencia

        }   
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>    
</body>
</html>

<?php 
   }
    } 
?>