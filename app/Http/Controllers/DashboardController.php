<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = session('user_id');
        
        // Total tasks
        $totalTugas = Task::where('user_id', $userId)->count();
        
        // Get status IDs
        $statusSelesai = Status::where('user_id', $userId)
            ->where('tipe', 'Selesai')
            ->first();
        
        $statusSedang = Status::where('user_id', $userId)
            ->where('tipe', 'Sedang Dikerjakan')
            ->first();
        
        // Tugas selesai
        $tugasSelesai = 0;
        if ($statusSelesai) {
            $tugasSelesai = Task::where('user_id', $userId)
                ->where('status_id', $statusSelesai->id)
                ->count();
        }
        
        // Sedang dikerjakan
        $sedangDikerjakan = 0;
        if ($statusSedang) {
            $sedangDikerjakan = Task::where('user_id', $userId)
                ->where('status_id', $statusSedang->id)
                ->count();
        }
        
        // Melebihi waktu (overdue) - tasks yang deadline sudah lewat dan belum selesai
        $melebihiWaktu = Task::where('user_id', $userId)
            ->where('deadline', '<', Carbon::today())
            ->when($statusSelesai, function($query) use ($statusSelesai) {
                return $query->where('status_id', '!=', $statusSelesai->id);
            })
            ->count();
        
        // Recent tasks (5 terbaru)
        $recentTasks = Task::where('user_id', $userId)
            ->with(['category', 'priority', 'status'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Decrypt description untuk setiap task
        foreach ($recentTasks as $task) {
            try {
                $task->description = $task->description ? Crypt::decryptString($task->description) : '';
            } catch (\Exception $e) {
                $task->description = '(tidak dapat didekripsi)';
            }
        }

        return view('dashboard', compact(
            'totalTugas',
            'tugasSelesai', 
            'sedangDikerjakan',
            'melebihiWaktu',
            'recentTasks'
        ));
    }
}