<style>
    tr {
        text-align: center;
        vertical-align: middle;
    }
</style>

<div class="row">
    <div class="col-sm-12">
        <h4>
            Saldo Akhir : {{ $saldo }}
        </h4>
    </div>
</div>
<table width="100%">
    <thead>
        <tr>
            <th>Tipe</th>
            <th>Nominal</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->tipe }}</td>
                <td>{{ $item->nominal }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>{{ $item->tanggal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
