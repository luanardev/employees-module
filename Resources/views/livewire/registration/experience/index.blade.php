
<div>
    @if($browseMode)
        @include('employees::livewire.registration.experience.view')
    @endif

    @if ($createMode)
        @include('employees::livewire.registration.experience.create')
    @endif
</div>
