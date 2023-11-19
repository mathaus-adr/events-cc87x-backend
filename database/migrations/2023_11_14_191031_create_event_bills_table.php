<?php

use App\Models\Bill;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bill_event', function (Blueprint $table) {
            $table->foreignIdFor(Event::class, 'event_id');
            $table->foreignIdFor(Bill::class, 'bill_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_event');
    }
};
