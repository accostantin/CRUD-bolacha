<?php 
include_once './include/conexao.php';
include_once './include/header.php';

// 1. CAPTURA O ID DA URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 2. INICIALIZA AS VARIÁVEIS VAZIAS (Para o caso de ser uma "Inclusão")
$nome  = '';
$sabor = '';
$titulo_pagina = "Incluir Recheio";

// 3. SE HOUVER ID, BUSCA OS DADOS (Para o caso de ser "Edição")
if ($id > 0) {
    $titulo_pagina = "Editar Recheio";
    
    $sql = "SELECT * FROM recheios WHERE RecheioID = $id LIMIT 1";
    $resultado = mysqli_query($conexao, $sql);
    
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
        $nome  = $dados['Nome'];
        $sabor = $dados['Sabor'];
    }
}
?>

<main>
    <div class="container">
        <div id="recheio" class="tela">
            <form class="crud-form" method="post" action="./act/recheio.php">
                <input type="hidden" name="acao" value="salvar">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                
                <h2><?php echo $titulo_pagina; ?></h2>
                
                <div class="form-group">
                    <label for="nome">Nome do Recheio</label>
                    <input type="text" name="nome" id="nome" 
                           placeholder="Ex: Chocolate Belga" 
                           value="<?php echo htmlspecialchars($nome); ?>" required>
                </div>

                <div class="form-group">
                    <label for="sabor">Sabor</label>
                    <input type="text" name="sabor" id="sabor" 
                           placeholder="Ex: Doce / Meio Amargo" 
                           value="<?php echo htmlspecialchars($sabor); ?>" required>
                </div>

                <div class="botoes">
                    <button type="submit" class="btn-salvar">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</main>
