$(document).ready(function() {
    //##### ELIMINAR PUBLICACION #########
    $("body").on("click", ".del_product", function(delRef) {
        delRef.returnValue = false;
        var id_producto  = this.id;
        if (confirm('Seguro de eliminarlo?')) {
                jQuery.ajax({
                        type: "POST",
                        url: RUTA + '/all_models/del_product/' + id_producto,
                        dataType: "text",
                        data: {
                            id_producto: id_producto
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