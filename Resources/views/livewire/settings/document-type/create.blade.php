
<div class="card card-outline">
    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Document Type</h3>
            <div class="float-right">
                <button type="submit" class=" btn btn-sm btn-primary">
                    <i class="fas fa-check-circle"></i> Save
                </button> 
                <button type="button" wire:click="show()" class="btn btn-sm btn-secondary">
                    <i class="fas fa-times-circle"></i> Cancel
                </button>
                
            </div> 
        </div>
        <div class="card-body">

            <x-adminlte-validation />

            <div class="row">
                
                <div class="col-md-9">
                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Name*
                        </label>
                        <div class="col-sm-6">
                            <input type="text" wire:model.lazy="documentType.name"  class="form-control " />
                        </div>
                    </div>
                          
                </div>
            </div>
        </div>
    </form>
</div>
