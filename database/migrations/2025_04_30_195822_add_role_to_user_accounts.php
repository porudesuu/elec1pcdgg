<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_accounts', function (Blueprint $table) {
            $table->enum('role', ['admin', 'manager', 'employee'])->default('employee');
            $table->boolean('can_access_admin')->default(false);
        });
    }

    public function down()
    {
        Schema::table('user_accounts', function (Blueprint $table) {
            $table->dropColumn(['role', 'can_access_admin']);
        });
    }
};
