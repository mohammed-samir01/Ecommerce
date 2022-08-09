@component('mail::message')
# Introduction


this is the code
{{$code}}



{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
