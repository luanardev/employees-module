<div>
    @if($browseMode)
        @include('employees::livewire.staff.spouse.view')
    @endif

    @if($createMode||$editMode)
        @include('employees::livewire.staff.spouse.update')
    @endif
</div>
