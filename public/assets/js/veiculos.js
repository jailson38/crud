let valorHora;
let valorSemana;
let valorMes;
$(document).ready(function() {
    $('.sortable').click(function() {
        var column = $(this).data('column');
        window.location.href = '?sortBy=' + column;
    });

    $('.placa-input').inputmask({
        mask: [
        'AAA-9999'
        ]
    });

    popularMontadoras();
    formataValor();
    
    $('#montadora').on('change', function() {
        var montadora = $(this).val();
        popularComResposta(montadora);
    });

    $('#veiculos-create').submit(function(event) {
        event.preventDefault(); 
        var formData = new FormData(this);
        var inputImagem = document.getElementById('imagem');
        var arquivoImagem = inputImagem.files[0];
        var id = $('#veiculo_id').val();
        formData.append('imagem', arquivoImagem);   
        saveVeiculo(formData, id);
    });
});

function saveVeiculo(data, id) {
    var url = id > 0 ? 'veiculos/' + id : 'veiculos';
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        success: function(res) {
            $('#successModal').modal('show');    
        }
    });
}

function editVeiculo(id) {
  $.ajax({
        url: 'veiculos/' + id,
        type: "GET",
        dataType: "json",
        success: function(res) {
            $('#veiculo_id').val(res.veiculo_id);
            $("#veiculo_nome").append($('<option selected></option>').val(res.veiculo_nome).text(res.veiculo_nome));
            $("#montadora").append($('<option selected></option>').val(res.veiculo_montadora).text(res.veiculo_montadora));
            $('#placa').val(res.veiculo_placa);
            $('#categoria').val(res.veiculo_categoria_id);
            $('#descricao').val(res.veiculo_descricao);
            $('#observacoes').text(res.veiculo_observacoes);
        }
    });
}

function deleteVeiculo(id) {
    if (confirm("Deseja mesmo apagar?")) {
        var d = {};
        d._token = $('input[name="_token"]').val();
        d.id = id;
        $.ajax({
            url: 'veiculos/delete/' + id,
            type: "POST",
            dataType: "json",
            data: d,
            success: function(res) {
               alert(res.message);
               location.reload();
            }
        });
    }
}

function formataValor() {
    $('#valor-diaria').on('input', function() {
        $('.valor-diaria').inputmask({
            mask: [
            '9,99',
            '99,99',
            '999,99',
            '9.999,99',
            '99.999,99',
            ]
        });

        valorHora = parseFloat(tratarValor($('#valor-diaria').val()) / 24).toFixed(2);
        valorHora = moedaToBrSoNumero(valorHora) !== 'NaN' ? moedaToBrSoNumero(valorHora) : '0,00';
        valorSemana = parseFloat(tratarValor($('#valor-diaria').val()) * 7).toFixed(2);
        valorSemana = moedaToBrSoNumero(valorSemana) !== 'NaN' ? moedaToBrSoNumero(valorSemana) : '0,00';
        valorMes = parseFloat(tratarValor($('#valor-diaria').val()) * 30).toFixed(2);
        valorMes = moedaToBrSoNumero(valorMes) !== 'NaN' ? moedaToBrSoNumero(valorMes) : '0,00';
        $('#valor-hora').attr('placeholder', valorHora);
        $('#valor-semana').attr('placeholder', valorSemana);
        $('#valor-mes').attr('placeholder', valorMes);
    });
}

function tratarValor(valor) {
    valor = valor.replace(/[^\d.,]/g, '');
    valor = valor.replace(',', '.');
    valor = valor.replace(/\.(?=.*\.)/g, '');
    valor = parseFloat(valor);
    
    return valor;
}

function getVeiculoData(id) {
    $.ajax({
        url: 'veiculos/' + id,
        type: "GET",
        dataType: "json",
        success: function(res) {
            console.log(res);
            $('#veiculo-nome').text(res.veiculo_nome);
            $('#veiculo-montadora').text(res.veiculo_montadora);
            $('#veiculo-placa').text(res.veiculo_placa);
            $('#veiculo-categoria-nome').text(res.veiculo_categoria_nome);
            $('#veiculo-descricao').text(res.veiculo_descricao);
            $('#veiculo-categoria-vl_hora').text(moedaToBr(res.veiculo_categoria_vl_hora));
            $('#veiculo-categoria-vl_diaria').text(moedaToBr(res.veiculo_categoria_vl_diaria));
            $('#veiculo-categoria-vl_semana').text(moedaToBr(res.veiculo_categoria_vl_semana));
            $('#veiculo-categoria-vl_mes').text(moedaToBr(res.veiculo_categoria_vl_mes));
            $('#veiculo-observacoes').text(res.veiculo_observacoes);
            $('#veiculo-imagem').attr('src', res.veiculo_image);
        }
    });
}

function moedaToBrSoNumero(valor) {
    var options = {
      style: 'currency',
      currency: 'BRL',
      minimumFractionDigits: 2
    };
    var formatoBR = new Intl.NumberFormat('pt-BR', options);
    formatoBR = formatoBR.format(valor);
    var valorSemSimbolo = formatoBR.replace('R$', '').trim();
    return valorSemSimbolo;
}

  
function moedaToBr(valor) {
    var options = {
      style: 'currency',
      currency: 'BRL',
      minimumFractionDigits: 2
    };
    var formatoBR = new Intl.NumberFormat('pt-BR', options);
    return formatoBR.format(valor);
}

function popularMontadoras() {
    var montadoras = [
        "Toyota",
        "Volkswagen",
        "Ford",
        "Chevrolet",
        "Honda",
        "Nissan",
        "Hyundai",
        "Mercedes-Benz",
        "BMW",
        "Audi",
        "Kia",
        "Renault",
        "Fiat",
        "Land Rover",
        "Jeep",
        "Mitsubishi",
        "Volvo",
        "Subaru",
        "Porsche",
        "Lexus"
      ];
    
    var dropdown = $("#montadora");

    // Preenche o dropdown com as opções de montadoras
    $.each(montadoras, function(index, montadora) {
        dropdown.append($('<option></option>').val(montadora).text(montadora));
    });
}

function popularComResposta(montadoraSelecionada) {
    $('#veiculo_nome').empty().append('<option value="">Carregando...</option>');
    
    $.getJSON('https://www.carqueryapi.com/api/0.3/?callback=?&cmd=getModels&make=' + montadoraSelecionada, function(response) {
        var modelos = response.Models;
    
        $('#veiculo_nome').empty().append('<option value="">Selecione um modelo</option>');
        $.each(modelos, function(index, modelo) {
            $('#veiculo_nome').append($('<option></option>').val(modelo.model_name).text(modelo.model_name));
        });
    });
}

function updateCountdown() {
    var countdownElement = document.getElementById('countdown');
    var countdownValue = parseInt(countdownElement.innerText);
    
    if (countdownValue > 0) {
      countdownValue--;
      countdownElement.innerText = countdownValue;
      setTimeout(updateCountdown, 1000);
    } else {
        location.reload()
    }
  }
  $('#successModal').on('shown.bs.modal', function () {
    updateCountdown();
  });