<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('location:cadastro.php');
} else {
  $usuario = $_SESSION['usuario'];
}

$database = new PDO('sqlite:PROJETO_IMPACTA/PROJETO_IMPACTA/bin/Debug/net6.0-windows/banco/banco.db');
$query = 'SELECT nome FROM professores WHERE usuario = :usuario';
$stmt = $database->prepare($query);
$stmt->bindParam(':usuario', $usuario);
$result = $stmt->execute();

if ($result) {
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $nome = $row['nome'];
} else {
  echo 'Erro ao recuperar pontos do usuário';
}

$database = null;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Points | Professor</title>
  <link rel="stylesheet" href="style_professor.css">
  <link rel="icon" href="imagens/logo.jpg">
</head>

<body>
  <div class="meio">
    <div>
      <h4><img src="imagens/logo.jpg" alt="logo"> | Área do professor</h4>
    </div>
    <div class="dropdown">
      <button class="dropbtn">
        <?php echo $nome; ?> <img src="imagens/user.png" alt="usuário">
      </button>
      <div class="dropdown-content">
        <div class="dropdown-content-linha1">
          <img src="imagens/logo.jpg" alt="logo">
          <div class="sair">
            <a href="sair.php">
              Sair
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <header>
    <h1>Olá, Professor(a)
      <?php echo $nome; ?>
    </h1>
    <div class="filtro">
      <?php
      $database = new PDO('sqlite:PROJETO_IMPACTA/PROJETO_IMPACTA/bin/Debug/net6.0-windows/banco/banco.db');
      $query = 'SELECT DISTINCT turma FROM usuarios';
      $turmas = $database->query($query)->fetchAll(PDO::FETCH_COLUMN);

      $database = null;
      ?>
      <label for="turma">Filtrar por Turma:</label>
      <select id="turma" name="turma">
        <option value="">Todas as Turmas</option>
        <?php
        foreach ($turmas as $turma) {
          echo '<option value="' . $turma . '">' . $turma . '</option>';
        }
        ?>
      </select>
      <input type="hidden" name="turmaSelecionada" id="turmaSelecionada" value="">
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const turmaSelect = document.getElementById('turma');
        const turmaSelecionadaInput = document.getElementById('turmaSelecionada');
        const tabela = document.querySelector('table');

        turmaSelect.addEventListener('change', function() {
          const selectedTurma = turmaSelect.value;

          turmaSelecionadaInput.value = selectedTurma;

          const linhas = tabela.querySelectorAll('tr');

          linhas.forEach(function(linha, index) {
            if (index === 0) {
              return;
            }

            const turmaCelula = linha.querySelector('td:nth-child(2)');

            if (!selectedTurma || turmaCelula.textContent === selectedTurma) {
              linha.style.display = 'table-row';
            } else {
              linha.style.display = 'none';
            }
          });
        });
      });
    </script>
  </header>
  <main>
    <?php
    if (isset($_SESSION['pontos_atualizados'])) {
    ?>
      <div class="pontos_atualizados">
        <h1>PONTOS ATUALIZADOS COM SUCESSO!</h1>
      </div>
    <?php
      unset($_SESSION['pontos_atualizados']);
    }
    ?>
    <form method="POST" action="update_pontos.php">
      <caption>TABELA DOS ALUNOS</caption>
      <table>
        <tr>
          <th>Nome</th>
          <th>Turma</th>
          <th>Presença por <br>ano</th>
          <th>Trabalho</th>
          <th>Prova</th>
        </tr>
        <?php
        $db = new PDO('sqlite:PROJETO_IMPACTA/PROJETO_IMPACTA/bin/Debug/net6.0-windows/banco/banco.db');
        $query = 'SELECT nome, turma, id FROM usuarios';
        $result = $db->prepare($query);
        $result->execute();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          echo "<input type='hidden' value='$turma' id='turma'>";
          echo '<tr>';
          echo '<td>' . $row['nome'] . '</td>';
          echo '<td>' . $row['turma'] . '</td>';

          echo "<td><select name='presenca[" . $row['id'] . "]'>
                <option value='Sim'>maior/igual a 80%</option>
                <option value='Não'>abaixo de 80%</option>
            </select></td>";

          echo "<td><select name='trabalho[" . $row['id'] . "]'>
                <option value='Sim'>Entregou todos</option>
                <option value='Não'>Não entregou todos</option>
            </select></td>";

          echo "<td><select name='prova[" . $row['id'] . "]'>
                <option value='Sim'>Dentro da média</option>
                <option value='Não'>Abaixo da média</option>
            </select></td>";

          echo '</tr>';
        }
        echo '</table>';
        echo "<input type='submit' value='Atualizar' class='btn_enviar'>";
        echo '</form>';

        $db = null;
        ?>
    </form>
  </main>
  <footer>
    <div class="informacoes">
      <ul>
        <li>Maior/igual a 80% em presença = 500 pontos</li>
        <li>Entregou todos os trabalhos = 1.000 pontos</li>
        <li>Prova dentro da média = 1.500 pontos</li>
      </ul>
    </div>
  </footer>
</body>

</html>