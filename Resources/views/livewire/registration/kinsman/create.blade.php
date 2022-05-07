
<div>
    <div class="card card-outline">
        <x-adminlte-validation />
        <form wire:submit.prevent="save">

            <div class="card-header">
                <h3 class="card-title text-bold">Next of Kin</h3>
                <button type="submit" class="float-right btn btn-sm btn-primary">
                    <i class="fas fa-check-circle"></i> Save
                </button>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12">

                        <div class="form-group">
                            <label class="control-label">Title *</label>
                            <select wire:model.lazy="kinsman.title" name="title" class="form-control custom-select"  >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('title') as $case)
                                    <option value="{{$case}}">{{$case}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">First Name *</label>
                            <input type="text" wire:model.lazy="kinsman.firstname" name="firstname"class="form-control" placeholder="Enter First Name" />
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Last Name *</label>
                            <input type="text" wire:model.lazy="kinsman.lastname" name="lastname" class="form-control " placeholder="Enter Last Name" />
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Middle Name</label>
                            <input type="text" wire:model.lazy="kinsman.middlename" name="middlename" class="form-control " placeholder="Enter Middle Name">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Relation *</label>
                            <select wire:model.lazy="kinsman.relation" name="relation" class="form-control custom-select"  >
                                <option value="">--select--</option>
                                @foreach ($viewBag->get('relation') as $case)
                                    <option value="{{$case}}">{{$case}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Occupation</label>
                            <input type="text" wire:model.lazy="kinsman.occupation" name="occupation"   class="form-control" placeholder="Enter Occupation " />
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Organisation</label>
                            <input type="text" wire:model.lazy="kinsman.organisation" name="organisation"   class="form-control" placeholder="Enter Organisation" />
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Contact Address *</label>
                            <input type="text" wire:model.lazy="kinsman.contact_address" name="contact_address" class="form-control " placeholder="Enter Contact Address" />
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Phone One *</label>
                            <input type="tel" wire:model.lazy="kinsman.phone1" name="phone_number1" class="form-control" placeholder="Enter Phone One"/>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Phone Two</label>
                            <input type="tel" wire:model.lazy="kinsman.phone2"  name="phone_number2" class="form-control " placeholder="Enter Phone Two">
                        </div>
                    </div>

                </div>

            </div>

        </form>
    </div>
</div>





