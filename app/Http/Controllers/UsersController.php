<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //用户信息展示
    public function show(User $user) {
        return view('users.show', compact('user'));
    }

    //用户信息编辑表单
    public function edit(User $user) {
        return view('users.edit', compact('user'));
    }

    //用户信息修改
    public function update(UserRequest $request, User $user) {
        $user->update($request->all());
        return redirect()->route('users.show', $user->id)->with('success', '个人资料已更新！');
    }


}
