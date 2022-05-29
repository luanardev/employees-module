<div class="card card-outline">
    <div class="card-header ">
        <h3 class="card-title text-bold">Next of Kin</h3>

        <div class="float-right">
            <div class="mb-3 mb-md-0">
                <div class="dropdown d-block d-md-inline">
                    <button class="btn dropdown-toggle d-block w-100 d-md-inline" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
        
                    <div class="dropdown-menu dropdown-menu-right w-100" aria-labelledby="actions">
                        @if($staff->hasKinsman())

                            <a href="#" wire:click.prevent="edit({{$staff->kinsman->id}})" class="dropdown-item">
                                <i class="fas fa-edit"></i> Update
                            </a>
                            <a href="#" wire:click.prevent="delete({{$staff->kinsman->id}})" class="dropdown-item">
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
                        <span class="text-bold">Name</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->kinsman->fullname()}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Relation</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->kinsman->relation}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Occupation</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->kinsman->occupation}}</span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Organisation</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->kinsman->organisation}}</span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Contact Address</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->kinsman->contact_address}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Phone Number</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->kinsman->phone1}}</span><br/>
                            @isset($staff->kinsman->phone2)
                            <span class="text-bold">{{$staff->kinsman->phone2}}</span>
                            @endisset
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </div>
</div>
