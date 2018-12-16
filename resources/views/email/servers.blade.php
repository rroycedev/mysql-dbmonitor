@component('mail::message')

@component('mail::table')
| Hostname | IP Address |
| -------- | ---------- |
@foreach($servers as $server)
| {{ $server->hostname}} | {{ $server->ipaddress }} |
@endforeach
@endcomponent

@endcomponent
