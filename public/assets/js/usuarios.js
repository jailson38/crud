$(document).ready(function() {
    $('#usuarios-create').submit(function(event) {
        event.preventDefault(); 
        let data = {};
        $(this).find('input, select, textarea').each(function() {
            var campo = $(this);
            var campoId = campo.attr('id');
            var campoValor = campo.val();
            data[campoId] = campoValor;
        });

        data._token = $('input[name="_token"]').val();
        
        saveUsuario(data);
    });

    $('#login').submit(function(event) {
        event.preventDefault(); 
        let data = {};
        $(this).find('input, select, textarea').each(function() {
            var campo = $(this);
            var campoId = campo.attr('id');
            var campoValor = campo.val();
            data[campoId] = campoValor;
        });

        data._token = $('input[name="_token"]').val();
        
        login(data);
    });
});

function login(data) {
    var url = 'login';
    $.ajax({
        url: url,
        type: 'POST',
        dataType: "json",
        data: data,
        success: function(res) {
            if (res.status == 'error') {
                alert(res.message);
                return;
            }
            window.location = '/veiculos';
        }
    });
}

function saveUsuario(data) {
    var url = data.usuario_id > 0 ? 'usuarios/' + data.usuario_id : 'usuarios';
    $.ajax({
        url: url,
        type: 'POST',
        dataType: "json",
        data: data,
        success: function(res) {
            if (res.status == 'error') {
                alert(res.message);
                return;
            }
            $('#successModal').modal('show');    
        }
    });
}

function editUser(id) {
    var d = {};
    d.id = id
    $.ajax({
        url: 'usuarios/' + id,
        type: "GET",
        dataType: "json",
        data: d,
        success: function(res) {
            $('#usuario_id').val(res.user_id);
            $('#name').val(res.user_nome);
            $('#email').val(res.user_email);
        }
    });
}

function deleteUser(id) {
    if (confirm("Deseja mesmo apagar?")) {
        var d = {};
        d._token = $('input[name="_token"]').val();
        d.id = id;
        $.ajax({
            url: 'usuarios/delete/' + id,
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

function getUserData(id) {
    var d = {};
    d.id = id
    $.ajax({
        url: 'usuarios/' + id,
        type: "GET",
        dataType: "json",
        data: d,
        success: function(res) {
            $('#user-nome').text(res.user_nome);
            $('#user-email').text(res.user_email);
            $('#user-status').text(res.user_status);
        }
    });
}

function checkPassword() {
    var password = document.getElementById("password").value;
    var passwordConfirm = document.getElementById("password_confirm").value;
    var passwordMatch = document.getElementById("password_match");

    if (password === passwordConfirm) {
        passwordMatch.style.display = "none";
    } else {
        passwordMatch.style.display = "block";
    }
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