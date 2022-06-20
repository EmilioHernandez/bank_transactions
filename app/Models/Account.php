<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    public $guarded = [];

    /**
     * @param string $uuid
     * @return static
     */
    public static function uuid(string $uuid): self
    {
        return static::where('uuid', $uuid)->first();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param int $amount
     */
    public function addMoney(int $amount)
    {
        $this->balance += $amount;

        $this->save();

    }

    /**
     * @param int $amount
     */
    public function subtractMoney(int $amount)
    {
        $this->balance -= $amount;

        $this->save();

    }
}
