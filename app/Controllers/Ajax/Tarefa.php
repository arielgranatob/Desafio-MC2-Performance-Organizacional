<?php

namespace App\Controllers\Ajax;

use App\Models\TarefaModel;
use CodeIgniter\Controller;

class Tarefa extends Controller
{
    public function getDados()
    {
        $model = new TarefaModel();
        $model->select();
        $model->where('idUsuario', session()->get('idUsuario'));
        $tarefas = $model->findAll();
        $i = 0;
        $data = array();
        foreach ($tarefas as $tarefa) {
            $data[$i]['id'] = $tarefa['idTarefa'];
            $data[$i]['tituloTarefa'] = $tarefa['tituloTarefa'];
            $data[$i]['descricaoTarefa'] = $tarefa['descricaoTarefa'];
            $data[$i]['dataInicioTarefa'] = $tarefa['dataInicioTarefa'];
            $data[$i]['dataTerminoTarefa'] = $tarefa['dataTerminoTarefa'];
            $data[$i]['statusTarefa'] = $tarefa['statusTarefa'];
            $i++;
        }

        $tarefa = [
            'data' => $data
        ];

        echo json_encode($tarefa);
    }
}
