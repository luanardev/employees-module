@component('mail::message')
<h2>Dear Admin</h2>

<p>Please be advised that <strong>{{ $employee->fullname() }}</strong> CONTRACT IS TERMINATED.</p>
<p>Below is the information pertaining the contract.</p>
<p>
    Designation: <strong>{{$employee->employment->getDesignation()}}</strong> <br/>
    Starting Date: <strong>{{$employee->employment->startDate()}}</strong> <br/>
    Ending Date: <strong>{{$employee->employment->endDate()}}</strong> <br/>
    Contract Period: <strong>{{$employee->employment->contractPeriod()}}</strong><br/>
</p>

{{ config('app.name') }}
@endcomponent
