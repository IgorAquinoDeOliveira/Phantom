<?php

if ($_FILES['planilha']['error'] === UPLOAD_ERR_OK) {
    $nome_temporario = $_FILES['planilha']['tmp_name']; // Caminho temporário do arquivo
    $csvFile = 'result.csv'; // Nome do arquivo onde você deseja salvar os dados

    // Move o arquivo temporário para a pasta de destino
    if (move_uploaded_file($nome_temporario, $csvFile)) {
        // Abre o arquivo CSV para leitura
        if (($row = fopen($csvFile, 'r')) !== FALSE) {
            // Lê a primeira linha (cabeçalho) para obter os nomes das colunas
            $separados = fgetcsv($row, 1000, ',');

            // Encontra o índice da coluna 'website'
            $site = array_search('website', $separados);
            $titulo = array_search('title', $separados);
            $telefone = array_search('phoneNumber', $separados);
            $escolha = $_POST["opcao"];

            if ($site !== FALSE) {
                // Loop através das linhas do arquivo
                print "<div class='table-responsive' style='margin-top:30px;'>";
                print "<table class='table table-hover table-striped table-bordered'>";

                print "<tr>";
                print "<th>Titulo</th>";
                print "<th>Site</th>";
                print "<th>Telefone</th>";
                print "</tr>";

                while (($data = fgetcsv($row, 1000, ',')) !== FALSE) {
                    // Verifica se a coluna 'website' não está vazia

                    if ($escolha == "possuemSite") {
                        if (!empty($data[$site])) {
                            // echo "{$data[$titulo]}\n";
                            // echo "{$data[$site]}\n";
                            // echo "{$data[$telefone]}\n";

                            // $sTelefone = isset($data[$telefone]);

                            if (isset($data[$telefone])) {
                                $sTelefone = preg_replace("/[^0-9]/", "", $data[$telefone]);
                                $linkTelefone = "https://wa.me//" . $sTelefone;
                            } else {
                                $sTelefone = "Não Disponível";
                                $linkTelefone = ""; // Define o link como uma string vazia
                            }

                            print "<tr>";
                            print "<td style='max-width: 300px; overflow: auto;'> {$data[$titulo]} </td>";
                            print "<td style='max-width: 300px; overflow: auto;'><a href='{$data[$site]}' target='_blank'>{$data[$site]}</a></td>"; // Define a largura máxima e adicione overflow
                            if ($linkTelefone) { // Verifica se o link do telefone não está vazio
                                print "<td style='min-width:200px;'><a href='$linkTelefone' target='_blank'>$sTelefone</a></td>";
                            } else {
                                print "<td style='min-width:200px;'>$sTelefone</td>"; // Se não estiver disponível, não cria o link
                            }
                            print "</tr>";
                        }
                    } else {
                        if (empty($data[$site])) {

                            $sTitulo = isset($data[$titulo]);
                            // $sTelefone = isset($data[$telefone]);

                            if ($sTitulo != "") {
                                $sTitulo = $data[$titulo];
                            } else {
                                $sTitulo = "Não Disponivel";
                            }

                            if (isset($data[$telefone])) {
                                $sTelefone = preg_replace("/[^0-9]/", "", $data[$telefone]);
                                $linkTelefone = "https://wa.me//" . $sTelefone;
                            } else {
                                $sTelefone = "Não Disponível";
                                $linkTelefone = ""; // Define o link como uma string vazia
                            }

                            print "<tr>";
                            print "<td style='max-width: 300px; overflow: auto;'> $sTitulo </td>";
                            print "<td style='max-width: 300px; overflow: auto;'> Não disponível </td>";
                            if ($linkTelefone) { // Verifica se o link do telefone não está vazio
                                print "<td style='min-width:200px;'><a href='$linkTelefone' target='_blank'>$sTelefone</a></td>";
                            } else {
                                print "<td style='min-width:200px;'>$sTelefone</td>"; // Se não estiver disponível, não cria o link
                            }
                            print "</tr>";
                        }
                    }
                }
                print "</table>";
                print "</div>";
                print '<a href="#logo"><div class="floating-button"><i class="bi bi-arrow-up"></i></div></a';
                fclose($row);
            } else {
                echo "Verifique se o arquivo é .CSV ou tente novamente.\n";
            }
        } else {
            echo "Não foi possível abrir o arquivo CSV.\n";
        }
    } else {
        echo "Não foi possível mover o arquivo temporário.\n";
    }
} else {
    echo 'Ocorreu um erro ao enviar o arquivo.';
}
