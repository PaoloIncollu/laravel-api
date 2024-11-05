<?php

namespace App\Http\Controllers\Admin;

// Helpers
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Project,
    Type,
    Technology
};

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.comic
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        $data = $request->all();

        $data['slug'] = str()->slug($data['name']);
        $data['published'] = isset($data['published']);

        if (isset($data['cover'])) {
            $coverPath = Storage::disk('public')->put('uploads', $data['cover']);
            $data['cover'] = $coverPath;
        }

        $project = Project::create($data);

        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        $data = $this->validateRequest($request);

        $data = $request->all();

        $data['slug'] = str()->slug($data['name']);
        $data['published'] = isset($data['published']);

        if (isset($data['cover'])) {
            if ($project->cover) {
                // ELIMINA L'IMMAGINE PRECEDENTE
                Storage::disk('public')->delete($project->cover);
                $project->cover = null;
            }

            $coverPath = Storage::disk('public')->put('uploads', $data['cover']);
            $data['cover'] = $coverPath;
        }
        else if (isset($data['remove_cover']) && $project->cover) {
            // ELIMINA L'IMMAGINE PRECEDENTE
            Storage::disk('public')->delete($project->cover);
            $project->cover = null;
        }

        $project->update($data);

        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if ($project->cover) {
            // ELIMINA L'IMMAGINE PRECEDENTE
            Storage::disk('public')->delete($project->cover);
        }

        $project->delete();
        return redirect()->route('admin.projects.index');
    }

    private function validateRequest($request){

        $request->validate([

            'name' => 'required|min:3|max:64',
            'description' => 'required|min:10|max:5000',
            'content' => 'required|min:10|max:5000',
            'creation_date' => 'nullable|date',
            'published' => 'nullable|in:1,0,true,false',
            'cover' => 'nullable|image|max:2048',
            'type_id' => 'nullable|exists:types,id',

        ]);
    }
}
