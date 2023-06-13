<?php
/* A Tabela Tratamento é a tabela principal com o id principal (id_tratamento)
    e a fk (id_base)
    a tabela tratamento é N:N criando as tabelas de associação
*/
include_once('../formulario/config.php');

//Listagem de dados por id do maior para o menor
$sql = "SELECT t.id_tratamento ,bl.base_legal, t.sensivel ,t.compartilhamento , t.objetivo , t.retencao, t.armazenamento FROM tratamento as t INNER JOIN base_legal as bl on bl.id_base = t.id_base";
//Junção de tabelas (on junção)

$result = $conexao->query($sql);
//print_r($result);

?>
<!DOCTYPE html>
<html lang="pt-br"> 

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Sistema</title>
    <style>
        body {
            font-family: system-ui, -apple-system, Helvetica, Arial, sans-serif;
            /*background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));*/
            color: white;
            text-align: center;
            background: #245680;
        }

        .table-bg {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }
    </style>
</head>

<body>
    <div>
        <div class="m-5">
            <table class="table text-white table-bg">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Processo</th>
                        <th scope="col">Base Legal</th>
                        <th scope="col">Sensíveis</th>
                        <th scope="col">Compartilhamento</th>
                        <th scope="col">Objetivo</th>
                        <th scope="col">Retenção</th>
                        <th scope="col">Dados Coletados</th>
                        <th scope="col">...</th>
                    </tr>
                    <thead>
                    <tbody>
                        <?php
                        while ($user_data = mysqli_fetch_assoc($result)) //Matriz associativa 
                        {
                            echo "<tr>";
                            echo "<td>" .$user_data['id_tratamento']."</td>";
                            echo "<td>" .$user_data['base_legal']."</td>";
                            echo "<td>" .$user_data['sensivel']."</td>";
                            echo "<td>" .$user_data['compartilhamento']."</td>";
                            echo "<td>" .$user_data['objetivo']."</td>";
                            echo "<td>" .$user_data['retencao']."</td>";
                            echo "<td>" .$user_data['armazenamento']."</td>";
                            echo " <td>
                            <a class='btn btn-sm btn-primary' href='edit.php?id=$user_data[id_tratamento] ' title='Editar'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-lápis' viewBox='0 0 16 16' >
                                    <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65- .65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10. 5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                                </svg>
                                </a>
                                <a class='btn btn-sm btn-danger' href='delete.php?id=$user_data[id_tratamento] ' title='Deletar'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi-trash-fill' viewBox='0 0 16 16'>
                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1 -1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a. 5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                    </svg>
                                </a>
                                </td>";
                            echo " </tr> ";
                            "</td>";
                        }
                        ?>
                    </tbody>
            </table>
        </div>
    </div>
</body>
</html>