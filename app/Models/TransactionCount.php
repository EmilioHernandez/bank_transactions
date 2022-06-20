<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionCount extends Model
{
    /**
     * @var array
     */
    public $guarded = [];

    /**
     * @param string $uuid
     * @return mixed
     */
    public static function uuid(string $uuid)
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
     *
     */
    public function incrementCount()
    {
        $this->count += 1;

        $this->save();
    }
}
