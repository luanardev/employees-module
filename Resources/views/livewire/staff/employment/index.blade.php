
<div>
    @if($browseMode)
        @include('employees::livewire.staff.employment.view')
    @endif

    @if($editMode)
        @include('employees::livewire.staff.employment.update')
    @endif
</div>
