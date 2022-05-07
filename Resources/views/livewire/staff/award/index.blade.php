
<div>
    @if($browseMode)
    <div class="card card-outline">
        <div class="card-header">
            <h3 class="card-title text-bold">Awards</h3>
        </div>
        <div class="card-body">
            @livewire('employees::staff.staff-award-table', ['employee' => $employee])
        </div>
    </div>
    @endif

    @if ($createMode||$editMode)
        @include('employees::livewire.staff.award.update')
    @endif
</div>
