$(document).on("submit", ".form_registro", function(event){
    //previene el evento por defecto para no refrescar la pagina
    event.preventDefault();
    //crea la variable que recibe la informacion del formulario
    var  $form = $(this);
    console.log($form);
    //crea un objeto con los valores del formulario
    var data_form = {
        email: $("input[type='email']",$form).val(),
        password: $("input[type='password']",$form).val()
    }
    //se validan los parametro minimos del email y la contraseña
    if (data_form.email.length < 6) {
        $("#msg_error").text("Necesitamos un email valido").show();
        return false;
    }else if(data_form.password.length < 8){
        $("#msg_error").text("Tu password debe ser minimo de 8 caracteres").show();
        return false;
    }

    $("#msg_error").hide();

    var url_php ='http://localhost/task_app/ajax/procesar_registro.php';
    //crea la llamada Ajax
    $.ajax({
        type:'POST',
        url: url_php,
        data: data_form,
        dataType: 'json',
        async: true,

    //maneja los posibles errores de la llamada Ajax    
    })
    .done(function ajaxDone(res) {
        console.log(res);
        if(res.error !== undefined){
           $("#msg_error").text(res.error).show(); 
        }
        if(res.redirect !== undefined){
            window.location = res.redirect; 
            return false;
         }

    })  
    
    //En caso de devolver un error
    .fail(function ajaxError(e){
        console.log(e);
    })
    // se ejecuta siempre sin importar la respuesta
    .always(function ajaxSiempre(){
        console.log("Final de la llamada ajax");
    })
    //evita que la pagina se actualice al realizar la peticion Ajax
    return false; 
});


$(document).on("submit", ".form_login", function(event){
    event.preventDefault();
    var  $form = $(this);
    console.log($form);
    
    var data_form = {
        email: $("input[type='email']",$form).val(),
        password: $("input[type='password']",$form).val()
    }

    if (data_form.email.length < 6) {
        $("#msg_error").text("Necesitamos un email valido").show();
        return false;
    }else if(data_form.password.length < 8){
        $("#msg_error").text("Tu password debe ser minimo de 8 caracteres").show();
        return false;
    }

    $("#msg_error").hide();

    var url_php ='http://localhost/task_app/ajax/procesar_login.php';
    
    $.ajax({
        type:'POST',
        url: url_php,
        data: data_form,
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(res) {
        console.log(res);
        if(res.error !== undefined){
           $("#msg_error").html(res.error).show(); 
           return false;
        }
        if(res.redirect !== undefined){
           window.location = res.redirect; 
        }
    })
    .fail(function ajaxError(e){
        console.log(e);
    })
    .always(function ajaxSiempre(){
        console.log("Final de la llamada ajax");
    })
    return false; 
});


