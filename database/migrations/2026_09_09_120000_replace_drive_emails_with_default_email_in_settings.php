<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('default_email')->nullable()->after('drive_root_folder_id');
            $table->dropColumn('drive_emails');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('drive_emails')->nullable()->after('drive_root_folder_id');
            $table->dropColumn('default_email');
        });
    }
};
