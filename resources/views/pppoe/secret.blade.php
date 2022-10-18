@extends('layouts.layouts', ['menu' => 'pppoe', 'submenu' => 'secret'])

@section('title', 'PPPoE Secret')

@section('content')



<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">@yield('title')</h2>
                        <h5 class="text-white op-7 mb-2">Total Secret PPPoE : {{ $totalsecret }}</h5>
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
                                Add Secret
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal Add-->
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                                New</span>
                                                <span class="fw-light">
                                                    Secret PPPoE
                                                </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- <p class="small">Create a new row using this form, make sure you fill them all</p> -->
                                            <form action="{{ route('pppoe.add') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Username</label>
                                                            <input name="user" type="text" id="user" class="form-control" placeholder="Username" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Password</label>
                                                            <input name="password" type="text" id="password" class="form-control" placeholder="Password" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Service</label>
                                                            <select name="service" id="service" class="form-control">
                                                                <option value="" selected disabled>Pilih</option>
                                                                <option value="any">ANY</option>
                                                                <option value="async">ASYNC</option>
                                                                <option value="pppoe">PPPoE</option>
                                                                <option value="pptp">PPTP</option>
                                                                <option value="sstp">SSTP</option>
                                                                <option value="l2tp">L2TP</option>
                                                                <option value="ovpn">OVPN</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Profile</label>
                                                            <select name="profile" id="profile" class="form-control" placeholder="Profile">
                                                                <option disabled selected value="">Pilih</option>
                                                                    @foreach ($profile as $data)
                                                                        <option>{{ $data['name'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Local Address</label>
                                                                <input name="localaddress" id="localaddress" type="text" class="form-control" placeholder="Local Address">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Remote Address</label>
                                                                <input name="remoteaddress" id="remoteaddress" class="form-control" placeholder="Remote Address">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div calass="form-group form-group-default">
                                                                <label>Comment</label>
                                                                <input name="comment" id="comment" type="text" class="form-control" placeholder="Comment">
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
                            </div>



                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Password</th>
                                            <th>Service</th>
                                            <th>Local-Address</th>
                                            <th>Remote-Address</th>
                                            <th>Status</th>
                                            <th>Comment</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Password</th>
                                            <th>Service</th>
                                            <th>Local-Address</th>
                                            <th>Remote-Address</th>
                                            <th>Status</th>
                                            <th>Comment</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($secret as $no => $data)
                                        <tr>
                                            <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                            <td>{{ $no+1 }} </td>
                                            <td>{{ $data['name'] ?? '' }} </td>
                                            <td>{{ $data['password'] ?? '' }} </td>
                                            <td>{{ $data['service'] ?? '' }} </td>
                                            <td>{{ $data['local-address'] ?? '' }} </td>
                                            <td>{{ $data['remote-address'] ?? '' }} </td>
                                            <td>
                                                @if ($data['disabled'] == "true")
                                                Disable
                                                @else
                                                Enable
                                                @endif
                                            </td>
                                            <td>{{ $data['comment'] ?? '' }} </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('pppoe.edit', $id ) }}" class="btn btn-link btn-primary btn-lg" data-toggle="tooltip" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a href="{{ route('pppoe.delete', $id ) }}" type="button" data-toggle="tooltip" class="btn btn-link btn-danger" data-original-title="Remove"
                                                    onclick="return confirm('Apakah anda yakin menghapus secret {{ $data['name'] }} ?')">
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


@endsection
