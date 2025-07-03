<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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

    public function updateStatusWithMutasi($status, $note, $user_id)
    {
        // 🔍 Debug 1: Before update
        $old = $this->only(['subject', 'desc', 'status']);
        Log::info('OLD DATA:', $old);

        $this->update([
            'status' => $status
        ]);

        // 🔍 Debug 2: After update
        $new = $this->only(['subject', 'desc', 'status']);
        Log::info('NEW DATA:', $new);

        // 🔍 Debug 3: Cek kondisi
        if (in_array($status, ['start', 'hold', 'closed'])) {
            Log::info('Condition matched: status = ' . $status);

            Mutasi::create([
                'user_id'    => $user_id,
                'ticket_id'  => $this->id,
                'status'     => $this->status,
                'indeks'     => Mutasi::where('ticket_id', $this->id)->first()->indeks ?? 0,
                'ket'        => $note,
                'old_data'   => $old,
                'new_data'   => $new,
            ]);

            Log::info('Mutasi created successfully');
        } else {
            Log::warning('Condition not matched, no mutasi created');
        }

        return $this;
    }



    public function updateReviewWithMutasi($subject, $desc,  $status, $note, $user_id)
    {
        $old = $this->only(['subject', 'desc', 'status']); // ← ambil dari Ticket sebelum update

        $this->update([
            'subject' => $subject,
            'desc' => $desc,
            'status' => $status,
        ]);


        $new = $this->only(['subject', 'desc', 'status']);

        if ($status === 'review') {
            Mutasi::create([
                'user_id'    => $user_id,
                'ticket_id'  => $this->id,
                'status'     => $this->status,
                'indeks'     => Mutasi::where('ticket_id', $this->id)->first()->indeks,
                'ket'       => $note,
                'old_data'   => $old, // ← dari ticket
                'new_data'   => $new,
            ]);
        }

        return $this;
    }
}
