<?php

function salvarUpload($campo, $arquivoAtual = '')
{
    // Se nao escolheu arquivo novo, mantem o arquivo atual.
    if (empty($_FILES[$campo]['name'])) {
        return $arquivoAtual;
    }

    if ($_FILES[$campo]['error'] !== UPLOAD_ERR_OK) {
        return $arquivoAtual;
    }

    $pastaDestino = __DIR__ . '/../imagem/';

    if (!is_dir($pastaDestino)) {
        mkdir($pastaDestino, 0777, true);
    }

    $extensao = strtolower(pathinfo($_FILES[$campo]['name'], PATHINFO_EXTENSION));
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($extensao, $extensoesPermitidas)) {
        return $arquivoAtual;
    }

    // Cria um nome unico para evitar substituir imagens antigas.
    $nomeArquivo = time() . '_' . uniqid() . '.' . $extensao;
    $destino = $pastaDestino . $nomeArquivo;

    if (move_uploaded_file($_FILES[$campo]['tmp_name'], $destino)) {
        return 'imagem/' . $nomeArquivo;
    }

    return $arquivoAtual;
}
