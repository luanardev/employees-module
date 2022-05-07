<div class="card card-outline">
    <x-adminlte-validation />
    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Award</h3>               
            <div class="float-right">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-check-circle"></i> Save
                </button>  
                <button type="button" wire:click="show()" class="btn btn-sm btn-secondary">
                    <i class="fas fa-times-circle"></i> Cancel
                </button>               
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Award *</label>
                        <input type="text" wire:model.lazy="award.name" name="award" class="form-control" placeholder="Enter Award Name" />
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Institution *</label>
                        <input type="text" wire:model.lazy="award.institution" name="institution" class="form-control " placeholder="Enter Awarding Institution" />
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Country *</label>
                        <select wire:model.lazy="award.country" name="country" class="form-control select2"  >
                            <option value="">--select--</option>
                            @foreach ($viewBag->get('country') as $case)
                                <option value="{{$case}}">{{$case}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Award Year *</label>
                        <input type="year" wire:model.lazy="award.year" name="year"   class="form-control" placeholder="Enter Year" />
                    </div>
                </div>

            </div>          
        </div>
    </form>
</div>