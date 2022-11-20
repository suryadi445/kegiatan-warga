@extends('template.admin')

@section('container-admin')
    <x-toast></x-toast>

    <div class="row">
        <div class="col-sm-12">
            <div class="row align-items-center">
                <div class="col-sm-9">
                </div>
                <div class="col-sm-3">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn-mdl btn btn-primary ml-2 mr-2" data-bs-toggle="modal"
                            data-bs-target="#modaltambah">
                            <i class="bi bi-plus"></i>
                            Tambah Kegiatan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<x-modal title="Tambah Foto Kegiatan" modal="modaltambah" method="POST" action="{{ route('gallery.store') }}">
    <input class="form-control" type="file" id="image" name="image[]" multiple required>
    <br>
    <select class="form-select" id="id_kegiatan_warga" name="id_kegiatan_warga" required>
        <option value="" disabled selected>Open this select menu</option>
        @foreach ($kegiatan_warga as $item)
            <option value="{{ $item->id }}">{{ $item->judul }}</option>
        @endforeach

    </select>
</x-modal>
