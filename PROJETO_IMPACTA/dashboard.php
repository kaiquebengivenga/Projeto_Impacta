<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('location:cadastro.php');
} else {
    $usuario = $_SESSION['usuario'];
}

$database = new PDO('sqlite:PROJETO_IMPACTA/PROJETO_IMPACTA/bin/Debug/net6.0-windows/banco/banco.db');
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

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Points | Aluno </title>
    <link rel="stylesheet" href="style_index.css?=v7">
    <link rel="icon" href="imagens/logo.jpg">

</head>

<body>
    <header>
        <h2 class="logo">School Points</h2>
        <nav class="navigation">
            <a class="current-page" href="dashboard.php">Home</a>
            <a href="sobre_nos_logado.php">Sobre nós</a>
            <a href="pagina_de_item.php">Resgatar</a>
            <div class="dropdown">
                <button class="dropbtn">
                    <?php echo $nome;
?> <img src="imagens/user.png" alt="usuário">
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
        </nav>
    </header>
    <main>
        <h1>School Points</h1>
        <p>"A educação é arma mais poderosa que você pode usar para mudar o mundo."</p>
        <br>
        <p>(Nelson Mandela)</p>
    </main>
</body>

</html>