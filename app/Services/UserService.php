<?php

namespace App\Services;

use App\Services\BaseService;
use DB;
use Illuminate\Http\Request;
use App\Models\User;

class UserService extends BaseService
{
    protected $userModel;
    public function __construct(User $user)
    {
        $this->userModel = $user;
    }


    public function getUsers()
    {
        $users = $this->userModel::paginate(20);

        return $users;
    }
    
    public function showUser($id)
    {
        $user = $this->userModel::findOrFail($id);
        return $user;
    }
}