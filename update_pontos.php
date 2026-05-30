<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $db = new PDO('sqlite:projetoimpacta/projetoimpacta/bin/Debug/net6.0-windows/banco/banco.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->beginTransaction();

        foreach ($_POST['presenca'] as $id => $valorPresenca) {
            $updateSql = "UPDATE usuarios SET pontos = pontos + 500 WHERE id = :id and turma = :turma";
            if (!empty($_POST['turma'])) {
                $updateSql .= " AND turma = :turma";
            }
            $updateStmt = $db->prepare($updateSql);
            $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
            if (!empty($_POST['turma'])) {
                $updateStmt->bindParam(':turma', $_POST['turma']);
            }
            $updateStmt->execute();
        }

        foreach ($_POST['trabalho'] as $id => $valorTrabalho) {
            $updateSql = "UPDATE usuarios SET pontos = pontos + 1000 WHERE id = :id and turma = :turma";
            if (!empty($_POST['turma'])) {
                $updateSql .= " AND turma = :turma";
            }
            $updateStmt = $db->prepare($updateSql);
            $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
            if (!empty($_POST['turma'])) {
                $updateStmt->bindParam(':turma', $_POST['turma']);
            }
            $updateStmt->execute();
        }

        foreach ($_POST['prova'] as $id => $valorProva) {
            $updateSql = "UPDATE usuarios SET pontos = pontos + 1500 WHERE id = :id and turma = :turma";
            if (!empty($_POST['turma'])) {
                $updateSql .= " AND turma = :turma";
            }
            $updateStmt = $db->prepare($updateSql);
            $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
            if (!empty($_POST['turma'])) {
                $updateStmt->bindParam(':turma', $_POST['turma']);
            }
            $updateStmt->execute();
        }

        $db->commit();

        $db = null;
        header("Location: pontos_atualizados.php");
    } catch (PDOException $e) {
        $db->rollBack();
        echo "Erro: " . $e->getMessage();
    }
}
?>
