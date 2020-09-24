<?php

namespace App\Http\Controllers\Participant;

use App\Models\Answer;
use App\Models\Exam;
use App\Http\Controllers\Controller;
use App\Http\Requests\Participant\Exam\DetailsRequest;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\ConfigResource;
use App\Http\Resources\ExamResource;
use App\Http\Resources\OptionResource;
use App\Http\Resources\ParticipantResource;
use App\Models\Option;
use App\Models\Participant;
use App\Models\Section;
use App\Services\ParticipantService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExamController extends Controller
{
    public function form(Request $request)
    {
        return Inertia::render('Participant/Exam/Form');
    }

    public function details(DetailsRequest $request)
    {
        return redirect()->route('participant.exams.details.show', $request->input('code'));
    }

    public function show($code)
    {
        $exam = Exam::query()->where('code', $code)->firstOrFail();
        return Inertia::render('Participant/Exam/Details', [
            'config' => new ConfigResource($exam->config),
            'creator' => $exam->user->name,
            'exam' => new ExamResource($exam),
        ]);
    }

    public function join(Exam $exam)
    {
        return ParticipantService::join($exam);
    }

    public function section(Participant $participant, Answer $answer, Section $section)
    {
        $exam = $participant->exam;

        return Inertia::render('Participant/Exam/Section', [
            'answer' => $answer,
            'answers' => ParticipantService::getParticipantAnswers($participant),
            'config' => new ConfigResource($exam->config),
            'exam' => new ExamResource($exam),
            'participant' => $participant,
            'section' => $section,
        ]);
    }

    public function process(Participant $participant, Answer $answer)
    {
        $exam = $participant->exam;

        $answers = ParticipantService::getParticipantAnswers($participant);

        return Inertia::render('Participant/Exam/Process', [
            'answer' => function () use ($answer) {
                return new AnswerResource(Answer::withOptionUuid()->where('id', $answer->id)->first());
            },
            'answers' => AnswerResource::collection($answers),
            'config' => new ConfigResource($exam->config),
            'exam' => new ExamResource($exam),
            'options' => OptionResource::collection($answer->question->options),
            'participant' => new ParticipantResource($participant),
            'question' => $answer->question,
            'section' => $answer->section,
        ]);
    }

    /**
     * @param Participant $participant
     * @param Answer $answer
     * @param Option $option
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function submit(Participant $participant, Answer $answer, Option $option)
    {
        $answer->option_id = $option->id;
        $answer->save();

        $answers = ParticipantService::getParticipantAnswers($participant);
        $navigation = ParticipantService::getNavigation($participant, $answer, $answers);

        return redirect($navigation['next']);
    }

    public function previous(Participant $participant, Answer $answer)
    {
        $answers = ParticipantService::getParticipantAnswers($participant);
        $navigation = ParticipantService::getNavigation($participant, $answer, $answers);

        return redirect($navigation['prev']);
    }
}
