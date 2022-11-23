@extends('template.admin')
<link rel="stylesheet" href="/css/chartjs.css">

@section('container-admin')
    <x-toast></x-toast>

    <div class="row">
        <div class="col-sm-12">

            <div id="container"></div>

        </div>
    </div>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        Highcharts.chart('container', {
            chart: {
                type: 'column',
                styledMode: true
            },

            title: {
                text: 'Data Keuangan Warga'
            },


            xAxis: {
                categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ]
            },

            yAxis: [{ // Primary axis
                className: 'highcharts-color-0',
                title: {
                    text: 'Kas Masuk'
                }
            }, { // Secondary axis
                className: 'highcharts-color-1',
                opposite: true,
                title: {
                    text: 'Kas Keluar'
                }
            }],

            plotOptions: {
                column: {
                    borderRadius: 5
                }
            },

            series: [{
                name: 'Pemasukan',
                data: [<?= $result_in ?>],
                tooltip: {
                    valueSuffix: " Rupiah"
                }
            }, {
                name: 'Pengeluaran',
                data: [<?= $result_out ?>],
                yAxis: 1
            }]

        });
    </script>
@endsection
