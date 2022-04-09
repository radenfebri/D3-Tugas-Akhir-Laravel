@extends('layouts.layouts', ['menu' => 'report', 'submenu' => 'traffic-up'])

@section('title', 'Report Traffic UP')

@section('content')



<div class="main-panel">
	<div class="content">
		<div class="panel-header bg-primary-gradient">
		<div class="page-inner py-5">
			<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
				<div>
					<h2 class="text-white pb-2 fw-bold">@yield('title')</h2>
					<h5 class="text-white op-7 mb-2">Report Data Traffic UP</h5>
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
						<div class="table-responsive">
							<!-- Content -->
								<div id="load"></div>
							<!-- Content -->
						</div>
					</div>
			</div>
			</div>
			</div>
		</div>
	</div>
</div>



<script>
	setInterval('load();',1000);
	function load() {
		$('#load').load('{{ route('report-up.load') }}')
	}
</script>



@endsection
