<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property mixed exam
 * @property mixed answers
 * @property mixed id
 * @property mixed uuid
 * @property mixed created_at
 * @property Carbon|mixed finish_at
 * @method static find(\Illuminate\Database\Eloquent\HigherOrderBuilderProxy $id)
 */
class Participant extends Model
{
    protected $fillable = ['user_id', 'exam_id', 'random_key', 'finish_at'];

    protected $dates = [
        'created_at',
        'updated_at',
        'finish_at',
    ];

    /**
     * Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }
}
