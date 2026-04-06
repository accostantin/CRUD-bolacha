<?php 
include_once '../include/conexao.php';

// Captura a ação e o ID
$acao = $_REQUEST['acao'] ?? '';
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

switch ($acao) {
    case 'excluir':
        // Proteção simples para o ID
        if ($id > 0) {
            $sql = "DELETE FROM bolacha WHERE BolachaID = $id";
            mysqli_query($conexao, $sql);
        }
        header("Location: ../lista_bolacha.php");
        break;

    case 'salvar':
        // 1. CAPTURA AS VARIÁVEIS DO FORMULÁRIO (usando os nomes do 'name' no HTML)
        $nome      = mysqli_real_escape_string($conexao, $_POST['nome']);
        $marca     = mysqli_real_escape_string($conexao, $_POST['marca']);
        $baseID    = intval($_POST['baseID']);
        $recheioID = intval($_POST['recheioID']);

        // 2. VERIFICA SE É EDIÇÃO OU NOVO REGISTRO
        if ($id > 0) {
            // Se o ID existe, ATUALIZA (UPDATE)
            $sql = "UPDATE bolacha SET 
                    Nome = '$nome', 
                    Marca = '$marca', 
                    BaseID = $baseID, 
                    RecheioID = $recheioID 
                    WHERE BolachaID = $id";
        } else {
            // Se o ID for 0, INSERE (INSERT)
            $sql = "INSERT INTO bolacha (Nome, Marca, BaseID, RecheioID) 
                    VALUES ('$nome', '$marca', $baseID, $recheioID)";
        }

        // 3. EXECUTA E REDIRECIONA
        if (mysqli_query($conexao, $sql)) {
            header("Location: ../lista_bolacha.php"); // Redireciona para a lista de bolachas
        } else {
            die("Erro ao processar a bolacha: " . mysqli_error($conexao));
        }
        break;

    default:
        header("Location: ../lista_bolacha.php");
        break;
}
?>