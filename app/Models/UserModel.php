<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'usuarios';
  protected $allowedFields = ['idUsuario', 'loginUsuario', 'senhaUsuario', 'created_at', 'updated_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  protected function beforeInsert(array $data)
  {
    $data = $this->passwordHash($data);
    $data['data']['created_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function beforeUpdate(array $data)
  {
    $data = $this->passwordHash($data);
    $data['data']['updated_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function passwordHash(array $data)
  {
    if (isset($data['data']['senhaUsuario']))
      $data['data']['senhaUsuario'] = password_hash($data['data']['senhaUsuario'], PASSWORD_DEFAULT);
    return $data;
  }
}
