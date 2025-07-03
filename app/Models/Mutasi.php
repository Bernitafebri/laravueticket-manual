<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ticket_id',
        'indeks',
        'status',
        'ket',
        'old_data',
        'new_data',
    ];
    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];
    const DRAFT     = 'draft';
    const START     = 'start';
    const HOLD      = 'hold';
    const REVIEW    = 'review';
    const CLOSED    = 'closed';

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public static function getLast()
    {
        return self::latest()->first();
    }

    public static function createMutasi($user_id, $ticket_id, $status = 'draft', $note = null)
    {
        if (!User::find($user_id) || !Ticket::find($ticket_id)) {
            throw new \Exception("User atau Ticket tidak ditemukan");
        }

        // Ambil mutasi terakhir untuk ticket
        $last = self::where('ticket_id', $ticket_id)->latest()->first();

        // Default values
        $indeks = 1;

        if ($last) {
            // Kalau mutasi terakhir status-nya review,
            // maka kita mulai dari status 'draft' dan indeks +1
            if ($last->status === self::REVIEW) {
                $status = self::DRAFT;
                $indeks = $last->indeks + 1;
            } else {
                // Masih dalam siklus indeks yang sama
                $indeks = $last->indeks;
            }
        }

        return self::create([
            'user_id'    => $user_id,
            'ticket_id'  => $ticket_id,
            'status'     => $status,
            'indeks'     => $indeks,
            'ket'        => $note,
            'created_at' => now(),
        ]);
    }
}
