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
                            
                            @if($staff->employment->isPermanent() && $staff->employment->isNotConfirmed() )
                                <a href="{{route('staff.confirm', $staff) }}"  class="dropdown-item">
                                    <i class="fas fa-check"></i> Confirm
                                </a>
                            @endif
                            @if($staff->employment->isPermanent() && $staff->employment->isAppointed())
                                <a href="#" wire:click.prevent="dismiss()" class="dropdown-item">
                                    <i class="fas fa-ban"></i> Dismiss
                                </a>
                            @endif
                            @if($staff->employment->isNotPermanent() && $staff->employment->isServing())
                                <a href="#" wire:click.prevent="terminate()" class="dropdown-item">
                                    <i class="fas fa-ban"></i> Terminate
                                </a>
                            @endif
                            @if($staff->employment->isPermanent() && $staff->employment->isConfirmed() && $staff->employment->isNotAppointed() )
                                <a href="{{route('staff.promote', $staff) }}"  class="dropdown-item">
                                    <i class="fas fa-check"></i> Promote
                                </a>
                            @endif
                        @endcan
                        @can('create_employment')
                            @if($staff->employment->isNotPermanent() && $staff->employment->isNotServing())
                                <a href="{{route('staff.contract', $staff)}}" class="dropdown-item">
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
                        <span class="text-bold">Position</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->employment->getPosition() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Grade</span>
                        <a class="float-right">
                            <span class="text-bold">{{ $staff->employment->getGradeScale() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Department</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->employment->getDepartment() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Section</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->employment->getSection() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Campus</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->employment->getCampus() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Job Type</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->employment->getType() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Job Category</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->employment->getCategory() }}</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <span class="text-bold">Starting Date</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->employment->startDate()}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">
                            Ending Date
                        </span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->employment->endDate()}}</span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Period of Service</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->employment->elapsedPeriod()}}</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="text-bold">Remaining Period</span>
                        <a class="float-right">
                            <span class="text-bold">{{$staff->employment->remainingPeriod()}}</span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Job Status</span>
                        <div class="float-right">
                            <span class="text-bold">{!! $staff->employment->statusBadge() !!}</span>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Confirmed</span>
                        <div class="float-right">
                            <span class="text-bold">{!! $staff->employment->confirmationBadge() !!}</span>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <span class="text-bold">Appointed</span>
                        <div class="float-right">
                            <span class="text-bold">{!! $staff->employment->appointmentBadge() !!}</span>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
