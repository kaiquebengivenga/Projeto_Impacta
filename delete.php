<?php

session_start();
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
} else {
    echo 'ID do usuário não encontrado na sessão.';
    exit;
}
try {
    $db = new PDO('sqlite:projetoimpacta/projetoimpacta/bin/Debug/net6.0-windows/banco/banco.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'DELETE FROM codigo_resgatado WHERE id_usuario = :id_usuario';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id_usuario', $usuario_id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: codigos_resgatados.php');
} catch (PDOException $e) {
    echo 'Erro: '.$e->getMessage();
}

?> 