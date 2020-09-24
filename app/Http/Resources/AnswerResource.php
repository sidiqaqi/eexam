<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed uuid
 * @property mixed option_id
 * @property mixed option_uuid
 */
class AnswerResource extends JsonResource
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
            'filled' => $this->option_id ? true : false,
            'option_uuid' => $this->option_uuid,
        ];
    }
}
