<?php 
include_once './include/conexao.php';
include_once './include/header.php';
?>

<h2>Bolacha</h2>
<form class="" method="post" action="./act/recheio.php">
    <input type="hidden" name="acao" value="salvar">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="text" name="nome" placeholder="Nome">
    <input type="text" name="marca" placeholder="Marca">
    <button>Salvar</button>
</form>

