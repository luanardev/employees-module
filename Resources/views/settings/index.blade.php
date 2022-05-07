@extends('employees::layouts.app')
@section('content')

<div class="container-fluid">
	<div class="content-header">
	
		<div class="row mb-2">
			<div class="col-sm-6">
				<h4 class="m-0">Settings</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('employees') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('settings.index') }}">Settings</a></li>
				</ol>
			</div>
		</div>
	</div>

	<div class="content">
		
		<div class="card">
			<div class="card-header">
				
                <div class="float-right">
                    <a href="{{route('settings.index')}}" class="btn btn-sm btn-outline-primary" >
                        <i class="fas fa-sync-alt"></i>
                        Refresh
                    </a>
                    
                </div>
			</div>
			<div class="card-body">
				<livewire:employees::settings />
			</div>
		</div>
	</div>
</div>
@endsection

