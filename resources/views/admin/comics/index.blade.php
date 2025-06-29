<h2>Daftar Komik</h2>
<a href="/admin/comics/create">Tambah Komik</a>
<table border="1">
    <tr>
        <th>Judul</th>
        <th>Genre</th>
        <th>Aksi</th>
    </tr>
    @foreach($comics as $comic)
    <tr>
        <td>{{ $comic->title }}</td>
        <td>
            @foreach ($comic->genres as $genre)
                {{ $genre->name }},
            @endforeach
        </td>
        <td>
            <a href="/admin/comics/{{ $comic->id }}/edit">Edit</a>
            <form method="POST" action="/admin/comics/{{ $comic->id }}" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
