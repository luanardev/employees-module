<div class="card card-outline">
    <x-adminlte-validation />
    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">
				<a href="{{route('staff.show', $staff)}}">{{$staff->fullname()}}</a>
			</h3>
            <div class="float-right">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-check-circle"></i> Save
                </button>
                <a href="{{route('staff.show', $staff)}}" class="btn btn-sm btn-success">
                    <i class="fas fa-user"></i> Profile
                </a>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Staff Name *
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$staff->name()}}" disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Position *
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$staff->employment->getPosition()}}" disabled />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Campus *
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{$staff->employment->getCampus()}}" disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Confirmation Date *
                        </label>
                        <div class="col-sm-6">
                            <input type="date" wire:model="confirmDate" name="confirmDate" class="form-control " placeholder="Enter date">
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </form>
</div>
