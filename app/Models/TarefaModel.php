<?php

namespace App\Models;

use CodeIgniter\Model;

class TarefaModel extends Model
{
  protected $table = 'tarefas';
  protected $allowedFields = ['idTarefa', 'idUsuario', 'tituloTarefa', 'descricaoTarefa', 'dataInicioTarefa', 'dataTerminoTarefa', 'statusTarefa', 'created_at', 'updated_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  protected function beforeInsert(array $data)
  {
    $data['data']['created_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function beforeUpdate(array $data)
  {
    $data['data']['updated_at'] = date('Y-m-d H:i:s');
    return $data;
  }
}
