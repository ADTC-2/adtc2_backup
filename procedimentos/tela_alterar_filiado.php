<?php
session_start();
if (!isset($_SESSION['nome']) && !isset($_SESSION['senha'])) {
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Redireciona para a página de autenticação
    header('location:login.php');
}
?>

<?php
require '../db/config.php';

$matricula = $_GET['matricula'];

$sql = "SELECT * FROM filiado WHERE matricula ='$matricula' LIMIT 1";
$sql = $pdo->query($sql);
if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $resultado) {
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Alterar Filiado</title>
</head>
<body>
<div class="container">
    <h1>Cadastrar Novo Filiado</h1>
    <hr style="border:1px solid #008000;">
    <form id="frmRegistro" name="frmRegistro" action="../procedimentos/alterar_foto.php" method="POST" enctype="multipart/form-data" style="border: 1px solid #c3c9c5; margin-top: 10px; padding: 10px; margin-right: 0px; background-color: #c3c9c5; border-radius: 10px;">
        <div class="form-row" style="border-radius: 10px; padding: 10px; background-color: #c3c9c5">
            <div class="form-group col-md-12" id="label_cor">
                <label for="arquivo" id="label_cor">Alterar foto</label>
                <input type="file" class="form-control" id="arquivo" name="arquivo">
            </div>
            <div class="col-md-3">
                <input class="form-control" type="hidden" name="matricula" value="<?php echo $resultado['matricula'] ?>">
            </div>  
        </div><br>  
        <button id="registro" type="submit" name="button" class="btn btn-secondary" style="border-radius: 10px;">Trocar a foto</button>
    </form>
    <div class="row">
        <div class="col-md-12">
            <form id="frmRegistro" name="form1" action="../procedimentos/alterar_filiado.php" method="POST" enctype="multipart/form-data" style="border:1px solid #c3c9c5;margin-top:10px;padding:10px;margin-right:0px;background-color:#d49757;">
                <div class="form-row">
                    <div class="col-md-3">
                        <h1>Alterar Filiado</h1>
                        <input class="form-control" type="hidden" name="matricula" value="<?php echo $resultado['matricula'] ?>">
                    </div>
                    <div class="col-md-4">
                        <img src="../imagens/<?php echo $resultado['arquivo']; ?>" width="100" height="100" style="border-radius: 50%">
                    </div>
                </div>
                <script type="text/javascript">
                    // INICIO FUNÇÃO DE MASCARA MAIUSCULA
                    function maiuscula(z) {
                        v = z.value.toUpperCase();
                        z.value = v;
                    }
                    // FIM DA FUNÇÃO MASCARA MAIUSCULA
                </script>
                <div class="form-group col-md-8">
                    <label for="nome" id="label_cor">Nome</label>
                    <input type="text" class="form-control" id="" name="nome" onkeyup="maiuscula(this)" value="<?php echo $resultado['nome'] ?>">
                </div>
                <div class="form-group col-md-8">
                    <label for="nome" id="label_cor">Nome Carteira</label>
                    <input type="text" class="form-control" id="" name="nome_carteira" onkeyup="maiuscula(this)" value="<?php echo $resultado['nome_carteira'] ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="funcao" id="label_cor">Função</label>
                    <select class="form-control" id="funcao" name="funcao">
                        <option><?php echo $resultado['funcao'] ?></option>
                        <option>Novo Convertido</option>
                        <option>Congregado</option>
                        <option>Membro</option>
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
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="congregacao" id="label_cor">Congregação</label>
                        <select class="form-control" id="congregacao" name="congregacao">
                            <option><?php echo $resultado['congregacao'] ?></option>
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
                            <option>PLANALTO</option>
                            <option>SERRA JUBAIA</option>
                            <option>PAPARA</option>
                            <option>CASTELO</option>
                            <option>PARAISO</option>
                            <option>IRACEMA</option>
                            <option>Lameirão</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="documento" id="label_cor">Documento</label>
                        <input type="text" class="form-control" id="documento" placeholder="" name="documento" value="<?php echo $resultado['documento'] ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="datanascimento" id="label_cor">Data Nascimento</label>
                        <input type="date" class="form-control" id="dataNascimento" placeholder="" name="dataNascimento" value="<?php echo $resultado['dataNascimento'] ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="databatismo" id="label_cor">Data Batismo</label>
                        <input type="date" class="form-control" id="dataBatismo" placeholder="" name="dataBatismo" value="<?php echo $resultado['dataBatismo'] ?>">
                    </div>
                    <div class="form-group col-md-3" >
                    <label for="data_Consagracao" id="label_cor">Data Consagração</label>                   
                       <input type="date" class="form-control" id="data_Consagracao" placeholder="" name="data_Consagracao" value="<?php echo $resultado['data_Consagracao'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="estadoCivil" id="label_cor">Estado Civil</label>
                        <select class="form-control" id="estadoCivil" name="estadoCivil">
                            <option><?php echo $resultado['estadoCivil'] ?></option>
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
                        <input type="text" class="form-control" id="mae" name="mae" onkeyup="maiuscula(this)" value="<?php echo $resultado['mae'] ?>">
                    </div>
                    <div class="form-group col-md-5" id="label_cor">
                        <label for="pai" id="label_cor">Nome do Pai </label>
                        <input type="text" class="form-control" id="pai" name="pai" onkeyup="maiuscula(this)" value="<?php echo $resultado['pai'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8" id="label_cor">
                        <label for="arquivo" id="label_cor">Foto Atual</label>
                        <input type="text" class="form-control" id="arquivo" name="arquivo" value="<?php echo $resultado['arquivo'] ?>">
                    </div>
                    <div class="form-group col-md-4" id="label_cor">
                        <label for="datCadastro" id="label_cor">Data do Cadastro</label>
                        <input type="date" class="form-control" id="datCadastro" placeholder="" name="datCadastro" onkeyup="maiuscula(this)" value="<?php echo $resultado['datCadastro'] ?>">
                    </div>
                </div>
                <!---  Formulario para adicionar endereço                               -->
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="logradouro" id="label_cor">Logradouro</label>
                        <select class="form-control" id="logradouro" name="logradouro">
                            <option><?php echo $resultado['logradouro'] ?></option>
                            <option>Rua</option>
                            <option>Avenida</option>
                            <option>Fazenda</option>
                            <option>Rodovia</option>
                            <option>Travessa</option>
                            <option>Povoado</option>
                            <option>Distrito</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="endereco" id="label_cor">Endereço</label>
                        <input type="text" class="form-control" id="endereco" placeholder="" name="endereco" onkeyup="maiuscula(this)" value="<?php echo $resultado['endereco'] ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="numero" id="label_cor">Numero</label>
                        <input type="text" class="form-control" id="numero" placeholder="" name="numero" value="<?php echo $resultado['numero'] ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="bairro" id="label_cor">Bairro</label>
                        <input type="text" class="form-control" id="bairro" placeholder="" name="bairro" onkeyup="maiuscula(this)" value="<?php echo $resultado['bairro'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="cep" id="label_cor">CEP</label>
                        <input type="text" class="form-control" id="cep" placeholder="" name="cep" value="<?php echo $resultado['cep'] ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="cidade" id="label_cor">Cidade</label>
                        <input type="text" class="form-control" id="cidade" placeholder="" name="cidade" onkeyup="maiuscula(this)" value="<?php echo $resultado['cidade'] ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="uf" id="label_cor">UF</label>
                        <select class="form-control" id="uf" name="uf">
                            <option><?php echo $resultado['uf'] ?></option>
                            <option>AC</option>
                            <option>AL</option>
                            <option>AM</option>
                            <option>AP</option>
                            <option>BA</option>
                            <option>CE</option>
                            <option>DF</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="telefone" id="label_cor">Telefone</label>
                        <input type="text" class="form-control" id="telefone" placeholder="" name="telefone" value="<?php echo $resultado['telefone'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" id="label_cor">E-mail</label>
                        <input type="text" class="form-control" id="email" placeholder="" name="email" value="<?php echo $resultado['email'] ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="status" id="label_cor">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option><?php echo $resultado['status'] ?></option>
                            <option>Ativo</option>
                            <option>Habilitado ao Batismo</option>
                            <option>Em discipulado</option>
                            <option>Falecido</option>
                            <option>Deixou Ministério</option>
                            <option>Em disciplina</option>
                            <option>Mudança ADTC2</option>
                            <option>Inativo</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="col-sm-6" style="margin-top:20px;">
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary btn-block">Alterar</button>
                      <a href="../view/tela_controle_filiado.php" class="btn btn-primary">Voltar</a>
                   </div>
                 </div>
            </form>    
</body>
</html>
    
