<?php
session_start();
$porPagina = 5;
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
if (!isset($_SESSION['usuario'])) {
    header('location: cadastro.php');
    exit;
} else {
    $usuario = $_SESSION['usuario'];
}

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
} else {
    echo 'ID do usuário não encontrado na sessão.';
    exit;
}
$database = new PDO('sqlite:projetoimpacta/projetoimpacta/bin/Debug/net6.0-windows/banco/banco.db');
$query = 'SELECT coalesce(pontos, 0) AS pontos, nome FROM usuarios WHERE usuario = :usuario';
$stmt = $database->prepare($query);
$stmt->bindParam(':usuario', $usuario);
$result = $stmt->execute();

if ($result) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $pontos = $row['pontos'];
    $nome = $row['nome'];
} else {
    echo 'Erro ao recuperar pontos do usuário';
}

$database = null;
try {
    $db = new PDO('sqlite:projetoimpacta/projetoimpacta/bin/Debug/net6.0-windows/banco/banco.db');
    $sql = 'SELECT codigo, data_resgate FROM codigo_resgatado WHERE id_usuario = :id_usuario ORDER BY data_resgate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id_usuario', $usuario_id);
    $stmt->execute();

    $codigosResgatados = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $codigosResgatados[] = $row;
    }
} catch (PDOException $e) {
    echo 'Erro no banco de dados: '.$e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Códigos resgatados</title>
    <link rel="stylesheet" href="style_codigos_resgatados.css?v=2">
    <link rel="icon" href="imagens/logo.jpg">
</head>

<body>
    <div class="meio">
        <div>
            <h4><img src="imagens/logo.jpg" alt="logo"> | Recompensas</h4>
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
        <h1>
            Histórico de resgate
        </h1>
        <div class="historico">
            <a href="pagina_de_item.php">
                Voltar
            </a>
        </div>
    </header>
    <main>
        <caption>
            Códigos já resgatados:
        </caption>
        <form>
            <table>
                <tr>
                    <th>Resgatado no dia:</th>
                    <th>Código:</th>
                </tr>
                <script>
                    let codigosResgatados = <?php echo json_encode($codigosResgatados); ?>;
                    let currentPage = 0;
                    let itemsPerPage = 5;

                    function showCodes() {
                        let startIndex = currentPage * itemsPerPage;
                        let endIndex = startIndex + itemsPerPage;
                        let codesToDisplay = codigosResgatados.slice(startIndex, endIndex);

                        let table = document.querySelector("table");
                        table.innerHTML = "<tr><th>Data:</th><th>Código:</th></tr>";

                        codesToDisplay.forEach((code) => {
                            let data_resgate_formatada = new Date(code.data_resgate).toLocaleDateString("pt-BR");
                            table.innerHTML += `
                <tr>
                    <td><div><img src='imagens/historico.png'>${data_resgate_formatada}</div></td>
                    <td class='codigo'><div>${code.codigo}</div></td>
                </tr>`;
                        });
                    }
                    showCodes();

                    function nextBtn() {
                        if (currentPage < Math.ceil(codigosResgatados.length / itemsPerPage) - 1) {
                            currentPage++;
                            showCodes();
                        }
                    }

                    function backBtn() {
                        if (currentPage > 0) {
                            currentPage--;
                            showCodes();
                        }
                    }
                </script>
            </table>
        </form>
    </main>
    <footer>
        <div class="container_footer">
            <?php
            $totalRegistros = $stmt->rowCount();
$totalPaginas = ceil($totalRegistros / $porPagina);

echo "<div class='pagination'>";
echo "<button class='btn1' onclick='backBtn()'><img src='imagens/esquerda.png' alt=''>Prev</button>";
echo '<ul>';

for ($i = 1; $i <= $totalPaginas; ++$i) {
    $classeAtiva = ($i === $paginaAtual) ? 'active' : '';
    echo "<li class='link $classeAtiva' value='$i'>$i</li>";
}

echo '</ul>';
echo "<button class='btn2' onclick='nextBtn()'>Next<img src='imagens/direita.png' alt=''></button>";
echo '</div>';
?>
        </div>
    </footer>
</body>

</html>