<?php

function salvarUpload($campo, $arquivoAtual = '')
{
    if (empty($_FILES[$campo]['name'])) {
        return $arquivoAtual;
    }

    if ($_FILES[$campo]['error'] !== UPLOAD_ERR_OK) {
        return $arquivoAtual;
    }

    $tamanhoMaximo = 4 * 1024 * 1024;

    if ($_FILES[$campo]['size'] > $tamanhoMaximo) {
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

    $nomeArquivo = time() . '_' . uniqid() . '.' . $extensao;
    $destino = $pastaDestino . $nomeArquivo;

    if (redimensionarImagem($_FILES[$campo]['tmp_name'], $destino, $extensao)) {
        return 'imagem/' . $nomeArquivo;
    }

    if (move_uploaded_file($_FILES[$campo]['tmp_name'], $destino)) {
        return 'imagem/' . $nomeArquivo;
    }

    return $arquivoAtual;
}

function redimensionarImagem($origem, $destino, $extensao)
{
    if (!function_exists('imagecreatetruecolor')) {
        return false;
    }

    $info = getimagesize($origem);

    if (!$info) {
        return false;
    }

    $larguraOriginal = $info[0];
    $alturaOriginal = $info[1];
    $limite = 1200;
    $maiorLado = max($larguraOriginal, $alturaOriginal);

    if ($maiorLado <= $limite) {
        return false;
    }

    $escala = $limite / $maiorLado;
    $novaLargura = (int)($larguraOriginal * $escala);
    $novaAltura = (int)($alturaOriginal * $escala);

    if ($extensao == 'jpg' || $extensao == 'jpeg') {
        $imagemOriginal = imagecreatefromjpeg($origem);
    } elseif ($extensao == 'png') {
        $imagemOriginal = imagecreatefrompng($origem);
    } elseif ($extensao == 'webp' && function_exists('imagecreatefromwebp')) {
        $imagemOriginal = imagecreatefromwebp($origem);
    } else {
        return false;
    }

    if (!$imagemOriginal) {
        return false;
    }

    $imagemNova = imagecreatetruecolor($novaLargura, $novaAltura);

    if ($extensao == 'png' || $extensao == 'webp') {
        imagealphablending($imagemNova, false);
        imagesavealpha($imagemNova, true);
    }

    imagecopyresampled($imagemNova, $imagemOriginal, 0, 0, 0, 0, $novaLargura, $novaAltura, $larguraOriginal, $alturaOriginal);

    if ($extensao == 'jpg' || $extensao == 'jpeg') {
        $salvou = imagejpeg($imagemNova, $destino, 82);
    } elseif ($extensao == 'png') {
        $salvou = imagepng($imagemNova, $destino, 7);
    } else {
        $salvou = imagewebp($imagemNova, $destino, 82);
    }

    imagedestroy($imagemOriginal);
    imagedestroy($imagemNova);

    return $salvou;
}

function formatarPrecoBanco($preco)
{
    $preco = str_replace(['R$', ' ', '.'], '', $preco);
    return str_replace(',', '.', $preco);
}
