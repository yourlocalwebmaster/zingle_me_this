@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Insert Contact.</div>

                    <div class="panel-body">
                        <div id="insert-contact-form">
                            <form name="insertcontact" method="POST" action="{{URL::to('/contact/insert')}}">
                                <div class="col-md-12 padding10"><input type="text" name="title" placeholder="contact name" required class="form-control" /></div>
                                <div class="col-md-12 padding10"><input type="text" name="email" placeholder="contact email address" required class="form-control" /></div>
                                <div class="col-md-12 padding10"><button type="submit" class="form-control">Save.</button></div>
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
