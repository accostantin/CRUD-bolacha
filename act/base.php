<?php
include_once '../include/conexao.php';

// captura a acao e o id
$acao = $_REQUEST['acao'] ?? '';
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

switch ($acao) {
    case 'excluir':
        if ($id > 0) {
            // Verifique se o nome da coluna é BaseID ou baseID no seu banco
            $sql = "DELETE FROM base WHERE BaseID = $id";
            mysqli_query($conexao, $sql);
        }
        header("Location: ../lista_base.php");
        break;

    case 'salvar':
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $cor = mysqli_real_escape_string($conexao, $_POST['cor']);

        if ($id > 0) {
            // Se o ID existe, ATUALIZA o registro
            $sql = "UPDATE base SET 
                    Nome = '$nome', 
                    Cor = '$cor' 
                    WHERE BaseID = $id";
        } else {
            // Se o ID é 0, INSERE um novo
            $sql = "INSERT INTO base (Nome, Cor) VALUES ('$nome', '$cor')";
        }

        if (!mysqli_query($conexao, $sql)) {
            die("Erro ao processar a base: " . mysqli_error($conexao));
        }

        header("Location: ../lista_base.php");
        break;

    default:
        header("Location: ../lista_base.php");
        break;
}
?>