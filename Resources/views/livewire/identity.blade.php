
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Staff Identity</div>

            </div>
            <div class="card-body">
                <x-adminlte-validation />

                <form wire:submit.prevent="save">

                    <div class="col-lg-6 col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Passport Photo *</label>
                            <input type="file" wire:model="photo" class="form-control-file"  />
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Signature *</label>
                            <input type="file" wire:model="signature" class="form-control-file" >
                        </div>
                    </div>
                    @can('create_staff_card')
                        <div class="col-lg-6 col-md-3 col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-check-circle"></i> Upload
                            </button>
                        </div>
                    @endcan
                    
                </form>

            </div>

            <div class="card-footer">
                <div class="float-right">
                    @can('print_staff_card')
                        <a href="{{route('identity.card', $employee->id)}}" target="_blank" class="btn btn-success">
                            <i class="fas fa-id-card"></i> Get ID Card
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h6>Passport Photo</h6>

                        @if(!is_null($employee->avatar))
                            <img src="{{ asset("storage/".$employee->avatar) }}"class="img-fluid img-thumbnail"  />
                        @else
                            <img src="{{ asset('assets/images/default.png') }}" class="img-fluid img-thumbnail"  />
                        @endif

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h6>Signature (350px by 230px)</h6>
                        @if(!is_null($employee->signature))
                            <img src="{{ asset("storage/".$employee->signature) }}" class="img-fluid img-circle"  />
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
