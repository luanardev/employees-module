
<div class="card card-outline">

    <form wire:submit.prevent="save">
        @csrf
        <div class="card-header">
            <div class="card-title">Import Excel Sheet</div>
            <div class="float-right">
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="fas fa-check-circle"></i> Save
                </button>
                <a href="{{route('staff.template')}}" class="btn btn-sm btn-primary">
                    <i class="nav-icon fas fa-file-excel"></i> Get Template
                </a>
            </div>

        </div>
        <div class="card-body">
            <x-adminlte-flash />
            <x-adminlte-validation />
            <div class="row">

                <div class="col-md-4 offset-lg-1">
                    <div class="form-group">
                        <input wire:model.defer="file" type="file" name="file" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
