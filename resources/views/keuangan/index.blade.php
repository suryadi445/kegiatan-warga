@extends('template.admin')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">



@section('container-admin')
    <x-toast></x-toast>

    <div class="row mt-2">
        <div class="col-sm-12">
            <h3 class="text-center">Laporan Keuangan</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary ml-2 mr-2" data-bs-toggle="modal" data-bs-target="#modaltambah">
                Tambah Saldo
            </button>
            <button type="button" class="btn btn-warning ml-2 mr-2" data-bs-toggle="modal" data-bs-target="#modalkurang">
                Kurangi Saldo
            </button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-12">
            <h4 class="text-info">Rp. {{ number_format($saldo, 0, ',', '.') }}</h4>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered yajra-datatable" width=100%>
                    <thead class="bg-dark text-light">
                        <tr>
                            <th>Tipe</th>
                            <th>Nominal</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Saldo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('keuangan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>

                        <div class="form-floating mt-3 mb-3">
                            <input type="number" class="form-control" name="nominal" id="nominal"
                                placeholder="example@gmail.com" required>
                            <label for="nominal">Nominal</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="deskripsi" name="deskripsi" id="deskripsi" style="height: 100px" required></textarea>
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

    <div class="modal fade" id="modalkurang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Kurangi Saldo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('keuangan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="saldo" value="out">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>

                        <div class="form-floating mt-3 mb-3">
                            <input type="number" class="form-control" name="nominal" id="nominal"
                                max="{{ $saldo }}" placeholder="example@gmail.com" required>
                            <label for="nominal">Nominal</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="deskripsi" name="deskripsi" id="deskripsi" style="height: 100px" required></textarea>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
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


{{-- datatable --}}
<script type="text/javascript">
    $(function() {

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

    });
</script>
