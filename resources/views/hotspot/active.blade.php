@extends('layouts.layouts', ['menu' => 'hotspot', 'submenu' => 'u-active'])

@section('title', 'Hotspot Users Active')

@section('content')



<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">@yield('title')</h2>
                        <h5 class="text-white op-7 mb-2">Total Hotspot Users Active: {{ $totalsecretactive }}</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Server</th>
                                        <th>Login By</th>
                                        <th>Uptime</th>
                                        <th>Bytes In</th>
                                        <th>Bytes Out</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Server</th>
                                        <th>Login By</th>
                                        <th>Uptime</th>
                                        <th>Bytes In</th>
                                        <th>Bytes Out</th>
                                        <th>Comment</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($hotspotactive as $no => $data)
                                    <tr>
                                        <div class="hidden">{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                        <td>{{ $no+1 }}</td>
                                        <td>{{ $data['name'] }}</td>
                                        <td>{{ $data['server'] }}</td>
                                        <td>{{ $data['login-by'] }}</td>
                                        <td>{{ $data['uptime'] }}</td>
                                        <td>{{ formatBytes($data['bytes-in']) }}</td>
                                        <td>{{ formatBytes($data['bytes-out']) }}</td>
                                        <td>{{ $data['comment'] }}</td>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>




<?php function formatBytes($bytes, $decimal = null){
    $satuan = ['Bytes', 'Kb', 'Mb', 'Gb', 'Tb'];
    $i = 0;
    while ($bytes > 1024) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, $decimal) .'-' . $satuan[$i];
}
?>

@endsection
