<?php
// app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use App\Models\Priority;
use App\Models\Status;
use Illuminate\Support\Facades\Crypt;

class TaskController extends Controller
{
    private function authorizeOwner(Task $task)
    {
        if ($task->user_id !== session('user_id')) {
            abort(403, 'Akses ditolak.');
        }
    }

    public function index(Request $request)
    {
        $query = Task::where('user_id', session('user_id'))
            ->with(['category', 'priority', 'status']);

        // Filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id);
        }

        if ($request->filled('priority_id')) {
            $query->where('priority_id', $request->priority_id);
        }

        // Sort
        if ($request->filled('sort')) {
            $sort = $request->sort;
            if ($sort == 'deadline') {
                $query->orderBy('deadline');
            } elseif ($sort == 'title') {
                $query->orderBy('title');
            }
        } else {
            $query->orderBy('deadline'); // default
        }

        $tasks = $query->get();

        // Decrypt description
        foreach ($tasks as $task) {
            try {
                $task->description = $task->description ? Crypt::decryptString($task->description) : '';
            } catch (\Exception $e) {
                $task->description = '(tidak dapat didekripsi)';
            }
        }

        $categories = Category::where('user_id', session('user_id'))->get();
        $priorities = Priority::where('user_id', session('user_id'))->get();
        $statuses = Status::where('user_id', session('user_id'))->get();

        return view('tasks.index', compact('tasks', 'categories', 'priorities', 'statuses'));
    }

    public function create()
    {
        $categories = Category::where('user_id', session('user_id'))->get();
        $priorities = Priority::where('user_id', session('user_id'))->get();
        $statuses = Status::where('user_id', session('user_id'))->get();
        return view('tasks.create', compact('categories', 'priorities', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'deadline'    => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'priority_id' => 'nullable|exists:priorities,id',
            'status_id'   => 'nullable|exists:statuses,id',
        ]);

        Task::create([
            'title'       => $request->title,
            'description' => Crypt::encryptString($request->description ?? ''),
            'deadline'    => $request->deadline,
            'category_id' => $request->category_id,
            'priority_id' => $request->priority_id,
            'status_id'   => $request->status_id,
            'user_id'     => session('user_id'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugas ditambahkan.');
    }

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
        $priorities = Priority::where('user_id', session('user_id'))->get();
        $statuses = Status::where('user_id', session('user_id'))->get();
        return view('tasks.edit', compact('task', 'categories', 'priorities', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $this->authorizeOwner($task);

        $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'deadline'    => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'priority_id' => 'nullable|exists:priorities,id',
            'status_id'   => 'nullable|exists:statuses,id',
        ]);

        $task->update([
            'title'       => $request->title,
            'description' => Crypt::encryptString($request->description ?? ''),
            'deadline'    => $request->deadline,
            'category_id' => $request->category_id,
            'priority_id' => $request->priority_id,
            'status_id'   => $request->status_id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugas diperbarui.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $this->authorizeOwner($task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tugas dihapus.');
    }
}