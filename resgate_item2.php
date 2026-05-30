<?php
session_start();
$_SESSION['pagina_anterior'] = 'resgate_item2';

if (!isset($_SESSION['usuario'])) {
    header('location:cadastro.php');
    exit;
} else {
    $usuario = $_SESSION['usuario'];
}

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
} else {
    echo 'ID do usuário não encontrado na sessão.';
    exit;
}

require_once 'vendor/autoload.php';
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

function generateRandomCode() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $code = '';
    for ($i = 0; $i < 25; ++$i) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
        if ($i % 5 == 4 && $i < 24) {
            $code .= '-';
        }
    }
    return $code;
}

$randomCode = generateRandomCode();

$options = new QROptions([
    'version'    => 5,
    'eccLevel'   => QRCode::ECC_L,
    'outputType' => QRCode::OUTPUT_MARKUP_SVG // Define a saída como SVG (imagem)
]);

$qrcode = new QRCode($options);
$imagem_qrcode_html = '<img class="qr-code" src="'.$qrcode->render($randomCode).'" alt="QR Code" />';

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
    echo 'Erro ao recuperar pontos do usuÃ¡rio';
}

$database = null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resgate</title>
    <link rel="stylesheet" href="style_res.css">
    <link rel="stylesheet" href="style_erro_ao_resgatar.css">
    <link rel="stylesheet" href="style_mostrar_qrcode.css">
    <script src="https://unpkg.com"></script>
    <link class="visual-anchor" rel="icon" href="imagens/logo.jpg">
