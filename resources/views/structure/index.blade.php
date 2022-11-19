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
                                    <button type="button" class="btn-mdl btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#edit_data" onclick="btn_edit({{ $item->id }})">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button> <a href="" class="btn btn-danger">Delete</a>
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

<x-modal title="Update" modal="edit_data" method="POST" action="{{ route('structure.update', $item->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <input class="form-control" type="file" name="foto" id="foto">
    </div>
    <x-input-float tipe="text" attr="nama" placeholder="Nama" text="Nama"></x-input-float>
    <x-input-float tipe="text" attr="jabatan" placeholder="Jabatan" text="Jabatan"></x-input-float>
    <x-input-float tipe="number" attr="no_hp" placeholder="Nomor Handphone" text="Nomor Handphone"></x-input-float>
    <x-textarea attr="alamat" height="100px" placeholder="Alamat Anggota" text="Alamat Anggota"></x-textarea>
</x-modal>

@push('jquery')
    <script>
        $(document).ready(function() {
            $('.btn-mdl').on('click', function() {
                $('input:not([name="_token"])').val('')
                $('.alamat').val('')
            })

            $(document).on('click', '.btn_delete', function() {
                var id = $(this).attr('data-id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    title: 'Do you want to save the changes?',
                    icon: 'warning',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    confirmButtonColor: '#d23030',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('keuangan.index') }}" + '/' + id,
                            success: function(response) {
                                table.draw();
                            }
                        });
                    }
                })


            });

        }); // end of ready function

        function btn_edit(id) {
            $.ajax({
                type: "get",
                url: '/structure' + '/' + id + '/edit',
                success: function(response) {
                    $(".nama").val(response.nama);
                    $(".jabatan").val(response.jabatan);
                    $(".no_hp").val(response.no_hp);
                    $(".alamat").val(response.alamat);
                    $('#edit_data form').attr('action', "{{ route('structure.index') }}" + '/' + id);
                }
            });
        }
    </script>
@endpush
