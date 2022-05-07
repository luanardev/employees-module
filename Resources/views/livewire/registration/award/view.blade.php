<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Awards</h3>
        <button wire:click="create()" class="float-right btn btn-sm btn-primary">
            <i class="fas fa-plus-circle"></i> Add
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Award</th>
                        <th>Institution</th>
                        <th>Country</th>
                        <th>Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewBag->get('award') as $award)
                    <tr>
                        <td>{{$award->name}}</td>
                        <td>{{$award->institution}}</td>
                        <td>{{$award->country}}</td>
                        <td>{{$award->year}}</td>
                        <td>
                            <button wire:click="delete({{$award->id}})" class="btn btn-sm btn-danger">
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