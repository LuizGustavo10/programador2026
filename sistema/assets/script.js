$(document).ready(function () {
    if ($('#tabela').length) {
        $('#tabela').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json',
            },
        });
    }
});

function mostrarPreview(input, idPreview){
    const preview = document.getElementById(idPreview);

    if(input.files && input.files[0]){
        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('d-none');
    }
}

function apenasNumeros(valor) {
    return valor.replace(/\D/g, '');
}

function aplicarMascaraCpf(valor) {
    return apenasNumeros(valor)
        .slice(0, 11)
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
}

function aplicarMascaraCnpj(valor) {
    return apenasNumeros(valor)
        .slice(0, 14)
        .replace(/(\d{2})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1/$2')
        .replace(/(\d{4})(\d{1,2})$/, '$1-$2');
}

function aplicarMascaraTelefone(valor) {
    const numeros = apenasNumeros(valor).slice(0, 11);

    if (numeros.length <= 10) {
        return numeros
            .replace(/(\d{2})(\d)/, '($1) $2')
            .replace(/(\d{4})(\d)/, '$1-$2');
    }

    return numeros
        .replace(/(\d{2})(\d)/, '($1) $2')
        .replace(/(\d{5})(\d)/, '$1-$2');
}

function aplicarMascaraPreco(valor) {
    const numeros = apenasNumeros(valor);
    const numero = (parseInt(numeros || '0', 10) / 100).toFixed(2);
    return numero.replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

document.addEventListener('input', function(event) {
    const campo = event.target;

    if (campo.classList.contains('mascara-cpf')) {
        campo.value = aplicarMascaraCpf(campo.value);
    }

    if (campo.classList.contains('mascara-cnpj')) {
        campo.value = aplicarMascaraCnpj(campo.value);
    }

    if (campo.classList.contains('mascara-telefone')) {
        campo.value = aplicarMascaraTelefone(campo.value);
    }

    if (campo.classList.contains('mascara-preco')) {
        campo.value = aplicarMascaraPreco(campo.value);
    }
});
