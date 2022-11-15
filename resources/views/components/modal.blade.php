<div class="modal fade" id="{{ $modal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ $action }}" method="{{ $method }}">
                @csrf
                <div class="modal-body">
                    <x-input tipe="date" attr="tanggal"></x-input>
                    <x-input-float tipe="text" attr="nominal" text="Nominal" placeholder="example@gmail.com">
                    </x-input-float>
                    <x-textarea attr="deskripsi" text="Deskripsi Kegiatan" height="height: 100px"></x-textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div>
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
</div>
