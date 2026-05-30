<?php

session_start();

$_SESSION['nao_autenticado'] = true;

header("Location: cadastro.php");