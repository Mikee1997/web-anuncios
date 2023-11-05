document.addEventListener('DOMContentLoaded', function() {

    $('#pickpoint').on('change',function(){
        $(this).parent('form').submit();
    })

    var form
    var modalConfirm = function(callback) {


        $(".btn-confirm").on("click", function(event) {
            event.preventDefault();
            console.log($(this).attr('confirm-text'));
            $('#myModalLabel').text($(this).attr('confirm-text'));
            form = $(this).parent('form');
            $("#confirmation-modal").modal('show');
        });

        $("#modal-btn-si").on("click", function() {
            callback(true);
            $("#confirmation-modal").modal('hide');
        });

        $("#modal-btn-no").on("click", function() {
            callback(false);
            $("#confirmation-modal").modal('hide');
        });

        $(".btn-confirm").prop('disabled',false);
        console.log('test');
    };

    modalConfirm(function(confirm) {
        if (confirm) {
            //Acciones si el usuario confirma
            form.submit();
        }
    });


}, false);
