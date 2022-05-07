<div>
    @if($browseMode)
        @include('employees::livewire.registration.award.view')
    @endif

    @if($createMode)
        @include('employees::livewire.registration.award.create')
    @endif
</div>