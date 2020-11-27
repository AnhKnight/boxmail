<?php

namespace App\Models\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToUser
{
    public static function bootBelongsToUser(): void
    {
        static::creating(function ($model) {
            $model->user()->associate(request()->user());
        });

        static::addGlobalScope('current_user', function (Builder $builder) {
            if (request()->user()) {
                $builder->where('user_id', request()->user()->id);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeByLoggedUser($query): void
    {
        $query->where('user_id', request()->user()->id);
    }
}
