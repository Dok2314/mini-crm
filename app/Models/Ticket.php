<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['customer_id', 'subject', 'message', 'status'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeToday(Builder $query): Builder
    { return $query->whereDate('created_at', now()); }
    public function scopeThisWeek(Builder $query): Builder
    { return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]); }
    public function scopeThisMonth(Builder $query): Builder
    { return $query->whereMonth('created_at', now()->month); }

    public function scopeEmail(Builder $query, ?string $email): Builder
    {
        return $email ? $query->whereHas('customer', fn($q) => $q->where('email', 'like', "%$email%")) : $query;
    }

    public function scopePhone(Builder $query, ?string $phone): Builder
    {
        return $phone ? $query->whereHas('customer', fn($q) => $q->where('phone', 'like', "%$phone%")) : $query;
    }

    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        return $status ? $query->where('status', $status) : $query;
    }

    public function scopeDateRange(Builder $query, ?string $from, ?string $to): Builder
    {
        if ($from) $query->whereDate('created_at', '>=', $from);
        if ($to) $query->whereDate('created_at', '<=', $to);
        return $query;
    }
}
