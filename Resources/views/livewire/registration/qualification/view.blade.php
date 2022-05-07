<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Qualifications</h3>
        <button wire:click="create()" class="float-right btn btn-sm btn-primary">
            <i class="fas fa-plus-circle"></i> Add
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Qualification</th>
                        <th>Institution</th>
                        <th>Country</th>
                        <th>Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewBag->get('qualification') as $qualification)
                    <tr>
                        <td>{{$qualification->name}}</td>
                        <td>{{$qualification->institution}}</td>
                        <td>{{$qualification->country}}</td>
                        <td>{{$qualification->year}}</td>
                        <td>
                            <button wire:click="delete({{$qualification->id}})" class="btn btn-sm btn-danger">
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