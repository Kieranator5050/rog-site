<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\OperationType;
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

    public function index()
    {
        return view('operations.index',[
            'operations'=>Operation::latest('op_date')->paginate(10)
        ]);
    }

    public function show(Operation $operation)
    {
        return "Test";
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
