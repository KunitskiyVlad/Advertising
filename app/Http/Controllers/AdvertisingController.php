<?php

namespace App\Http\Controllers;

use App\Advertising;
use App\Http\Requests\AdvertisingForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdvertisingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertising = Advertising::paginate(5);

        return view('home', ['advertising' => $advertising]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adveresting.create');
    }


    /**
     * @param AdvertisingForm $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AdvertisingForm $request)
    {
        $data = $request->validated();

        $advertising = new Advertising();
        $advertising->title = $data['title'];
        $advertising->description = $data['description'];
        $advertising->user_id = Auth::id();
        $advertising->save();

        return redirect('/'.$advertising->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Advertising $advertising
     * @return \Illuminate\Http\Response
     */
    public function show(Advertising $advertising)
    {
        return view('adveresting.show', ['advertising' => $advertising]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Advertising $advertising
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertising $advertising)
    {
        return view('adveresting.edit', ['advertising' => $advertising]);
    }


    public function update(AdvertisingForm $request, Advertising $advertising)
    {
        $this->authorize('modify', $advertising);

        $data = $request->validated();

        $advertising->title = $data['title'];
        $advertising->description = $data['description'];
        $advertising->save();

        return redirect('/'.$advertising->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Advertising $advertising
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertising $advertising)
    {
        $this->authorize('modify', $advertising);

        if ($advertising->delete()) {
            Session::flash('message', 'Advertising successfully deleted!');
            Session::flash('alert', 'success');
        } else {
            Session::flash('message', 'Advertising cann`t deleted!');
            Session::flash('alert', 'error');
        }

        return redirect(route('home'));
    }
}
