
<li class="nav-item">
    <a href="{{route('employees.home')}}" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

@can('create_employee')
<li class="nav-item">
	<a href="{{route('employee.create')}}" class="nav-link">
		<i class="nav-icon fas fa-plus-circle"></i>
		<p>Add Employee</p>
	</a>
</li>
@endcan

@can('view_employee')
<li class="nav-item">
	<a href="{{route('employee.index')}}" class="nav-link">
		<i class="nav-icon fas fa-users"></i>
		<p>Get Employees</p>
	</a>
</li>
@endcan


@can('view_employee')
<li class="nav-item">
	<a href="{{route('employee.search')}}" class="nav-link">
		<i class="nav-icon fas fa-search"></i>
		<p>Search Employee</p>
	</a>
</li>
@endcan

@can('view_staff_card')
<li class="nav-item">
	<a href="{{route('identity.search')}}" class="nav-link">
		<i class="nav-icon fas fa-id-card"></i>
		<p>Staff Identity</p>
	</a>
</li>
@endcan

@can('view_appointment')
<li class="nav-item">
	<a href="{{route('appointment.index')}}" class="nav-link">
		<i class="nav-icon fas fa-calendar-check"></i>
		<p>Appointments</p>
	</a>
</li>
@endcan


@can('view_employee_report')
<li class="nav-item">
	<a href="{{route('report.create')}}" class="nav-link">
		<i class="nav-icon fas fa-chart-pie"></i>
		<p>Get Reports</p>
	</a>
</li>
@endcan

@can('configure_employees')
<li class="nav-item">
	<a href="{{route('settings.index')}}" class="nav-link">
		<i class="nav-icon fas fa-cog"></i>
		<p>Settings</p>
	</a>
</li>
@endcan


