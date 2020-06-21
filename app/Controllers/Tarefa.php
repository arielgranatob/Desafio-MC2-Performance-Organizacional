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
        $model->replace([
            'idTarefa' => $this->request->getVar('id'),
            'idUsuario' => session()->get('idUsuario'),
            'tituloTarefa' => $this->request->getVar('tituloTarefa'),
            'dataInicioTarefa' => $this->request->getVar('dataInicioTarefa'),
            'dataTerminoTarefa' => $this->request->getVar('dataTerminoTarefa'),
            'statusTarefa' => $this->request->getVar('statusTarefa'),
            'descricaoTarefa' => $this->request->getVar('descricaoTarefa')
        ]);
    }

    public function deleteDt($idTarefa = null)
    {
        $model = new TarefaModel();
        $model->where('idTarefa', $idTarefa);
        $model->delete();
    }
}
