<?php 
include_once './include/conexao.php';
include_once './include/header.php';
?>

  <main>

    <div class="container">
        <h1>Lista de Base</h1>
        <a href="./salvar_recheio.php" class="btn btn-add">Incluir</a>
        <table>
          <thead>
            <tr>
              <th>BaseID</th>
              <th>Nome</th>
              <th>Cor</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $sql = 'SELECT * FROM base';
          $resultado = mysqli_query($conexao, $sql);
          if (mysqli_num_rows($resultado) > 0) {
              while ($row = mysqli_fetch_assoc($resultado)) {
                  echo "<tr>";
                  echo "<td>" . $row['BaseID'] . "</td>";
                  echo "<td>" . $row['Nome'] . "</td>";
                  echo "<td>" . $row['Cor'] . "</td>";
                  echo "<td>
                          <a href='salvar-base.php?id=". $row['BaseID']. "' class='btn-editar'>Editar</a>
                          <a href='#' class=' btn-excluir'>Excluir</a>
                        </td>";
                  echo "</tr>";
              }
          }
          ?>
          </tbody>
        </table>
      </div> 
    </main>