@extends('employees::layouts.app')

@section('content')

<div class="container-fluid">

	<div class="content-header">

		<div class="row mb-2">
			<div class="col-sm-6">
				<h4 class="m-0">Staff Members</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('employees') }}">Home</a></li>
					<li class="breadcrumb-item active">Staff Members</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="content">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
						<div class="float-right">
							@can('create_staff')
								<a  class="btn btn-sm btn-primary" href="{{route('staff.create')}}">
									<i class="fas fa-plus-circle"></i>
									<span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Add Staff</span>
								</a>
							@endcan
							
						</div>
					</div>
                    <div class="card-body">
                        <x-adminlte-flash />
						<div class="table-responsive">
                            <livewire:employees::staff-table />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

