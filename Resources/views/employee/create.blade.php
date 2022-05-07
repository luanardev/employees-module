@extends('employees::layouts.app')

@section('content')

<div class="container-fluid">
	<div class="content-header">
	
		<div class="row mb-2">
			<div class="col-sm-6">
				<h4 class="m-0">Add Employee</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('employees') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employees</a></li>
					<li class="breadcrumb-item active">Create</li>
				</ol>
			</div>
		</div>
       
	</div>
	
	<div class="content">

		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Employee Record</h3>
                <div class="float-right">
                    <a href="{{route('employee.create')}}" class="btn btn-sm btn-outline-primary" >
                        <i class="fas fa-sync-alt"></i>
                        Refresh
                    </a>
                    <a href="{{route('employee.finish')}}" class="btn btn-sm btn-outline-success" >
                        <i class="fas fa-check-circle"></i>
                        <span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline">Finish</span>
                    </a>
                    <a href="{{route('employee.cancel')}}" class="btn btn-sm btn-outline-danger" >
                        <i class="fas fa-times-circle"></i>
                        <span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline">Cancel</span>
                    </a>
                   
                </div>
			</div>
			<div class="card-body">
				<x-adminlte-flash />
                <livewire:employees::registration/>
			</div>
		</div>
	</div>
</div>

@endsection

