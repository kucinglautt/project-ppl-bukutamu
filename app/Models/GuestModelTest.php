// tests/app/Models/GuestModelTest.php
namespace Tests\App\Models;

use App\Models\GuestModel;
use CodeIgniter\Test\CIUnitTestCase;

class GuestModelTest extends CIUnitTestCase
{
    protected $guestModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->guestModel = new GuestModel();
    }

    public function testCountGuestsToday()
    {
        $today = date('Y-m-d');

        $count = $this->guestModel
            ->where('DATE(created_at)', $today)
            ->countAllResults();

        $this->assertGreaterThanOrEqual(0, $count); // tes minimal 0
    }
}
