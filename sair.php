<?php

session_start();
session_destroy();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}
if (isset($_COOKIE['usuario_logado'])) {
    setcookie('usuario_logado', '', time() - 3600, '/');
}
header('Location: cadastro.php');
exit;
