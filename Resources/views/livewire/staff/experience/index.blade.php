
<div>
    @if($browseMode)
    <div class="card card-outline">
        <div class="card-header">
            <h3 class="card-title text-bold">Experience</h3>
        </div>
        <div class="card-body">
            @livewire('employees::staff.staff-experience-table', ['staff' => $staff])
        </div>
    </div>
    @endif

    @if ($createMode||$editMode)
        @include('employees::livewire.staff.experience.update')
    @endif
</div>
