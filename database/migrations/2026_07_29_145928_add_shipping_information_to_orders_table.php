<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->string('recipient_name')->after('user_id');

            $table->string('phone')->after('recipient_name');

            $table->string('province')->after('phone');

            $table->string('city')->after('province');

            $table->string('postal_code')->after('city');

            $table->text('address')->after('postal_code');

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'recipient_name',
                'phone',
                'province',
                'city',
                'postal_code',
                'address',
            ]);

        });
    }
};