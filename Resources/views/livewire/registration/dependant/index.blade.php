<div>
    @if ($browseMode)
        @include('employees::livewire.registration.dependant.index')
    @endif
    @if($createMode)
        @include('employees::livewire.registration.dependant.create')
    @endif
</div>
