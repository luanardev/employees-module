
<div class="card card-outline">

    <form wire:submit.prevent="upload">
        @csrf
        <div class="card-header">
            <div class="card-title">Designation Import</div>
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
            <x-adminlte-flash />
            <x-adminlte-validation />
            <div class="row">

                <div class="col-md-4 offset-lg-1">
                    <div class="form-group">
                        <input wire:model.defer="importFile" type="file" name="file" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
