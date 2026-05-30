<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('location:cadastro.php');
} else {
    $usuario = $_SESSION['usuario'];
}

$database = new PDO('sqlite:projetoimpacta/projetoimpacta/bin/Debug/net6.0-windows/banco/banco.db');
$query = 'SELECT coalesce(pontos, 0) AS pontos, nome FROM usuarios WHERE usuario = :usuario';
$stmt = $database->prepare($query);
$stmt->bindParam(':usuario', $usuario);
$result = $stmt->execute();

if ($result) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $pontos = $row['pontos'];
    $nome = $row['nome'];
} else {
    echo 'Erro ao recuperar pontos do usuário';
}

$database = null;

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Points | Aluno </title>
    <link rel="stylesheet" href="style_pagina_resgate.css?v=1">
    <link rel="icon" href="imagens/logo.jpg">
</head>

<body>
    <header>
        <h2 class="logo">School Points</h2>
        <nav class="navigation">
            <a href="dashboard.php">Home</a>
            <a href="sobre_nos_logado.php">Sobre nós</a>
            <a class="current-page" href="pagina_de_item.php">Resgatar</a>
            <div class="dropdown">
                <button class="dropbtn">
                    <?php echo $nome;
                    ?> <img src="imagens/user.png" alt="usuário">
                </button>
                <div class="dropdown-content">
                    <div class="dropdown-content-linha1">
                        <img src="imagens/logo.jpg" alt="logo">
                        <div class="sair">
                            <a href="sair.php">
                                Sair
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="card_dados">
            <h1>Olá,
                <?php echo $nome . '.'; ?>
            </h1>
            <div class="linha">
                <div class="pontos">
                    <img src="imagens/pontos.png" alt="Pontos">
                    <p>Pontos disponíveis<br><span>
                            <?php echo number_format($pontos, 0, ',', '.'); ?>
                        </span></p>
                </div>
                <div class="historico">
                    <a href="codigos_resgatados.php">
                        <img src="imagens/historico.png" alt="Histórico">
                        Histórico de resgate
                    </a>
                </div>
            </div>
        </div>
        <form action="#">
            <div class="container">
                <a class="card_2" href="resgate.php">
                    <div class="foto_item">
                        <img src="imagens/cupom_5.png" alt="alguma coisa">
                    </div>
                    <div class="informacoes">
                        <p class="nome_item">loja de roupas</p><br>
                        <p class="pontos_nes" id="pontos1">
                            <?php echo number_format($pontos, 0, ',', '.'); ?> de 3.000 pontos
                        </p>
                        <div class="barra">
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo $pontos / 3000 * 100; ?>%;" id="progress1">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="card_2" href="resgate_item2.php">
                    <div class="foto_item">
                        <img src="imagens/cupom_10.png" alt="alguma coisa">
                    </div>
                    <div class="informacoes">
                        <p class="nome_item">restaurante</p><br>
                        <p class="pontos_nes" id="pontos2">
                            <?php echo number_format($pontos, 0, ',', '.'); ?> de 7.500 pontos
                        </p>
                        <div class="barra">
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo $pontos / 7500 * 100; ?>%;" id="progress2">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="card_2" href="resgate_item3.php">
                    <div class="foto_item">
                        <img src="imagens/cupom_15.png" alt="alguma coisa">
                    </div>
                    <div class="informacoes">
                        <p class="nome_item">mercado</p><br>
                        <p class="pontos_nes" id="pontos3">
                            <?php echo number_format($pontos, 0, ',', '.'); ?> de 11.500 pontos
                        </p>
                        <div class="barra">
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo $pontos / 11500 * 100; ?>%;" id="progress3">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="container">
                <a class="card_2" href="resgate_item4.php">
                    <div class="foto_item">
                        <img src="imagens/cupom_5.png" alt="alguma coisa">
                    </div>
                    <div class="informacoes">
                        <p class="nome_item">assistência técnica</p><br>
                        <p class="pontos_nes" id="pontos4">
                            <?php echo number_format($pontos, 0, ',', '.'); ?> de 3.500 pontos
                        </p>
                        <div class="barra">
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo $pontos / 3500 * 100; ?>%;" id="progress4">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="card_2" href="resgate_item5.php">
                    <div class="foto_item">
                        <img src="imagens/cupom_10.png" alt="alguma coisa">
                    </div>
                    <div class="informacoes">
                        <p class="nome_item">faculdade</p><br>
                        <p class="pontos_nes" id="pontos5">
                            <?php echo number_format($pontos, 0, ',', '.'); ?> de 8.000 pontos
                        </p>
                        <div class="barra">
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo $pontos / 8000 * 100; ?>%;" id="progress5">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="card_2" href="resgate_item6.php">
                    <div class="foto_item">
                        <img src="imagens/cupom_15.png" alt="alguma coisa">
                    </div>
                    <div class="informacoes">
                        <p class="nome_item">cursos</p><br>
                        <p class="pontos_nes" id="pontos6">
                            <?php echo number_format($pontos, 0, ',', '.'); ?> de 8.000 pontos
                        </p>
                        <div class="barra">
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo $pontos / 8000 * 100; ?>%;" id="progress6">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="container">
                <a class="card_2" href="resgate_item7.php">
                    <div class="foto_item">
                        <img src="imagens/cupom_5.png" alt="alguma coisa">
                    </div>
                    <div class="informacoes">
                        <p class="nome_item">loja de tênis</p><br>
                        <p class="pontos_nes" id="pontos7">
                            <?php echo number_format($pontos, 0, ',', '.'); ?> de 3.000 pontos
                        </p>
                        <div class="barra">
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo $pontos / 3000 * 100; ?>%;" id="progress7">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="card_2" href="resgate_item8.php">
                    <div class="foto_item">
                        <img src="imagens/cupom_10.png" alt="alguma coisa">
                    </div>
                    <div class="informacoes">
                        <p class="nome_item">materiais escolares</p><br>
                        <p class="pontos_nes" id="pontos8">
                            <?php echo number_format($pontos, 0, ',', '.'); ?> de 5.000 pontos
                        </p>
                        <div class="barra">
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo $pontos / 5000 * 100; ?>%;" id="progress8">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="card_2" href="resgate_item9.php">
                    <div class="foto_item">
                        <img src="imagens/cupom_15.png" alt="alguma coisa">
                    </div>
                    <div class="informacoes">
                        <p class="nome_item">livros</p><br>
                        <p class="pontos_nes" id="pontos9">
                            <?php echo number_format($pontos, 0, ',', '.'); ?> de 6.000 pontos
                        </p>
                        <div class="barra">
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo $pontos / 6000 * 100; ?>%;" id="progress9">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </form>
    </main>
    <script>
        function updateProgressBar(points, maxPoints, cardId) {
            var progressBar = document.getElementById('progress' + cardId);
            var pontosNes = document.getElementById('pontos' + cardId);

            var percentage = Math.min((points / maxPoints) * 100, 100);

            var color = getColorForPercentage(percentage);

            progressBar.style.width = percentage + '%';
            progressBar.style.backgroundColor = color;
            pontosNes.innerText = number_format(points, 0, ',', '.') + ' de ' + number_format(maxPoints, 0, ',', '.') + ' pontos';
        }

        function getColorForPercentage(percentage) {
            if (percentage <= 5) {
                return '#181661';
            } else if (percentage <= 10) {
                return '#181661';
            } else if (percentage <= 15) {
                return '#181661';
            } else if (percentage <= 20) {
                return '#181661';
            } else if (percentage <= 25) {
                return '#181661';
            } else if (percentage <= 30) {
                return '#181661';
            } else if (percentage <= 35) {
                return '#181661';
            } else if (percentage <= 40) {
                return '#181661';
            } else if (percentage <= 45) {
                return '#181661';
            } else if (percentage <= 50) {
                return '#181661';
            } else if (percentage <= 55) {
                return '#181661';
            } else if (percentage <= 60) {
                return '#181661';
            } else if (percentage <= 65) {
                return '#181661';
            } else if (percentage <= 70) {
                return '#181661';
            } else if (percentage <= 75) {
                return '#181661';
            } else if (percentage <= 80) {
                return '#181661';
            } else if (percentage <= 85) {
                return '#181661';
            } else if (percentage <= 90) {
                return '#181661';
            } else if (percentage <= 95) {
                return '#181661';
            } else {
                return 'green';
            }
        }

        function number_format(number, decimals, decPoint, thousandsSep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number;
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals);
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep;
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint;
            var s = '';

            var toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };

            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }

            return s.join(dec);
        }

        var pontosItens = [<?php echo $pontos; ?>, <?php echo $pontos; ?>, <?php echo $pontos; ?>, <?php echo $pontos; ?>, <?php echo $pontos; ?>, <?php echo $pontos; ?>, <?php echo $pontos; ?>, <?php echo $pontos; ?>, <?php echo $pontos; ?>];
        var maxPointsItens = [3000, 7500, 11500, 3500, 8000, 8000, 3000, 5000, 6000];

        for (var i = 1; i <= pontosItens.length; i++) {
            updateProgressBar(pontosItens[i - 1], maxPointsItens[i - 1], i);
        }
    </script>
</body>

</html>