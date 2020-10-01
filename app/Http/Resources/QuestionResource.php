<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed uuid
 * @property mixed type
 * @property mixed title
 * @property mixed value
 * @property mixed image
 * @property mixed time_limit
 */
class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'type' => $this->type,
            'title' => $this->title,
            'value' => $this->value,
            'image' => $this->image,
            'time_limit' => $this->time_limit,
        ];
    }
}
