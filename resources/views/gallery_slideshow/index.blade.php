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
                            Tambah Gallery
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="row row-cols-1 row-cols-md-6 g-4" id="loop-image">
                @foreach ($gallery as $item)
                    <div class="col">
                        <div class="card">
                            <button type="button" data-id="{{ $item->id }}" class="btn-close btn_delete"></button>
                            <img src="{{ $item->image }}" class="img-fluid" alt="image">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @if (count($gallery) <= 0)
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-primary d-block" role="alert">
                    Gambar Tidak Tersedia
                </div>
            </div>
        </div>
    @endif
@endsection

<x-modal title="Tambah Foto Gallery" modal="modaltambah" method="POST" action="{{ route('gallery_slideshow.store') }}">
    <input class="form-control" type="file" id="image" name="image[]" multiple required>
</x-modal>


@push('jquery')
    <script>
        $(document).ready(function() {

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
                            url: "{{ route('gallery_slideshow.index') }}" + '/' + id,
                            success: function(response) {
                                window.location.reload()
                            }
                        });
                    }
                })


            });
        });
    </script>
@endpush
