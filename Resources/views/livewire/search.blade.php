
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <form wire:submit.prevent="search">
                <div class="input-group">
                    <input wire:model="term" type="text" class="form-control" placeholder="Search Employee ID or Name">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br/>
    @if(isset($results))
    <div class="row">
        @if(count($results) > 0)
            <div class="col-md-6">
                <div class="list-group">
                    @foreach($results as $employee)
                    
                    <div class="list-group-item">
                        <div class="row">
                            
                            <div class="col-auto">
                                @if(!is_null($employee->avatar))
                                    <img src="{{ asset("storage/".$employee->avatar) }}" class="img-fluid" style="max-height: 100px;"/>
                                @else
                                    <img src="{{ asset('assets/images/default.png') }}" class="img-fluid"  style="max-height: 100px;"/>
                                @endif
                            </div>
                            <div class="col px-4">
                                <a href="{{route($route, $employee)}}" >
                                    <div>
                                        <h5>{{$employee->fullname}} ({{$employee->id}})</h5>
                                        <h6 class="mb-1">{{$employee->designation}}</h6>
                                        <h6 class="mb-1">{{$employee->campus}}</h6>
                                        <h6 class="mb-1">{{$employee->appointment}}</h6>
                                    </div>
                                </a>
                            </div>                   
                        </div>               
                    </div>  
                    @endforeach
                </div>
            </div>
        @else
            <div class="col-md-6">
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Record not found
                </div>
            </div>     
        @endif
    </div>
    @endif
</div>

