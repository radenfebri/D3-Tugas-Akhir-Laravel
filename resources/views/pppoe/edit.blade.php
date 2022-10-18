@extends('layouts.layouts', ['menu' => 'pppoe', 'submenu' => 'secret'])

@section('title', 'Edit PPPoE Secret')

@section('content')


<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">@yield('title') > {{ $user['name'] }}</h2>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <p><a href="{{ route('pppoe.secret') }}" class="btn btn-success"><i class="fas fa-backward"></i></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <form action="{{ route('pppoe.update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user">Username</label>
                        <input type="hidden" value="{{ $user['.id'] }}" name="id">  
                        <input type="text" name="user" class="form-control" value="{{ $user['name'] ?? ''}}" id="user" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" class="form-control" value="{{ $user['password'] ?? '' }}" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="service">Service</label>
                        <select name="service" id="service" class="form-control" required>
                            <option selected>{{ $user['service'] }}</option>
                            <option value="any">ANY</option>
                            <option value="async">ASYNC</option>
                            <option value="pppoe">PPPoE</option>
                            <option value="pptp">PPTP</option>
                            <option value="sstp">SSTP</option>
                            <option value="l2tp">L2TP</option>
                            <option value="ovpn">OVPN</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profile">Profile</label>
                        <select name="profile" id="profile" class="form-control">
                            <option selected>{{ $user['profile'] }}</option>
                            @foreach ($profile as $data)
                                <option>{{ $data['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="timelimit">Local Address</label>
                        <input type="text" name="localaddress" value="{{ $user['local-address'] ?? '' }}" class="form-control" id="timelimit">
                    </div>
                    <div class="form-group">
                        <label for="comment">Remote Address</label>
                        <input type="text" name="remoteaddress" class="form-control" value="{{ $user['remote-address'] ?? '' }}" id="comment">
                    </div>
                    <div class="form-group">
                        <label for="comment">Status</label>
                        <select name="disabled" id="disabled" class="form-control">
                            <option disabled selected>--Pilih Kategori Produk--</option>
                            @if ($user['disabled'] == "false")
                                <option value="true">Disable</option>
                                <option value="false" selected>Enable</option>
                            @elseif($user['disabled'] == "true")
                                <option value="true" selected>Disable</option>
                                <option value="false">Enable</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <input type="text" name="comment" class="form-control" value="{{ $user['comment'] ?? '' }}" id="comment">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">

                    <button type="submit" class="btn btn-outline-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
