<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCronRequest;
use App\Http\Resources\CronListResource;
use App\Models\Schedule;
use Illuminate\Http\Request;

class CustomCronJobController extends Controller
{
    public function index()
    {
        return CronListResource::collection(Schedule::all());
    }

    public function store(StoreCronRequest $request)
    {
        Schedule::create($request->validated());

        return response()->noContent(201);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return response()->noContent(200);
    }
}
