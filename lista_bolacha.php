<?php 
include_once './include/conexao.php';
include_once './include/header.php';
?>

  <main>

    <div class="container">
        <h1>Lista de Bolacha</h1>
        <a href="./salvar_recheio.php" class="btn btn-add">Incluir</a>
        <table>
          <thead>
            <tr>
              <th>BolachaID</th>
              <th>Nome</th>
              <th>Marca</th>
              <th>Recheio</th>
              <th>Base</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $sql = 'SELECT bolacha.BolachaID AS BolachaID, bolacha.Nome AS NomeBolacha, recheios.Nome AS NomeRecheio, base.Nome As NomeBase, Marca FROM bolacha 
          INNER JOIN recheios ON bolacha.RecheioID = recheios.RecheioID
          INNER JOIN base ON bolacha.BaseID = base.BaseID';
          $resultado = mysqli_query($conexao, $sql);
          if (mysqli_num_rows($resultado) > 0) {
              while ($row = mysqli_fetch_assoc($resultado)) {
                  echo "<tr>";
                  echo "<td>" . $row['BolachaID'] . "</td>";
                  echo "<td>" . $row['NomeBolacha'] . "</td>";
                  echo "<td>" . $row['NomeRecheio'] . "</td>";
                  echo "<td>" . $row['NomeBase'] . "</td>";
                  echo "<td>" . $row['Marca'] . "</td>";
                  echo "<td>
                          <a href='salvar_bolacha.php?id=". $row['BolachaID']. "' class='btn-editar'>Editar</a>
                          <a href='./act/bolacha.php?id=" . $row['BolachaID'] . "&acao=excluir'class=' btn-excluir'>Excluir</a>
                        </td>";
                  echo "</tr>";
              }
          }
          ?>
          </tbody>
        </table>
      </div> 
    </main>