$(document).ready(function() {
    //##### ELIMINAR PUBLICACION #########
    $("body").on("click", ".del_tipo", function(delRef) {
        delRef.returnValue = false;
        var id_tipodocumentos  = this.id;
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: RUTA + '/all_models/del_tipo/' + id_tipodocumentos,
                        dataType: "text",
                        data: {
                            id_tipodocumentos: id_tipodocumentos
                        },
                        success:function(response, status, xhr){
                            location.reload();
                        },
                        // error:function (xhr, ajaxOptions, thrownError){
                        //     alert(thrownError);
                        // }
                });
        // location.reload();
        // $(".observaciones textarea").focus();
    }
    });



});