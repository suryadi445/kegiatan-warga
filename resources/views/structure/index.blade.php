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
                        <button type="button" class="btn-mdl btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modaltambah">
                            <i class="bi bi-plus"></i>
                            Tambah Anggota
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">No. Handphone</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($structure as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item->foto }}" alt="image" width="35px">
                                </td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <a href="" class="btn btn-warning">Edit</a>
                                    <a href="" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<x-modal title="Tambah Anggota" modal="modaltambah" method="POST" action="{{ route('structure.store') }}">
    <div class="mb-3">
        <input class="form-control" type="file" name="foto" id="foto">
    </div>
    <x-input-float tipe="text" attr="nama" placeholder="Nama" text="Nama"></x-input-float>
    <x-input-float tipe="text" attr="jabatan" placeholder="Jabatan" text="Jabatan"></x-input-float>
    <x-input-float tipe="number" attr="no_hp" placeholder="Nomor Handphone" text="Nomor Handphone"></x-input-float>
    <x-textarea attr="alamat" height="100px" placeholder="Alamat Anggota" text="Alamat Anggota"></x-textarea>
</x-modal>
