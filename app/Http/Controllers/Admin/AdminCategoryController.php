<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DB;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(12);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            $category = Category::create($data);
        } catch (\Exception $e) {
            \Log::error($e);

            return back()->withInput($data)->with('error','Create Failed  Sir !!');
        }
            
        return back()->withInput($data)->with('status', 'Create success!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        $category = Category::findOrFail($id);

        try {
            $category->update($data);
        } catch (\Exception $e) {
            \Log::error($e);

            return back()->withInput($data)->with('error','Update Failed  Sir !!');
        }
            
        return back()->withInput($data)->with('status', 'Update success!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        try {
            $category->delete();
        } catch (\Exception $e) {
            \Log::error($e);

            return back()->with('error','Delete Failed  Sir !!');
        }
            
        return back()->with('status', 'Delete success!');
    }
}