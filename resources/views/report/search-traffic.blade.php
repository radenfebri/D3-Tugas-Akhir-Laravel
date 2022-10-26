@extends('layouts.layouts', ['menu' => 'report', 'submenu' => 'search-traffic'])

@section('title', 'Search Traffic UP')

@section('content')


<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">@yield('title')</h2>
                        <h5 class="text-white op-7 mb-2">Total Secret PPPoE </h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <div>
                                <table>
                                    <tr>
                                        <form class="form-inline" action="{{ route('search.report') }}" method="GET">
                                            <div class="form-group">
                                                <td><label><b>Mulai Tanggal:</b></label></td>
                                                <td><input type="date" class="form-control datepicker" name="tgl_awal" id="tgl_awal" value="{{ date('Y-m-d') }}" required></td>
                                            </div>

                                            <div class="form-group">
                                                <td><label><b>Sampai Tanggal:</b></label></td>
                                                <td><input type="date" class="form-control datepiscker" name="tgl_akhir" id="tgl_akhir" value="{{ date('Y-m-d') }}" required></td>
                                            </div>

                                            <div class="form-group">
                                                <td><button type="submit" class="btn btn-primary">Search</button></td>
                                            </div>
                                            <div class="form-group">
                                                <td><a href="{{ route('search.report') }}" type="reset" value="reset" class="btn btn-danger">Reset</a></td>
                                            </div>
                                        </form>
                                    </tr>
                                </table>
                            </div>
                        </center>
                        <center class="mt-4">
                            {{ $view_tgl }}
                        </center>

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Message</th>
                                        <th>Date & Time</th>
                                        <th>Data Ke</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Message</th>
                                        <th>Date & Time</th>
                                        <th>Data Ke</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($data as $no => $row)
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td>{!! $row['text'] !!}</td>
                                        <td>{{ date("d F Y, h:i A", strtotime($row['time'])) }}</td>
                                        <td>{{ $row['id'] }}</td>
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



@endsection
