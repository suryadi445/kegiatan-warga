@extends('template.admin')

@section('container-admin')
    <x-toast></x-toast>

    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-center">Laporan Keuangan</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-2">
                    <form action="{{ route('file-export') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <a class="btn btn-success d-block" href="{{ route('file-export') }}">Export Excel</a>
                    </form>
                </div>
                <div class="col-sm-2">
                    <form action="{{ route('export-pdf') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <a class="btn btn-info d-block" href="{{ route('export-pdf') }}">Export PDF</a>
                    </form>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-sm-9">
                    <h6 class="">Saldo Akhir : </h6>
                    <h4 class="text-info">Rp. {{ number_format($saldo, 0, ',', '.') }}</h4>
                </div>
                <div class="col-sm-3">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary ml-2 mr-2 btn-mdl" data-bs-toggle="modal"
                            data-bs-target="#modaltambah">
                            <i class="bi bi-plus"></i>
                            Tambah Saldo
                        </button>
                        <button type="button" class="btn btn-warning ml-2 mr-2 btn-mdl" data-bs-toggle="modal"
                            data-bs-target="#modalkurang">
                            <i class="bi bi-dash"></i>
                            Kurangi Saldo
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
@endsection


<x-modal title="Tambah Saldo" modal="modaltambah" method="POST" action="{{ route('keuangan.store') }}">
    <x-input tipe="date" attr="tanggal"></x-input>
    <x-input-float tipe="text" attr="nominal" text="Nominal" placeholder="example@gmail.com">
    </x-input-float>
    <x-textarea attr="deskripsi" text="Deskripsi Kegiatan" height="height: 100px"></x-textarea>
</x-modal>

<x-modal title="Kurangi Saldo" modal="modalkurang" method="POST" action="{{ route('keuangan.store') }}">
    <input type="hidden" name="saldo" value="out">
    <x-input tipe="date" attr="tanggal"></x-input>
    <x-input-float tipe="text" attr="nominal" text="Nominal" placeholder="example@gmail.com">
    </x-input-float>
    <x-textarea attr="deskripsi" text="Deskripsi Kegiatan" height="height: 100px"></x-textarea>
</x-modal>

<x-modal title="Update" modal="edit_data" method="POST" action="">
    @csrf
    @method('PUT')
    <x-input tipe="date" attr="tanggal"></x-input>
    <x-input-float tipe="text" attr="nominal" text="Nominal" placeholder="example@gmail.com">
    </x-input-float>
    <x-textarea attr="deskripsi" text="Deskripsi Kegiatan" height="height: 100px"></x-textarea>
</x-modal>

@push('jquery')
    <script>
        $(document).ready(function() {

            $('.btn-mdl').on('click', function() {
                $(".nominal").val('');
                $(".deskripsi").val('');
                $(".tanggal").val('');
            })

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
            // let form_edit = document.getElementById('form_edit')
            $.ajax({
                type: "get",
                url: '/keuangan' + '/' + id + '/edit',
                success: function(response) {
                    myModal.show()
                    $(".nominal").val(response.nominal);
                    $(".deskripsi").val(response.deskripsi);
                    $(".tanggal").val(response.tanggal);
                    $('#edit_data form').attr('action', "{{ route('keuangan.index') }}" + '/' + id);

                    // form_edit.setAttribute("action", "{{ route('keuangan.index') }}" + '/' + id)
                }
            });
        }
    </script>
@endpush
