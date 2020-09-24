<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed uuid
 * @property mixed order
 * @property mixed type
 * @property mixed value
 */
class OptionResource extends JsonResource
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
            'order' => $this->order,
            'type' => $this->type,
            'value' => $this->value,
        ];
    }
}
