<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //用户信息展示
    public function show(User $user) {
        return view('users.show', compact('user'));
    }

    //用户信息编辑表单
    public function edit() {

    }

    //用户信息修改
    public function update() {

    }


}
