@extends('layouts/postsLayout')
@section('pageTitle') See allNewss @endsection


@section('pageBody')


{{-----@dd($allNews)------}}
<div class="row">
    <table class="table table-bordered table-striped">

        <tr class="table-primary text-center">
            <th>id</th>
            <th>title</th>
            <th>decription</th>
            <th>author_id</th>
            <th>view</th>
            <th>edit</th>
            <th>delete</th>

        </tr>

        @foreach($allNews as $value)

        <tr>
            <td class="table-info">{{$value->id}}</td>
            <td>{{$value->title}}</td>
            <td>{{$value->description}}</td>
            <td>{{$value->user_id}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('news.show',$value->id)}}">View</a>
            </td>
            <td>
                <a class="btn btn-secondary" href="{{route('news.edit',$value->id)}}">Edit</a>
            </td>
            <td>
                <input class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#exampleModal{{$value->id}}" type="button" value="Delete">
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$value->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Now</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                Are you Sure You Want to Process Deleting?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{route('news.destroy',$value->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" >Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach


    </table>


    <form id="restore" action="{{route('restore')}}" method="get">
        <button class="btn btn-info">Restore</button>
    </form>


    {{--paginator--}}
    {{ $allNews->links()}}
    {{--OR--}}
    {{-- @if ($allNews->lastPage() > 1)
   --<ul class="pagination">
   --    <li class="{{ ($allNews->currentPage() == 1) ? ' disabled' : '' }}">
    -- <a class="btn btn-secondary " href="{{ $allNews->url(1) }}">Previous</a>
    -- </li>
    -- @for ($i = 1; $i <= $allNews->lastPage(); $i++)
        -- <li class="{{ ($allNews->currentPage() == $i) ? ' active' : '' }}">
            -- <a class="btn btn-info mx-1" href="{{ $allNews->url($i) }}"> {{ $i }} </a>
            -- </li>
        -- @endfor
        -- <li class="{{ ($allNews->currentPage() == $allNews->lastPage()) ? ' disabled' : '' }}">
            -- <a class="btn btn-success " href="{{ $allNews->url($allNews->currentPage()+1) }}">Next</a>
            -- </li>
        --</ul>
        @endif --}}



</div>
@endsection