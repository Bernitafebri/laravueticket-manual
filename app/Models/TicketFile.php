<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketFile extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id', 'file'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Akses URL
    protected $appends = ['file_url'];

    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file);
    }
}
