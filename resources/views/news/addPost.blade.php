@extends('layouts/postsLayout')
@section('pageTitle') Add News @endsection


@section('pageBody')

<div class="row ">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
            <div class="card-body bg-light">

                <div class="container">
                    <form id="contact-form" action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="controls">

                            <div class="row">

                                <div class="form-group">
                                    <label for="form_lastname">Title *</label>
                                    <input id="form_lastname" type="text" name="title" class="form-control" placeholder="Please enter post title *" required>
                                </div>

                            </div>
                            @if ($errors->has('title')) <div class="alert py-0 alert-danger">{{ $errors->first('title') }}</div> @endif
                            <div class="row">
                                <div class="form-group">
                                    <label for="form_email">Description *</label>
                                    <textarea id="form_email" type="text" name="description" rows="5" class="form-control" placeholder="Please enter post's description *" required></textarea>

                                </div>
                            </div>
                            @if ($errors->has('description')) <div class="alert py-0 alert-danger">{{ $errors->first('description') }}</div> @endif

                            <div class="row">
                                <div class="form-group">
                                    <label for="form_need">Author *</label>
                                    <select id="form_need" name="user_id" class="form-select">
                                        <option disabled>--Select Your Role--</option>

                                        <!-- @foreach($user as $val)
                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach -->
                                        <!-- author with logged person -->
                                        <option selected value="{{$val->id}}">{{Auth::user()['name']}}</option>

                                    </select>

                                </div>
                            </div>
                            @if ($errors->has('user_id')) <div class="alert py-0 alert-danger">You did't selected an Author</div> @endif

                            <div class="row form-group mt-2">
                                <input class="form-control" type="file" name="image">
                            </div>
                            @if ($errors->has('image')) <div class="alert py-0 alert-danger">You must select a valid Image, Size less than 2 Mb</div> @endif
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-success ms-5 p-2 btn-block" value="Publish">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
