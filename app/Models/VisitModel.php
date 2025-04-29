<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitModel extends Model
{
    protected $table = 'visits';
    protected $primaryKey = 'id';
    protected $allowedFields = ['guest_id', 'check_in', 'check_out', 'status', 'handled_by'];
}
