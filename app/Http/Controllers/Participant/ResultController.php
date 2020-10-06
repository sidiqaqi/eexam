<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Participant\Result\OwnerRequest;
use App\Http\Resources\ParticipantReportResource;
use App\Models\Participant;
use App\Models\User;
use App\Services\RecapService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ResultController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Participant/Result/Index', [
            'participants' => ParticipantReportResource::collection(
                Participant::query()->owner(User::find(Auth::id()))
                    ->with(['recap.examModel'])
                    ->paginate()
            )
        ]);
    }

    /**
     * @param OwnerRequest $request
     * @param Participant $participant
     * @return \Inertia\Response
     */
    public function show(OwnerRequest $request, Participant $participant)
    {
        return Inertia::render('Participant/Result/Show', [
            'report' => RecapService::participantReport($participant)
        ]);
    }
}
