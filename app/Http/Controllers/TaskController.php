<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Crypt;

class TaskController extends Controller
{
    /**
     * Pastikan task milik user yang sedang login
     */
    private function authorizeOwner(Task $task)
    {
        if ($task->user_id !== session('user_id')) {
            abort(403, 'Akses ditolak.');
        }
    }

    /**
     * Tampilkan daftar tugas
     */
    public function index()
    {
        $tasks = Task::where('user_id', session('user_id'))
                     ->with('category')
                     ->orderBy('deadline')
                     ->get();

        // Decrypt description
        foreach ($tasks as $task) {
            try {
                $task->description = $task->description ? Crypt::decryptString($task->description) : '';
            } catch (\Exception $e) {
                $task->description = '(tidak dapat didekripsi)';
            }
        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Tampilkan form tambah tugas
     */
    public function create()
    {
        $categories = Category::where('user_id', session('user_id'))->get();
        return view('tasks.create', compact('categories'));
    }

    /**
     * Simpan tugas baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'deadline'    => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        Task::create([
            'title'       => $request->title,
            'description' => Crypt::encryptString($request->description ?? ''),
            'deadline'    => $request->deadline,
            'category_id' => $request->category_id,
            'user_id'     => session('user_id'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugas ditambahkan.');
    }

    /**
     * Tampilkan form edit tugas
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $this->authorizeOwner($task);

        try {
            $task->description = $task->description ? Crypt::decryptString($task->description) : '';
        } catch (\Exception $e) {
            $task->description = '';
        }

        $categories = Category::where('user_id', session('user_id'))->get();
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update tugas
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $this->authorizeOwner($task);

        $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'deadline'    => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $task->update([
            'title'       => $request->title,
            'description' => Crypt::encryptString($request->description ?? ''),
            'deadline'    => $request->deadline,
            'category_id' => $request->category_id,
            'status'      => $request->has('status'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugas diperbarui.');
    }

    /**
     * Hapus tugas
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $this->authorizeOwner($task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tugas dihapus.');
    }
}
