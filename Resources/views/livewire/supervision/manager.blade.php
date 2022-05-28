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
                <a href="{{route('manager.index')}}" class="btn btn-sm btn-success">
                    <i class="fas fa-users"></i> Heads
                </a>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Campus *
                        </label>
                        <div class="col-sm-6">
                            <select wire:model="campus" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('campus') as $id => $name)
                                    <option value="{{$id}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Section *
                        </label>
                        <div class="col-sm-6">
                            <select wire:model="section" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('section') as $id => $name)
                                    <option value="{{$id}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Position *
                        </label>
                        <div class="col-sm-6">
                            <select wire:model="position" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('position') as $name)
                                    <option value="{{$name}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                           
                </div>
            </div>
        </div>
    </form>
</div>
