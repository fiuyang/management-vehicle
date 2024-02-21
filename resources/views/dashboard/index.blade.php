@extends('layouts.main')

@section('title','Dashboard')

@section('content')

<div class="row" id="sortable">
    </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                 
                </div>
                <div class="card-body">
                    <div id="chart" height="150px"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(function() {
        $.ajax({
            url: '',
            success: function(response) {
                var total = [];
                var name = [];
                $.each (response, function(i, row) {
                    total.push(row.total)
                    name.push(row.name)
                })
                var options = {
                    series: [{
                    name: 'Frekuensi',
                    type: 'column',
                    data: total
                    }],
                    chart: {
                    height: 350,
                    type: 'line',
                    },
                    stroke: {
                    width: [0, 4]
                    },
                    title: {
                    text: 'Vehicle Usage'
                    },
                    dataLabels: {
                    enabled: true,
                    enabledOnSeries: [1]
                    },
                    labels: name,
                    yaxis: [{
                    title: {
                        text: 'Frekuensi',
                    },
                    }]
                };
    
                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();  
            }
        })
    })
</script>
@endsection