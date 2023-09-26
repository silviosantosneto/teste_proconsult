<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketReply extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'description',
        'files'
    ];

    protected $casts = [
        'files' => 'array'
    ];

    protected $appends = ['user_name'];

    public function getUserNameAttribute(): string
    {
        return $this->user->name;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
