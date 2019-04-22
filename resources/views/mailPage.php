<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/semantic.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Netshow Mailer Test</title>
</head>
<body>

    <!-- Modal de aviso -->
    <div class="ui modal">
        <div class="header" id="warning">Header</div>
    </div>
    <div class="ui container" style='padding: 1%'>
        <h2 style='text-align: center'>Página de Contato</h2>

        <form class="ui form segment two column grid" id="mailer-form">
            <div class="row">
                <div class="column">
                    <div class="field">
                        <label>Nome</label>
                        <input type="text" id='name' name="name" placeholder="Seu nome">
                        
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label>E-Mail</label>
                        <input type="email" id="email" name="email" placeholder="Seu e-mail">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <div class="field">
                        <label>Telefone</label>
                        <input type="text" id="phone" name="phone" placeholder="Seu telefone">
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label>Anexar Arquivo</label>
                        <div class="ui action input">
                            <input type="text" readonly>
                            <input type="file" id="file" name="file" style="display: none!important;" />
                            <div class="ui button">
                                Anexo
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="sixteen wide column">
                    <div class="field" style='width: 100%;'>
                        <label>Mensagem</label>
                        <textarea name="message" id="message"></textarea>
                    </div>
                </div>
            </div>
            <div class="row" style='padding: 2%'>
                <button class="fluid ui button" type="submit" id="submit-button">Enviar</button>
            </div>
        </form>
    </div>
    
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.inputmask.bundle.js"></script>
    <script src="../js/semantic.min.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>