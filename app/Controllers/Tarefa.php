<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TarefaModel;

class Tarefa extends Controller
{
    public function index()
    {
        $data = [];
        echo view('tarefa', $data);
    }

    public function storeDt()
    {
        $model = new TarefaModel();
        $model->save([
            'idTarefa' => $this->request->getVar('id'),
            'tituloTarefa' => $this->request->getVar('titulo'),
            'descricaoTarefa' => $this->request->getVar('descricao')
        ]);
    }

    public function deleteDt($idTarefa = null)
    {
        $model = new TarefaModel();
        $model->where('idTarefa', $idTarefa);
        $model->delete();
    }
}
