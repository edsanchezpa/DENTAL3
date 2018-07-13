(function( $ ) {

    "use strict"; 
    /*==================================================================
    [ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })

    /*=====================================================
    Validate */
     $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });


     function showValidate(input) {
        var thisAlert = $(input).parent();
        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();
        $(thisAlert).removeClass('alert-validate');
    }

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function validate() {

        var pass=$('#txtpass').val().trim();
        var vlogin=$('#txtuser').val();
        var vclave=$('#txtpass').val();

        var newclave = hex_md5(pass);

        if(vlogin =="" && vclave ==""){
            $('#userdiv').addClass('alert-validate');
            $('#passdiv').addClass('alert-validate');
            }
        else if(vlogin=="" || vlogin==undefined) {
                $('#userdiv').addClass('alert-validate'); 
            }
        else if(vclave=="" || vclave==undefined) {
                $('#passdiv').addClass('alert-validate');
            }
        else if(validateEmail(vlogin) == false){
             $('#userdiv').addClass('alert-validate');
        }else{
            var params = {
                    usuario : vlogin,
                    clave   : newclave 
                    };

                    var url = "DAO/valida_usuario.php";

                    $.ajax({            
                        url: url,
                        type: "POST",
                        data: params,
                        dataType: "json",
                         complete: function (jsondata, stat) {  
                            var json = jsondata.responseJSON;
                            var datos = json.datos;

                            if (datos.status == 100){
                                window.location.href = 'agendita.php';
                            }else{
                                $.msgBox({
                                title: "Error",
                                content: "Usuario y/o Contraseña Incorrecta",
                                type: "error",
                                buttons: [{ value: "Ok" }]
                                });       
                            }
  
                         },                      
                        beforeSend: function () {
                         },
                        error: function (jqXHR, textStatus, errorThrown) {
                                $.msgBox({
                                title: "Error",
                                content: "Ocurrio un error inesperado. </br> Pongase en contacto con el Administrador",
                                type: "error",
                                align: "center",
                                buttons: [{ value: "Ok" }]
                                });                    
                         }
                    });

        }
        
    }

    $("#btnenviar").bind("click", validate);
    $("#btnregistrarse").bind("click",nextpage);

    function nextpage(){
        window.location.href = 'UI/registrarse.php';
    }
  

    $.fn.fnValidar=function(){
        
        var vlogin=$('#txtuser').val();
        var vclave=$('#txtpass').val();

        if(vlogin =="" && vclave ==""){
            $('#userdiv').addClass('alert-validate');
            $('#passdiv').addClass('alert-validate');
        }
        else if(vlogin=="" || vlogin==undefined) {
                $('#userdiv').addClass('alert-validate'); 
        }
        else if(vclave=="" || vclave==undefined) {
                $('#passdiv').addClass('alert-validate');
        }
        else{
                    var params = {
                    usuario : vlogin,
                    clave    :vclave 
                    };

                    var url = "DAO/valida_usuario.php";

                    $.ajax({            
                        url: url,
                        type: "POST",
                        data: params,
                        dataType: "json",
                         complete: function (jsondata, stat) {  
                            var json = jsondata.responseJSON;
                            var datos = json.datos;

                            if (datos.status == 100){
                                window.location.href = 'agendita.php';
                            }
                            else{
                                $.msgBox({
                                title: "Ooops",
                                content: "Ohh dear! You broke it!!!",
                                type: "error",
                                buttons: [{ value: "Ok" }]
                                });      
                            }
  
                         },                      
                        beforeSend: function () {
                         },
                        error: function (jqXHR, textStatus, errorThrown) {                            
                         }
                    });

            /*
            var datos={ module:"mdlaccess",fruc:vruc,flogin:vlogin,fclave:vclave};

            $.ajax({
                async:true, 
                cache:false,  
                url: "./BL/BL_principal.php",
                type: "POST",
                data: datos,
                dataType: "JSON",
                success: function (retorno) {
                    try{
//                        console.log(retorno);

                        var vmessage=retorno[0]['message'];
                        var datas = [];
                        if(vmessage=="ok"){
                           window.location.href = 'inicio.php';
                        }else{
                            $.msgBox({
                                title: "Mensaje",
                                content: "No se encontró el usuario",
                                type: "info",
                                buttons: [{ value: "Ok" }]
                            });                         
                        }                          
                    }catch(err) {
                            $.msgBox({
                                title: "Mensaje",
                                content: "No se encontró el usuario",
                                type: "info",
                                buttons: [{ value: "Ok" }]
                            });                          
                    }
  
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $.msgBox({
                        title: "Error - Acceso",
                        content: "Comunicarse con el Administrador.",
                        type: "error",
                        buttons: [{ value: "Ok" }]
                    });                    
                }  
            });            
*/
        }
  }  

}(jQuery));