<?php

if (!empty($_GET['id_tratamento'])) {

    include_once('../formulario/config.php');

    $id = $_GET['id_tratamento'];

    $sqlSelect = "SELECT t.id_tratamento ,bl.base_legal, t.sensivel ,t.compartilhamento , t.objetivo , t.retencao, t.armazenamento FROM tratamento as t INNER JOIN base_legal as bl on bl.id_base = t.id_base WHERE t.id_tratamento=$id";
    //Condição onde id_tratamento seja a variavel id  

    $result = $conexao->query($sqlSelect);
    //print_r($result);

    //Verifica se o numero de linha for maior que 0
    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            $processo = $user_data['processo'];
            $baseLegal = $user_data['baseLegal'];
            $sensiveis = $user_data['sensivel'];
            $compartilhamento = $user_data['compartilhamento'];
            $objetivo = $user_data['objetivo'];
            $retencao = $user_data['retencao'];
            $dados = $user_data['dados'];
        }
    } else {
        $edicao = dirname($_SERVER['sistema.php']);
        header("Location: $edicao");
        exit;
    }
} else {
    $edicao = 'sistema.php';
    header("Location: $edicao");
    exit;
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
            background-color: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            width: 100%;
            box-sizing: border-box;
            margin: auto;

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

        #update {
            background-image: linear-gradient(to right, rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }

        #update:hover {
            background-image: linear-gradient(to right, rgb(0, 80, 172), rgb(80, 19, 195));
        }
    </style>
</head>

<body>
    <a href="sistema.php">Voltar</a>
    <div class="box">
        <form id="formulario" action="saveEdit.php" method="POST" class="formulario">
            <fieldset>
                <legend><b>Formulário</b></legend>
                <br>
                <div class="inputbox">
                    <input type="text" name="processo" id="processo" class="inputProcesso" value="<?php echo $processo ?>" maxlength="80">
                    <label for="processo" class="labelInput">Processo:</label>
                </div>
                <br>
                <div>
                    <p>Base Legal:</p>
                    <select id="baselegal" name="baseLegal" class="baseLegal" value="<?php echo $baseLegal ?>">
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
                        <input type="radio" id="sim" name="sensiveis" value="sim" <?php echo ($sensiveis == 'sim') ? 'checked' : '' ?>>
                        <label for="sim">Sim</label>
                        <input type="radio" id="nao" name="sensiveis" value="nao" <?php echo ($sensiveis == 'nao') ? 'checked' : '' ?>>>
                        <label for="nao">Não</label>
                    </div>
                    <br>
                    <div>
                        <p>Compartilhamento:</p>
                        <input type="radio" id="s" name="compartilhamento" value="s" <?php echo ($compartilhamento == 's') ? 'checked' : '' ?>>>>
                        <label for="s">Sim</label>
                        <input type="radio" id="n" name="compartilhamento" value="n" <?php echo ($compartilhamento == 'n') ? 'checked' : '' ?>>>>
                        <label for="n">Não</label>
                    </div>
                    <br>
                    <div>
                        <p>Objetivo:</p>
                        <textarea class="objetivo" name="objetivo" id="objetivo" rows="5" style="width: 26em" value="<?php echo $objetivo ?>" placeholder="Qual o seu objetivo..."></textarea>
                    </div>
                    <br>
                    <div>
                        <p>Retenção:</p>
                        <textarea class="retencao" name="retencao" id="retencao" rows="5" style="width: 26em" value="<?php echo $retencao ?>" placeholder="Qual a sua retenção..."></textarea>
                    </div>
                    <br>
                    <div>
                        <p>Dados Coletados:</p>
                        <div class="inputbox">
                            <input class="inputbox" type="checkbox" name="dados[]" id="cpf" value="cpf" <?php echo ($dados == 'cpf') ? 'checked' : '' ?>>
                            <label class="inputbox" for="cpf">CPF</label>
                        </div>
                        <div class="inputbox">
                            <input class="inputbox" type="checkbox" name="dados[]" id="genero" value="genero" <?php echo ($dados == 'genero') ? 'checked' : '' ?>>
                            <label class="inputbox" for="genero">Gênero</label>
                        </div>
                        <div class="inputbox">
                            <input class="inputbox" type="checkbox" name="dados[]" id="login" value="login" <?php echo ($dados == 'login') ? 'checked' : '' ?>>
                            <label class="inputbox" for="login">Login</label>
                        </div>
                        <div class="inputbox">
                            <input class="inputbox" type="checkbox" name="dados[]" id="matricula" value="matricula" <?php echo ($dados == 'matricula') ? 'checked' : '' ?>>
                            <label class="inputbox" for="matricula">Matricula</label>
                        </div>
                    </div>
                    <div>
                        <div class="inputbox">
                            <input class="inputbox" type="checkbox" name="dados[]" id="rg" value="rg" <?php echo ($dados == 'rg') ? 'checked' : '' ?>>
                            <label class="inputbox" for="rg">RG</label>
                        </div>
                        <div class="inputbox">
                            <input class="inputbox" type="checkbox" name="dados[]" id="saude" value="saude" <?php echo ($dados == 'saude') ? 'checked' : '' ?>>
                            <label class="inputbox" for="saude">Saúde</label>
                        </div>
                        <div class="inputbox">
                            <input class="inputbox" type="checkbox" name="dados[]" id="telefone" value="telefone" <?php echo ($dados == 'telefone') ? 'checked' : '' ?>>
                            <label class="inputbox" for="telefone">Telefone</label>
                        </div>
                    </div>
                    <div>
                        <br><br>
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <button type="submit" name="update" id="update" value="enviar">Enviar</button>
                    </div>
                </div>
                <script src="../formulario/custom.js"></script>
                <script src="../formulario/sweetAlert.js"></script>
    </div>
    </fieldset>
    </form>
    </div>
</body>

</html>