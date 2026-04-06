<?php
include_once '../include/conexao.php';

// captura a acao e o id
$acao = $_REQUEST['acao'] ?? '';
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

switch ($acao) {
    case 'excluir':
        if ($id > 0) {
            $sql = "DELETE FROM recheios WHERE RecheioID = $id";
            mysqli_query($conexao, $sql);
        }
        header("Location: ../lista_recheio.php");
        break;

    case 'salvar':
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $sabor = mysqli_real_escape_string($conexao, $_POST['sabor']);

        // --- LÓGICA DE ATUALIZAÇÃO OU CADASTRO ---
        if ($id > 0) {
            // Se o ID for maior que zero, ele ATUALIZA o registro existente
            $sql = "UPDATE recheios SET 
                    Nome = '$nome', 
                    Sabor = '$sabor' 
                    WHERE RecheioID = $id";
        } else {
            // Se o ID for 0, ele CRIA um novo registro
            $sql = "INSERT INTO recheios (Nome, Sabor) VALUES ('$nome', '$sabor')";
        }

        if (!mysqli_query($conexao, $sql)) {
            die("Erro ao processar o recheio: " . mysqli_error($conexao));
        }

        header("Location: ../lista_recheio.php");
        break;

    default:
        header("Location: ../lista_recheio.php");
        break;
}
?>