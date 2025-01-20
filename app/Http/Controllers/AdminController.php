<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function export(){
        return Inertia::render('Impex/Export');
    }
    public function import(){
        return Inertia::render('Impex/Import');
    }
}
