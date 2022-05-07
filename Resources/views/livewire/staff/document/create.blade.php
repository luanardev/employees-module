<div class="card card-outline">
    <x-adminlte-validation />
    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Document</h3>               
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

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Name *</label>
                        <input type="text" wire:model="name" name="name" class="form-control" placeholder="Enter Document Name" />
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Type *</label>
                        <select wire:model="type" name="type" class="form-control select2"  >
                            <option value="">--select--</option>
                            @foreach ($viewBag->get('documentType') as $id => $name)
                                <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">File *</label>
                        <input type="file" wire:model="file" name="file" class="form-control" />
                    </div>
                </div>

            </div>          
        </div>
    </form>
</div>