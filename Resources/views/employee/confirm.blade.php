@extends('employees::layouts.app')

@section('content')

<div class="container-fluid">

	<div class="content-header">		
		<div class="row mb-2">
			<div class="col-sm-6">
				<h4 class="m-0">Confirm Employment</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('employees') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('employee.show', $employee) }}">Employee</a></li>
					<li class="breadcrumb-item active">Create</li>
				</ol>
			</div>
		</div>	
	</div>
	<div class="content">
		<x-adminlte-flash />
		<livewire:employees::confirmation :employee=$employee />
	</div>
</div>
@endsection

