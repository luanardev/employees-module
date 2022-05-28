
<li class="nav-item">
    <a href="{{route('employees.home')}}" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Staff Members</p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        @can('create_staff')
		<li class="nav-item">
			<a href="{{route('staff.create')}}" class="nav-link">
				<i class="far fa-circle nav-icon"></i>
				<p>Add Staff</p>
			</a>
		</li>
		@endcan

        @can('view_staff')
		<li class="nav-item">
			<a href="{{route('staff.index')}}" class="nav-link">
				<i class="far fa-circle nav-icon"></i>
				<p>Staff Members</p>
			</a>
		</li>
		@endcan

		@can('view_staff')
		<li class="nav-item">
			<a href="{{route('staff.search')}}" class="nav-link">
				<i class="far fa-circle nav-icon"></i>
				<p>Search Staff</p>
			</a>
		</li>
		@endcan

		@can('view_staff_card')
		<li class="nav-item">
			<a href="{{route('identity.search')}}" class="nav-link">
				<i class="far fa-circle nav-icon"></i>
				<p>Staff Identity</p>
			</a>
		</li>
		@endcan
    
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
		<i class="nav-icon fas fa-chart-line"></i>
        <p>Employment</p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">

		@can('update_employment')
        <li class="nav-item">
            <a href="{{route('job.confirmation')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Confirmation</p>
            </a>
        </li>

		<li class="nav-item">
            <a href="{{route('job.promotion')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Promotion</p>
            </a>
        </li>

		<li class="nav-item">
            <a href="{{route('job.renewal')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Renew Contract</p>
            </a>
        </li>
        @endcan
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-calendar-check"></i>
        <p>Appointment</p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">

		@can('create_appointment')
        <li class="nav-item">
            <a href="{{route('appointment.add')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Appointment</p>
            </a>
        </li>
		@endcan

		@can('view_appointment')
        <li class="nav-item">
            <a href="{{route('appointment.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Get Appointments</p>
            </a>
        </li>
		@endcan

    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Heads & Deans</p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
		@can('view_supervision')
        <li class="nav-item">
            <a href="{{route('deanship.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dean of Faculty</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('headship.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Head of Department</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('manager.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Head of Section</p>
            </a>
        </li>
       @endcan
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>Report Generator</p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">	
		@can('view_staff_report')
		<li class="nav-item">
			<a href="{{route('report.create')}}" class="nav-link">
				<i class="far fa-circle nav-icon"></i>
				<p>Get Reports</p>
			</a>
		</li>
		@endcan
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cog"></i>
        <p>Configurations</p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">	
		@can('configure_employees')
		<li class="nav-item">
			<a href="{{route('settings.index')}}" class="nav-link">
				<i class="far fa-circle nav-icon"></i>
				<p>General Settings</p>
			</a>
		</li>
		@endcan
		
    </ul>
</li>





