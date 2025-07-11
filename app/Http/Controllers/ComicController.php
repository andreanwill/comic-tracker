<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ComicController extends Controller
{
    public function index()
    {
        $comics = Comic::with('genres')->get();
        return view('admin.comics.index', compact('comics'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.comics.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:andrean_genres,id'
        ], [
            'title.required' => 'Judul komik wajib diisi',
            'title.max' => 'Judul komik maksimal 255 karakter',
            'cover_image.image' => 'File harus berupa gambar',
            'cover_image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'cover_image.max' => 'Ukuran gambar maksimal 2MB',
            'genres.*.exists' => 'Genre yang dipilih tidak valid'
        ]);

        $data = $request->only('title', 'description');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
            // Debug: Log the stored path
            Log::info('Cover image stored at: ' . $data['cover_image']);
        }

        $comic = Comic::create($data);
        
        if ($request->has('genres')) {
            $comic->genres()->sync($request->genres);
        }

        return redirect('/admin/comics')->with('success', 'Komik berhasil ditambahkan');
    }

    public function edit(Comic $comic)
    {
        $genres = Genre::all();
        return view('admin.comics.edit', compact('comic', 'genres'));
    }

    public function update(Request $request, Comic $comic)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:andrean_genres,id'
        ], [
            'title.required' => 'Judul komik wajib diisi',
            'title.max' => 'Judul komik maksimal 255 karakter',
            'cover_image.image' => 'File harus berupa gambar',
            'cover_image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'cover_image.max' => 'Ukuran gambar maksimal 2MB',
            'genres.*.exists' => 'Genre yang dipilih tidak valid'
        ]);

        $data = $request->only('title', 'description');

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($comic->cover_image) {
                Storage::disk('public')->delete($comic->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
            // Debug: Log the stored path
            Log::info('Cover image updated at: ' . $data['cover_image']);
        }

        $comic->update($data);
        
        if ($request->has('genres')) {
            $comic->genres()->sync($request->genres);
        } else {
            $comic->genres()->detach();
        }

        return redirect('/admin/comics')->with('success', 'Komik berhasil diupdate');
    }

    public function destroy(Comic $comic)
    {
        // Delete cover image if exists
        if ($comic->cover_image) {
            Storage::disk('public')->delete($comic->cover_image);
        }
        
        $comic->delete();
        return redirect('/admin/comics')->with('success', 'Komik berhasil dihapus');
    }

    public function show(Comic $comic)
    {
        $comic->load('genres');
        return view('comics.show', compact('comic'));
    }

    public function publicIndex()
    {
        $comics = Comic::with('genres')->get();
        return view('comics.index', compact('comics'));
    }
}

