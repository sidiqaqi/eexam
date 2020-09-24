<?php

namespace App\Http\Controllers\Creator;

use App\Models\Config;
use App\Models\Exam;
use App\Http\Controllers\Controller;
use App\Http\Requests\Creator\Config\UpdateRequest;

class ConfigController extends Controller
{
    public function update(UpdateRequest $request, Config $config)
    {
        $config->update($request->data());

        return redirect()->route('creator.exams.edit', Exam::find($config->exam_id)->uuid)
            ->with('success', __('notification.success.update', ['model' => __('Config')]));
    }
}
