<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'idUsuario'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'loginUsuario'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'senhaUsuario'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
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

		$this->forge->addKey('idUsuario', TRUE);
		$this->forge->createTable('usuarios');
	}
	public function down()
	{
		$this->forge->dropTable('usuarios');
	}
}
