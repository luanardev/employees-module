@component('mail::message')
<h2>Dear {{$employee->name()}}</h2>

<p>Please be advised that you are now RETIRED from the post of {{$employee->employment->getDesignation()}}.</p>
<p>Below is the information pertaining your tenure.</p>
<p>
    Starting Date: <strong>{{$employee->employment->startDate()}}</strong> <br/>
    Period of Service: <strong>{{$employee->employment->elapsedPeriod()}}</strong> <br/>
    Grade Scale: <strong>{{$employment->gradeScale()}}</strong><br/>
    Current Age: <strong>{{$employee->age()}}</strong> <br/>
</p>

{{ config('app.name') }}
@endcomponent
