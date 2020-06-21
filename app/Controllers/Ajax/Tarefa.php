<?php

namespace App\Controllers\Ajax;

use App\Models\TarefaModel;
use CodeIgniter\Controller;

class Tarefa extends Controller
{
    public function getDados()
    {
        $model = new TarefaModel();
        $model->select('*');
        $model->where('idUsuario', '0');
        $tarefas = $model->findAll();
        $i = 0;
        $data = array();
        foreach ($tarefas as $tarefa) {
            $data[$i]['id'] = $tarefa['idTarefa'];
            $data[$i]['titulo'] = $tarefa['tituloTarefa'];
            $data[$i]['descricao'] = $tarefa['descricaoTarefa'];
            $i++;
        }
        $tarefa = [
            'data' => $data
        ];

        echo json_encode($tarefa);
    }
}
