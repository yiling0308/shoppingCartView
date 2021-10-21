<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\News\StoreRequest;
use App\Http\Requests\News\ShowRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();

        return $news;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\News\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $news = new News([
            'title' => $validated['title'],
            'content'=> $validated['content']
        ]);

        $news->save();

        $status = (!empty($news)) ? "成功" : "失敗";

        return $status;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\News\ShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRequest $request)
    {
        $validated = $request->validated();

        $news = News::find($validated['id']);

        return $news;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(ShowRequest $request, News $news)
    {
        $validated = $request->all();

        $news = News::find($validated['id']);

        if ($validated['title']) {
            $news->title = $validated['title'];
        }

        if ($validated['content']) {
            $news->content = $validated['content'];
        }

        $news->save();

        $status = (!empty($news)) ? "成功" : "失敗";

        return $status;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\News\ShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShowRequest $request)
    {
        $validated = $request->validated();

        $news = News::find($validated['id']);

        $news->delete();

        $status = (!empty($news)) ? "成功" : "失敗";

        return $status;
    }
}
