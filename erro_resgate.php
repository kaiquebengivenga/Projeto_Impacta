<?php

session_start();

$paginaAnterior = isset($_SESSION['pagina_anterior']) ? $_SESSION['pagina_anterior'] : 'resgate';
$_SESSION["erro-pop-up"] = true;

header("Location: $paginaAnterior.php");