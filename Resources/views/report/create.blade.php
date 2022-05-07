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
				<form action="{{route('report.result')}}" method="GET">

					<div class="card">
						<div class="card-header">
							Query Criteria
						</div>
						<div class="card-body">
							<div class="row">
								@foreach ($filters as $key => $filter)
								<div class="col-3">
									<div class="form-group">
										<label for="filter-{{ $key }}">
											{{ $filter->name() }}
										</label>
										@if ($filter->isSelect())
										<select class="form-control" name="filterby[{{$key}}]">
											<option value="">--select--</option>
                                            @foreach($filter->options() as $option)
												<option value="{{ $option }}">{{ $option }}</option>
											@endforeach
										</select>
										@endif
									</div>
								</div>
								@endforeach
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group" >
										<label class="control-label">Group By</label>
										<select name='groupby[]' class="form-control">
                                            <option value="">--select--</option>
											@foreach($groups as $key => $group)
												<option value='{{$key}}'> {{$group}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group" >
										<label class="control-label">Sort By</label>
										<select name='sortby' class="form-control "  >
                                            <option value="">--select--</option>
											@foreach($groups as $key => $group)
												<option value='{{$key}}'> {{$group}}</option>
											@endforeach
										</select>
									</div>
								</div>

							</div>
						</div>

						<div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary" title="Create">
                                    <span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-check-circle"></i></span>
                                    <span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Generate</span>
                                </button>
                                <button type="button" onclick="window.location.href='{{route('report.create')}}'" class="btn btn-secondary" title="Cancel">
                                    <span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-window-close"></i></span>
                                    <span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Reset</span>
                                </button>
                            </div>
						</div>

					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection

