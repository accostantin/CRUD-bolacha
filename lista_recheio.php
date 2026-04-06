<?php 
include_once './include/conexao.php';
include_once './include/header.php';
?>

  <main>

    <div class="container">
        <h1>Lista de Recheios</h1>
        <a href="./salvar_recheio.php" class="btn btn-add">Incluir</a>
        <table>
          <thead>
            <tr>
              <th>RecheioID</th>
              <th>Nome</th>
              <th>sabor</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $sql = 'SELECT * FROM recheios';
          $resultado = mysqli_query($conexao, $sql);
          if (mysqli_num_rows($resultado) > 0) {
              while ($row = mysqli_fetch_assoc($resultado)) {
                  echo "<tr>";
                  echo "<td>" . $row['RecheioID'] . "</td>";
                  echo "<td>" . $row['Nome'] . "</td>";
                  echo "<td>" . $row['Sabor'] . "</td>";
                  echo "<td>
        <a href='salvar_recheio.php?id=" . $row['RecheioID'] . "' class='btn-editar'>Editar</a>
        <a href='./act/recheio.php?id=" . $row['RecheioID'] . "&acao=excluir' class='btn-excluir'>Excluir</a>
      </td>";
                  echo "</tr>";
              }
          }
          ?>
          </tbody>
        </table>
      </div> 
    </main>