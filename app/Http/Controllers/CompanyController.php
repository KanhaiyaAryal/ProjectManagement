<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) {
            $companies=Company::where('user_id', Auth::user()->id)->get();
            return view('company.index',['companies'=>$companies]);
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
        
       return view('company.create');
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
            'descriptions' => 'required'
        ]);
       
       if(Auth::check()) {  
            $insertCompany = Company::create([
                'name'=> $request->input('name'),
                'descriptions' => $request->input('descriptions'),
                'user_id' => Auth::user()->id 
                ]);
            //echo $request->input('descriptions');
            if($insertCompany){
                return redirect()->route('company.index')
                           ->with('success','Company created successfully.');
            }
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company= Company::find($company->id);
        return view('company.show',['company'=>$company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
       $company= Company::find($company->id);
       return view('company.edit',['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'descriptions' => 'required',
        ]);
        $companyUpdate= Company::where('id',$company->id)
                ->update([
                    'name'=>$request->input('name'),
                    'descriptions'=>$request->input('descriptions')
                ]);
         
        if($companyUpdate) {
            return redirect('company')->with('success','Company updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $companyDelete=Company::find($company->id);
        if($companyDelete->delete()) {
            return redirect('company')->with('success','Company deleted successfully');
        }
        return back()->withInput('error','Company cannot delete');
    }
}
