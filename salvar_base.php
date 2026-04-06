<?php 
include_once './include/conexao.php';
include_once './include/header.php';

// 1. CAPTURA O ID DA URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 2. INICIALIZA AS VARIÁVEIS
$nome = '';
$cor  = '';
$titulo_pagina = "Incluir Base";

// 3. BUSCA DADOS SE FOR EDIÇÃO
if ($id > 0) {
    $titulo_pagina = "Editar Base";
    
    $sql = "SELECT * FROM base WHERE BaseID = $id LIMIT 1";
    $resultado = mysqli_query($conexao, $sql);
    
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
        $nome = $dados['Nome'];
        $cor  = $dados['Cor'];
    }
}
?>

<main>
    <div class="container">
        <div id="base" class="tela">
            <form class="crud-form" method="post" action="./act/base.php">
                <input type="hidden" name="acao" value="salvar">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                
                <h2><?php echo $titulo_pagina; ?></h2>
                
                <div class="form-group">
                    <label for="nome">Nome da Base</label>
                    <input type="text" name="nome" id="nome" 
                           placeholder="Ex: Baunilha, Chocolate, Integral" 
                           value="<?php echo htmlspecialchars($nome); ?>" required>
                </div>

                <div class="form-group">
                    <label for="cor">Cor / Aspecto</label>
                    <input type="text" name="cor" id="cor" 
                           placeholder="Ex: Amarelado, Escuro" 
                           value="<?php echo htmlspecialchars($cor); ?>" required>
                </div>

                <div class="botoes">
                    <button type="submit" class="btn-salvar">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</main>