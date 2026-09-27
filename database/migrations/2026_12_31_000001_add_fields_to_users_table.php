<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->after('id');
            $table->string('username')->unique()->after('name');
            $table->foreignId('tenant_id')->nullable()->constrained()->nullOnDelete()->after('password');
            $table->string('avatar_url')->nullable()->after('tenant_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['uuid', 'username', 'tenant_id', 'avatar_url']);
            $table->dropForeign(['tenant_id']);
        });
    }
};
