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
                        <label class="control-label">Designation *</label>
                        <select wire:model="designation" class="form-control select2" >
                            <option value="">--select--</option>
                            @foreach ($viewBag->get('designations') as $id => $name)                              
                                <option value="{{$id}}" >{{$name}}</option>
                            @endforeach
                        </select>
                    </div> 
                   
                    <div class="form-group">
                        <label class="control-label">Grade *</label>
                        <select wire:model="grade" class="form-control select2" >
                            <option value="">--select--</option>
                            @foreach ($viewBag->get('grades') as $name)                              
                                <option value="{{$name}}" >{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
       
                    <div class="form-group">
                        <label class="control-label">Starting Date * </label>
                        <input type="date" wire:model="startdate"  class="form-control " />
                    </div>
  
                    <div class="form-group">
                        <label class="control-label">Ending Date *</label>
                        <input type="date" wire:model="enddate" class="form-control" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>