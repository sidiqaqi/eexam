<?php

namespace App\Http\Controllers\Participant;

use App\Enums\TimeMode;
use App\Http\Requests\Participant\Exam\ProcessRequest;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\SectionResource;
use App\Enums\CorrectStatus;
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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExamController extends Controller
{
    /**
     * @param Request $request
     * @return \Inertia\Response
     */
    public function form(Request $request)
    {
        return Inertia::render('Participant/Exam/Form');
    }

    /**
     * @param DetailsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function details(DetailsRequest $request)
    {
        return redirect()->route('participant.exams.details.show', $request->input('code'));
    }

    /**
     * @param $code
     * @return \Inertia\Response
     */
    public function show($code)
    {
        $exam = Exam::query()->where('code', $code)->firstOrFail();
        return Inertia::render('Participant/Exam/Details', [
            'config' => new ConfigResource($exam->config),
            'creator' => $exam->user->name,
            'exam' => new ExamResource($exam),
        ]);
    }

    /**
     * @param Exam $exam
     * @return mixed
     */
    public function join(Exam $exam)
    {
        return ParticipantService::join($exam);
    }

    /**
     * @param ProcessRequest $request
     * @param Participant $participant
     * @param Answer $answer
     * @param Section $section
     * @return \Inertia\Response
     */
    public function section(ProcessRequest $request, Participant $participant, Answer $answer, Section $section)
    {
        $exam = $participant->exam;

        return Inertia::render('Participant/Exam/Section', [
            'answer' => new AnswerResource($answer),
            'answers' => ParticipantResource::collection(ParticipantService::getParticipantAnswers($participant)),
            'config' => new ConfigResource($exam->config),
            'exam' => new ExamResource($exam),
            'participant' => new ParticipantResource($participant),
            'section' => new SectionResource($section),
            'time_limit' => $exam->config->time_mode == TimeMode::TimeLimit ?
                Carbon::now()->diffInSeconds(
                    $participant->created_at->addSeconds($exam->config->time_limit * 60), false
                ) * 1000
                : 0,
        ]);
    }

    /**
     * @param ProcessRequest $request
     * @param Participant $participant
     * @param Answer $answer
     * @return \Inertia\Response
     */
    public function process(ProcessRequest $request, Participant $participant, Answer $answer)
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
            'question' => new QuestionResource($answer->question),
            'section' => new SectionResource($answer->section),
            'time_limit' => $exam->config->time_mode == TimeMode::TimeLimit ?
                Carbon::now()->diffInSeconds(
                    $participant->created_at->addSeconds($exam->config->time_limit * 60), false
                ) * 1000
                : 0,
        ]);
    }

    /**
     * @param ProcessRequest $request
     * @param Participant $participant
     * @param Answer $answer
     * @param Option $option
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function submit(ProcessRequest $request, Participant $participant, Answer $answer, Option $option)
    {
        $answer->option_id = $option->id;
        $answer->is_correct = $option->correct_id;
        $answer->score = $option->correct_id == CorrectStatus::True ? ParticipantService::getScore($participant, $answer) : 0;
        $answer->save();

        $answers = ParticipantService::getParticipantAnswers($participant);
        $navigation = ParticipantService::getNavigation($participant, $answer, $answers);

        return redirect($navigation['next']);
    }

    /**
     * @param ProcessRequest $request
     * @param Participant $participant
     * @param Answer $answer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function previous(ProcessRequest $request, Participant $participant, Answer $answer)
    {
        $answers = ParticipantService::getParticipantAnswers($participant);
        $navigation = ParticipantService::getNavigation($participant, $answer, $answers);

        return redirect($navigation['prev']);
    }

    /**
     * @param ProcessRequest $request
     * @param Participant $participant
     * @return \Inertia\Response
     */
    public function recap(ProcessRequest $request, Participant $participant)
    {
        $exam = $participant->exam;

        $answers = ParticipantService::getParticipantAnswers($participant);

        return Inertia::render('Participant/Exam/Recap', [
            'answers' => AnswerResource::collection($answers),
            'config' => new ConfigResource($exam->config),
            'exam' => new ExamResource($exam),
            'participant' => new ParticipantResource($participant),
        ]);
    }

    /**
     * @param ProcessRequest $request
     * @param Participant $participant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finish(ProcessRequest $request, Participant $participant)
    {
        return ParticipantService::finish($participant);
    }
}
