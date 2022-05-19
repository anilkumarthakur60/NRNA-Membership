<?php

use App\Models\Membertype;
use App\Models\Paymenttype;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->boolean('usertype')->default(false);
            
            $table->string('street_address')->nullable();
            $table->string('apartment')->nullable();
            $table->string('city')->nullable();
            $table->string('provience')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('status')->nullable();
            $table->string('total')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('referal_code')->nullable();
            $table->foreignIdFor(Membertype::class)->nullable()->constrained('membertypes')->nullOnDelete();
            $table->foreignIdFor(Paymenttype::class)->nullable()->constrained()->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
