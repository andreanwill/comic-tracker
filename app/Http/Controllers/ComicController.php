<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Genre;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    public function index()
    {
        $comics = Comic::all();
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
            'title' => 'required',
            'description' => 'nullable',
            'cover_image' => 'nullable|image'
        ]);

        $data = $request->only('title', 'description');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $comic = Comic::create($data);
        $comic->genres()->sync($request->genres);

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
            'title' => 'required',
            'description' => 'nullable',
            'cover_image' => 'nullable|image'
        ]);

        $data = $request->only('title', 'description');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $comic->update($data);
        $comic->genres()->sync($request->genres);

        return redirect('/admin/comics')->with('success', 'Komik berhasil diupdate');
    }

    public function destroy(Comic $comic)
    {
        $comic->delete();
        return redirect('/admin/comics')->with('success', 'Komik berhasil dihapus');
    }
}

