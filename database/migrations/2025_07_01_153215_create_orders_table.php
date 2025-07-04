<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\OrderStatusEnum;
use App\Enums\OrderPaymentStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('address_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('total', 10, 2);
            $table->enum('status', OrderStatusEnum::allValuesAsArray())->default(OrderStatusEnum::default());
            $table->string('payment_method');
            $table->enum('payment_status', OrderPaymentStatusEnum::allValuesAsArray())->default(OrderPaymentStatusEnum::default());
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
