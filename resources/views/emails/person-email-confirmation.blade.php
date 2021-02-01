<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>{{ __('messages.emails.confirmation.subject') }}</title>
        <style type="text/css">
            @media screen and (max-width: 600px) {
                table[class="container"] {
                    width: 95% !important;
                }
            }
            p{
                color:#555;
                font-family:Helvetica, Arial, sans-serif;
                font-size:16px;
                line-height:160%;
            }
            .code{
                text-decoration: none;
                font-family: Helvetica, Arial, sans-serif;
                color: #fff;
                border-radius: 4px;
                letter-spacing: 10px;
                font-size: 2em;
                padding: 10px 20px;
            }
        </style>
    </head>
    <body>
        <table class="container" cellpadding="0" cellspacing="0" border="0" align="center" width="620" class="container">
            <tr>
                <td>
                    <img src="{{ $message->embed( asset('img/logo-128.png') ) }}">
                </td>
            </tr>
            {{-- Content --}}
            <tr>
                <td>
                    <p>
                        {{ __('messages.emails.confirmation.greeting', [ 'name' => $person_email->person()->first()->first_name .' '.$person_email->person()->first()->last_name ] )  }}
                    </p>
                    <p>
                        {!! __('messages.emails.confirmation.description', [ 'email' => $person_email->email ]) !!}:
                    </p>
                    <p>
                        <a href="{{ $link }}">{{ __('messages.emails.confirmation.click_confirm') }}</a> {{ __('messages.emails.confirmation.copy_link') }}:<br>
                        <i>{{ $link }}</i>
                    </p>
                </td>
            </tr>
            {{-- End Content --}}
            <tr>
                <td colspan="2" style="padding-top:65px;" width="100%">
                    <hr style="height:1px;border:none;color:#333;background-color:#ddd;">
                </td>
            </tr>
            <tr>
                <td style="padding-bottom:20px;" width="60%" valign="middle" height="70" align="left">
                    <span style="font-size:13px;color:#181818;font-family:Helvetica, Arial, sans-serif;line-height:200%;">
                        {{  __('messages.emails.confirmation.footer') }}
                    </span>
                </td>
            </tr>
        </table>
    </body>
</html>
