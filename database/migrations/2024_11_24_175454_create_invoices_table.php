<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string("invoice_number");
            $table->date("invoice_date");
            $table->date("due_date");
            $table->foreignId("section_id")->constrained()->onDelete("cascade");
            $table->decimal("Amount_collection");
            $table->decimal("Amount_commision");
            $table->string("product");
            $table->decimal("discoint");
            $table->text("rate_vate");
            $table->decimal("value_vate");
            $table->decimal("total" , 8 ,2);
            $table->string("status");
            $table->boolean("value_status");
            $table->text("note")->nullable();
            $table->string("user");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};