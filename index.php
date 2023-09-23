<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phantom</title>

    <link href="assets/style.css" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="assets/img/logo_nova.png" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-94RGZ7P7KX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-94RGZ7P7KX');
    </script>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="assets/img/logo_sem.png" alt="" id="logo">
            </div>

            <div class="col-md-12">
                <form action="?page=procurar" method="POST" class="container-fluid container-xl align-items-center justify-content-between" enctype="multipart/form-data" id="forms">
                    <h3>Site foi criado no intuito de ajudar a prospecção de pessoas. Utilizando o arquivo gerado pelo <span style="color: #008CBA;"><a href="https://phantombuster.com">PhantomBuster</a></span></h3>
                    <br>
                    <h3>Quer testar? Baixe um arquivo <a href="assets/TestaAi.csv" download>.csv</a></h3>
                    <div class="box">
                        <h4 style="color: red;">Só é aceitado arquivo .csv</h4>
                        <label class="upload-btn" for="planilha">Escolher arquivo</label>
                        <input type="file" name="planilha" id="planilha" accept=".csv" onchange="NomeArquivo()">
                        <br>
                        <div id="carrega"></div>
                        <br>
                        <div id="escolha" class="escolha"></div>
                        <br>
                        <div id="procurar"></div>
                        <!-- <input type="submit" value="Procurar"> -->
                    </div>
                </form>
            </div>

        </div>

        <?php
        switch (@$_REQUEST["page"]) {
            case "procurar":
                include("procurar.php");
                break;
        }
        ?>

    </div>

    <div id="botao">
    </div>


    <script>
        function NomeArquivo() {
            const input = document.getElementById('planilha');
            const carrega = document.getElementById('carrega');
            const escolha = document.getElementById('escolha');
            const procurar = document.getElementById('procurar');
            const botao = document.getElementById('botao');

            if (input.files.length > 0) {
                carrega.innerHTML = '<h1> Arquivo selecionado: <span>' + input.files[0].name + '</span></h1>';
                escolha.innerHTML = `
                 <select class="form-select" id="opcao" name="opcao">
                  <option value="possuemSite">Possuem site</option>
                  <option value="nãoPossuemSite">Não possuem site</option>
                 </select>
                `;
                procurar.innerHTML = '<input type="submit" value="Procurar">';
                botao.innerHTML = '<a href="#logo"><div class="floating-button"><i class="bi bi-arrow-up"></i></div></a>';
            } else {
                carrega.textContent = '';
            }
        }
    </script>
</body>

</html>