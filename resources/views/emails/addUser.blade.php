@component('mail::message')
# Introduction


<h1> Name : {{$data['name']}} </h1>
<h1> Email : {{$data['email']}}</h1>
<h1> Password : {{$data['password']}}</h1>
<h1> Type : {{$data['type']}}</h1>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
