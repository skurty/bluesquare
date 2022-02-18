<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('tickets')->get();
        return response()->json($projects);
    }

    public function show(Project $project)
    {
        return response()->json($project);
    }
}
