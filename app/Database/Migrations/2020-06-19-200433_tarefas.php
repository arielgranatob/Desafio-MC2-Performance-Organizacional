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
				'auto_increment' => TRUE,
			],
			'idUsuario'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
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
				'type'           => 'DATETIME',
			],
			'dataTerminoTarefa'       => [
				'type'           => 'DATETIME',
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
		$this->forge->addField("ALTER TABLE tarefas ADD CONSTRAINT fk_tarefa_usuario FOREIGN KEY (idUsuario) REFERENCES usuarios (idUsuario)");
	}

	public function down()
	{
		$this->forge->dropTable('tarefas');
	}
}
