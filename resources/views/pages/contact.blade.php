@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Contact a user.</div>

                    <div class="panel-body">
                        @if(Session::has('message_sent'))
                            {{--Session::get('message_sent') ? 'You own this user. Message Sent.' : 'You do not own this user.'--}}
                            @if(Session::get('message_sent'))
                                <div class="alert alert-success fade in" style="margin-top:18px;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                    <strong>Congrats!</strong> You own this user and message was sent (but not really sent).
                                </div>
                            @else
                                <div class="alert alert-danger fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                    <strong>Excuse Me!</strong> You do not own this user.
                                </div>
                            @endif
                        @endif
                        <div id="react-contact-form"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
