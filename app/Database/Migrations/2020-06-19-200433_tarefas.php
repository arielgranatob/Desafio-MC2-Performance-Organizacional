<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tarefas extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'idTarefa'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'tituloTarefa'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'descricaoTarefa'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'dataInicioTarefa'       => [
				'type'           => 'DATE',
			],
			'dataTerminoTarefa'       => [
				'type'           => 'DATE',
			],
			'idUsuario'          => [
				'type'           => 'INT',
			],
			'statusTarefa'       => [
				'type'           => 'boolean',
			],
			'created_at'       => [
				'type'           => 'DATETIME',
			],
			'updated_at'       => [
				'type'           => 'DATETIME',
			],
			'deleted_at'       => [
				'type'           => 'DATETIME',
			]
		]);

		$this->forge->addKey('idTarefa', TRUE);
		$this->forge->createTable('tarefas');
	}

	public function down()
	{
		$this->forge->dropTable('tarefas');
	}
}
