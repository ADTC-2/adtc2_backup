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
  require '../db/config.php';
  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Cadastrar Filiado</title>
</head>
<body>
<div class="container">	
<h1>Cadastrar Novo Filiado</h1>
<hr style="border:1px solid #008000;">
 <a href="../view/tela_controle_filiado.php">Listar filiados</a>

<div class="row">
<div class="col-md-12">	
        <form id="frmRegistro" name="frmRegistro" action="../procedimentos/cadastrar_filiado.php"  method="POST" enctype="multipart/form-data" style="border:1px solid #c3c9c5;margin-top:10px;padding:10px;margin-right:0px;background-color:#d49757;">
      	<div class="form-row">
           <div class="col-md-6">                       
           </div> 
           <div class="col-md-6">          
           </div>
           <div class="form-group col-md-8">
                <label for="nome" id="label_cor">Nome</label>			      
	   <input type="text" class="form-control"  name="nome"onkeyup="maiuscula(this)"required name=nome>
	   </div>
	   <div class="form-group col-md-8">
                <label for="nome" id="label_cor">Nome Carteira</label>			      
	        <input type="text" class="form-control"  name="nome_carteira"onkeyup="maiuscula(this)"required name=nome>
	   </div>
           <div class="form-group col-md-4"> 
                <label for="funcao" id="label_cor">Função </label>              
                <select class="form-control" id="funcao" name="funcao"onkeyup="maiuscula(this)"required name=funcao>   
                      <option>Selecione</option>
                      <option>Novo Convertido</option>
                      <option>Membro</option>
                      <option>Congregado</option>
                      <option>Auxiliar</option>
                      <option>Diácono</option>
                      <option>Presbítero</option>
                      <option>Evangelista</option>
                      <option>Missionário</option>
                      <option>Pastor-Presidente</option>
                      <option>Co-Pastor</option>
                      <option>Pastor</option>
                </select>
             </div>    
	</div> 

        <div class="form-row">
            <div class="form-group col-md-4"> 
                <label for="congregacao" id="label_cor">Congregação</label>      
                <select class="form-control" id="congregacao" name="congregacao"onkeyup="maiuscula(this)"required name=congregacao>                   
                      <option>Selecione</option>
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
                </select>
                </div>
		<div class="form-group col-md-2" >
                <label for="documento" id="label_cor">Documento</label> 		       	      
                <input type="text" class="form-control" id="documento"placeholder=""name="documento" >
		</div>
                <div class="form-group col-md-3" >
                <label for="datanascimento" id="label_cor">Data Nascimento</label>                  
                <input type="date" class="form-control" id="dataNascimento"name="dataNascimento" >
                </div>
                <div class="form-group col-md-3" >
                <label for="databatismo" id="label_cor">Data Batismo</label>                   
                <input type="date" class="form-control" id="dataBatismo"name="dataBatismo" >
                </div>
                <div class="form-group col-md-3" >
                <label for="data_Consagracao" id="label_cor">Data Consagração</label>                   
                <input type="date" class="form-control" id="data_Consagracao"name="data_Consagracao" >
                </div>	    
        </div>

        <div class="form-row">
                <div class="form-group col-md-2" >
                      <label for="estadoCivil" id="label_cor">Estado Civil</label>       
                <select class="form-control" id="estadoCivil" name="estadoCivil" onkeyup="maiuscula(this)"required name=estadoCivil>   
                      <option>Selecione</option>
                      <option>Casado</option>
                      <option>Casada</option>
                      <option>Solteiro</option>
                      <option>Solteira</option>
                      <option>Divorciado</option>
                      <option>Divorciada</option>
                      <option>Viuvo</option>
                      <option>Viuva</option>
                      <option>Separado</option>
                      <option>Separada</option>
                 </select>
                </div>

                <div class="form-group col-md-5" id="label_cor">
                        <label for="mae" id="label_cor"> Nome da Mãe</label>             
                        <input type="text" class="form-control" id="mae" name="mae"onkeyup="maiuscula(this)">
                </div>

                <div class="form-group col-md-5" id="label_cor"> 
                        <label for="pai" id="label_cor">Nome do Pai </label>   
                        <input type="text" class="form-control" id="pai"  name="pai"onkeyup="maiuscula(this)">
                </div>

        </div>  

                <div class="form-group">             
                        <div class="form-group col-md-12">
                                <label for="arquivo" class="form-label" id="label_cor">Cadastrar imagem</label>        
                                <input type="file" class="form-control" id="arquivo" name="arquivo" required accept="image/*">
                        </div>          
                </div>
                               
        <div class="form-row">
            <div class="form-group col-md-2"> 
                <label for="logradouro" id="label_cor">Logradouro</label>               
                <select class="form-control" id="logradouro" name="logradouro">   
                      
                      <option>Selecione</option>
                      <option>Rua</option>
                      <option>Avenida</option>
                      <option>Fazenda</option>
                      <option>Rodovia</option>
                      <option>Travessa</option>
                      <option>Povoado</option>
                      <option>Distrito</option>
                </select>
             </div>

                 <div class="form-group col-md-6" >
                <label for="endereco" id="label_cor">Endereço</label>                   
                <input type="text" class="form-control" id="endereco"placeholder=""name="endereco" onkeyup="maiuscula(this)">
                </div>
                <div class="form-group col-md-2" >
                <label for="numero" id="label_cor">Numero</label>                  
                <input type="text" class="form-control" id="numero"placeholder=""name="numero" >
                </div>
                 <div class="form-group col-md-2" >
                <label for="bairro" id="label_cor">Bairro</label>                   
                <input type="text" class="form-control" id="bairro"placeholder=""name="bairro" onkeyup="maiuscula(this)">
                 </div>        
        </div>

        <div class="form-row">
                <div class="form-group col-md-2"> 
                        <label for="cep" id="label_cor">CEP</label>               
                        <input type="text" class="form-control" id="cep"placeholder=""name="cep" oninput="mascaraCEP(event)">
                </div>

                <div class="form-group col-md-2" >
                        <label for="cidade" id="label_cor">Cidade</label>                   
                        <input type="text" class="form-control" id="cidade"placeholder=""name="cidade" onkeyup="maiuscula(this)"required name=cidade>
                </div>
                <div class="form-group col-md-2" >
                <label for="uf" id="label_cor">UF</label>                  
                <select class="form-control" id="uf" name="uf"required name=uf>                   
                      <option>Selecione</option>
                      <option>AC</option>
                      <option>AL</option>
                      <option>AM</option>
                      <option>AP</option>
                      <option>BA</option>
                      <option>CE</option>
                      <option>DF</option>
                </select>            
        </div>

                <div class="form-group col-md-2" >
                        <label for="telefone" id="label_cor">Telefone</label>                   
                        <input type="text" class="form-control" id="telefone"placeholder="" required name=telefone oninput="mascaraTelefone(event)">
                </div>
                <div class="form-group col-md-4" >
                <label for="email" id="label_cor">E-mail</label>                   
                <input type="email" class="form-control" id="email"placeholder=""name="email" oninput="mascaraEmail(event)" >
                </div>
                <div class="form-group col-md-2" >
                <label for="status" id="label_cor">Status</label>   
                <select class="form-control" id="status" name="status"required name=status>       
                       <option>Ativo</option>
                      <option>Habilitado ao Batismo</option>
                      <option>Em discipulado</option>
                      <option>Falecido</option>
                      <option>Deixou Ministerio</option>
                      <option>Em disciplina</option>
                      <option>Mudança ADTC2</option>
                      <option>Inativo</option>
                </select>
                </div>        
                </div>
                <div class="col-sm-6" style="margin-top:20px;">
                <div class="text-center">
                      <button type="submit" class="btn btn-primary btn-block">Gravar</button>
                      <a href="../view/tela_controle_filiado.php" class="btn btn-primary">Voltar</a>
                </div>
                </div>
                </div>

        </form>          
