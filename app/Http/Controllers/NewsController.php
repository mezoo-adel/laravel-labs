<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewsRequest;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(["destroy", "create", "edit"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($allNews);
        $allNews = News::paginate(6);
        return view('news/posts', ['allNews' => $allNews]);
    }

    public function restore()
    {
        //
        $news = new News();
        if ($news->withTrashed()) {
            // dump($news->withTrashed());
            News::withTrashed()->restore();
        }
        // dd($allNews);
        $allNews = $news->paginate(6);
        return view('news/posts', ['allNews' => $allNews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        return view('news/addPost', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddNewsRequest $request)
    {
        //
        if ($request->hasFile('image')) {
            $request->image->store('public'); //store image in storage/app/images
        }
        // dd($request->image->hashName());

        $news = new News([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'image' => $request->image->hashName(),
        ]);
        $news->save();
        // dd($allNews);
        return to_route('news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        //  dd($news::find($id));
        $user = new User();
        $news = News::findOrFail($id);
        $userName = $user::where('id', $news->user_id)->first()['name'];
        // dd($userName);
        return view('news/viewPost', ["news" => $news, 'user' => $userName]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $news = News::findOrFail($id);
        $user = User::all();
        return view('news/editPost', ["news" => $news, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddNewsRequest $request, News $news)
    {
        // dd($request->all());
        //  dd($news->all());

        if ($request->hasFile('image')) {
            $request->image->store('public'); //store image in storage/app/images
        }


        $policy = Gate::inspect('update', $news);
        if ($policy->allowed()) {
            # code...
            $myRequest = [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $request->user_id,
                'image' => $request->image->hashName(),
            ];
            $news->update($myRequest);
            $allNews = News::paginate(6);
            return to_route('news.index', ['allNews' => $allNews]);
        } else {
            return abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Gate
        $news = new News();
        $news = $news->findOrFail($id);
        if (Auth::user()->can('isCreator', $news)) {
            News::findOrFail($id)->delete();
            return to_route('news.index');
        } else {
            return abort(401);
        }
    }
}
