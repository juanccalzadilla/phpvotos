

// IF IS PREVIOUS LOGGIN THEN REDIRECT TO HOME PAGE
if (localStorage.getItem('user') !== null) {
    window.location.replace = './listadoVIEW.php';
}


$(document).ready(function () {


    console.log('JQUERY READY');

    $('#form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'src/login.php', // url where to submit the request
            type: 'GET',
            data: { "user": $('#user').val(), "pass": $('#pass').val() },
            success: function (data) {
                if (data == '1') {
                    window.location.href = './listadoVIEW.php';
                    localStorage.setItem('user', $('#user').val());
                } else {

                    alert('Usuario o contraseña incorrectos');
                }
            },
            error: function (data) {

                alert("Usuario no valido")
            }
        })
    })


    $('#form-sign').submit(function (e) {
        e.preventDefault();
        if ($('#pass').val() !== $('#pass1').val()){
            alert("Contraseñas no coinciden");
            return
        } 
            
        if($('#pass').val() == '' || $('#pass1').val() == '' || $('#user').val() == ''){
            alert("No deje campos vacios"); 
            return
        } 
        $.ajax({
            url: 'src/registeruser.php', // url where to submit the request
            type: 'GET',
            data: { "user": $('#user').val(), "pass": $('#pass').val() },
            success: function (data) {
                if (data == '1') {
                    window.location.href = './loginVIEW.php';
                    alert('Usuario registrado correctamente');
                    // localStorage.setItem('user', $('#user').val());
                } else {

                    alert("Usuario no se ha podido registrar");
                }
            },
            error: function (data) {

                console.log(data);
            }
        })

    })

})


