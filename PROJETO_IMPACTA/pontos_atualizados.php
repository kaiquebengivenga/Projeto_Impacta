<?php

session_start();

$_SESSION["pontos_atualizados"] = true;

header("Location: dashboard_professor.php");