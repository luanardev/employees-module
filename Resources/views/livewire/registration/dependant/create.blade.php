<div class="card card-outline">
    <x-adminlte-validation />
    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Dependants</h3>
            <button type="submit" class="float-right btn btn-sm btn-primary">
                <i class="fas fa-check-circle"></i> Save
            </button>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Title *</label>
                        <select wire:model.lazy="dependant.title" class="form-control select2" >
                            <option value="">--select--</option>
                            @foreach ($viewBag->get('title') as $name)
                                <option value="{{$name}}" >{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">First Name *</label>
                        <input type="text" wire:model.lazy="dependant.firstname" class="form-control " placeholder="Enter Firstname"  />
                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Last Name *</label>
                        <input type="text" wire:model.lazy="dependant.lastname" class="form-control" placeholder="Enter Lastname" />
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Date of Birth *</label>
                        <input type="date" wire:model.lazy="dependant.date_of_birth" class="form-control" placeholder="Enter Date of birth" />
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Gender *</label>
                        <select wire:model.lazy="dependant.gender" class="form-control select2" >
                            <option value="">--select--</option>
                            @foreach ($viewBag->get('gender') as $name)
                                <option value="{{$name}}" >{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Relation *</label>
                        <select wire:model.lazy="dependant.relation" class="form-control select2" >
                            <option value="">--select--</option>
                            @foreach ($viewBag->get('relation') as $name)
                                <option value="{{$name}}" >{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

        </div>
    </form>
</div>