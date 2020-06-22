var table;
$(document).ready(function () {
    table = $('#tableNoticias').DataTable({
        "ajax": "../Ajax/tarefa/getDados/",
        "processing": true,
        columns: [{
            data: "id"
        },
        {
            data: "tituloTarefa"
        },
        {
            data: "descricaoTarefa"
        },
        {
            data: "dataInicioTarefa"
        },
        {
            data: "dataTerminoTarefa"
        },
        {
            data: "statusTarefa"
        },
        {
            "mData": null,
            "mRender": function (data, type, row) {
                return '<div class="btn-group" role="group" aria-label="Basic example"><a href="" class="btn btn btn-outline-dark" onClick="editar(\'' + row.id + '\' , \'' + row.tituloTarefa + '\' , \'' + row.descricaoTarefa + '\',\'' + row.dataInicioTarefa + '\',\'' + row.dataTerminoTarefa + '\',\'' + row.statusTarefa + '\');return false;">Editar</a>' +
                    ' <a href="" class="btn btn-outline-danger" onClick="deletar(' + row.id + ');return false;">Excluir</a></div>';
            },
        }
        ],
        responsive: true,
        "oLanguage": {
            "sSearch": "Pesquisa"
        },
        "language": {
            "paginate": {
                "previous": "Anterior",
                "next": "Próxima"
            },
            "processing": "Carregando...",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Desculpe, nada encontrado.",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Sem registros disponíveis.",
            "infoFiltered": "(filtrado de _MAX_ total registros)"
        }
    });
});

$(document).ready(function () {
    $('#btn').click(function () {
        var dados = $('#form').serializeArray();
        console.log(dados);
        if (dados[1]['value'] == "" || dados[2]['value'] == "" || dados[3]['value'] == "" || dados[4]['value'] == "" || dados[5]['value'] == "") {
            alert("Há campos em branco!");
        } else {
            $.ajax({
                type: "POST",
                url: "/tarefa/storeDt",
                data: dados,
                success: function (result) {
                    $('#form').trigger("reset");
                    table.ajax.reload();
                    $('#id').val();
                    $('#modal').modal('hide')
                }
            });
            return false;
        }
    });
});

function editar(id, tituloTarefa, descricaoTarefa, dataInicioTarefa, dataTerminoTarefa, statusTarefa) {
    moedalEdit();
    $('#id').val(id);
    $('#tituloTarefa').val(tituloTarefa);
    $('#dataInicioTarefa').val(dataInicioTarefa);
    $('#dataTerminoTarefa').val(dataTerminoTarefa);
    $("#statusTarefa").val(statusTarefa).change();
    $('#descricaoTarefa').val(descricaoTarefa);
}

function deletar(id) {
    $.ajax({
        type: "DELETE",
        url: "../tarefa/deleteDt/" + id,
        success: function (result) {
            table.ajax.reload();
        }
    });
}

function moedalEdit() {
    $('#tituloModal').text("Editar tarefa");
    $('#modal').modal('show')
}

function moedalCadastro() {
    $('#tituloModal').text('Nova tarefa');
    $('#modal').modal('show')
}

$('#modal').on('hidden.bs.modal', function (e) {
    $(this)
        .find("input,textarea")
        .val('')
        .end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
})