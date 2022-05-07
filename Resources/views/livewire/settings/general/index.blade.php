
<div>
    <div class="card card-outline">
        <x-adminlte-validation />
        <form wire:submit.prevent="save">

            <div class="card-header">
                <h3 class="card-title text-bold">General Settings</h3>
                <button type="submit" class="float-right btn btn-sm btn-primary">
                    <i class="fas fa-check-circle"></i> Save
                </button>
            </div>

            <div class="card-body">

                <div class="form-group row">
                    <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                        Retirement Age
                    </label>
                    <div class="col-sm-4">
                        <input type="number" wire:model.lazy="settings.retirement_age"  class="form-control"  />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                        Probation Period (years)
                    </label>
                    <div class="col-sm-4">
                        <input type="number" wire:model.lazy="settings.probation_period"  class="form-control"  />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                        Contract Period (years)
                    </label>
                    <div class="col-sm-4">
                        <input type="number" wire:model.lazy="settings.contract_period"  class="form-control"  />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                        Service Period (years)
                    </label>
                    <div class="col-sm-4">
                        <input type="number" wire:model.lazy="settings.service_period"  class="form-control"  />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                        Appointment Term
                    </label>
                    <div class="col-sm-4">
                        <input type="number" wire:model.lazy="settings.appointment_term"  class="form-control"  />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                        Email Domain
                    </label>
                    <div class="col-sm-4">
                        <input type="text" wire:model.lazy="settings.email_domain"  class="form-control"  />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                        Admin Email
                    </label>
                    <div class="col-sm-4">
                        <input type="text" wire:model.lazy="settings.admin_email"  class="form-control"  />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                        Create Staff Email
                    </label>
                    <div class="col-sm-4">
                        <select wire:model.lazy="settings.create_staff_email"class="form-control">
                            @foreach (['true', 'false'] as $option)
                                <option value="{{$option}}">{{$option}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                        Create Staff Account
                    </label>
                    <div class="col-sm-4">
                        <select wire:model.lazy="settings.create_staff_account"class="form-control">
                            @foreach (['true', 'false'] as $option)
                                <option value="{{$option}}">{{$option}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                        Send Notification
                    </label>
                    <div class="col-sm-4">
                        <select wire:model.lazy="settings.send_notification"class="form-control">
                            @foreach (['true', 'false'] as $option)
                                <option value="{{$option}}">{{$option}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                        Send Reminders
                    </label>
                    <div class="col-sm-4">
                        <select wire:model.lazy="settings.send_reminder"class="form-control">
                            @foreach (['true', 'false'] as $option)
                                <option value="{{$option}}">{{$option}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>





