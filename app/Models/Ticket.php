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

    public static function createData($user_id, $ticket_code, $subject, $desc, $status = 'draft')
    {
        return self::create([
            'user_id'       => $user_id,
            'ticket_code'   => $ticket_code,
            'subject'       => $subject,
            'status'        => $status,
            'desc'          => $desc,
            'created_at'    => now(),
        ]);
    }

    public function updateWithMutasiStart($status, $user_id)
    {
        $old = $this->only(['subject', 'desc', 'status']); // ← ambil dari Ticket sebelum update

        $this->update([
            'status' => $status
        ]);

        $new = $this->only(['subject', 'desc', 'status']);

        if (($attributes['status'] ?? null) === 'start') {
            Mutasi::create([
                'user_id'    => $user_id,
                'ticket_id'  => $this->id,
                'status'     => $this->status,
                'indeks'     => Mutasi::where('ticket_id', $this->id)->first()->indeks,
                'note'       => 'Otomatis saat status ' . $status,
                'old_data'   => $old, // ← dari ticket
                'new_data'   => $new,
            ]);
        }

        return $this;
    }
}
