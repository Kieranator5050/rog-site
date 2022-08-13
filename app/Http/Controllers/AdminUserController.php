<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::paginate(30)
        ]);
    }

    public function destroy(User $user)
    {
        $name = $user->username;
        $user->delete();
        request()->session()->flash('flash.banner', "Deleted $name");
        request()->session()->flash('flash.bannerStyle', "danger");
        return back();
    }

    public function edit(User $user)
    {
        return view('admin.users.edit',[
            'user'=>$user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $attributes = request()->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'uid' => ['integer','nullable'],
            'discord_id'=>[Rule::unique('users')->ignore($user->id),'nullable','regex:/^.{3,32}#[0-9]{4}$/m'],
            'team_id'=>['integer','nullable',Rule::exists('teams','id')],
            'rank_id'=>['integer','nullable',Rule::exists('teams','id')]
        ]);

        $data = $request->all();
        $user->isAdmin = (int)$data['isAdmin'];
        $user->isTeamLead = (int)$data['isTL'];
        $user->isQuartermaster = (int)$data['isQM'];
        $user->isMissionMaker = (int)$data['isMM'];
        $user->isActive = (int)$data['isActive'];
        $user->isLocked = (int)$data['isLocked'];

        $user->update($attributes);

        request()->session()->flash('flash.banner', "Edited $user->username");
        request()->session()->flash('flash.bannerStyle', "success");
        return back();
    }

}
