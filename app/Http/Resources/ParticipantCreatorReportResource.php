<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use function PHPUnit\Framework\isNull;

/**
 * @property mixed finish_at
 * @property mixed rank
 * @property mixed user
 * @property mixed uuid
 * @property mixed status
 * @property mixed participant
 */
class ParticipantCreatorReportResource extends JsonResource
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
            'uuid' => $this->participant->uuid,
            'name' => $this->user->name,
            'rank' => $this->rank,
            'on_going' => $this->status ? 0 : 1,
        ];
    }
}
