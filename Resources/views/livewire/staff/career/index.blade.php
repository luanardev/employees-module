
<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Staff Career</h3>
    </div>
    <div class="card-body">
        @foreach ($staff->orderedProgress() as $progress)
        <div class="timeline">

            <div class="time-label">
                <span class="bg-green">
                    {{$progress->getType() }}
                </span>
                @can('delete_progress')
                    @if( $progress->isActive()  && $progress->isNotPermanent() )
                        <button wire:click="delete({{$progress->id}})" class=" float-right btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    @endif
                @endcan
            </div>

            <div>
                <i class="fas fa-user bg-blue"></i>
                <div class="timeline-item">
                    <div class="timeline-header">
                        <p>
                            <a href="#" class="text-bold">{{$progress->getPosition()}}</a>
                            <span class="float-right">
                                {!! $progress->statusBadge() !!}
                            </span>

                        </p>

                    </div>
                    <div class="timeline-body">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <strong>Grade: </strong><span>{{$progress->getGradeScale()}}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>Start Date: </strong><span>{{$progress->startDate()}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
