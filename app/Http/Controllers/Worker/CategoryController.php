<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        return view('account.category.index');
    }

    public function create(){
        return view('account.category.create',[
            'category' => [],
            'categories' => Category::with('children')->where('parent_id', '0')->get(),
            'delimiter' => ''
        ]);
    }

    public function store(Request $request){
        $category_ids = $request->category_id;
        $user = Auth::user();

        foreach($category_ids as $category_id){
            if(!$user->categories->contains($category_id)){
                $user->categories()->attach($category_id);
            }
        }

        return back()->with(['success'=>'Подписки изменены']);

    }

    public function destroy(Request $request, $id){
        $user = Auth::user();
        $user->categories()->detach($id);
        return back()->with(['success' => 'Вы отписались от Категории']);
    }
}