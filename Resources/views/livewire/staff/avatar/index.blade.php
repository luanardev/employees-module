<div>

    @if($browseMode)
    <div class="text-center">
        @if(!is_null($staff->avatar))
            <img src="{{ asset("storage/".$staff->avatar) }}" class="profile-user-img img-fluid img-circle"  />
        @else
            <img src="{{ asset('assets/images/default.png') }}" class="profile-user-img img-fluid img-circle"  />
        @endif
        <h3 class="profile-username">
            {{$staff->fullname()}}
        </h3>
        <h5 class="text-muted">
            {{$staff->employment->getPosition()}}
        </h5>
        @can('update_employee')
            <button class="btn btn-sm btn-primary" wire:click="create()">
                <i class="fas fa-upload"></i> Upload
            </button>
        @endcan
       
    </div>

    @endif

    @if($createMode)
    <x-adminlte-validation />
    <form wire:submit.prevent="save">
        
        <div class="form-control">
            <input type="file" wire:model="photo" class="form-control-file" >
        </div>
        <br/>
        <div class="text-center">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fas fa-check-circle"></i> Save
            </button>
            <button class="btn btn-sm btn-secondary" wire:click="show()">
                <i class="fas fa-times-circle"></i> Cancel
            </button>
        </div>
    </form>
    @endif
</div>
