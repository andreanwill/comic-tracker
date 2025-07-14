@extends('layouts.template')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Daftar Baca Saya</h2>
                <a href="{{ route('comics.index') }}" class="btn btn-outline-primary">Tambah Komik Baru</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($readStatuses->count() > 0)
                <div class="row">
                    @foreach($readStatuses as $readStatus)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($readStatus->comic->cover_image)
                                    @if(Str::startsWith($readStatus->comic->cover_image, ['http://', 'https://']))
                                        <img src="{{ $readStatus->comic->cover_image }}" class="card-img-top" alt="{{ $readStatus->comic->title }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('storage/' . $readStatus->comic->cover_image) }}" class="card-img-top" alt="{{ $readStatus->comic->title }}" style="height: 200px; object-fit: cover;">
                                    @endif
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <span class="text-secondary display-4">📚</span>
                                    </div>
                                @endif
                                
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $readStatus->comic->title }}</h5>
                                    
                                    <div class="mb-2">
                                        @foreach($readStatus->comic->genres as $genre)
                                            <span class="badge bg-secondary me-1">{{ $genre->name }}</span>
                                        @endforeach
                                    </div>

                                    <div class="mb-3">
                                        <label for="status-{{ $readStatus->id }}" class="form-label">Status:</label>
                                        <select class="form-select form-select-sm" id="status-{{ $readStatus->id }}" onchange="updateStatus({{ $readStatus->id }}, this.value)">
                                            <option value="Belum Dibaca" {{ $readStatus->status == 'Belum Dibaca' ? 'selected' : '' }}>Belum Dibaca</option>
                                            <option value="Sedang Dibaca" {{ $readStatus->status == 'Sedang Dibaca' ? 'selected' : '' }}>Sedang Dibaca</option>
                                            <option value="Selesai Dibaca" {{ $readStatus->status == 'Selesai Dibaca' ? 'selected' : '' }}>Selesai Dibaca</option>
                                        </select>
                                    </div>

                                    <div class="mt-auto">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('comics.show', $readStatus->comic->id) }}" class="btn btn-outline-primary btn-sm flex-fill">Lihat Detail</a>
                                            <form method="POST" action="{{ route('read-status.remove', $readStatus->id) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus dari daftar baca?')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <span class="display-1 text-muted">📚</span>
                    </div>
                    <h4 class="text-muted">Daftar baca masih kosong</h4>
                    <p class="text-muted">Mulai tambahkan komik ke daftar baca Anda!</p>
                    <a href="{{ route('comics.index') }}" class="btn btn-primary">Jelajahi Komik</a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function updateStatus(readStatusId, status) {
    fetch(`/baca/${readStatusId}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            const alert = document.createElement('div');
            alert.className = 'alert alert-success alert-dismissible fade show position-fixed';
            alert.style.top = '20px';
            alert.style.right = '20px';
            alert.style.zIndex = '9999';
            alert.innerHTML = `
                Status berhasil diperbarui!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            document.body.appendChild(alert);
            
            // Remove alert after 3 s   econds
            setTimeout(() => {
                alert.remove();
            }, 3000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>

@endsection 