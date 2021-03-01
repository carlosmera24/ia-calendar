{{ __('messages.emails.password_reset.greeting', [ 'name' => $participant->person()->first()->first_name .' '.$participant->person()->first()->last_name ] )  }},
{{ __('messages.emails.password_reset.description') }}
{{ __('messages.emails.password_reset.copy_link') }}:
{{ $link }}

{{  __('messages.emails.password_reset.footer') }}
