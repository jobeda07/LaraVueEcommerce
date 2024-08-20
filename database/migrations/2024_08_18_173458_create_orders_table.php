<?php

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->nullable();
            $table->decimal('sub_total', 20, 2);
            $table->decimal('grand_price', 20, 2);
            $table->string('session_id', 255);
            $table->enum('payment_type', ['paid','unpaid', 'partial']);
            $table->enum('status', ['Ongoing','Pickup', 'Delivered', 'Returned','Cancel'])->default('Ongoing');
            $table->string('payment_method', 255);
            $table->decimal('shipping_charge', 10,2);
            $table->boolean('order_by')->default(0);
            $table->foreignIdFor(UserAddress::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
