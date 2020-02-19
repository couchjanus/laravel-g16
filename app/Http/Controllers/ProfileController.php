<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Http\Requests\ProfileRequest;
use App\Http\Services\ProfileService;

class ProfileController extends Controller
{
    /**
     * @var ProfileService
     */
    private $service;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('profile.index');

    }
    
    public function info()
    {
        return view('profile.home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $this->service->updateInformation($request->all());
        return redirect()->route('profile.home')->withSuccess("Your Profile Updated Successguly");
    }

    public function update(Request $request)     {
        // $request->user() returns an instance of the authenticated user...
    }
    
}
