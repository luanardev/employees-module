
<div class="card card-outline">
    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold"> 
				<a href="{{route('employee.show', $employee)}}">{{$employee->fullname()}}</a>
			</h3>
            <div class="float-right">
                <button type="submit" class="btn btn-sm btn-primary"> 
                    <i class="fas fa-check-circle"></i> Save 
                </button>
        
                <a href="{{route('appointment.index')}}" class="btn btn-sm btn-primary"> 
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>   
        </div>
        <div class="card-body">

            <x-adminlte-validation />

            <div class="row">
                
                <div class="col-md-9">

                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Designation *
                        </label>
                        <div class="col-sm-6">
                            <select wire:model="designation" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('designations') as $id => $name)
                                    <option value="{{$id}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
   
                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Grade *
                        </label>
                        <div class="col-sm-6">
                            <select wire:model="grade" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('grades') as $name)
                                    <option value="{{$name}}" >{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Notch *
                        </label>
                        <div class="col-sm-6">
                            <select wire:model="notch" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($this->notches($grade) as $notch)
                                    <option value="{{$notch}}" >{{$notch}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Start Date *
                        </label>
                        <div class="col-sm-6">
                            <input type="date" wire:model="startdate"  class="form-control " />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            End Date 
                        </label>
                        <div class="col-sm-6">
                            <input type="date" wire:model="enddate" class="form-control" />
                        </div>
                    </div>
                          
                </div>
            </div>
        </div>
    </form>
</div>
