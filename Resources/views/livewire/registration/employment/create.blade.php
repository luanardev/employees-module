<div>
    <div class="card card-outline">
        <x-adminlte-validation />
        <form wire:submit.prevent="save">
            <div class="card-header">
                <h3 class="card-title text-bold">Employment</h3>
                <button type="submit" class="float-right btn btn-sm btn-primary">
                    <i class="fas fa-check-circle"></i> Save
                </button>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Position *</label>
                            <select wire:model.lazy="employment.position_id" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('positions') as $id => $name)
                                    <option value="{{$id}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12">

                        <div class="form-group">
                            <label class="control-label">Grade *</label>
                            <select wire:model.lazy="employment.grade_id" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('grades') as $id => $name)
                                    <option value="{{$id}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Scale *</label>
                            <select wire:model.lazy="employment.scale" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('scales') as $name)
                                    <option value="{{$name}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Notch *</label>
                            <select wire:model.lazy="employment.notch" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($this->notches($employment->scale) as $notch)
                                    <option value="{{$notch}}" >{{$notch}}</option>
                                @endforeach
                            </select>
    
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Department *</label>
                            <select wire:model.lazy="employment.department_id" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('departments') as $id => $name)
                                    <option value="{{$id}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Section *</label>
                            <select wire:model.lazy="employment.section_id" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('sections') as $id => $name)
                                    <option value="{{$id}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Job Type *</label>
                            <select wire:model.lazy="employment.type_id" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('types') as $id =>  $name)
                                    <option value="{{$id}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Job Category *</label>
                            <select wire:model.lazy="employment.category_id" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('categories') as $id => $name)
                                    <option value="{{$id}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Campus *</label>
                            <select wire:model.lazy="employment.campus_id" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('campuses') as $id => $name)
                                    <option value="{{$id}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Starting Date *</label>
                            <input type="date" wire:model.lazy="employment.start_date" name="start_date" class="form-control " placeholder="Enter date">
                        </div>
                    </div>
    
                    @if($employment->isNotPermanent())
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Ending Date</label>
                            <input type="date" wire:model.lazy="employment.end_date" name="end_date" class="form-control " placeholder="Enter date">
                        </div>
                    </div>
                    @endif
    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Status *</label>
                            <select wire:model.lazy="employment.status_id" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('statuses') as $id => $name)
                                    <option value="{{$id}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

