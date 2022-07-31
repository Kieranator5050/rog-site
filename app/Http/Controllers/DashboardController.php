<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index',[
            'operations'=>\App\Models\Operation::query()->latest()->where('isCompleted','=','0')->paginate(3),
            'operation_user' => \App\Models\OperationUser::query()
        ]);
    }

    public function rules()
    {
        return view('dashboard.rules');
    }
}
