<div class="card card-outline">
    <x-adminlte-validation />
    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Employment</h3>
            <div class="float-right">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-check-circle"></i> Save
                </button>  
                <button type="button" wire:click="show()" class="btn btn-sm btn-secondary">
                    <i class="fas fa-times-circle"></i> Cancel
                </button>               
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Designation *</label>
                        <select wire:model.lazy="employment.designation_id" class="form-control select2" >
                            <option value="">--select--</option>
                            @foreach ($viewBag->get('designations') as $id => $name)
                                <option value="{{$id}}" >{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Grade *</label>
                        <select wire:model.lazy="employment.grade" class="form-control select2" >
                            <option value="">--select--</option>
                            @foreach ($viewBag->get('grades') as $name)
                                <option value="{{$name}}" >{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Notch *</label>
                        <select wire:model.lazy="employment.notch" class="form-control select2" >
                            <option value="">--select--</option>
                            @foreach ($this->notches($employment->grade) as $notch)
                                <option value="{{$notch}}" >{{$notch}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
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
                <div class="col-lg-6 col-md-6 col-sm-12">
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

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Employment Type *</label>
                        <select wire:model.lazy="employment.employment_type" class="form-control select2" >
                            <option value="">--select--</option>
                            @foreach ($viewBag->get('types') as $id =>  $name)
                                <option value="{{$id}}" >{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Employee Category *</label>
                        <select wire:model.lazy="employment.employee_category" class="form-control select2" >
                            <option value="">--select--</option>
                            @foreach ($viewBag->get('categories') as $id => $name)
                                <option value="{{$id}}" >{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
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

                <div class="col-lg-6 col-md-3 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Starting Date *</label>
                        <input type="date" wire:model.lazy="employment.start_date" name="start_date" class="form-control " placeholder="Enter date">
                    </div>
                </div>

                @if($employment->isNotPermanent())
                <div class="col-lg-6 col-md-3 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Ending Date</label>
                        <input type="date" wire:model.lazy="employment.end_date" name="end_date" class="form-control " placeholder="Enter date">
                    </div>
                </div>
                @endif
                
                @if($employment->isPermanent() && $employment->isAppointed())
                <div class="col-lg-6 col-md-3 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Ending Date</label>
                        <input type="date" wire:model.lazy="employment.end_date" name="end_date" class="form-control " placeholder="Enter date">
                    </div>
                </div>
                @endif

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Status *</label>
                        <select wire:model.lazy="employment.employment_status" class="form-control select2" >
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
