<?php

namespace App\Models;

use App\Traits\HasOwner;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property mixed exam
 * @property mixed answers
 * @property mixed id
 * @property mixed uuid
 * @property mixed created_at
 * @property Carbon|mixed finish_at
 * @property mixed user_id
 * @property false|mixed|string cache_config
 * @property mixed recap
 * @method static find(\Illuminate\Database\Eloquent\HigherOrderBuilderProxy $id)
 * @method static owner(int|string|null $id)
 */
class Participant extends Model
{
    use HasOwner;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function recap()
    {
        return $this->hasOne('App\Models\Recap');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
