<?php

namespace App\Http\Controllers;

use App\Actions\GetStatisticsAction;
use App\Actions\UpdateStatisticsAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StatisticsController extends Controller
{

    /**
     * Возвращает JSON-объект вида: { код страны: количество посещений, cy: 123, us: 456, ... }
     *
     * @param  GetStatisticsAction  $action
     *
     * @return JsonResponse
     */
    public function getStatistics(GetStatisticsAction $action): JsonResponse
    {
        $statistics = $action->handle();

        return response()->json($statistics);
    }

    /**
     * Обновление статистики, принимает один аргумент – код страны (ru, us, it...).
     *
     * @param  Request  $request
     * @param  UpdateStatisticsAction  $action
     *
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatistics(Request $request, UpdateStatisticsAction $action): JsonResponse
    {
        $this->validate($request, [
            'country_code' => [
                'required',
                Rule::in(config('countries.codes')),
            ],
        ]);

        $countryCode = $request->input('country_code');

        $count = $action->handle($countryCode);

        return response()->json([
            'country_code' => $countryCode,
            'value'        => $count,
        ]);
    }
}
