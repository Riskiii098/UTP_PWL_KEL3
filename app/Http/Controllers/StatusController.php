<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    private function authorizeOwner(Status $status) {
        if ($status->user_id !== session('user_id')) abort(403);
    }

    public function index(){
        $statuses = Status::where('user_id', session('user_id'))
            ->withCount('tasks')
            ->get();
        return view('statuses.index', compact('statuses'));
    }

    public function create(){ 
        return view('statuses.create'); 
    }

    public function store(Request $r){
        $r->validate([
            'nama' => 'required|string|max:100',
            'tipe' => 'required|string|max:50',
            'color' => 'required|string|max:20',
        ]);
        
        Status::create([
            'nama' => $r->nama,
            'tipe' => $r->tipe,
            'color' => $r->color,
            'user_id' => session('user_id')
        ]);
        
        return redirect()->route('statuses.index')->with('success','Status ditambahkan.');
    }

    public function edit($id){
        $status = Status::findOrFail($id);
        $this->authorizeOwner($status);
        return view('statuses.edit', compact('status'));
    }

    public function update(Request $r, $id){
        $status = Status::findOrFail($id);
        $this->authorizeOwner($status);
        
        $r->validate([
            'nama' => 'required|string|max:100',
            'tipe' => 'required|string|max:50',
            'color' => 'required|string|max:20',
        ]);
        
        $status->update([
            'nama' => $r->nama,
            'tipe' => $r->tipe,
            'color' => $r->color,
        ]);
        
        return redirect()->route('statuses.index')->with('success','Status diperbarui.');
    }

    public function destroy($id){
        $status = Status::findOrFail($id);
        $this->authorizeOwner($status);
        $status->delete();
        return redirect()->route('statuses.index')->with('success','Status dihapus.');
    }
}