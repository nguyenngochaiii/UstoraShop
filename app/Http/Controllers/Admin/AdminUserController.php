<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\UserService;
use App\Models\User;
use DB;


class AdminUserController extends Controller
{
    
    protected $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getUsers();
        return view('admin.users.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'username',
            'password',
            'phone',
            'email',
            'address',
            'sex',
            'date_of_birth',
        ]);

        try {
            $user = User::create($data);
        } catch (\Exception $e) {
            \Log::error($e);
            
            return back()->withInput($data)->with('error','Something Wrong Sir !!'); //err meg
            
        }
        
        return redirect()->route('admin.users.edit' , $user->id)->with('status', 'Create success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('layout.product', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userService->showUser($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->only([
            'name',
            'username',
            'password',
            'phone',
            'email',
            'country',
            'streetAddress',
            'city',
            'postCode',
            'sex',
            'date_of_birth',
        ]);

        try {
            $user = User::update($data);
        } catch (\Exception $e) {
            \Log::error($e);
            
            return back()->withInput($data)->with('error','Something Wrong Sir !!'); //err meg
            
        }

        return redirect()->route('admin.users.edit' , $user->id)->with('status', 'Create success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            
            return back()->with('error','Delete Failed  Sir !!'); //err meg
        }

        return redirect()->route('admin.users.index')->with('status', 'Delete success!');
    }
}