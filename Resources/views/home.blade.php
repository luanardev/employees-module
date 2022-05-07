@extends('employees::layouts.app')

@section('content')

<div class="container-fluid">

	<div class="content-header">

		<div class="row mb-2">
			<div class="col-sm-6">
				<h4 class="m-0">{{config('employees.name')}}</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item active">Home</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="content">

	</div>
</div>


@endsection


