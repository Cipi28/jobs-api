<?php

namespace App\Http\Controllers;


use App\Models\Job;
use Illuminate\Http\JsonResponse;
use App\Models\Company;

class CompaniesController extends Controller
{
    const RESOURCE_MODEL = Company::class;

    /**
     * Retrieve all companies from the database.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $companies = Company::withCount('jobs')->get();

        foreach ($companies as $company) {
            $company->jobsNumber = $company->jobs_count;
            unset($company->jobs_count);
        }

        return response()->json($companies);
    }
    /**
     * Retrieve a single company by its ID.
     *
     * @param int $companyId
     * @return JsonResponse
     */
    public function show($companyId)
    {
        $company = Company::withCount('jobs')->find($companyId);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $company->jobsNumber = $company->jobs_count;
        unset($company->jobs_count);

        return response()->json($company);
    }

    /**
     * Retrieve all jobs for a given company ID.
     *
     * @param int $companyId
     * @return JsonResponse
     */
    public function getJobsByCompany($companyId)
    {
        $jobs = Job::where('company_id', $companyId)->get();

        //empty list of jobs can also be returned
//        if ($jobs->isEmpty()) {
//            return response()->json(['message' => 'No jobs found for this company'], 404);
//        }

        return response()->json($jobs);
    }
}
