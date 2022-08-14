<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\OperationType;
use App\Models\OperationUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OperationController extends Controller
{
    public function complete(Request $request, Operation $operation)
    {
        $request->validate([
           'isCompleted'=>['required','digits_between:0,1']
        ]);
        $data = $request->all();
        $operation->update([
            'isCompleted'=>!(int)$data['isCompleted']
        ]);

        request()->session()->flash('flash.banner', "Edited Completion Status for $operation->name");
        request()->session()->flash('flash.bannerStyle', "success");
        return back();
    }

    public function unregister(Operation $operation, User $user)
    {
        //Check if user is trying to unregister another user
        if(request()->user()->cannot('Quartermaster')){
            //Unregister Self
            if(auth()->user()->id == $user->id){
                OperationUser::query()->where('user_id','=',$user->id)->where('operation_id','=',$operation->id)->delete();
            } else {
                request()->session()->flash('flash.banner', "No");
                request()->session()->flash('flash.bannerStyle', "danger");
                return back();
            }
        } else {
            OperationUser::query()->where('user_id','=',$user->id)->where('operation_id','=',$operation->id)->delete();
        }

        request()->session()->flash('flash.banner', "Unregistered $user->username from $operation->name");
        request()->session()->flash('flash.bannerStyle', "success");
        return back();
    }

    public function signup(Request $request, Operation $operation, User $user)
    {
        //Check if adding life insurance to already existing registration
        if(!$request['updateLifeInsurance']??false){

            //Check if attempting to sign up as another user
            if(auth()->user()->id != $user->id){
                request()->session()->flash('flash.banner', "No");
                request()->session()->flash('flash.bannerStyle', "danger");
                return back();
            }

            //Create the registration
            if($request['hasLifeInsurance'] ?? false){
                OperationUser::create([
                    'operation_id'=>$operation->id,
                    'user_id'=>$user->id,
                    'hasLifeInsurance'=>1
                ]);
                request()->session()->flash('flash.banner', "Registered for $operation->name successfully with life insurance");
            } else {
                OperationUser::create([
                    'operation_id'=>$operation->id,
                    'user_id'=>$user->id,
                    'hasLifeInsurance'=>0
                ]);
                request()->session()->flash('flash.banner', "Registered for $operation->name successfully");
            }
        } else {
            //Update life insurance
            OperationUser::query()
                            ->where('user_id','=',$user->id)
                            ->where('operation_id','=',$operation->id)
                            ->update([
                                'hasLifeInsurance'=>1
                            ]);
            request()->session()->flash('flash.banner', "Purchased Life Insurance Successfully!}");
        }



        request()->session()->flash('flash.bannerStyle', "success");
        return back();
    }

    public function index()
    {
        return view('operations.index',[
            'operations'=>Operation::latest('op_date')->paginate(10),
            'operation_user'=>OperationUser::class
        ]);
    }

    public function show(Operation $operation)
    {
        return view('operations.show',[
            'operation'=>$operation,
            'users'=>$operation->users->paginate(20),

            'isRegistered'=>OperationUser::query()
                                            ->where('operation_id','=',$operation->id)
                                            ->where('user_id','=',auth()->user()->id)
                                            ->exists(),

            'hasLifeInsurance'=>OperationUser::query()
                                            ->where('operation_id','=',$operation->id)
                                            ->where('user_id','=',auth()->user()->id)
                                            ->where('hasLifeInsurance','=',1)
                                            ->exists()
        ]);
    }

    public function create()
    {
        return view('operations.create',[
            'types'=>OperationType::all()
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'=>['required'],
            'op_date'=>['required', 'after_or_equal:today'],
            'description'=>['required'],
            'operation_type_id'=>['required',Rule::exists('operation_types','id')]
        ]);
        $attributes['isCompleted'] = 0;

        Operation::create($attributes);

        request()->session()->flash('flash.banner', "Added Operation : ".$attributes['name']);
        request()->session()->flash('flash.bannerStyle', "success");
        return back();
    }

    public function destroy(Operation $operation)
    {
        $name = $operation->name;
        $operation->delete();
        request()->session()->flash('flash.banner', "Deleted Operation $name");
        request()->session()->flash('flash.bannerStyle', "danger");
        return back();
    }

    public function edit(Operation $operation)
    {
        return view('operations.edit',[
            'op'=>$operation,
            'types'=>OperationType::all()
        ]);
    }

    public function update(Request $request, Operation $operation)
    {
        $attributes = $request->validate([
            'name'=>['required'],
            'op_date'=>['required'],//after_or_equal:today
            'description'=>['required'],
            'operation_type_id'=>['required',Rule::exists('operation_types','id')]
        ]);

        $data = $request->all();
        $operation->isCompleted = (int)$data['isCompleted'];

        $operation->update($attributes);

        request()->session()->flash('flash.banner', "Edited $operation->name");
        request()->session()->flash('flash.bannerStyle', "success");
        return back();
    }
}
