<?php

use App\Models\ActivityLogModel;

if (!function_exists('log_activity')) {
    function log_activity($action, $detail = null)
    {
        $session = session();
        $model = new ActivityLogModel();

        $model->insert([
            'user_id'    => $session->get('id'), // pastikan session menyimpan id
            'username'   => $session->get('username'),
            'action'     => $action,
            'detail'     => $detail,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
            'created_at' => date('Y-m-d H:i:s') // karena tidak pakai useTimestamps
        ]);
    }
}
