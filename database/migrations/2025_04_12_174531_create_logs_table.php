<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE_NAME = 'logs';
    private const COLUMN_LEVEL = 'level';
    private const COLUMN_MESSAGE = 'message';
    private const COLUMN_CONTEXT = 'context';

    public function up()
    {
        if (!Schema::hasTable(self::TABLE_NAME)) {
            Schema::create(self::TABLE_NAME, function (Blueprint $table) {
                $table->id();
                $table->string(column: self::COLUMN_LEVEL);         
                $table->text(self::COLUMN_MESSAGE);          
                $table->text(self::COLUMN_CONTEXT)->nullable();
                $table->timestamps();
            });
        }
    }
    
    public function down(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            Schema::dropIfExists(self::TABLE_NAME);
        }  
    }
};
