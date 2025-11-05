<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    private function authorizeOwner(Category $category) {
        if ($category->user_id !== session('user_id')) abort(403);
    }

    public function index(){
        $categories = Category::where('user_id', session('user_id'))->get();
        return view('categories.index', compact('categories'));
    }
    public function create(){ return view('categories.create'); }
    public function store(Request $r){
        $r->validate(['name'=>'required|string|max:100']);
        Category::create(['name'=>$r->name,'user_id'=>session('user_id')]);
        return redirect()->route('categories.index')->with('success','Kategori dibuat');
    }
    public function edit($id){
        $category = Category::findOrFail($id);
        $this->authorizeOwner($category);
        return view('categories.edit', compact('category'));
    }
    public function update(Request $r,$id){
        $category = Category::findOrFail($id);
        $this->authorizeOwner($category);
        $r->validate(['name'=>'required|string|max:100']);
        $category->update(['name'=>$r->name]);
        return redirect()->route('categories.index')->with('success','Kategori diperbarui');
    }
    public function destroy($id){
        $category = Category::findOrFail($id);
        $this->authorizeOwner($category);
        $category->delete();
        return redirect()->route('categories.index')->with('success','Kategori dihapus');
    }
}
