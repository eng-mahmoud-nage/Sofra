@component('mail::message')
# Introduction

Your pin_code is {{$client->pin_code}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
