<div class="card card-outline">
    <div class="card-header ">
        <h3 class="card-title text-bold">Employment</h3>
        <div class="float-right">
            <div class="mb-3 mb-md-0">
                <div class="dropdown d-block d-md-inline">
                    <button class="btn dropdown-toggle d-block w-100 d-md-inline" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
        
                    <div class="dropdown-menu dropdown-menu-right w-100" aria-labelledby="actions">
                        @can('update_employment')
                            <a href="#" wire:click.prevent="edit()" class="dropdown-item">
                                <i class="fas fa-edit"></i> Update
                            </a>
                            
                            @if($employee->employment->isPermanent() && $employee->employment->isNotConfirmed() )
                                <a href="{{route('employee.confirm', $employee) }}"  class="dropdown-item">
                                    <i class="fas fa-check"></i> Confirm
                                </a>
                            @endif
                            @if($employee->employment->isPermanent() && $employee->employment->isAppointed())
                                <a href="#" wire:click.prevent="dismiss()" class="dropdown-item">
                                    <i class="fas fa-ban"></i> Dismiss
                                </a>
                            @endif
                            @if($employee->employment->isNotPermanent() && $employee->employment->isServing())
                                <a href="#" wire:click.prevent="terminate()" class="dropdown-item">
                                    <i class="fas fa-ban"></i> Terminate
                                </a>
                            @endif
                            @if($employee->employment->isPermanent() && $employee->employment->isConfirmed() && $employee->employment->isNotAppointed() )
                                <a href="{{route('employee.promote', $employee) }}"  class="dropdown-item">
                                    <i class="fas fa-check"></i> Promote
                                </a>
                            @endif
                        @endcan
                        @can('create_employment')
                            @if($employee->employment->isNotPermanent() && $employee->employment->isNotServing())
                                <a href="{{route('employee.contract', $employee)}}" class="dropdown-item">
                                    <i class="fas fa-plus-circle"></i> New Contract
                                </a>
                            @endif
                        @endcan
                           
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <span class="text-bold">Designation</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->employment->getDesignation() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Grade</span>
                        <a class="float-right">
                            <span class="text-bold">{{ $employee->employment->gradeScale() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Department</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->employment->getDepartment() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Section</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->employment->getSection() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Campus</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->employment->getCampus() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Employment Type</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->employment->getType() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Employee Category</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->employment->getCategory() }}</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <span class="text-bold">Starting Date</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->employment->startDate()}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">
                            Ending Date
                        </span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->employment->endDate()}}</span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Period of Service</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->employment->elapsedPeriod()}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Remaining Period</span>
                        <a class="float-right">
                            <span class="text-bold">{{$employee->employment->remainingPeriod()}}</span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Employment Status</span>
                        <div class="float-right">
                            <span class="text-bold">{!! $employee->employment->statusBadge() !!}</span>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Confirmed</span>
                        <div class="float-right">
                            <span class="text-bold">{!! $employee->employment->confirmationBadge() !!}</span>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Appointed</span>
                        <div class="float-right">
                            <span class="text-bold">{!! $employee->employment->appointmentBadge() !!}</span>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
