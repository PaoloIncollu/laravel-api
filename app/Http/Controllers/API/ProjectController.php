<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type','technologies');            // Eager loading

        $nameParam = request()->input('name');
        if (isset($nameParam)) {
            $projects = $projects->where('name', 'LIKE', '%'.$nameParam.'%');
        }

        $projects = $projects->paginate(3);                       // Paginazione

        return response()->json([
            'success' => true,
            'code' => 200,
            // 'message' => 'Ok',
            'projects' => $projects
        ]);
    }

    public function show(string $slug)
    {
        $project = Project::with('type','technologies')
                    ->where('slug', $slug)
                    ->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'code' => 200,
                // 'message' => 'Ok',
                'project' => $project
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'code' => 404,
                'message' => 'Project not found'
            ]);
        }
    }
}
