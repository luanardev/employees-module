
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Staff Identity</div>

            </div>
            <div class="card-body">
                <x-adminlte-validation />

                <form wire:submit.prevent="saveAvatar">

                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Profile Picture *</label>
                            <div class="input-group">
                                <input type="file" wire:model="avatar" class="form-control" >
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-check-circle"></i> Upload
                                </button>
                            </div>
                        </div>
                    </div>

                </form>

                <form wire:submit.prevent="saveSignature">

                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Signature *</label>
                            <div class="input-group">
                                <input type="file" wire:model="signature" class="form-control" >
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-check-circle"></i> Upload
                                </button>
                            </div>
                        </div>
                    </div>

                    
                   
                </form>

            </div>

            <div class="card-footer">
                <div class="float-right">
                    @can('print_staff_card')
                        <a href="{{route('identity.card', $staff->id)}}" target="_blank" class="btn btn-success">
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

                        @if(!is_null($staff->avatar))
                            <img src="{{ asset("storage/".$staff->avatar) }}"class="img-fluid img-thumbnail"  />
                        @else
                            <img src="{{ asset('img/default.png') }}" class="img-fluid img-thumbnail"  />
                        @endif

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h6>Signature (350px by 230px)</h6>
                        @if(!is_null($staff->signature))
                            <img src="{{ asset("storage/".$staff->signature) }}" class="img-fluid img-circle"  />
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
