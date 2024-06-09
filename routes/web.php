<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function() {
    return view('contact');
});
//CREATE
Route::get('/jobs/create', function() {
    return view('jobs.create');

});
//STORE
Route::post('/jobs', function(){
    // validation...
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' =>  ['required'],
    ]);
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);
    return redirect();
});
//SHOW
Route::get('/jobs/{id}', function($id) {

    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});
//INDEX
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    return view('jobs.index',[
        'jobs' => $jobs,
    ]);
});

//EDIT
Route::get('/jobs/{id}/edit', function($id) {

    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

//UPDATE
Route::patch('/jobs/{job}', function(Job $job) {

    //validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    //authorize (On hold)
    //update job
    // and presist
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);
    
    //redirect to the job page

    return redirect('/jobs/'.$job->id);
});

//DESTROY
Route::delete('/jobs/{job}', function(Job $job) {

    //authorize(On hold)

    $job->delete();

    return redirect('/jobs');
});
