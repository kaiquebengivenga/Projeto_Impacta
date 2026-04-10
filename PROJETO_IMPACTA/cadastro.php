<?php
session_start();

if (isset($_COOKIE['usuario_logado'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imagens/logo.jpg">
    <link rel="stylesheet" href="style_login.css?v=9">
    <title>School Points | Login</title>
</head>
<body>
    <header>
        <h2 class="logo">School Points</h2>
        <nav class="navigation">
            <a class="current-page" style="--i:12" href="#">Home</a>
            <a href="sobre_nos.php" style="--i:13">Sobre nós</a>
            <button class="btnLogin-popup" style="--i:14">Login</button>
        </nav>
    </header>
    <main>
        <h1>School Points</h1>
        <p>"A educação é arma mais poderosa que você pode usar para mudar o mundo."</p>
        <br>
        <p>(Nelson Mandela)</p>
    </main>
    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>

        <div class="form-box login">
            <div class="titulo">
                <h2>School Points</h2>
            </div>

            <form method="POST" action="login.php" autocomplete="off">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="txt_usuario" id="txt_usuario" required autocomplete="off">
                    <label>Usuário:</label>
                </div>
                <div class="input-box">
                    <span class="icon" id="togglePassword">
                        <ion-icon name="eye-outline"></ion-icon>
                    </span>
                    <input type="password" name="txt_senha" id="txt_senha" required autocomplete="off">
                    <label>Senha:</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="lembrar_de_mim" id="lembrar_de_mim"> Lembrar de mim</label>
                </div>
                <button class="btn">Entrar</button>
                <div class="login-register">
                </div>
            </form>
        </div>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const wrapper = document.querySelector('.wrapper');
                const iconClose = document.querySelector('.icon-close');
                const btnPopup = document.querySelector('.btnLogin-popup');
                const popupState = localStorage.getItem("popupState");

                if (popupState === "aberto") {
                    wrapper.classList.add('active-popup');
                }

                btnPopup.addEventListener('click', () => {
                    wrapper.classList.add('active-popup');
                    localStorage.setItem("popupState", "aberto");
                });

                iconClose.addEventListener('click', () => {
                    wrapper.classList.remove('active-popup');
                    localStorage.setItem("popupState", "fechado");
                });

                const togglePasswordButton = document.getElementById('togglePassword');
                const passwordField = document.getElementById('txt_senha');

                togglePasswordButton.addEventListener('click', function () {
                    const passwordType = passwordField.getAttribute('type');

                    if (passwordType === 'password') {
                        passwordField.setAttribute('type', 'text');
                        togglePasswordButton.innerHTML = '<ion-icon name="eye-off-outline"></ion-icon>';
                    } else {
                        passwordField.setAttribute('type', 'password');
                        togglePasswordButton.innerHTML = '<ion-icon name="eye-outline"></ion-icon>';
                    }
                });
            });
        </script>
    </body>
</html>
