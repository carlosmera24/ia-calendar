{{ __('messages.emails.confirmation.greeting', [ 'name' => $person_email->person()->first()->first_name .' '.$person_email->person()->first()->last_name ] )  }},
{{ __('messages.emails.confirmation.description', [ 'email' => $person_email->email ]) }}
{{ __('messages.emails.confirmation.copy_link') }}:
{{ $link }}

{{  __('messages.emails.confirmation.footer') }}
