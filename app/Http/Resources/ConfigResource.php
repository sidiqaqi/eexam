<?php

namespace App\Http\Resources;

use App\Enums\AnswerOrderStatus;
use App\Enums\QuestionOrderStatus;
use App\Enums\RankingStatus;
use App\Enums\ResultStatus;
use App\Enums\TimeMode;
use Illuminate\Http\Resources\Json\JsonResource;

class ConfigResource extends JsonResource
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
            'answer_order' => AnswerOrderStatus::getDescription($this->answer_order),
            'question_order' => QuestionOrderStatus::getDescription($this->question_order),
            'ranking_status' => RankingStatus::getDescription($this->ranking_status),
            'time_limit' => $this->time_limit . ' menit',
            'time_mode' => $this->time_mode,
            'time_mode_text' => TimeMode::getDescription($this->time_mode),
            'result_status' => ResultStatus::getDescription($this->result_status),
        ];
    }
}
