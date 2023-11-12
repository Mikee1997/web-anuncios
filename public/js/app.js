document.addEventListener('DOMContentLoaded', function() {

    $('#pickpoint').on('change',function(){
        $(this).parent('form').submit();
    })

    var form
    var modalConfirm = function(callback) {

        $(document).on('click','.btn-confirm',function(event) {
            event.preventDefault();
            console.log($(this).attr('confirm-text'));
            $('#myModalLabel').text($(this).attr('confirm-text'));
            form = $(this).parent('form');
            $("#confirmation-modal").modal('show');
        });

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

        window.addEventListener("load", function() {
            $(".btn-confirm").prop('disabled',false);

        });
        console.log('test');
    };

    modalConfirm(function(confirm) {
        if (confirm) {
            //Acciones si el usuario confirma
            form.submit();
        }
    });


}, false);


let loadingSpin = '<i class="fa fa-circle-notch fa-spin"></i>';

$(document).ready(function(e) {
    initializeDeleteFile();

    //Ir al tab seleccionado.
    var hash = window.location.hash;
    if (hash !== '') {
        let hashes = hash.split('#');
        $.each(hashes, function (i, hash) {
            if (hash == '') {
                return;
            }

            setTimeout(function() {
                let byHref = $('a[href="#'+ hash +'"]');
                if (byHref.length) {
                    byHref.click();
                    return;
                }

                let byId = $('a[id="' + hash + '"]');
                if (byId.length) {
                    byId.click();
                }
            }, 500);
        });
    }

    $('.dataTable').each(function() {
        let table = $(this);
        let datatableColumns = [];
        let searchColumns = [];
        let orderTable = table.data('order-column');
        let orderType = table.data('order-type');
        let orders = [];
        let searchTimeout = null;

        table.find('thead th').each(function(i, item){
            let columnName = $(item).data('name');
            let foot = $(this).parents('table').find('tfoot th:nth-child('+(i+1)+')');
            datatableColumns.push({ data: columnName, name: columnName, orderable: $(foot).data('orderable') == 0 ? false : true, searchable: $(foot).data('searchable') == 0 ? false : true});

            //FILTRO POR DEFECTO
            //Obtenemos la columna del footer correspondiente al header y añadimos a search_columns si tiene default, null en caso contrario.

            let defaultValue = $(foot).data('selected');
            if (defaultValue != undefined) {
                searchColumns.push({ 'sSearch': defaultValue })
            } else {
                searchColumns.push(null);
            }
        });

        if (orderTable !== undefined && orderType !== undefined){
            if ($.isNumeric(orderTable)) {
                orderTable = orderTable.toString();
            }

            orderTable = orderTable.split(',');
            orderType = orderType.split(',');

            $.each(orderTable, function(i, item) {
                orders.push([orderTable[i], orderType[i]]);
            });
        }

        table.DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ajax": $(this).data('url'),
            "columns": datatableColumns,
            "order": orders,
            "pageLength": 100,
            "lengthMenu": [[100, 500, -1], [100, 500, "Todos"]],
            "searchDelay": 350,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
            },
            'searchCols': searchColumns,
            initComplete: function () {
                let api = this.api();
                api.columns().every(function(){
                    let column = this;
                    let footer = column.footer();
                    let defaultValue = $(footer).data('selected');


                    if ($(footer).data('searchable') == undefined || $(footer).data('searchable') != 0) {
                        if ($(footer).hasClass('select')) {
                            let values = $(footer).data('values');
                            let select = document.createElement('select');
                            let option = document.createElement("option");

                            option.text = '';
                            option.value = '';
                            select.appendChild(option);
                            $.each(values, function (itemName, itemId) {
                                let option = document.createElement("option");
                                option.text = itemName;
                                option.value = itemId;
                                option.selected = (defaultValue == option.value);
                                select.appendChild(option);
                            });

                            $(select).appendTo($(column.footer()).empty()).on('change', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                        } else {
                            let input = document.createElement("input");
                            $(input).appendTo($(column.footer()).empty()).on('keyup', function () {
                                let value = $(this).val();

                                if (searchTimeout != null) {
                                    clearTimeout(searchTimeout);
                                }

                                searchTimeout = setTimeout(function() {
                                    searchTimeout = null;
                                    column.search(value, false, false, true).draw();
                                }, 500);
                            });
                        }
                    }



                });
                api.draw();
            },
            drawCallback: function() {
                table.find("td").addClass("text-center");
                table.find("a[data-toggle='tooltip']").tooltip({ html: true });
            }
        });

        table
            .on('click', '.btn-delete', function(e){
                e.preventDefault();
                deleteItem($(this), table);
            })
            .on('click', '.btn-restore', function(e){
                e.preventDefault();
                restoreItem($(this), table);
            });

    });

    if ($('.summernote').length) {
        $('.summernote').summernote({
            height: 200
        });
    }

    if ($('.select2').length) {
        $('.select2').select2({placeholder: 'Selecciona'});
    }
});

function deleteItem(element, table) {
    let url = element.attr('href');
    modalConfirm("¿Estás seguro de que quieres eliminar el elemento '" + element.data('name') + "'?", function(confirm){
        if(confirm){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                dataType: 'json',
                type: 'DELETE',
                success: function(){
                    table.DataTable().ajax.reload();
                    toastr.success('El registro ha sido eliminado correctamente');
                },
                error: function (){

                },
                complete: function (){

                },
            })
        }
    }, true);
}

function restoreItem(element, table) {
    let url = element.attr('href');
    modalConfirm("¿Estás seguro de que quieres restaurar el elemento '" + element.data('name') + "'?", function(confirm){
        if(confirm){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                dataType: 'json',
                type: 'PUT',
                success: function(){
                    table.DataTable().ajax.reload();
                    toastr.success('El registro ha sido restaurado correctamente');
                },
                error: function (xhr){
                    if (xhr.status == 422) {
                        toastr.error(xhr.responseText)
                    }

                },
            })
        }
    }, true);
}

function deleteFile(element) {
    let url = element.attr('href');

    if (url != '') {
        modalConfirm("¿Estás seguro de que quieres eliminar el archivo?", function (confirm) {
            if (confirm) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    dataType: 'json',
                    type: 'DELETE',
                    success: function () {
                        location.reload();
                    },
                    error: function (xhr) {

                    },
                })
            }
        }, false);
    } else {
        let inputGroup = element.parents('.input-group');
        inputGroup.find('.delete-file-input').val(1);
        inputGroup.find(':file').filestyle('clear');
        inputGroup.find(':file').filestyle('placeholder', '');
        inputGroup.find('.view-delete-buttons').remove();
    }
}

function modalConfirm(message, callback, close, object) {
    close = (close != undefined) ?  close : true;
    object = (close != undefined) ?  object : false;

    let modal = $("#confirmation-modal");
    let modalBody = modal.find('.modal-body');
    let yesButton = $("#confirmation-btn-yes");

    modalBody.html(message);
    yesButton.html("Sí");
    modal.modal('show');

    yesButton.unbind("click");

    yesButton.click(function() {
        yesButton.html(loadingSpin);
        callback(true, object);
        if (close) {
            modal.modal('hide');
        }
    });
}

function initializeDeleteFile() {
    $('.btn-delete-file').click(function(e) {
        e.preventDefault();
        deleteFile($(this));
    });
}
