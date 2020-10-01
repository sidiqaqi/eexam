<?php

namespace App\Services\Exams;

use App\Enums\TimeMode;
use App\Models\Participant;
use Carbon\Carbon;

class TimeLimitExam extends BasicExam
{
    public function onGoing(Participant $participant)
    {
        if (!empty($participant->finish_at)) {
            return false;
        }

        $config = $participant->exam->config;

        $now = Carbon::now();

        if ($config->time_mode == TimeMode::TimeLimit) {
            if ($now->gt($participant->created_at->addMinutes($config->time_limit))) {
                $this->markAsFinish($participant, $now);
                return false;
            }
        }

        return true;
    }
}
