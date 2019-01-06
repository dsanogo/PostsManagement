<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use App\Project;
use App\Facebook;

class ProjectsController extends Controller
{
    public function index(){

        $projects = Project::all();
        
        return view('projects.index', compact('projects'));

    }


    public function create(){
        
        return view('projects.create');
        
    }

    public function store(){

        Project::create(
            
            request()->validate([
                'title' => ['required', 'min:5'],

                'description' => ['required', 'min:10']
            ])
        );
        
        return redirect('/projects');
    }
    
    public function show(Project $project, Facebook $facebook)
    {

       /*  dd($facebook);
        dd(app('facebook')); */

        return view('projects.show', compact('project'));
        
    }

    public function edit(Project $project){

        return view('projects.edit', compact('project'));
        
    }

    public function update(Project $project){

        $project->update(request(['title','description']));

        return redirect('/projects/'.$project->id);
    }

    public function destroy(Project $project){

        $project->delete();

        return redirect('/projects');
    }


}
