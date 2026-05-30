<?php

session_start();

$paginaAnterior = isset($_SESSION['pagina_anterior']) ? $_SESSION['pagina_anterior'] : 'resgate';
$_SESSION['mostrar-qrcode'] = true;

header("Location: $paginaAnterior.php");
