<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("location:cadastro.php");
    exit();
}

$usuario = $_SESSION["usuario"];

$database = new PDO('sqlite:projetoimpacta/projetoimpacta/bin/Debug/net6.0-windows/banco/banco.db');;

if (isset($_POST["produto_id"])) {
    $produto_id = $_POST["produto_id"];

    $queryPontosNecessarios = "SELECT pontos_necessarios FROM produtos WHERE produto_id = :produto_id";
    $stmtPontosNecessarios = $database->prepare($queryPontosNecessarios);
    $stmtPontosNecessarios->bindParam(':produto_id', $produto_id);
    $resultPontosNecessarios = $stmtPontosNecessarios->execute();

    if ($resultPontosNecessarios) {
        $rowPontosNecessarios = $stmtPontosNecessarios->fetch(PDO::FETCH_ASSOC);
        $pontosNecessarios = $rowPontosNecessarios['pontos_necessarios'];
    } else {
        echo "Erro ao recuperar pontos necessários do produto";
        exit();
    }

    $queryPontosUsuario = "SELECT coalesce(pontos, 0) AS pontos FROM usuarios WHERE usuario = :usuario";
    $stmtPontosUsuario = $database->prepare($queryPontosUsuario);
    $stmtPontosUsuario->bindParam(':usuario', $usuario);
    $resultPontosUsuario = $stmtPontosUsuario->execute();

    if ($resultPontosUsuario) {
        $rowPontosUsuario = $stmtPontosUsuario->fetch(PDO::FETCH_ASSOC);
        $pontosUsuario = $rowPontosUsuario['pontos'];

        if ($pontosUsuario >= $pontosNecessarios) {
            $novosPontos = $pontosUsuario - $pontosNecessarios;
            $queryAtualizarPontos = "UPDATE usuarios SET pontos = :novosPontos WHERE usuario = :usuario";
            $stmtAtualizarPontos = $database->prepare($queryAtualizarPontos);
            $stmtAtualizarPontos->bindParam(':novosPontos', $novosPontos);
            $stmtAtualizarPontos->bindParam(':usuario', $usuario);
            $resultAtualizarPontos = $stmtAtualizarPontos->execute();

            if ($resultAtualizarPontos) {
                header("Location: mostrar_qr_code.php");
            } else {
                echo "Erro ao atualizar pontos do usuário";
            }
        } else {
            header("Location: erro_resgate.php");
        }
    } else {
        echo "Erro ao recuperar pontos do usuário";
    }
} else {
    echo "Produto não especificado.";
}

$database = null;
?>
