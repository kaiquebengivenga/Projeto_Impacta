<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $db = new PDO('sqlite:PROJETO_IMPACTA/PROJETO_IMPACTA/bin/Debug/net6.0-windows/banco/banco.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->beginTransaction();

        $turma = $_POST['turma'] ?? '';

        function atualizarPontos($db, $lista, $pontos, $turma) {
            foreach ($lista ?? [] as $id => $valor) {
                $sql = "UPDATE usuarios SET pontos = pontos + :pontos WHERE id = :id";

                if (!empty($turma)) {
                    $sql .= " AND turma = :turma";
                }

                $stmt = $db->prepare($sql);
                $stmt->bindValue(':pontos', $pontos, PDO::PARAM_INT);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);

                if (!empty($turma)) {
                    $stmt->bindValue(':turma', $turma);
                }

                $stmt->execute();
            }
        }

        atualizarPontos($db, $_POST['presenca'] ?? [], 500, $turma);
        atualizarPontos($db, $_POST['trabalho'] ?? [], 1000, $turma);
        atualizarPontos($db, $_POST['prova'] ?? [], 1500, $turma);

        $db->commit();

        header("Location: pontos_atualizados.php");
        exit;

    } catch (PDOException $e) {
        if (isset($db) && $db->inTransaction()) {
            $db->rollBack();
        }

        echo "Erro: " . $e->getMessage();
    }
}
?>