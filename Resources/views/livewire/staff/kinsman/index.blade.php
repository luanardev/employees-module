<div>
    @if($browseMode)
        @include('employees::livewire.staff.kinsman.view')
    @endif

    @if($createMode||$editMode)
        @include('employees::livewire.staff.kinsman.update')
    @endif
</div>
