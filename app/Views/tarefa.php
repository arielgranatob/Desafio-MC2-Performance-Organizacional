<!doctype html>
<html lang="pt_BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tarefas</title>
  <link rel="shortcut icon" href="/assets/images/ico.png" />
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/r-2.2.5/datatables.min.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <link href="../assets/css/dashboard.css" rel="stylesheet">

</head>

<body>

  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3"></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>

  <!-- sidebar -->
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <ul class="nav flex-column mb-2">
          <div class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Início</span>
          </div>
          <li class="nav-item">
            <a class="nav-link" href="/tarefa">
              <span data-feather="log-out"></span>
              Tarefas
            </a>
          </li>
        </ul>
        <div class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Meus dados</span>
        </div>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="/users/profile">
              <span data-feather="user"></span>
              Perfil (<b><?= session()->get('loginUsuario') ?></b>)
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/users/logout">
              <span data-feather="log-out"></span>
              Sair
            </a>
          </li>
        </ul>
      </nav>

      <!-- descricao -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Tarefas</h1>
          <button type="button" class="btn btn-primary" data-toggle="modal" onclick="moedalCadastro()">
            Nova tarefa
          </button>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-bordered" style="width: 100%" id="tableNoticias">
            <thead>
              <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descricao</th>
                <th>Data de Início</th>
                <th>Data de Término</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
          </table>
        </div>
      </main>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form" method="post" class="container">
            <input type="hidden" id="id" name="id">
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" name="tituloTarefa" id="tituloTarefa">
                <label>Título</label>
              </div>
              <div class="col">
                <select class="form-control" id="statusTarefa" name="statusTarefa">
                  <option id="1" value="Ativo">Ativo</option>
                  <option id="0" value="Inativo">Inativo</option>
                </select>
                <label>Status</label>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <input type="datetime-local" class="form-control" name="dataInicioTarefa" id="dataInicioTarefa" step="1">
                <label>Data de início da tarefa</label>
              </div>
              <div class="col">
                <input type="datetime-local" class="form-control" name="dataTerminoTarefa" id="dataTerminoTarefa" step="1">
                <label>Data de término da tarefa</label>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <textarea class="form-control" name="descricaoTarefa" id="descricaoTarefa" placeholder="Descrição da tarefa"></textarea>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btn">Salvar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/r-2.2.5/datatables.min.js"></script>

  <script>
    var table;
    $(document).ready(function() {
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
            "mRender": function(data, type, row) {
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

    $(document).ready(function() {
      $('#btn').click(function() {
        var dados = $('#form').serializeArray();
        console.log(dados);
        if (dados[1]['value'] == "" || dados[2]['value'] == "" || dados[3]['value'] == "" || dados[4]['value'] == "" || dados[5]['value'] == "") {
          alert("Há campos em branco!");
        } else {
          $.ajax({
            type: "POST",
            url: "/tarefa/storeDt",
            data: dados,
            success: function(result) {
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
        success: function(result) {
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

    $('#modal').on('hidden.bs.modal', function(e) {
      $(this)
        .find("input,textarea")
        .val('')
        .end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
    })
  </script>
</body>

</html>