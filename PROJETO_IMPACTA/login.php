<?php

session_start();

if (isset($_SESSION['usuario'])) {
    $msg = ['codigo' => 100, 'msg' => 'Usuário já está logado'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new PDO('sqlite:PROJETO_IMPACTA/PROJETO_IMPACTA/bin/Debug/net6.0-windows/banco/banco.db');
    $usuario = $_POST['txt_usuario'];
    $senha = $_POST['txt_senha'];
    $query = "SELECT * FROM logins WHERE usuario='$usuario' AND senha='$senha' AND ativo = 1";
    $resultado = $db->query($query);
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);

    if ($linha) {
        if ($linha['ativo'] == 1) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['usuario_id'] = $linha['id'];
            $user_level = $linha['user_level'];

            if ($user_level == 1) {
                $msg = ['codigo' => 101, 'msg' => 'Usuário autenticado como regular user'];

                if (isset($_POST['lembrar_de_mim']) && $_POST['lembrar_de_mim'] == 'on') {
                    setcookie('usuario_logado', $usuario, time() + 604800, '/');
                }

                header('Location: dashboard.php');
            } elseif ($user_level == 2) {
                $msg = ['codigo' => 102, 'msg' => 'Usuário autenticado como administrador'];
                header('Location: dashboard_professor.php');
            }
        } else {
            $msg = ['codigo' => 998, 'msg' => 'Usuário está inativo. Entre em contato com o suporte.'];
            header('Location: cadastro.php');
        }
    } else {
        $msg = ['codigo' => 999, 'msg' => 'Nome de usuário ou senha incorretos'];
        header('Location: cadastro.php');
    }
}
