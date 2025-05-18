<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

use App\Controllers\AdminController;
use App\Models\GuestModel;
use App\Models\UserModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class AdminControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();

        // Manual insert dummy data karena tidak pakai seed()
        $guestModel = new GuestModel();
        $userModel = new UserModel();

        // Disable foreign key checks sebelum truncate
        $db = \Config\Database::connect();
        $db->query("SET FOREIGN_KEY_CHECKS = 0");

        // Clear table dulu
        $guestModel->truncate();
        $userModel->truncate();

        // Enable foreign key checks setelah truncate
        $db->query("SET FOREIGN_KEY_CHECKS = 1");

        // Tambahkan tamu dummy
        for ($i = 0; $i < 10; $i++) {
            $guestModel->insert([
                'name' => "Tamu $i",
                'institution' => 'Instansi ' . chr(65 + ($i % 4)),
                'purpose' => 'Konsultasi',
                'created_at' => date('Y-m-d H:i:s', strtotime("-$i days")),
            ]);
        }

        // Tambahkan petugas dummy
        $userModel->insert([
            'username' => 'petugas1',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'role' => 'petugas',
        ]);
    }

    public function testIndexDashboardViewRenders()
    {
        $controller = new AdminController();

        $response = $controller->index();

        $this->assertIsString($response);
        $this->assertStringContainsString('barData', $response);
        $this->assertStringContainsString('pieData', $response);
    }

    public function testActivityLogViewRenders()
    {
        $controller = new AdminController();

        $response = $controller->activityLog();

        $this->assertIsString($response);
        $this->assertStringContainsString('Riwayat', $response); // Ubah sesuai isi view
    }
}
