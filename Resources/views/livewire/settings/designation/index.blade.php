<div>
    @if($browseMode)
    <div class="card card-outline">
        <div class="card-header">
            <h3 class="card-title text-bold">Designation</h3>
            <div class="float-right">
                <button wire:click="create()" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-circle"></i> Create
                </button>
                
                <button wire:click="import()" class="btn btn-sm btn-primary">
                    <i class="fas fa-upload"></i> Import
                </button>                  
            </div>
        </div>
        <div class="card-body">
            @livewire('employees::settings.designation-table')
        </div>
    </div>
       
    @elseif ($createMode||$editMode)
        @include('employees::livewire.settings.designation.create')  

    @elseif($importMode)
        @include('employees::livewire.settings.designation.import')
    @endif
</div>