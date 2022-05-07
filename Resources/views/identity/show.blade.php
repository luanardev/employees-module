@extends('employees::layouts.app')

@section('content')

<div class="container-fluid">

	<div class="content-header">

		<div class="row mb-2">
			<div class="col-sm-6">
				<h4 class="m-0">Staff Identity</h4>
			</div>
            <div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('identity') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('identity.search') }}">Staff</a></li>
					<li class="breadcrumb-item active">Identity</li>
				</ol>
			</div>
			
		</div>
	</div>

	<div class="content">
        <livewire:employees::identity :employee=$employee />
	</div>
</div>


@endsection
