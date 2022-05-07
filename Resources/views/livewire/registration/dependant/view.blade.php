<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Dependants</h3>
        <button wire:click="create()" class="float-right btn btn-sm btn-primary">
            <i class="fas fa-plus-circle"></i> Add
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Birth Date</th>
                        <th>Gender</th>
                        <th>Relation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewBag->get('dependant') as $dependant)
                    <tr>
                        <td>{{$dependant->name()}}</td>
                        <td>{{$dependant->dateOfBirth()}}</td>
                        <td>{{$dependant->gender}}</td>
                        <td>{{$dependant->relation}}</td>
                        <td>
                            <button wire:click="delete({{$dependant->id}})" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>