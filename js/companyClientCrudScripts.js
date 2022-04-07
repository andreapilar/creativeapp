
var direcciones_generales = [];
var leyenda_error="Debe digitar todos los campos con *";
var element_adition=$(".elementos_adicionales");
var element_div_form_1=$(".contenedor_formulario_1");
var element_div_form_2=$(".contenedor_formulario_2");
var menu_videos=$(".menu_videos");
var ID_SESSION=$(".id_session");
var type_test=$(".type_test");
var btn_pre_text=$(".js_pre_text");
var navbar_toggle=$(".navbar-toggle");
var menu_videos_select=$(".menu_videos_select");

var element_NameClient=$(".NameClient");
var element_ApellClient=$(".ApellClient");
var element_phoneTable=$(".phoneTable");
var element_correo=$(".correo");
var element_edad=$(".edad");
var element_genero=$(".genero");


menu_videos.hide();
$('.jsBtnCreateClient').click(function(){

    //validamos que cada campo este validado con las funciones de validacion, si toodo esta bn , osea true,  cumple la condicion y envia
    if (validateText('NameClient', 20,leyenda_error)===true &&
        validateText('ApellClient',20,leyenda_error)===true){


        var NameClient=element_NameClient.val();
        var ApellClient=element_ApellClient.val();
        var phoneTable=element_phoneTable.val();
        var correo=element_correo.val();
        var edad=element_edad.val();
        var genero=element_genero.val();


        $.ajax({
            type: 'POST',
            url: 'ajax/companyClientCrud.php',
            data: ({
                Action : 'CREATE',
                NameClient : NameClient,
                phoneTable : phoneTable,
                correo : correo,
                ApellClient:ApellClient,
                edad:edad,
                genero:genero
            }),
            success:function (response){

                //Parseamos a formato JSON la respuesta
                var json_obj = $.parseJSON(response);

                ID_SESSION.val(json_obj);
                element_div_form_1.hide();
                element_div_form_2.show();



            },
            error : function(xhr, status) {
                return false;
            },
        });
    }
});

$("[data_video]").click(function (){
    var index=$(this);
    var url_video=index.attr("data_video");
    var time_video=index.attr("data_time");
    var index_frame=$("#video_background");
    ocultar_todo();
    index_frame.show();
    index_frame.attr("src",url_video);

    setTimeout(function(){
        mostrar_btn_post_test();
    },time_video*1000);

})

$(".post_test").click(function (){
    type_test.val("post_test")
    mostrar_form_post();
    var index_frame=$("#video_background");
    index_frame.attr("src",'');
    index_frame.hide();
    $(this).hide();

})


$('#JSFile_1').change(function(){
    upload_file($(this),'form_2')
})


function upload_file(element,type) {

    //Obtenemos y guardamos las propiedades del archivo
    var imagenes=element[0].files;

    //Validamos que se haya seleccionado algún archivo
    if (imagenes !== null) {

        //Obtenemos el nombre del archivo
        //let file_name = file['name'];

        //Creamos objeto para recopilar la información del archivo
        var formData = new FormData();
        for (const imagen in imagenes){
            formData.append('archivo'+imagen,imagenes[imagen]);
        }

        formData.append('archivo', imagenes);
        formData.append('id_session', ID_SESSION.val());
        formData.append('type_test', type_test.val());
        formData.append('type_process', type);

        //Preparamos petición Ajax para procesar el archivo
        $.ajax({
            type: 'POST',
            url: 'ajax/processing-files.php',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {

                let json_obj = $.parseJSON(response);
                $.each( json_obj, function( key, value ) {
                    //Validamos si la respuesta fue exitosa
                    if (value.status === '200') {


                    }

                })
                $('#JSFile').val("");
                $('.fileinput-remove-button').click();
                $('.progress-bar').css('width',"0%");
                $('.progress-bar').html(0+"%");

                $('.btn-close-modal').click();
                $('.js-pdf-subir').show()
                $('.btn-close-modal').show()
            }
        })
    } else {
        validationMessageError('Ocurrió un error al seleccionar el archivo.');
    }
}

btn_pre_text.click(function (){

    insert_pre_text()
})

function insert_pre_text (){
    var element_titulos=$('.titulos_input');
    var array_titulos=[];
    element_titulos.each(function (){
        var titulo=$(this).val()
        if (titulo!=="")
            array_titulos.push(titulo)
    })

    var codigo_titulos=$('.codigo_input');
    var array_codigos=[];
    codigo_titulos.each(function (){
        var codigo=$(this).val()
        if (codigo!=="")
            array_codigos.push(codigo)
    })

    var descripcion_element=$('.descripcion');
    var descripcion_array=[];
    descripcion_element.each(function (){
        var descripcion=$(this).val()
        if (descripcion!=="")
            descripcion_array.push(descripcion)
    })


    $.ajax({
        type: 'POST',
        url: 'ajax/companyClientCrud.php',
        data: ({
            Action : 'pre_test',
            array_titulos : array_titulos,
            array_codigos : array_codigos,
            type_test : type_test.val(),
            descripcion_array : descripcion_array,
            id_session : ID_SESSION.val()
        }),
        success:function (response){

            //Parseamos a formato JSON la respuesta

            limpiar_campos();
            ocultar_todo();

        },
        error : function(xhr, status) {
            return false;
        },
    });



}

function  ocultar_todo (){
    element_div_form_1.hide();
    element_div_form_2.hide();
    element_adition.hide();
    menu_videos.show();
    if (navbar_toggle.is(":visible")===true)
        navbar_toggle.click();

    menu_videos_select.click();
}

function  mostrar_form_post (){
    element_div_form_2.show();
    $('.post_test').show();
    element_adition.show();

}
function mostrar_btn_post_test(){
    $('.post_test').show();
}

function limpiar_campos(){
    element_NameClient.val("");
    element_ApellClient.val("");
    element_phoneTable.val("");
    element_correo.val("");
    element_edad.val("");
    element_genero.val("");
    $('#JSFile_1').val("");


    $('.codigo_input').val("");
    $('.titulos_input').val("");
    $('.descripcion').val("");


}