<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE_NAME = 'tasks';
    private const COLUMN_TITLE = 'title';
    private const COLUMN_DESCRIPTION = 'description';
    private const COLUMN_IS_ACTIVE = 'is_active';

    public function up(): void
    {
        if (!Schema::hasTable(self::TABLE_NAME)) {
            Schema::create(self::TABLE_NAME, function (Blueprint $table) {
                $table->id();
                $table->string(self::COLUMN_TITLE);
                $table->text(self::COLUMN_DESCRIPTION)->nullable();
                $table->boolean(self::COLUMN_IS_ACTIVE);
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
