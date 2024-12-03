<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\JsonResponse;

class JobsController extends Controller
{

    const RESOURCE_MODEL = Company::class;

    /**
     * Retrieve all jobs from the database.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $jobs = Job::all();
        return response()->json($jobs);
    }

    /**
     * Retrieve a single job by its ID.
     *
     * @param int $jobId
     * @return JsonResponse
     */
    public function show(int $jobId)
    {
        $job = Job::with('company')->find($jobId);

        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        return response()->json($job);
    }
}
