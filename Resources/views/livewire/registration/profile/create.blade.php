
<div>
    <div class="card card-outline">
        <x-adminlte-validation />
        <form wire:submit.prevent="save">

            <div class="card-header">
                <h3 class="card-title text-bold">Personal Information</h3>
                <button type="submit" class="float-right btn btn-sm btn-primary">
                    <i class="fas fa-check-circle"></i> Save
                </button>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Employee ID </label>
                            <input type="text" wire:model.lazy="staff.id" name="id" class="form-control" placeholder="Enter Employee ID" />
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">National ID </label>
                            <input type="text" wire:model.lazy="staff.national_id" name="national_id" class="form-control" placeholder="Enter National ID" />
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">

                        <div class="form-group">
                            <label class="control-label">Title *</label>
                            <select wire:model.lazy="staff.title" name="title" class="form-control select2"  >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('title') as $case)
                                    <option value="{{$case}}">{{$case}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">First Name *</label>
                            <input type="text" wire:model.lazy="staff.firstname" name="firstname"class="form-control" placeholder="Enter First Name" />
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Last Name *</label>
                            <input type="text" wire:model.lazy="staff.lastname" name="lastname" class="form-control " placeholder="Enter Last Name" />
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Middle Name</label>
                            <input type="text" wire:model.lazy="staff.middlename" name="middlename" class="form-control " placeholder="Enter Middle Name">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Date of Birth *</label>
                            <input type="date" wire:model.lazy="staff.date_of_birth" name="date_of_birth"   class="form-control" />
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Gender *</label>
                            <select wire:model.lazy="staff.gender" name="gender" class="form-control select2"  >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('gender') as $case)
                                    <option value="{{$case}}">{{$case}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Marital Status *</label>
                            <select wire:model.lazy="staff.marital_status" name="marital_status" class="form-control select2"  >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('maritalStatus') as $case)
                                    <option value="{{$case}}">{{$case}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Contact Address *</label>
                            <input type="text" wire:model.lazy="staff.contact_address" name="contact_address" class="form-control " placeholder="Enter Contact Address" />
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Personal Email *</label>
                            <input type="email" wire:model.lazy="staff.personal_email" name="personal_email" class="form-control " placeholder="Enter Personal Email" />
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Official Email</label>
                            <input type="email" wire:model.lazy="staff.official_email" name="official_email" class="form-control " placeholder="Enter Official Email" />
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Phone One *</label>
                            <input type="text" wire:model.lazy="staff.phone1" name="phone_number1" class="form-control" placeholder="Enter Phone One"/>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Phone Two</label>
                            <input type="text" wire:model.lazy="staff.phone2" name="phone_number2" class="form-control " placeholder="Enter Phone Two">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Home Village</label>
                            <input type="text" wire:model.lazy="staff.home_village" name="home_village" class="form-control " placeholder="Enter Home Village">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Home T/A</label>
                            <input type="text" wire:model.lazy="staff.home_authority" name="home_ta" class="form-control " placeholder="Enter Home TA">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Home District</label>
                            <select wire:model.lazy="staff.home_district" name="home_district" class="form-control select2" >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('district') as $case)
                                    <option value="{{$case}}">{{$case}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Residence Country</label>
                            <select wire:model.lazy="staff.residence_country" name="home_country" class="form-control select2"  >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('country') as $country)
                                    <option value="{{$country}}">{{$country}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</div>





