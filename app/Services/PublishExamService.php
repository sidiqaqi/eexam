<?php
namespace App\Services;

use App\Enums\PassingGradeStatus;
use App\Enums\ScoreStatus;
use App\Models\Exam;
use App\Models\Question;

class PublishExamService
{
    private $errors;
    private $hasError;

    public function __construct($errors)
    {
        $this->errors = $errors;

        if ($errors) {
            $this->hasError = true;
        } else {
            $this->hasError = false;
        }

        return $this;
    }

    public function isHasErrors()
    {
        return $this->hasError;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public static function validate(Exam $exam)
    {
        if (!$exam->sections->count()) {
            return new self(['exam' => [__('validation.no_sections')]]);
        }

        $sections = $exam->sections;

        $sectionId = $sections->pluck('id');

        foreach ($sections as $section) {
            if (!$section->questions()->count()) {
                return new self(['exam' => [__('validation.no_questions')]]);
            }
        }

        $config = $exam->config;

        $totalScore = 0;

        if ($config->score_status == ScoreStatus::Global) {
            $totalScore = Question::query()->whereIn('section_id', $sectionId)->count() * $config->default_score;
        } elseif ($config->score_status == ScoreStatus::Section) {
            foreach ($sections as $section) {
                $totalScore += $section->questions()->count() * $section->score_per_question;
            }
        } else {
            $totalScore = Question::query()->whereIn('section_id', $sectionId)->sum('score');
        }

        if ($config->passing_grade_status == PassingGradeStatus::Global) {
            if ($config->default_passing_grade > $totalScore) {
                return new self(['exam' => [__('validation.need_question')]]);
            };
        } else {
            foreach ($sections as $section) {

                if ($config->score_status == ScoreStatus::Global) {
                    if ($section->passing_grade > $section->questions()->count() * $config->default_score) {
                        return new self(['exam' => [__('validation.need_question')]]);
                    }
                } elseif ($config->score_status == ScoreStatus::Section) {
                    if ($section->passing_grade > $section->questions()->count() * $section->score_per_question) {
                        return new self(['exam' => [__('validation.need_question')]]);
                    }
                } else {
                    if ($section->passing_grade > $section->questions()->sum('score')) {
                        return new self(['exam' => [__('validation.need_question')]]);
                    }
                }


            }
        }

        return new self(null);
    }
}
