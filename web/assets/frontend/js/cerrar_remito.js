$(document).ready(function()
{
    //##### ELIMINAR PUBLICACION #########
    $("body").on("click", ".cerrar_remito", function(delRef)
    {
        delRef.returnValue = false;
        //var id_categoria  = this.id;
        if (confirm('Seguro desea cerrar e imprimir el remito?'))
        {
            // Debe hacer las consultas necesaria para cerrar el remito
            // jQuery.ajax({
            //         type: "POST",
            //         url: RUTA + '/all_models/del_category/' + id_categoria,
            //         dataType: "text",
            //         data: {
            //             id_categoria: id_categoria
            //         },
            //         success:function(response, status, xhr){
            //             location.reload();
            //         },
            //         // error:function (xhr, ajaxOptions, thrownError){
            //         //     alert(thrownError);
            //         // }
            // });
            // location.reload();
            // $(".observaciones textarea").focus();
        }
    });
});