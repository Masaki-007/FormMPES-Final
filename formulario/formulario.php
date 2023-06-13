<?php

if (isset($_POST['submit'])) {
  echo "Passou aqui";

  
  //$dados = isset($_POST['dados']) ? ($_POST['dados']) : null;
  $dados = null;

  if (isset($_POST['dados']))
    $dados = $_POST['dados'];

  if ($dados !== null) {
    for ($i = 0; $i < count($dados); $i++) {
      //echo "<p>{$dados[$i]}</p>";
    }
  }

  include_once('./config.php');

  $processo = $_POST['processo'];
  $baseLegal = $_POST['baseLegal'];
  $sensiveis = $_POST['sensiveis'];
  $compartilhamento = $_POST['compartilhamento'];
  $objetivo = $_POST['objetivo'];
  $retencao = $_POST['retencao'];
  $dados = $_POST['dados'];

  $result = mysqli_query($conexao, "INSERT INTO tratamento(id_tratamento, id_base, sensivel, objetivo , compartilhamento, armazenamento, retencao) SELECT $id as id_tratamento, id_base as bl.id_base, $sensivel as sensivel, $objetivo as objetivo, $compartilhamento as compartilhamento, $armazenamento as armazenamento, $retencao as retencao FROM base_legal as bl WHERE base_legal = $baseLegal)");

  $id =  mysqli_query($conexao, " mysql_insert_id()");

  if ($dados !== null) {
    for ($i = 0; $i < count($dados); $i++) {

      $result = mysqli_query($conexao, "INSERT INTO tratamento_dados_pessoais(id_tratamento,id_dado) SELECT $id, id_dado FROM dados_pessoais WHERE dado = {$dados[$i]}");
    }
  } 
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      /*background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));*/
      width: 100%;
      box-sizing: border-box;
      margin: auto;
      background: #245680;

    }

    .box {
      color: white;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(0, 0, 0, 0.8);
      padding: 15px;
      border-radius: 15px;

    }

    fieldset {
      border: 3px solid dodgerblue;

    }

    legend {
      border: 1px solid dodgerblue;
      padding: 10px;
      text-align: center;
      background-color: dodgerblue;
      border-radius: 8px;

    }

    .inputbox {
      position: relative;

    }

    .inputProcesso {
      background: none;
      border: none;
      border-bottom: 1px solid white;
      outline: none;
      color: white;
      font-size: 15px;
      width: 100%;
      letter-spacing: 2px;
    }

    .labelInput {
      position: absolute;
      top: 0px;
      left: 0px;
      pointer-events: none;
      transition: .5s;

    }

    .inputProcesso:focus~.labelInput,
    .inputProcesso:valid~.labelInput {
      top: -20px;
      font-size: 12px;
      color: dodgerblue;

    }

    #submit {
      background-image: linear-gradient(to right, rgb(0, 92, 197), rgb(90, 20, 220));
      width: 100%;
      border: none;
      padding: 15px;
      color: white;
      font-size: 15px;
      cursor: pointer;
      border-radius: 10px;
    }

    #submit:hover {
      background-image: linear-gradient(to right, rgb(0, 80, 172), rgb(80, 19, 195));
    }
  </style>
</head>

<body>
  <div class="box">
    <form id="formulario" action="formulario.php" method="POST" class="formulario">
      <fieldset>
        <legend><b>Formulário</b></legend>
        <br>
        <div class="inputbox">
          <input type="text" name="processo" id="processo" class="inputProcesso" maxlength="80">
          <label for="processo" class="labelInput">Processo:</label>
        </div>
        <br>
        <div>
          <p>Base Legal:</p>
          <select id="baselegal" name="baseLegal" class="baseLegal">
            <option selected>Selecione</option>
            <option>I - Consentimento</option>
            <option>II - Cumprimento de obrigação legal ou regulatória</option>
            <option>III - Execução de políticas públicas</option>
            <option>IV - Estudos por órgão de pesquisa</option>
            <option>V - Execução de contrato</option>
            <option>VI - Exercício regular de direitos em processo judicial</option>
            <option>VII - Proteção da vida ou da incolumidade física do titular</option>
            <option>VIII - Tutela da saúde</option>
            <option>IX - Legítimo interesse</option>
            <option>X - Proteção do crédito</option>
          </select>
          <br>
          <div>
            <p>Sensíveis:</p>
            <input type="radio" id="sim" name="sensiveis" value="sim">
            <label for="sim">Sim</label>
            <input type="radio" id="nao" name="sensiveis" value="nao">
            <label for="nao">Não</label>
          </div>
          <br>
          <div>
            <p>Compartilhamento:</p>
            <input type="radio" id="s" name="compartilhamento" value="s">
            <label for="s">Sim</label>
            <input type="radio" id="n" name="compartilhamento" value="n">
            <label for="n">Não</label>
          </div>
          <br>
          <div>
            <p>Objetivo:</p>
            <textarea class="objetivo" name="objetivo" id="objetivo" rows="5" style="width: 26em" placeholder="Qual o seu objetivo..."></textarea>
          </div>
          <br>
          <div>
            <p>Retenção:</p>
            <textarea class="retencao" name="retencao" id="retencao" rows="5" style="width: 26em" placeholder="Qual a sua retenção..."></textarea>
          </div>
          <br>
          <div>
            <p>Dados Coletados:</p>
            <div class="inputbox">
              <input class="inputbox" type="checkbox" name="dados[]" id="cpf" value="cpf">
              <label class="inputbox" for="cpf">CPF</label>
            </div>
            <div class="inputbox">
              <input class="inputbox" type="checkbox" name="dados[]" id="genero" value="genero">
              <label class="inputbox" for="genero">Gênero</label>
            </div>
            <div class="inputbox">
              <input class="inputbox" type="checkbox" name="dados[]" id="login" value="login">
              <label class="inputbox" for="login">Login</label>
            </div>
            <div class="inputbox">
              <input class="inputbox" type="checkbox" name="dados[]" id="matricula" value="matricula">
              <label class="inputbox" for="matricula">Matricula</label>
            </div>
          </div>
          <div>
            <div class="inputbox">
              <input class="inputbox" type="checkbox" name="dados[]" id="rg" value="rg">
              <label class="inputbox" for="rg">RG</label>
            </div>
            <div class="inputbox">
              <input class="inputbox" type="checkbox" name="dados[]" id="saude" value="saude">
              <label class="inputbox" for="saude">Saúde</label>
            </div>
            <div class="inputbox">
              <input class="inputbox" type="checkbox" name="dados[]" id="telefone" value="telefone">
              <label class="inputbox" for="telefone">Telefone</label>
            </div>
          </div>
          <div>
            <button type="submit" name="submit" id="submit" value="enviar">Enviar</button>
          </div>
        </div>
        <script src="custom.js"></script>
        <script src="sweetAlert.js"></script>
  </div>
  </fieldset>
  </form>
  </div>
</body>

</html>