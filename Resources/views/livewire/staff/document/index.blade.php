
<div>
    @if($browseMode)
    <div class="card card-outline">
        <div class="card-header">
            <h3 class="card-title text-bold">Documents</h3>
        </div>
        <div class="card-body">
            @livewire('employees::staff.staff-document-table', ['employee' => $employee])
        </div>
    </div>
    @endif

    @if ($createMode)
        @include('employees::livewire.staff.document.create')
    @endif
</div>
