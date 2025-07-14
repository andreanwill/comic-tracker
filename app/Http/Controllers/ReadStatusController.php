<?php

namespace App\Http\Controllers;

use App\Models\ReadStatus;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReadStatusController extends Controller
{
    public function index()
    {
        $readStatuses = ReadStatus::with(['comic.genres'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('read-status.index', compact('readStatuses'));
    }

    public function addToReadList(Request $request, Comic $comic)
    {
        // Check if already exists
        $existingStatus = ReadStatus::where('user_id', Auth::id())
            ->where('comic_id', $comic->id)
            ->first();

        if (!$existingStatus) {
            ReadStatus::create([
                'user_id' => Auth::id(),
                'comic_id' => $comic->id,
                'status' => 'Belum Dibaca'
            ]);
        }

        return redirect()->back()->with('success', 'Komik berhasil ditambahkan ke daftar baca!');
    }

    public function updateStatus(Request $request, ReadStatus $readStatus)
    {
        $request->validate([
            'status' => 'required|in:Belum Dibaca,Sedang Dibaca,Selesai Dibaca'
        ]);

        $readStatus->update([
            'status' => $request->status
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui!']);
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    public function removeFromReadList(ReadStatus $readStatus)
    {
        $readStatus->delete();
        return redirect()->back()->with('success', 'Komik berhasil dihapus dari daftar baca!');
    }
} 