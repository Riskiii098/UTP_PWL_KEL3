<?php
// app/Models/Task.php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status_id',      // UBAH dari 'status'
        'deadline',
        'category_id',
        'user_id',
        'priority_id',    // UBAH dari 'priority'
        'mood_id'
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function category() { return $this->belongsTo(Category::class); }
    public function priority() { return $this->belongsTo(Priority::class); }
    public function status() { return $this->belongsTo(Status::class); }
    public function user() { return $this->belongsTo(User::class); }
    
    public function mood()
{
    return $this->belongsTo(Mood::class);
}

}
