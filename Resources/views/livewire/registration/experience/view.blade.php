<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Experience</h3>
        <button wire:click="create()" class="float-right btn btn-sm btn-primary">
            <i class="fas fa-plus-circle"></i> Add
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Employer</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Period</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewBag->get('experience') as $experience)
                    <tr>
                        <td>{{$experience->job_position}}</td>
                        <td>{{$experience->employer_name}}</td>
                        <td>{{$experience->employer_address}}</td>
                        <td>{{$experience->employer_phone}}</td>
                        <td>{{$experience->startDate()}}</td>
                        <td>{{$experience->endDate()}}</td>
                        <td>{{$experience->period()}}</td>
                        <td>
                            <button wire:click="delete({{$experience->id}})" class="btn btn-sm btn-danger">
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