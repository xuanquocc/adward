<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageBlogController extends Controller
{
    public function index(){
        return view('forum.index');
    }
}
