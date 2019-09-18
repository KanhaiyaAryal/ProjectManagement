<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\ProjectUser;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        if (Auth::check()) {
            //$projectId= Project::find($project->id);
            $project=Project::where('user_id', Auth::user()->id)->get();
            return view('project.index', ['project'=>$project]);
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company=Company::all();
        return view('project.create', ['company'=>$company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required',
            'descriptions' => 'required',
            'company_id' => 'required',
            'days' => 'required'
        ]);
       
        if (Auth::check()) {
            $insertProject = Project::create([
                'name'=> $request->input('name'),
                'descriptions' => $request->input('descriptions'),
                'company_id' => $request->input('company_id'),
                'days' => $request->input('days'),
                'user_id' => Auth::user()->id
                ]);
             //echo $request->input('descriptions');
            if ($insertProject) {
                return redirect()->route('project.index')
                          ->with('success', 'Project created successfully.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project= Project::find($project->id);
        $projectUser = ProjectUser::where('project_id', $project->id)
                                       ->first();
        if ($projectUser) {
            return view('project.show', ['project'=>$project])
                                   ->with('success', 'Project created successfully.');
        } else {
            return view('project.show', ['project'=>$project])
                                       ->with('success', 'Project created successfully.2');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $company=Company::all();
        $project= Project::find($project->id);
        return view('project.edit', ['project'=>$project], ['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'descriptions' => 'required',
            'company_id' => 'required',
            'days' => 'required'
        ]);
        $projectUpdate= Project::where('id', $project->id)
                ->update([
                    'name'=> $request->input('name'),
                'descriptions' => $request->input('descriptions'),
                'company_id' => $request->input('company_id'),
                'days' => $request->input('days')
                ]);
         
        if ($projectUpdate) {
            return redirect('project')->with('success', 'Project updated successfully');
        }
    }
    
    public function addmember(Request $request)
    {
        $project = Project::find($request->input('project_id'));
        
        if (Auth::user()->id == $project->user_id) {
            $user = User::where('email', $request->input('email'))->first(); //single record
            //check if user is already added to the project

            if (!$user) {
                return redirect()->route('project.show', ['project'=>$project->id])
                              ->with('error', $request->input('email').' does not exist');
            }
            $projectUser = ProjectUser::where('user_id', $user->id)
                                      ->where('project_id', $project->id)
                                      ->first();
            if ($projectUser) {
                   //if user already exists, exit
                   return redirect()->route('project.show', ['project'=>$project->id])
                              ->with('error', $request->input('email').' is already a member of this project');
                   //return redirect()->route('project.show', ['project'=> $project->id])->with(['error',  $request->input('email').' is already a member of this project']);
            }
            if ($user && $project) {
                $project->users()->attach($user->id);
                
                return redirect()->route('project.show', ['project'=>$project->id])
                              ->with('success', $request->input('email').' is added successfully');
            }
        }
        return redirect()->route('project.show', ['project'=>$project->id])
                              ->with('error', 'Error adding user this project!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $projectDelete=Project::find($project->id);
        if ($projectDelete->delete()) {
            return redirect('project')->with('success', 'Project deleted successfully');
        }
        return back()->withInput('error', 'Project cannot delete');
    }
}
