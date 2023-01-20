<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Order;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Order::class);
            $table->string("ref_number");
            $table->string("token");
            $table->string("transaction_id")->nullable();
            $table->string("card_number")->nullable();
            $table->string("tracking_code")->nullable();
            $table->string("provider")->default("paystar");
            $table->enum("status",["SUCCESSFUL", "FAILED", "PENDING"])->default("PENDING");
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
        Schema::dropIfExists('transactions');
    }
};
