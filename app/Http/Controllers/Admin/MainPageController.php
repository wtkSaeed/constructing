<?php

namespace App\Http\Controllers\Admin;

use App\HelperClasses\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MainPageController extends Controller
{
    public function ProjectMonths()
    {
        $projects = DB::table('projects')
                        ->select(DB::raw('COUNT(*) as count, MONTH(start_date) as month'))
                        ->whereNotNull('start_date')
                        ->groupBy('month')
                        ->get();

                        $months = [];
                        $projectCounts = [];

                        foreach ($projects as $project) {
                            $months[] = Carbon::createFromDate(null, $project->month)->format('F');
                            $projectCounts[] = $project->count;
                        }

                        // chart projects Count by status..


                        $projectsStatus = DB::table('projects')
                        ->select(DB::raw('COUNT(*) as count, status'))
                        ->groupBy('status')
                        ->get();

                        $statuses = [];
                        $projectCountsByStatus = [];

                        foreach ($projectsStatus as $project) {
                            $statuses[] =Constants::projectStatus[ $project->status];
                            $projectCountsByStatus[] = $project->count;
                        }

                        return view('admin.mainPage', ['months' => $months,'projectCounts'=>$projectCounts,'statuses' => $statuses,'projectCountsByStatus'=>$projectCountsByStatus]);

    }
}
