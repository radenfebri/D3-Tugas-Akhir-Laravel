@extends('layouts.layouts', ['menu' => 'interface', 'submenu' => ''])

@section('title', 'Ckeck Traffic Interface')

@section('content')


<div class="main-panel mt-5">
    <div class="mt-5"></div>

    <div class="container">
        <main role="main" class="container">
            <div class="container">
                <button type="button" class="btn btn-primary btn-sm mt-2">
                    <span class="spinner-grow spinner-grow-sm"></span>
                    Data Realtime
                </button>
            </div>
            <div class="col-md-12 mt-2">
                <div class="card mt-2">
                    <div id="graph"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Interace</th>
                            <th>UPLOAD (TX)</th>
                            <th>DOWNLOAD (RX)</th>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-control form-control" name="interface" id="interface">
                                    <?php foreach ($interface as $data) { ?>
                                        <option value="<?= $data['name'] ?>"><?= $data['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    {{-- <input name="interface" id="interface" type="text" value="ether1-INTERNET" disabled> --}}
                                </td>

                                <td>
                                    <div id="tabletx"></div>
                                </td>
                                <td>
                                    <div id="tablerx"></div>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>

<script type="text/javascript" src="{{ asset('template') }}/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="{{ asset('/') }}highchart/js/highcharts.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
<script>
    $('#select').on('change', function(e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        console.clear();
        $("#interface").val(valueSelected);
    });
    var chart;

    function requestDatta(interface) {
        var interface = $('#interface').val()
        var newStr = interface.replace(/%20/g, " ");
        $.ajax({
            url: '{{ url('interface/traffic/') }}' + newStr,
            datatype: "json",
            success: function(data) {
                var midata = JSON.parse(data);
                // console.log(midata);
                if (midata.length > 0) {
                    var TX = parseInt(midata[0].data);
                    var RX = parseInt(midata[1].data);
                    var x = (new Date()).getTime();
                    shift = chart.series[0].data.length > 19;
                    chart.series[0].addPoint([x, TX], true, shift);
                    chart.series[1].addPoint([x, RX], true, shift);
                    document.getElementById("tabletx").innerHTML = convert(TX);
                    document.getElementById("tablerx").innerHTML = convert(RX);
                } else {
                    document.getElementById("tabletx").innerHTML = "0";
                    document.getElementById("tablerx").innerHTML = "0";
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.error("Status: " + textStatus + " request: " + XMLHttpRequest);
                console.error("Error: " + errorThrown);
            }
        });
    }

    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'graph',
                animation: Highcharts.svg,
                type: 'spline',
                events: {
                    load: function() {
                        setInterval(function() {
                            requestDatta(document.getElementById("interface").value);
                        }, 1000);
                    }
                }
            },
            title: {
                text: 'Monitoring'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20 * 1000
            },

            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: 'Traffic'
                },
                labels: {
                    formatter: function() {
                        var bytes = this.value;
                        var sizes = ['bps', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
                        if (bytes == 0) return '0 bps';
                        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                        return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
                    },
                },
            },
            series: [{
                name: 'TX',
                data: []
            }, {
                name: 'RX',
                data: []
            }],
            tooltip: {
                headerFormat: '<b>{series.name}</b><br/>',
                pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y}'
            },


        });
    });

    function convert(bytes) {
        var sizes = ['bps', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
        if (bytes == 0) return '0 bps';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
    }
</script>


@endsection

