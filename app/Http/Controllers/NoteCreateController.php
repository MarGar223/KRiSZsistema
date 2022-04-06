<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteCreateController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index() {
        return view('notes.createNote');
    }

    public function createNote(Request $request){

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $request->user()->notes()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->route('notes');
    }
}
