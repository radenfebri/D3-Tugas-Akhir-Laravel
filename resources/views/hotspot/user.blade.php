@extends('layouts.layouts', ['menu' => 'hotspot', 'submenu' => 'user'])

@section('title', 'Hotspot Users')

@section('content')


<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">@yield('title')</h2>
                        <h5 class="text-white op-7 mb-2">Total Hotspot Users <?= $totalhotspotuser ?></h5>
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
                            <!-- <h4 class="card-title">Add Row</h4> -->
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Add User
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                                New</span>
                                                <span class="fw-light">
                                                    User Hotspot
                                                </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- <p class="small">Create a new row using this form, make sure you fill them all</p> -->
                                            <form action="{{ route('hotspot.add') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>User</label>
                                                            <input name="user" type="text" class="form-control" placeholder="User" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Password</label>
                                                            <input name="password" type="text" class="form-control" placeholder="Password" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Server</label>
                                                            <select name="server" class="form-control" placeholder="Password" required>
                                                                <option disabled selected>Pilih</option>
                                                                @foreach ($server as $data)
                                                                <option>{{ $data['name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Profile</label>
                                                            <select name="profile" class="form-control" placeholder="Profile" required>
                                                                <option disabled selected>Pilih</option>
                                                                @foreach ($profile as $data)
                                                                <option>{{ $data['name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Time Limit</label>
                                                            <input name="timelimit" type="text" class="form-control" placeholder="Time Limit">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Comment</label>
                                                            <input name="comment" type="text" class="form-control" placeholder="Comment">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer no-bd">
                                                <button type="submit" class="btn btn-primary">Add</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Profile</th>
                                                <th>Uptime</th>
                                                <th>Bytes In</th>
                                                <th>Bytes Out</th>
                                                <th>Status</th>
                                                <th>Comment</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Profile</th>
                                                <th>Uptime</th>
                                                <th>Bytes In</th>
                                                <th>Bytes Out</th>
                                                <th>Status</th>
                                                <th>Comment</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($hotspotuser as $no => $data)
                                            <tr>
                                                <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                                <td>{{ $no + 1 }}</td>
                                                <td>{{ $data['name'] }}</td>
                                                <td>{{ $data['password'] }}</td>
                                                <td>{{ $data['profile'] }}</td>
                                                <td>{{ $data['uptime'] }}</td>
                                                <td>{{ formatBytes($data['bytes-in'],) }}</td>
                                                <td>{{ formatBytes($data['bytes-out'],) }}</td>
                                                <td>
                                                    @if ($data['disabled'] == "true" )
                                                    Disable
                                                    @else
                                                    Enable
                                                    @endif

                                                </td>
                                                <td>{{ $data['comment'] }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('hotspot.edit', $id) }}" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="" type="button" data-toggle="tooltip" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Apakah anda yakin menghapus user {{ $data['name'] }} ?')">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
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
