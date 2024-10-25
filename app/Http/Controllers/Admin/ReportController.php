<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
{
    $projects = Project::all();
    return view('admin.material-report', ['projects' => $projects]);
}

public function getMaterialsForProject($projectId)
{
    $materials = DB::table('materials')
        ->join('project_materials', 'materials.id', '=', 'project_materials.material_id')
        ->leftJoin('request_details', 'materials.id', '=', 'request_details.material_id')
        ->where('project_materials.project_id', $projectId)
        ->select('materials.name as material_name',
                 DB::raw('SUM(project_materials.quantity) as available'),
                 DB::raw('SUM(request_details.quantity) as requested'))
        ->groupBy('materials.name')
        ->get();

    return response()->json(['materials' => $materials]);
}

}
