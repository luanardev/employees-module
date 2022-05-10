<div>
    @if ($browseMode)
        @include('employees::livewire.registration.dependant.view')
    @endif
    @if($createMode)
        @include('employees::livewire.registration.dependant.create')
    @endif
</div>
