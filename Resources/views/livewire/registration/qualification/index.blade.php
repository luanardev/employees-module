
<div>
    @if($browseMode)
        @include('employees::livewire.registration.qualification.view')
    @endif

    @if ($createMode)
        @include('employees::livewire.registration.qualification.create')
    @endif
</div>
