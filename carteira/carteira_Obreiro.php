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
    <link rel="stylesheet" href="css/carteira_Obreiro.css">
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
        <div id="img_fundo1" class="">
          <img id="frente_card1"  onclick="trocar()"  src="imagens/membroGrande_new.png" alt="">
        </div>      

        
        <div id = "nome1" class = "col-12-sm"><p style="text-align:center"><?php echo $linhas['nome'];?></p></div> 
        <div id = "documento1" class = "col-12-sm"><p style="text-align:center"><?php echo $linhas['documento'];?></p></div>
        <div id = "dataNascimento1" class = "col-12-sm"><p style="text-align:center"><?php echo date("d/m/Y",strtotime($linhas['dataNascimento']));?></p></div>
        <div id = "dataBatismo1" class = "col-12-sm"><p style="text-align:center"><?php echo date("d/m/Y",strtotime($linhas['dataBatismo']));?></p></div>
        <div id = "estadoCivil1" class = "col-12-sm"><p style="text-align:center"><?php echo $linhas['estadoCivil'];?></p></div>
        <div id = "mae1" class = "col-12-sm"><p style="text-align:center"><?php echo $linhas['mae'];?></p></div>
        <div id = "pai1" class = "col-12-sm"><p style="text-align:center"><?php echo $linhas['pai'];?></p></div>
      
        
        <div id = "matricula1" class = "col-4-sm"><p style="text-align:center"><?php echo $linhas['matricula'];?></p></div>
        <div id = "nome_carteira1" class = "col-12-sm"><p style="text-align:center"><?php echo $linhas['nome_carteira'];?></p></div>
        <div id = "funcao1" class = "col-12-sm"><p style="text-align:center"><?php echo $linhas['funcao'];?></p></div>
        <div id = "congregacao1" class = "col-12-sm"><p style="text-align:center"><?php echo $linhas['congregacao'];?></p></div>    
       

        <div id = "foto1" class="circle">
           <img id="img_foto1" src="../imagens/<?php echo $linhas['arquivo'];?>">
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
        document.getElementById("frente_card1").src=ImgSrcArray[currentImgIndex]; //altera a img do elemento "bomdia" de acordo com o indice
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