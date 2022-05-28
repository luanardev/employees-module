@extends('employees::layouts.app')

@section('content')

<div class="container-fluid">

	<div class="content-header">	
	
		<div class="row mb-2">
			<div class="col-sm-6">
				<h4 class="m-0">Head of Department <h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('employees') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('deanship.index') }}">Heads</a></li>
					<li class="breadcrumb-item active">Add</li>
				</ol>
			</div>
		</div>     
	</div>
	
	<div class="content"> 
		<x-adminlte-flash />	
		<livewire:employees::supervision.assign-head :staff=$staff />	                                      
	</div>
</div>

@endsection

