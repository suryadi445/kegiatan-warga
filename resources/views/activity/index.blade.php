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
                            <th>Rumah Peserta</th>
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

    <x-modal title="Tambah Saldo" modal="modaltambah" method="POST" action="{{ route('keuangan.store') }}"></x-modal>


    <div class="modal fade" id="edit_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Kurangi Saldo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="form_edit">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <input type="date" class="form-control" id="tanggal_edit" name="tanggal" required>

                        <div class="form-floating mt-3 mb-3">
                            <input type="number" class="form-control" name="nominal" id="nominal_edit"
                                placeholder="example@gmail.com" required>
                            <label for="nominal">Nominal</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="deskripsi" name="deskripsi" id="deskripsi_edit" style="height: 100px"
                                required></textarea>
                            <label for="deskripsi">Deskripsi Kegiatan</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('jquery')
    <script>
        $(document).ready(function() {


            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('keuangan.index') }}",
                columns: [{
                        data: 'tipe',
                        name: 'tipe'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
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
