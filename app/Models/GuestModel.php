<?php namespace App\Models;

use CodeIgniter\Model;

class GuestModel extends Model
{
    protected $table = 'guests';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 
        'institution', 
        'purpose', 
        'phone_number', 
        'created_at',
        'updated_at',
        'updated_at'
    ];

    protected $useTimestamps = true; 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'updated_at';
}