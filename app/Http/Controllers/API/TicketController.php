<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mutasi;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        try {
            $data = Ticket::with('files')->paginate('10');
            return response()->json([
                'success' => true,
                'data'    => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'desc' => 'required',
            'files' => 'nullable|array',
            'files.*' => 'file|max:2048'
        ]);

        try {
            DB::beginTransaction();

            $ticket = Ticket::createData(auth('api')->user()->id, Str::random(20), $request->subject, $request->desc);

            foreach ($request->file('files') as $file) {
                if (in_array($file->getClientOriginalExtension(), ['exe', 'sh'])) {
                    return response()->json(['message' => 'File type not allowed'], 422);
                } else {
                    $path = $file->store('uploads/tickets', 'public');
                    $ticket->files()->create(['file' => $path]);
                }
            }

            Mutasi::createMutasi(auth('api')->user()->id, $ticket->id);

            DB::commit();

            return response()->json([
                'success' => true,
                'data'    => [],
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json([
                'message'   => 'Gagal menyimpan data',
                'error'     => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        return response()->json([
            'message' => 'Tiket berhasil diperbarui',
            'data' => $ticket
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStart(Request $request, string $id)
    {

        DB::beginTransaction();

        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->updateWithMutasiStart($request->status, auth()->id());

            DB::commit();

            return response()->json([
                'message' => 'Tiket berhasil diperbarui',
                'data' => []
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui status tiket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        //
    }
}
