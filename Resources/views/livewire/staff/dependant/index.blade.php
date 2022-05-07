
<div>
    @if ($browseMode)
    <div class="card card-outline">
        <div class="card-header">
            <h3 class="card-title text-bold">Dependants</h3>
        </div>
        <div class="card-body">
            @livewire('employees::staff.staff-dependant-table', ['employee' => $employee])
        </div>
    </div>

    @endif

    @if ($createMode || $editMode)
        @include('employees::livewire.staff.dependant.update')
    @endif

</div>
