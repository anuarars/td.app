<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($id)
    {
        $page = Page::find($id);
        return view('page', compact('page'));
    }

}
