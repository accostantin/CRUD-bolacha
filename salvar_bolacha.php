<?php 
include_once './include/conexao.php';
include_once './include/header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : '';

// 1. INICIALIZAÇÃO DE VARIÁVEIS (Evita erro de "undefined variable")
$nomeBolacha = '';
$recheioID   = '';
$baseID      = '';
$marca       = '';

// 2. CONSULTAS PARA OS SELECTS (Sempre carregam para preencher as opções)
$resBases        = mysqli_query($conexao, "SELECT BaseID, Nome FROM base ORDER BY Nome ASC");
$resRecheios     = mysqli_query($conexao, "SELECT RecheioID, Nome FROM recheios ORDER BY Nome ASC");

// 3. BUSCA DADOS CASO SEJA EDIÇÃO
if ($id > 0) {
    // Busca os dados da bolacha específica
    $sql = "SELECT * FROM bolacha WHERE BolachaID = $id LIMIT 1";
    $return = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($return);

    if ($dados) {
        $nomeBolacha = $dados['Nome'];
        $recheioID   = $dados['RecheioID'];
        $baseID      = $dados['BaseID'];
        $marca       = $dados['Marca'];
    }
}
?>

<main>
    <div id="bolacha" class="tela">
        <form class="crud-form" method="post" action="./act/bolacha.php">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <h2>Cadastro de Bolachas</h2>
            
            <label>Nome da Bolacha</label>
            <input type="text" name="nome" placeholder="Ex: Recheada de Morango" value="<?php echo htmlspecialchars($nomeBolacha); ?>" required>

            <label>Marca</label>
            <input type="text" name="marca" placeholder="Marca" value="<?php echo htmlspecialchars($marca); ?>">

            <label for="base">Base</label>
            <select name="baseID" id="base" required>
                <option value="">Selecione a Base</option>
                <?php
                while ($b = mysqli_fetch_assoc($resBases)) {
                    $selected = ($baseID == $b['BaseID']) ? 'selected' : '';
                    echo "<option value='{$b['BaseID']}' $selected>" . htmlspecialchars($b['Nome']) . "</option>";
                }
                ?>
            </select>

            <label for="recheio">Recheio</label>
            <select name="recheioID" id="recheio" required>
                <option value="">Selecione o Recheio</option>
                <?php
                while ($r = mysqli_fetch_assoc($resRecheios)) {
                    $selected = ($recheioID == $r['RecheioID']) ? 'selected' : '';
                    echo "<option value='{$r['RecheioID']}' $selected>" . htmlspecialchars($r['Nome']) . "</option>";
                }
                ?>
            </select>

            <button type="submit" class="btn-salvar">Salvar Bolacha</button>
        </form>
    </div>
</main>