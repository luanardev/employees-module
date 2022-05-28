@extends('employees::layouts.app')

@section('content')

<div class="container-fluid">

	<div class="content-header">

		<div class="row mb-2">
			<div class="col-sm-6">
				<h4 class="m-0">Head of Department</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('employees') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('headship.index') }}">Heads</a></li>
					<li class="breadcrumb-item active">Add</li>
				</ol>
			</div>
		</div>
	</div>
    
	<div class="content">
        
        @livewire('employees::search-staff', ['route' => 'headship.assign'])

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-flash />
                </div>
            </div>
        </div>
       
	</div>
</div>


@endsection

