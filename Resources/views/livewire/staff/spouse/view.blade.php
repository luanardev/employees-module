<div class="card card-outline">
    <div class="card-header ">
        <h3 class="card-title text-bold">Spouse Information</h3>

        <div class="float-right">
            <div class="mb-3 mb-md-0">
                <div class="dropdown d-block d-md-inline">
                    <button class="btn dropdown-toggle d-block w-100 d-md-inline" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
        
                    <div class="dropdown-menu dropdown-menu-right w-100" aria-labelledby="actions">
                        @if($employee->hasSpouse())

                            <a href="#" wire:click.prevent="edit({{$employee->spouse->id}})" class="dropdown-item">
                                <i class="fas fa-edit"></i> Update
                            </a>
                            <a href="#" wire:click.prevent="delete({{$employee->spouse->id}})" class="dropdown-item">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                            
                        @else
                            <a href="#" wire:click.prevent="create()" class="dropdown-item">
                                <i class="fas fa-plus-circle"></i> Create
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    <div class="card-body">
        <div class="row">

            <div class="col-lg-12 col-md-6 col-sm-12">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <span class="text-bold">Spouse Name</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->spouse->fullname()}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Gender</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->spouse->gender}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Date of Birth</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->spouse->dateOfBirth()}}</span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Contact Address</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->spouse->contact_address}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Phone Number</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->spouse->phone1}}</span><br/>
                            @isset($employee->spouse->phone2)
                            <span class="text-bold">{{$employee->spouse->phone2}}</span>
                            @endisset
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Residence Country</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->spouse->residence_country}}</span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Home Village</span>
                        <a class="float-right">
                            <span class="text-bold">
                                {{ $employee->spouse->home_village }}
                            </span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Home T/A</span>
                        <a class="float-right">
                            <span class="text-bold">
                                {{ $employee->spouse->home_authority }}
                            </span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Home District</span>
                        <a class="float-right">
                            <span class="text-bold">
                                {{ $employee->spouse->home_district }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
