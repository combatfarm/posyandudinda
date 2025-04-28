use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToPetugasTable extends Migration
{
    public function up()
    {
        Schema::table('petugas', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('petugas', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
} 