</div>
</div><!-- fim do Conteiner_principal --> 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>     
</body>
</html>
<script type="text/javascript">
        // INICIO FUNÇÃO DE MASCARA MAIUSCULA
        function maiuscula(z){
          v = z.value.toUpperCase();
          z.value = v; 
        }
          //FIM DA FUNÇÃO MASCARA MAIUSCULA
          function mascaraTelefone(event) {
                const input = event.target;
                const value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
                const maxDigits = 11; // Defina o número máximo de dígitos para o telefone

                if (value.length <= maxDigits) {
                const match = value.match(/^(\d{2})(\d{4,5})(\d{4})/);

                if (match) {
                input.value = `(${match[1]}) ${match[2]}-${match[3]}`;
                } else {
                input.value = value;
                }
                } else {
                // Limite o número de dígitos no campo
                input.value = input.value.slice(0, maxDigits);
                }
                }
                function mascaraCEP(event) {
                const input = event.target;
                const value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
                const match = value.match(/^(\d{2})(\d{3})(\d{3})$/);

                if (match) {
                input.value = `${match[1]}.${match[2]}-${match[3]}`;
                } else {
                input.value = value;
                }

                if (value.length >= 8) {
                // Limita a quantidade de caracteres a 9 (incluindo os separadores)
                input.value = input.value.slice(0, 8);
                }
                }
                function mascaraEmail(event) {
  const input = event.target;
  const value = input.value.trim(); // Remove espaços em branco no início e no final

  if (value.length > 0) {
    // Verifica se o valor é um email válido
    if (/^\S+@\S+\.\S+$/.test(value)) {
      input.value = value; // O email é válido, mantém o valor
    } else {
      // O email não é válido, mantém o que foi digitado
    }
  }
}



</script>




