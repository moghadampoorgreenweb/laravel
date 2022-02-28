@extends('mail.BaseMail')
@section('body')

    <h4>LOGIN:{{$data??''}}</h4>
    <hr>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
        <tbody>
        <tr>
            <td align="left">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td> <a href="http://htmlemail.io" target="_blank">ENTER TO LOGIN</a> </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

@endsection
