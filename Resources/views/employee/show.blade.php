@extends('employees::layouts.app')
@section('content')

<div class="container-fluid">
	<div class="content-header">
	
		<div class="row mb-2">
			<div class="col-sm-6">
				<h4 class="m-0">{{$employee->fullname()}} </h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('employees') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employees</a></li>
					<li class="breadcrumb-item active">Profile</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="content">
	
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">
                    Employee Record
                </h3>
                <div class="float-right">
                    <a href="{{route('employee.show', $employee->id)}}" class="btn btn-sm btn-outline-primary" >
                        <i class="fas fa-sync-alt"></i>
                        Refresh
                    </a>
                    <a href="{{route('employee.export', $employee->id)}}" class="btn btn-sm btn-outline-primary" target="_blank" >
                        <i class="fas fa-file-pdf"></i>
                        Download
                    </a>
                    <a href="{{route('employee.destroy', $employee->id)}}" class="btn btn-sm btn-outline-danger" >
                        <i class="fas fa-trash"></i>
                        Remove
                    </a>
                </div>
			</div>
			<div class="card-body">
                <livewire:employees::staff :employee=$employee />
			</div>
		</div>
	</div>
</div>
@endsection

