@component('mail::message')
<h2>Dear {{$progress->employee->name()}}</h2>

<p>Congratulations for your {{$progress->getType()}}.</p>

<p>Below is the information pertaining your {{$progress->getType()}}.</p>

<p>
    Designation: <strong>{{$progress->getDesignation()}}</strong> <br/>
    Grade Scale: <strong>{{$progress->gradeScale()}}</strong> <br/>
    Starting Date : <strong>{{$progress->startDate()}}</strong>
</p>

{{ config('app.name') }}
@endcomponent
