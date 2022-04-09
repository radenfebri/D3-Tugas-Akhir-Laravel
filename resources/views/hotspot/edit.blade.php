@extends('layouts.layouts', ['menu' => 'hotspot', 'submenu' => 'user'])

@section('title', 'Hotspot Edit Users')

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
						<p><a href="{{ route('hotspot.users') }}" class="btn btn-success"><i class="fas fa-backward"></i></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <form action="{{ route('hotspot.update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user">User</label>
                        <input type="hidden" value="<?= $user['.id'] ?>" name="id">
                        <input type="text" name="user" class="form-control" autocomplete="off" value="{{ $user['name'] }}" id="user" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" class="form-control" value="{{ $user['password'] }}" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="server">Server</label>
                        <select name="server" id="server" class="form-control">
                            <option disabled selected>{{ $user['server'] }}</option>
                            @foreach ($server as $data)
                                <option>{{ $data['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profile">Profile</label>
                        <select name="profile" id="profile" class="form-control">
                            <option disabled selected><?= $user['profile'] ?></option>
                            @foreach ($profile as $data)
                                <option>{{ $data['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="timelimit">Time Limit</label>
                        <input type="text" name="timelimit" value="{{ $user['limit-uptime'] }}" class="form-control" id="timelimit">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="disabled" id="disabled" class="form-control">
                            @if ($user['disabled'] == "false")
                                <option disabled selected>Enable</option>
                            @else
                                <option disabled selected>Disable</option>
                            @endif
                            <option value="false">Enable</option>
                            <option value="true">Disable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <input type="text" name="comment" class="form-control" value="{{ $user['comment'] }}" id="comment">
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
