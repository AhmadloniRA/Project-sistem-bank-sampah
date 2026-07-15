<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_id')->nullable()->after('id');
        });

        $users = DB::table('users')->orderBy('id', 'asc')->get();
        foreach ($users as $index => $user) {
            $year = $user->created_at ? date('Y', strtotime($user->created_at)) : '2026';
            $noId = 'BS-' . $year . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
            DB::table('users')->where('id', $user->id)->update(['no_id' => $noId]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('no_id')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('no_id');
        });
    }
};
