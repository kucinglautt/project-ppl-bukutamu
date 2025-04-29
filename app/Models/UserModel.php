<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 
        'password', 
        'role', 
        'is_deleted', 
        'created_at', 
        'updated_at', 
        'deleted_at'];

    protected $useTimestamps = true; 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function softDelete($id)
    {
        return $this->update($id, [
            'is_deleted' => 1,
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getActiveUsers()
    {
        return $this->where('is_deleted', 0)->findAll();
    }
}
