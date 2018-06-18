$(document).ready(function () {

    $(document).on("click", "#tablausuarios tr td .boton-eliminar", function() {
        let fatherId = $(this).parent().closest("tr").attr("id");
        
        $( function() {
            $("#dialog-confirm").dialog({
                show: {
                    effect: "fade",
                    duration: 1000
                },
                    hide: {
                    effect: "explode",
                    duration: 1000
                },
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Eliminar usuario": function() {
                    $.post({ 
                        url: "borrarusuario.php",
                        data: {
                            usuario: fatherId,
                        },
                        success: function() {
                            $("#"+fatherId).fadeOut("slow", function() {
                                $(this).remove();
                            });
                        }
                    });
                    $( this ).dialog( "close" );
                },
                "Cancelar": function() {
                $( this ).dialog( "close" );
                }
            }
            });
        });
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });


    $("#fecha_nacimiento").datepicker({ 
        dateFormat: "dd-mm-yy"
    });

    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });

});




}