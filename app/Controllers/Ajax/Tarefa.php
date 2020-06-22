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
            $data[$i]['dataInicioTarefa'] = date("Y-m-d\TH:i:s", strtotime($tarefa['dataInicioTarefa']));
            $data[$i]['dataTerminoTarefa'] = date("Y-m-d\TH:i:s", strtotime($tarefa['dataTerminoTarefa']));
            if($tarefa['statusTarefa']) $data[$i]['statusTarefa'] = "Ativo";
            else $data[$i]['statusTarefa'] = "Inativo";
            $i++;
        }

        $tarefa = [
            'data' => $data
        ];

        echo json_encode($tarefa);
    }
}
