<?php

namespace App\Models;

use App\Enums\TicketStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status_id',
        'files'
    ];

    protected $casts = [
        'status_id' => TicketStatusEnum::class,
        'files' => 'array'
    ];

    protected $appends = [
        'status',
        'user_name'
    ];

    public function getStatusAttribute(): string
    {
        return $this->status_id->getName();
    }

    public function getUserNameAttribute(): string
    {
        return $this->user->name;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}

