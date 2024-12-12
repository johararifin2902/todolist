<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    // Kolom yang bisa diisi (Mass Assignment)
    protected $fillable = [
        'task_name',
        'duration',
        'deadline',
        'status',
        'priority',  // Kolom priority
    ];

    // Kolom yang tidak bisa diubah (optional)
    protected $guarded = ['id'];

    // Tentukan tipe kolom untuk memastikan format data yang benar
    protected $casts = [
        'deadline' => 'datetime',  // Pastikan deadline diperlakukan sebagai datetime
    ];

    // Method untuk mendapatkan durasi dalam format jam
    public function getDurationInHoursAttribute()
    {
        return $this->duration / 60;  // Mengubah durasi menit menjadi jam
    }

    // Menambahkan method untuk menghitung waktu yang tersisa hingga deadline
    public function timeRemaining()
    {
        return $this->deadline ? $this->deadline->diffInMinutes(now()) : null;
    }
}
