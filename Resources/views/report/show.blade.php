@extends('employees::layouts.app')

@section('content')
<div class="container-fluid">
    <div class="content-header">
	
		<div class="row mb-2">
			<div class="col-sm-6">
				<h4 class="m-0">Employees Report</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('employees') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employees</a></li>
					<li class="breadcrumb-item active">Reports</li>
				</ol>
			</div>
		</div>
	</div>
    
    <div class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
                    <div class="card-header">
                        <div class="card-title">{{$report->title()}}</div>
						<div class="float-right">
							<a href="{{ route('report.create') }}" class="btn btn-sm btn-primary">
								<i class="nav-icon fas fa-chart-pie"></i>
								New Report
							</a>
						</div>
                    </div>
                    <div class="card-body">
                        <div class="pre-scrollable">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        @foreach($report->columns() as $column)
                                            <th>{{ucwords($column)}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($report->data() as $row)
                                        <tr>
                                            @foreach($report->columns() as $column)
                                            <td>{{$row->$column}}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection

