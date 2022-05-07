
<div>
    @if($browseMode)
        @include('employees::livewire.registration.document.view')
    @endif

    @if ($createMode)
        @include('employees::livewire.registration.document.create')
    @endif
</div>
