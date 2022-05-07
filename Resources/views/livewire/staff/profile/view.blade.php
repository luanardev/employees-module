<div class="card card-outline">

    <div class="card-header">
        <h3 class="card-title text-bold">Personal Information</h3>

        <div class="float-right">
            <div class="mb-3 mb-md-0">
                <div class="dropdown d-block d-md-inline">
                    <button class="btn dropdown-toggle d-block w-100 d-md-inline" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>

                    <div class="dropdown-menu dropdown-menu-right w-100" aria-labelledby="actions">
                        @can('employees.employee.update')
                            <a href="#" wire:click.prevent="edit({{$employee->id}})" class="dropdown-item">
                                <i class="fas fa-edit"></i> Update
                            </a> 
                        @endcan
                                             
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box-profile">
                    <div class="text-center">
                        @livewire('employees::staff.staff-avatar', ['employee' => $employee])
                    </div>
                </div>

            </div>
            <div class="col-lg-8 col-md-6 col-sm-12">

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <span class="text-bold"><i class="fas fa-id-card"></i> Employee ID </span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->id}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold"><i class="fas fa-id-card"></i> National ID </span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->national_id}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold"><i class="fas fa-user"></i> Gender </span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->gender}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold"><i class="fas fa-ring"></i> Marital Status </span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->marital_status}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold"><i class="fas fa-calendar"></i> Date of Birth</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->dateOfBirth()}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold"> <i class="fas fa-address-book"></i> Contact Address</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->contact_address}}</span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold"> <i class="fas fa-envelope"></i> Offical Email</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->official_email}}</span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold"> <i class="fas fa-envelope"></i> Personal Email</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->personal_email}}</span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold"> <i class="fas fa-mobile"></i> Phone Number</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->phone1}}</span><br/>
                            @isset($employee->phone2)
                            <span class="text-bold">{{$employee->phone2}}</span><br/>
                            @endisset
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold"><i class="fas fa-flag"></i> Residence Country</span>
                        <a class="float-right">
                            <span class="text-bold">
                                {{ $employee->residence_country }}
                            </span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold"><i class="fas fa-map-marker-alt"></i> Home Village</span>
                        <a class="float-right">
                            <span class="text-bold">
                                {{ $employee->home_village }}
                            </span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold"><i class="fas fa-map-marker-alt"></i> Home T/A</span>
                        <a class="float-right">
                            <span class="text-bold">
                                {{ $employee->home_authority }}
                            </span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold"><i class="fas fa-map-marker-alt"></i> Home District</span>
                        <a class="float-right">
                            <span class="text-bold">
                                {{ $employee->home_district }}
                            </span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold"><i class="fas fa-graduation-cap"></i> Qualification </span>
                        <a class="float-right">
                            <span class="text-bold">
                                {!! $employee->highestQf() !!}
                            </span>
                        </a>
                    </li>


                </ul>

            </div>

        </div>

    </div>
</div>
