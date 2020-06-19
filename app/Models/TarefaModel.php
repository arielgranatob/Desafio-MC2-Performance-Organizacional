<?php

namespace App\Models;

use CodeIgniter\Model;

class TarefaModel extends Model
{
  protected $table = 'tarefas';
  protected $allowedFields = ['tituloTarefa', 'descricaoTarefa', 'dataInicioTarefa', 'dataTerminoTarefa', 'statusTarefa'];
}
