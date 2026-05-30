<?php

session_start();

if (!isset($_SESSION["usuario"])){
    header("location:cadastro.php");
} else {
    $usuario = $_SESSION["usuario"];
}

    require_once 'vendor/autoload.php';

    use chillerlan\QRCode\QRCode;
    use chillerlan\QRCode\QROptions;

    function generateRandomCode()
    {
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
        'version' => 5,
        'eccLevel' => QRCode::ECC_L,
        'outputType' => QRCode::OUTPUT_MARKUP_SVG,
    ]);
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>QR Code Centralizado</title>
    <link rel="stylesheet" href="style_qrcode.css">
    <link rel="icon" href="imagens/logo.jpg">
</head>
<body>
    <header>
        <div class="logo">
            <img src="imagens/logo.jpg" alt="logo">
        </div>
        <div class="menu">
            <ul>
                <li><a href="resgate.php" class="link">VOLTAR</a></li>
            </ul>
        </div>
    </header>
    <main>
        <div class="container">
            <img class="qr-code" src="<?php echo (new QRCode($options))->render($randomCode); ?>" alt="QR Code">
   
            <div class="div_codigo"> 
                <p class="codigo"><?php echo $randomCode; ?></p>
                <button id="copiarBotao"> <img src="imagens/copiar.png" alt="copiar"> </button>
            </div>
        </div>
    </main>
</body>
<script>
    const copiarBotao = document.getElementById('copiarBotao');
    const codigoAleatorio = "<?php echo $randomCode; ?>";
    const imagemQRCode = document.querySelector('.qr-code');

    copiarBotao.addEventListener('click', () => {
        const textarea = document.createElement('textarea');
        textarea.value = codigoAleatorio;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);

        copiarBotao.querySelector('img').src = 'imagens/correto.png';

        setTimeout(() => {
            copiarBotao.querySelector('img').src = 'imagens/copiar.png';
        }, 800);
    });
</script>
</html>
