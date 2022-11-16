@extends('template.admin')

@section('container-admin')
    <x-toast></x-toast>

    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-center">Kegiatan Warga</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row align-items-center">
                <div class="col-sm-9">
                </div>
                <div class="col-sm-3">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary ml-2 mr-2" data-bs-toggle="modal"
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
            <div class="table-responsive">
                <table class="table table-bordered yajra-datatable" width=100%>
                    <thead class="bg-dark text-light">
                        <tr>
                            <th>Jenis Kegiatan</th>
                            <th>Tuan Rumah</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Jumlah Peserta</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-modal title="Tambah Kegiatan" modal="modaltambah" method="POST" action="{{ route('activity.store') }}">
        <x-input tipe="date" attr="tgl" placeholder="Tanggal" text="Tanggal"></x-input>
        <br>
        <x-input tipe="time" attr="time" placeholder="Jam" text="Jam"></x-input>
        <x-input-float tipe="text" attr="tuan_rumah" placeholder="Tuan Rumah" text="Tuan Rumah"></x-input-float>
        <x-input-float tipe="text" attr="judul" placeholder="Judul Kegiatan" text="Judul Kegiatan"></x-input-float>
        <x-input-float tipe="text" attr="lokasi" placeholder="Lokasi Kegiatan" text="Lokasi Kegiatan"></x-input-float>
        <x-textarea attr="deskripsi" height="100px" placeholder="Deskripsi Kegiatan" text="Deskripsi Kegiatan"></x-textarea>
    </x-modal>
@endsection

@push('jquery')
    <script>
        $(document).ready(function() {


            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('activity.index') }}",
                columns: [{
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'tuan_rumah',
                        name: 'tuan_rumah'
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'tgl',
                        name: 'tgl'
                    },
                    {
                        data: 'time',
                        name: 'time'
                    },
                    {
                        data: 'peserta',
                        name: 'peserta'
                    },
                    {
                        data: 'peserta',
                        name: 'peserta'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

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
            let myModal = new bootstrap.Modal(document.getElementById('edit_data'))
            let form_edit = document.getElementById('form_edit')
            $.ajax({
                type: "get",
                url: `/keuangan` + '/' + id + '/edit',
                success: function(response) {
                    document.getElementById('nominal_edit').value = response.nominal
                    document.getElementById('deskripsi_edit').value = response.deskripsi
                    document.getElementById('tanggal_edit').value = response.tanggal

                    form_edit.setAttribute("action", "{{ route('keuangan.index') }}" + '/' + id)
                    myModal.show()
                }
            });
        }
    </script>
@endpush
