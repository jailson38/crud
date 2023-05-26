let valorHora;
let valorSemana;
let valorMes;
$(document).ready(function() {
    $('.sortable').click(function() {
        var column = $(this).data('column');
        window.location.href = '?sortBy=' + column;
    });

    $('#valor_hora').on('input', function() {
        $('#valor_hora').inputmask({
            mask: [
            '9,99',
            '99,99',
            '999,99',
            '9.999,99',
            '99.999,99',
            ]
        });
    });

    $('#valor_semana').on('input', function() {
        $('#valor_semana').inputmask({
            mask: [
            '9,99',
            '99,99',
            '999,99',
            '9.999,99',
            '99.999,99',
            ]
        });
    });

    $('#valor_mes').on('input', function() {
        $('#valor_mes').inputmask({
            mask: [
            '9,99',
            '99,99',
            '999,99',
            '9.999,99',
            '99.999,99',
            ]
        });
    });

    $('#categorias-create').submit(function(event) {
        event.preventDefault(); 
        let data = {};
        $(this).find('input, select, textarea').each(function() {
          var campo = $(this);
          var campoId = campo.attr('id');
          var campoValor = campo.val();
          data[campoId] = campoValor;
        });

        data._token = $('input[name="_token"]').val();
        
        saveCategoria(data);
    });

    formataValor()

});

function editCategoria(id) {
    var d = {};
    d.id = id
    $.ajax({
        url: 'categorias/' + id,
        type: "GET",
        dataType: "json",
        data: d,
        success: function(res) {
            $('#categoria_id').val(res.categoria_id);
            $('#name').val(res.categoria_nome);
            $('#valor_diaria').val(moedaToBr(res.categoria_vl_diaria));
            $('#valor_hora').val(moedaToBr(res.categoria_vl_hora));
            $('#valor_semana').val(moedaToBr(res.categoria_vl_semana));
            $('#valor_mes').val(moedaToBr(res.categoria_vl_mes));
        }
    });
}

function formataValor() {
    $('#valor_diaria').on('input', function() {
        $('.valor_diaria').inputmask({
            mask: [
            '9,99',
            '99,99',
            '999,99',
            '9.999,99',
            '99.999,99',
            ]
        });

        valorHora = parseFloat(tratarValor($('#valor_diaria').val()) / 24).toFixed(2);
        valorHora = moedaToBrSoNumero(valorHora) !== 'NaN' ? moedaToBrSoNumero(valorHora) : '0,00';
        valorSemana = parseFloat(tratarValor($('#valor_diaria').val()) * 7).toFixed(2);
        valorSemana = moedaToBrSoNumero(valorSemana) !== 'NaN' ? moedaToBrSoNumero(valorSemana) : '0,00';
        valorMes = parseFloat(tratarValor($('#valor_diaria').val()) * 30).toFixed(2);
        valorMes = moedaToBrSoNumero(valorMes) !== 'NaN' ? moedaToBrSoNumero(valorMes) : '0,00';
        $('#valor_hora').attr('placeholder', valorHora);
        $('#valor_semana').attr('placeholder', valorSemana);
        $('#valor_mes').attr('placeholder', valorMes);
    });
}

function deleteCategoria(id) {
    if (confirm("Deseja mesmo apagar?")) {
        var d = {};
        d._token = $('input[name="_token"]').val();
        d.id = id;
        $.ajax({
            url: 'categorias/delete/' + id,
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

function tratarValor(valor) {
    valor = valor.replace(/[^\d.,]/g, '');
    valor = valor.replace(',', '.');
    valor = valor.replace(/\.(?=.*\.)/g, '');
    valor = parseFloat(valor);
    
    return valor;
}

function saveCategoria(data) {
    var url = data.categoria_id > 0 ? 'categorias/' + data.categoria_id : 'categorias';
    data.valor_diaria = tratarValor(data.valor_diaria);
    data.valor_hora = data.valor_hora == "" ? tratarValor(valorHora) : tratarValor(data.valor_hora);
    data.valor_semana = data.valor_semana == "" ? tratarValor(valorSemana) : tratarValor(data.valor_semana);
    data.valor_mes = data.valor_mes == "" ? tratarValor(valorMes) : tratarValor(data.valor_mes);

    $.ajax({
        url: url,
        type: 'POST',
        dataType: "json",
        data: data,
        success: function(res) {
            $('#successModal').modal('show');    
        }
    });
}

function getCategoriaData(id) {
    var d = {};
    d.id = id
    $.ajax({
        url: 'categorias/' + id,
        type: "GET",
        dataType: "json",
        data: d,
        success: function(res) {
            $('#categoria-nome').text(res.categoria_nome);
            $('#categoria-vl_diaria').text(moedaToBr(res.categoria_vl_diaria));
            $('#categoria-vl_hora').text(moedaToBr(res.categoria_vl_hora));
            $('#categoria-vl_semana').text(moedaToBr(res.categoria_vl_semana));
            $('#categoria-vl_mes').text(moedaToBr(res.categoria_vl_mes));
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