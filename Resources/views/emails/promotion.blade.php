@component('mail::message')
<h2>Dear {{$progress->staff->name()}}</h2>

<p>Congratulations for your {{$progress->getType()}}.</p>

<p>Below is the information pertaining your {{$progress->getType()}}.</p>

<p>
    Position: <strong>{{$progress->getPosition()}}</strong> <br/>
    Grade Scale: <strong>{{$progress->getScale()}}</strong> <br/>
    Starting Date : <strong>{{$progress->startDate()}}</strong>
</p>

{{ config('app.name') }}
@endcomponent
