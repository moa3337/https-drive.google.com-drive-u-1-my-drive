<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('published', true)
            ->with('type', 'technologies')
            ->orderBy('updated_at', 'DESC')
            ->paginate(6);

        foreach ($projects as $project) {
            $project->text = $project->getAbstract(200);
        }
        foreach ($projects as $project) {
            $project->image = $project->getImageUri();
        }

        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->with('type', 'technologies')
            ->first();
        if (!$project) return response(null, 404);
      
        $project->image = $project->getImageUri();

        return response()->json($project);
    }

    /**
     * Display the specified resource filtered by type_id).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProjectsByType($type_id)
    {
        $projects = Project::where('$type_id', $type_id)
            ->where('published', true)
            ->with('type', 'technologies')
            ->orderBy('updated_at', 'DESC')
            ->paginate(6);
        
        $type = Type::find($type_id);

        foreach ($projects as $project) {
            $project->image = $project->getImageUri();
        }
        return response()->json(compact('projects', 'type'));
    }
}
