<div class="card card-outline">
    <x-adminlte-validation />
    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Experience</h3>               
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
                        <label class="control-label">Job Position *</label>
                        <input type="text" wire:model.lazy="experience.job_position" name="job_position" class="form-control" placeholder="Enter Job Position" />
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Employer Name * </label>
                        <input type="text" wire:model.lazy="experience.employer_name" name="employer_name" class="form-control " placeholder="Enter Employer Name" />
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Employer Address </label>
                        <input type="text" wire:model.lazy="experience.employer_address" name="employer_address" class="form-control " placeholder="Enter Employer Address" />
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Employer Phone </label>
                        <input type="tel" wire:model.lazy="experience.employer_phone"  name="phone_number" class="form-control" placeholder="Enter Phone Number"/>
                    </div>
                </div>
              
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Start Date *</label>
                        <input type="date" wire:model="experience.start_date"  class="form-control " />
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label">End Date *</label>
                        <input type="date" wire:model="experience.end_date" class="form-control" />
                    </div>
                </div>

            </div>          
        </div>
    </form>
</div>