</head>
<body>
    <header>
        <div>
            <h4><img src="imagens/logo.jpg" alt="logo"> | Recompensas</h4>
        </div>
        <div class="dropdown">
            <button class="dropbtn" type="button">
                <?php echo isset($nome) ? $nome : 'Usuário'; ?><img src="imagens/user.png" alt="usuário">
            </button>
            <div class="dropdown-content">
                <div class="dropdown-content-linha1">
                    <img src="imagens/logo.jpg" alt="logo">
                    <div class="sair">
                        <a href="sair.php"> Sair </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="divisao">
        <div class="container_voltar">
            <a href="pagina_de_item.php">&lt; Voltar para a página de resgate.</a>
        </div>
        <div class="pontos">
            <img src="imagens/pontos.png" alt="Pontos">
            <p>Pontos disponíveis<br><span> <?php echo number_format($pontos, 0, ',', '.'); ?> </span></p>
        </div>
    </div>

    <main>
        <form id="resgateForm" action="codigo.php" method="POST">
            <input type="hidden" name="produto_id" value="2">
            <div class="container">
                <img src="imagens/cupom_10.png" alt="">
                <div class="detalhes">
                    <h2>Cupom para restaurantes - 10%</h2>
                    <p>7.500 pontos</p>
                    <p>Pontos: <span id="points"> <?php echo number_format($pontos, 0, ',', '.'); ?> de 7.500 </span></p>
                    <div class="progress-bar">
                        <div class="progress" id="progress" style="width: <?php echo ($pontos / 7500) * 100; ?>%;"></div>
                    </div>
                    <div class="btn">
                        <button type="button" onclick="confirmarResgate(event)">Resgatar</button>
                    </div>
                    <div class="mais_detalhes">
                        <h4> Detalhes : </h4>
                        <ul>
                            <li>Mínimo de R$ 100,00 para a utilização do desconto na hora da compra;</li>
                            <li>Duração de 10 dias após o resgate;</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="pop-up">
                <?php if (isset($_SESSION['erro-pop-up'])) { ?>
                    <div class="card-pop-up" id="popUpErro">
                        <button class="fechar" type="button" id="fecharErro"><img src="imagens/x.png" alt=""></button>
                        <p> ERRO! <br> Você não possui pontos suficientes para resgatar este produto</p>
                    </div>
                <?php } unset($_SESSION['erro-pop-up']); ?>
            </div>
        </form>

        <div class="qrcode">
            <?php if (isset($_SESSION['mostrar-qrcode'])) { ?>
                <div class="container-qrcode">
                    <div class="div_fechar">
                        <button class="fechar" id="ocultarQrCode" type="button">
                            <img src="imagens/X.png" alt="fechar">
                        </button>
                    </div>
                    
                    <?php echo $imagem_qrcode_html; ?>

                    <div class="div_codigo">
                        <p class="codigo"><?php echo $randomCode; ?></p>
                        <button id="copiarBotao" type="button">
                            <img src="imagens/copiar.png" alt="copiar">
                        </button>
                    </div>

                    <?php
                    $dataAtual = date('Y-m-d H:i:s');
                    $database = new PDO('sqlite:projetoimpacta/projetoimpacta/bin/Debug/net6.0-windows/banco/banco.db');
                    $query = 'INSERT INTO codigo_resgatado (id_usuario, codigo, data_resgate) VALUES (:id_usuario, :codigo_qr, :data_resgate)';
                    $stmt = $database->prepare($query);
                    $stmt->bindParam(':id_usuario', $usuario_id);
                    $stmt->bindParam(':codigo_qr', $randomCode);
                    $stmt->bindParam(':data_resgate', $dataAtual);
                    $result = $stmt->execute();
                    if (!$result) {
                        echo '<p style="color:red;">Erro ao inserir o código QR no banco de dados</p>';
                    }
                    $database = null;
                    ?>
                </div>
            <?php } unset($_SESSION['mostrar-qrcode']); ?>
        </div>
    </main>

    <div id="confirmPopup" class="confirm-popup" style="display: none;">
        <h2>Confirmação de Resgate</h2>
        <p>Tem certeza que deseja resgatar este produto?</p>
        <button type="button" onclick="document.getElementById('resgateForm').submit()">Sim</button>
        <button type="button" class="cancel" onclick="cancelarResgate()">Cancelar</button>
    </div>

    <script>
        function confirmarResgate(event) {
            event.preventDefault();
            const popup = document.getElementById('confirmPopup');
            if (popup) popup.style.display = 'block';
        }

        function cancelarResgate() {
            const popup = document.getElementById('confirmPopup');
            if (popup) popup.style.display = 'none';
        }

        function updateProgressBar(points) {
            var progressBar = document.getElementById('progress');
            if (!progressBar) return;
            
            var maxPoints = 7500;
            var percentage = Math.min((points / maxPoints) * 100, 100);
            
            var color = (percentage >= 100) ? 'green' : '#181661';
            
            progressBar.style.width = percentage + '%';
            progressBar.style.backgroundColor = color;
        }

        updateProgressBar(<?php echo (int)$pontos; ?>);

        const codigoAleatorio = "<?php echo $randomCode; ?>";
        const copiarBotao = document.getElementById('copiarBotao');
        const ocultarQrCodeBotao = document.getElementById('ocultarQrCode');
        const qrCodeElement = document.querySelector('.container-qrcode');
        const ocultarErroBotao = document.getElementById('fecharErro');
        const popUpErro = document.querySelector('.pop-up');

        if (copiarBotao) {
            copiarBotao.addEventListener('click', (e) => {
                e.preventDefault();
                const textarea = document.createElement('textarea');
                textarea.value = codigoAleatorio;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);

                const iconeBotao = copiarBotao.querySelector('img');
                if (iconeBotao) {
                    iconeBotao.src = 'imagens/correto.png';
                    setTimeout(() => { iconeBotao.src = 'imagens/copiar.png'; }, 800);
                }
            });
        }

        if (ocultarQrCodeBotao && qrCodeElement) {
            ocultarQrCodeBotao.addEventListener('click', (e) => {
                e.preventDefault();
                const estiloAtual = window.getComputedStyle(qrCodeElement).display;
                
                if (estiloAtual === 'none') {
                qrCodeElement.style.display = 'block';} 
                else {
                    qrCodeElement.style.display = 'none';}});}
                    (ocultarErroBotao && popUpErro) 
                    {ocultarErroBotao.addEventListener('click', (e) => {e.preventDefault();popUpErro.style.display = 'none';});}
    </script>
</body>
</html>
