@extends('layouts.admin')
@section('title', 'Tambah Komik')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary">Tambah Komik Baru</h2>
        <a href="/admin/comics" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="/admin/comics" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Judul Komik <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="genres" class="form-label fw-semibold">Genre</label>
                            <select class="form-select @error('genres') is-invalid @enderror" 
                                    id="genres" name="genres[]" multiple>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" 
                                        {{ in_array($genre->id, old('genres', [])) ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Tekan Ctrl (Windows) atau Cmd (Mac) untuk memilih multiple genre</div>
                            @error('genres')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="cover_image" class="form-label fw-semibold">Cover Image</label>
                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                   id="cover_image" name="cover_image" accept="image/*">
                            <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB</div>
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div id="imagePreview" class="d-none">
                                        <img id="preview" src="" alt="Preview" class="img-fluid rounded mb-2" style="max-height: 200px; width: 100%; object-fit: cover;">
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">Hapus Gambar</button>
                                    </div>
                                    <div id="noImage" class="text-muted">
                                        <i class="bi bi-image fs-1"></i>
                                        <p class="mt-2">Preview cover akan muncul di sini</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Simpan Komik
                    </button>
                    <a href="/admin/comics" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('cover_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');
    const imagePreview = document.getElementById('imagePreview');
    const noImage = document.getElementById('noImage');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            imagePreview.classList.remove('d-none');
            noImage.classList.add('d-none');
        }
        reader.readAsDataURL(file);
    }
});

function removeImage() {
    document.getElementById('cover_image').value = '';
    document.getElementById('imagePreview').classList.add('d-none');
    document.getElementById('noImage').classList.remove('d-none');
}
</script>
@endsection 