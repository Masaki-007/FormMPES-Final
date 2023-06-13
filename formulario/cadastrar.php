<?php

include_once('config.php');

$alertForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Verificar a conexão com o banco de dados
if ($conexao->connect_error) {
    $retorna = ['status' => false, 'msg' => "Erro na conexão com o banco de dados: " . $conexao->connect_error];
    echo json_encode($retorna);
    exit;
}

if (empty($alertForm['processo'])) {
    $retorna = ['status' => false, 'msg' => "Erro: Necessário preencher o campo Processo!"];
} elseif (empty($alertForm['baseLegal'])) {
    $retorna = ['status' => false, 'msg' => "Erro: Necessário preencher o campo Base Legal!"];
} elseif (empty($alertForm['sensiveis'])) {
    $retorna = ['status' => false, 'msg' => "Erro: Necessário preencher o campo Sensíveis!"];
} elseif (empty($alertForm['compartilhamento'])) {
    $retorna = ['status' => false, 'msg' => "Erro: Necessário preencher o campo Compartilhamento!"];
} elseif (empty($alertForm['objetivo'])) {
    $retorna = ['status' => false, 'msg' => "Erro: Necessário preencher o campo Objetivo!"];
} elseif (empty($alertForm['retencao'])) {
    $retorna = ['status' => false, 'msg' => "Erro: Necessário preencher o campo Retenção!"];
} elseif (empty($alertForm['dados'])) {
    $retorna = ['status' => false, 'msg' => "Erro: Necessário preencher o campo Dados Coletados!"];
} else {
    $processo = $alertForm['processo'];
    $baseLegal = $alertForm['baseLegal'];
    $sensiveis = $alertForm['sensiveis'];
    $compartilhamento = $alertForm['compartilhamento'];
    $objetivo = $alertForm['objetivo'];
    $retencao = $alertForm['retencao'];
    $dados = $alertForm['dados'];

    // Preparar a consulta SQL
    $sql = "INSERT INTO tratamento (id_base, sensivel, objetivo, compartilhamento, armazenamento, retencao) 
            SELECT id_base, ?, ?, ?, ?, ? FROM base_legal WHERE base_legal = ?";
    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        $retorna = ['status' => false, 'msg' => "Erro na preparação da consulta: " . $conexao->error];
    } else {
        // Vincular os parâmetros e executar a consulta
        $stmt->bind_param("ssssss", $sensiveis, $objetivo, $compartilhamento, $armazenamento, $retencao, $baseLegal);
        $result = $stmt->execute();

        if (!$result) {
            $retorna = ['status' => false, 'msg' => "Erro na execução da consulta: " . $stmt->error];
        } else {
            $id_tratamento = $stmt->insert_id; // Obtém o ID do tratamento inserido

            // Inserir os dados pessoais relacionados ao tratamento
            $dadosColetados = $alertForm['dados'];
            $dadosColetados = explode(',', $dadosColetados);

            foreach ($dadosColetados as $dado) {
                $sql = "INSERT INTO tratamento_dados_pessoais (id_tratamento, id_dado) VALUES (?, ?)";
                $stmt_dados = $conexao->prepare($sql);

                if (!$stmt_dados) {
                    $retorna = ['status' => false, 'msg' => "Erro na preparação da consulta: " . $conexao->error];
                    break;
                }

                // Obtém o ID do dado pessoal com base no nome do dado
                $sql_select = "SELECT id_dado FROM dados_pessoais WHERE dado = ?";
                $stmt_select = $conexao->prepare($sql_select);
                $stmt_select->bind_param("s", $dado);
                $stmt_select->execute();
                $stmt_select->bind_result($id_dado);
                $stmt_select->fetch();
                $stmt_select->close();

                // Insere o relacionamento entre o tratamento e o dado pessoal
                $stmt_dados->bind_param("ii", $id_tratamento, $id_dado);
                $result_dados = $stmt_dados->execute();

                if (!$result_dados) {
                    $retorna = ['status' => false, 'msg' => "Erro na execução da consulta: " . $stmt_dados->error];
                    break;
                }
            }

            $stmt_dados->close(); // Fechar o statement após o loop

            if ($result_dados) {
                $retorna = ['status' => true, 'msg' => "Formulário cadastrado com Sucesso!"];
                header("Location: edicao/sistema.php");
                exit;
            } else {
                $retorna = ['status' => false, 'msg' => "Ocorreu um erro ao atualizar o registro."];
            }
        }
        $stmt->close(); // Fechar o statement após o loop
    }
}
echo json_encode($retorna);
