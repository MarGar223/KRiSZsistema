<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $user = $request->user()->id;
        $notes = Note::orderBy('created_at', 'desc')->where('user_id', $user)->get();


        return view('notes.notes',[
            'notes' => $notes
        ]);
    }
}
