<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:andrean_genres,name']);
        Genre::create($request->only('name'));
        return redirect('/admin/genres')->with('success', 'Genre berhasil ditambahkan');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate(['name' => 'required']);
        $genre->update($request->only('name'));
        return redirect('/admin/genres')->with('success', 'Genre berhasil diupdate');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect('/admin/genres')->with('success', 'Genre berhasil dihapus');
    }
}

