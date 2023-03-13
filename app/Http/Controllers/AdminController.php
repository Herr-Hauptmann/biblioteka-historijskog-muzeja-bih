<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function export(){
        return Inertia::render('Impex/Export');
    }
    public function import(){
        return Inertia::render('Impex/Import');
    }
}
