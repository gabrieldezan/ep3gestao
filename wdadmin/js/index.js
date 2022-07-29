$(document).ready(function () {

    $("#aviso_erro").hide();

    /*FORM LOGIN*/
    $("#form_entrar").on('submit', (function (e) {

        Loading();

        e.preventDefault();
        $.ajax({
            url: "controllers/LoginUsuarios.php",
            type: "POST",
            async: true,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data > 0) {
                    window.location.href = "inicio";
                } else {
                    CloseLoading();
                    $("#aviso_erro").show();
                }
            },
            error: function () {
                fecha_loader();
                Erro();
            }
        });
        return false;
    }));

    CloseLoading();

});

function Loading() {
    $(".preloader").fadeIn();
}
function CloseLoading() {
    $(".preloader").fadeOut();
}