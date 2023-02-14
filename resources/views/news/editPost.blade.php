@extends('layouts/postsLayout')
@section('pageTitle') Edit News @endsection


@section('pageBody')


<div class="row ">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
            <div class="card-body bg-light">

                <div class="container">
                    <form id="contact-form" enctype="multipart/form-data" action="{{route('news.update',$news->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="controls">

                            <div class="row">

                                <div class="form-group">
                                    <label for="form_lastname">Title *</label>
                                    <input id="form_lastname" type="text" name="title" value="{{$news->title}}" class="form-control" placeholder="Please enter post title *" required>
                                </div>

                            </div>
                            @if ($errors->has('title')) <div class="alert alert-danger">{{ $errors->first('title') }}</div> @endif
                            <div class="row">
                                <div class="form-group">
                                    <label for="form_email">Description *</label>
                                    <textarea id="form_email" type="text" name="description" rows="5" class="form-control" placeholder="Please enter post's description *" required>{{$news->description}}</textarea>

                                </div>
                            </div>
                            @if ($errors->has('description')) <div class="alert alert-danger">{{ $errors->first('description') }}</div> @endif

                            <div class="row">
                                <div class="form-group">
                                    <label for="form_need">Author *</label>
                                    <select id="form_need" name="user_id" class="form-select">
                                        <option disabled selected>--Select Your Role--</option>

                                        @foreach($user as $val)

                                        @if($val->id == $news->user_id)
                                        <option value="{{$val->id}}" selected>{{$val->name}}</option>
                                        @continue
                                        @endif
                                        <option value="{{$val->id}}">{{$val->name}}</option>

                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            @if ($errors->has('user_id')) <div class="alert alert-danger">You did't selected an Author</div> @endif

                            <div class="row form-group mt-2">
                                <input class="form-control" type="file" name="image"  value="{{asset('/storage/'.$news->image)}}">
                            @if ($errors->has('image')) <div class="alert py-0 alert-danger">You must select a valid Image, Size less than 2 Mb</div> @endif
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-success ms-5 p-2 btn-block" value="Publish">
                                    <img class="img-thumbnail" src="{{asset('/storage/'.$news->image)}}" alt="her'es an image">
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
