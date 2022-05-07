<div>
    @if($browseMode)
    <div class="card card-outline">
        <div class="card-header">
            <h3 class="card-title text-bold">Progress Type</h3>
            <div class="float-right">
                <button wire:click="create()" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-circle"></i> Create
                </button>                 
            </div>
        </div>
        <div class="card-body">
            @livewire('employees::settings.progress-type-table')
        </div>
    </div>
       
    @elseif ($createMode||$editMode)
        @include('employees::livewire.settings.progress-type.create')  
    @endif
</div>