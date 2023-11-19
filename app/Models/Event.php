<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeOwnedBy(Builder $query, int $id): void
    {
        $query->where('user_id', auth()?->user()?->id);
    }

    public function bills(): BelongsToMany
    {
        return $this->belongsToMany(Bill::class)->using(EventBill::class);
    }

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class)->using(PersonEvent::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
