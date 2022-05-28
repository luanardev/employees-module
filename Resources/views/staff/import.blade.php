@extends('employees::layouts.app')

@section('content')

<div class="container-fluid">

	<div class="content-header">

		<div class="row mb-2">
			<div class="col-sm-6">
				<h4 class="m-0">Staff Import</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('employees') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Staff</a></li>
					<li class="breadcrumb-item active">Import</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="content">
        <livewire:employees::import-staff />
	</div>
</div>


@endsection

