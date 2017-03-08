<?php

namespace App\Http\Controllers\Backend\Unit\Documentation;

use App\Models\Unit\Documentation\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        dd(Category::pluck('id','name'));
        javascript()->put([
            'categories' => Category::orderBy('sort_order','asc')->get()->values()->toJson(),
        ]);
        return view('backend.documentation.pages.index');
    }
}
