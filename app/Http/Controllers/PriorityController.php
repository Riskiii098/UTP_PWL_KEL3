<?php
// app/Http/Controllers/PriorityController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Priority;

class PriorityController extends Controller
{
    private function authorizeOwner(Priority $priority) {
        if ($priority->user_id !== session('user_id')) abort(403);
    }

    public function index(){
        $priorities = Priority::where('user_id', session('user_id'))
            ->withCount('tasks')
            ->orderBy('level', 'desc')
            ->get();
        return view('priorities.index', compact('priorities'));
    }

    public function create(){ 
        return view('priorities.create'); 
    }

    public function store(Request $r){
        $r->validate([
            'nama' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:5',
        ]);
        
        Priority::create([
            'nama' => $r->nama,
            'level' => $r->level,
            'user_id' => session('user_id')
        ]);
        
        return redirect()->route('priorities.index')->with('success','Prioritas ditambahkan.');
    }

    public function edit($id){
        $priority = Priority::findOrFail($id);
        $this->authorizeOwner($priority);
        return view('priorities.edit', compact('priority'));
    }

    public function update(Request $r, $id){
        $priority = Priority::findOrFail($id);
        $this->authorizeOwner($priority);
        
        $r->validate([
            'nama' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:5',
        ]);
        
        $priority->update([
            'nama' => $r->nama,
            'level' => $r->level,
        ]);
        
        return redirect()->route('priorities.index')->with('success','Prioritas diperbarui.');
    }

    public function destroy($id){
        $priority = Priority::findOrFail($id);
        $this->authorizeOwner($priority);
        $priority->delete();
        return redirect()->route('priorities.index')->with('success','Prioritas dihapus.');
    }
}