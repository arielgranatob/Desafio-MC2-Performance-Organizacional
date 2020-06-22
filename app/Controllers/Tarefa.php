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
        if ($this->request->getVar('statusTarefa') == "Ativo") $statusTarefa = 1;
        else $statusTarefa = 0;
        $model = new TarefaModel();
        $model->replace([
            'idTarefa' => $this->request->getVar('id'),
            'idUsuario' => session()->get('idUsuario'),
            'tituloTarefa' => $this->request->getVar('tituloTarefa'),
            'dataInicioTarefa' => date("Y-m-d\TH:i:s", strtotime($this->request->getVar('dataInicioTarefa'))),
            'dataTerminoTarefa' => date("Y-m-d\TH:i:s", strtotime($this->request->getVar('dataTerminoTarefa'))),
            'statusTarefa' => $statusTarefa,
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
