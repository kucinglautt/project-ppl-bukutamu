<?php namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_logs';
    protected $allowedFields = ['user_id', 'username', 'action', 'detail', 'ip_address', 'user_agent', 'created_at'];
    protected $useTimestamps = false;
}


