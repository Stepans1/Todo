<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $hidden = ['is_active'];

    protected $appends = ['isActive'];

    protected $fillable = [
        'title',
        'description',
    ];

    public function getIsActiveAttribute(): bool
    {
        return $this->attributes['is_active'];
    }

    public function setIsActiveAttribute(bool $value): void
    {
        $this->attributes['is_active'] = $value;
    }

    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('d.m.Y H:i');
    }
}
