<div>
    @if($browseMode)
        @include('employees::livewire.staff.profile.view')
    @endif

    @if($editMode)
        @include('employees::livewire.staff.profile.update')
    @endif
</div>
