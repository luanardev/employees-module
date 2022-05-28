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
					<li class="breadcrumb-item"><a href="{{ url('employees') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('identity.search') }}">Identity</a></li>
					<li class="breadcrumb-item active">Search</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="content">
        @livewire('employees::search-staff', ['route' => 'identity.show'])
	</div>
</div>


@endsection

