<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed recap
 * @property mixed uuid
 * @property mixed finish_at
 */
class ParticipantReportResource extends JsonResource
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
            'exam' => $this->recap->exam ?? '-',
            'creator' => $this->recap->creator ?? '-',
            'on_going' => $this->finish_at ? 0 : 1,
        ];
    }
}
