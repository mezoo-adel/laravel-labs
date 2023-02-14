@extends('layouts/postsLayout')
@section('pageTitle')View Post @endsection




<style>
    h5,
    .card-header {
        color: blue !important;
    }
</style>
@section('pageBody')

<div class="card" style=" border-color:blueviolet; position: relative;" >
    <h4 class="card-header">Post Info</h4>
    <div class="card-body">

        <div class="d-flex " style="position: static;">
          <section class="d-flex flex-column">
          <p class="card-text">{{$news->id}}</p>
            <p class="card-text">
            <h5>Title: </h5>{{$news->title}}</p>
            <p class="card-text">
            <h5>Description:</h5> {{$news->description}}</p>
          </section>
        <section >
            <img  class="img-fluid" style="object-fit: fill; width:25vw;  height: 10rem; position:absolute; right:8px; z-index:99;" src="{{asset('/storage/'.$news->image)}}" alt="image">
        </section>
        </div>
    </div>

</div>

<div class="card mt-3" style=" border-color:blueviolet;">
    <h4 class="card-header">By</h4>
    <div class="card-body">
        <p class="card-text">{{$user}}</p>
        <p class="card-text">
        <h5>Created_at: </h5>{{$news->created_at}}</p>
        <p class="card-text">
        <h5>Updated_at: </h5>{{$news->updated_at}}</p>


    </div>

</div>


@endsection
