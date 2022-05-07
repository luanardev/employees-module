<div class="card card-outline">
    <x-adminlte-validation />
    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">
				<a href="{{route('employee.show', $employee)}}">{{$employee->fullname()}}</a>
			</h3>
            <div class="float-right">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-check-circle"></i> Save
                </button>
                <a href="{{route('employee.show', $employee)}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4 offset-lg-1">
                    <div class="form-group">
                        <label class="control-label">Confirmation Date *</label>
                        <input type="date" wire:model="confirmDate" name="confirmDate" class="form-control " placeholder="Enter date">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
