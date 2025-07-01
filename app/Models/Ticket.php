<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'ticket_code', 'subject', 'status', 'desc'];
    const DRAFT     = 'draft';
    const START     = 'start';
    const HOLD      = 'hold';
    const REVIEW    = 'review';
    const CLOSED    = 'closed';


    public function files()
    {
        return $this->hasMany(TicketFile::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getLast()
    {
        return self::latest()->first();
    }
}
