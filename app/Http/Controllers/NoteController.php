<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $notes = Note::orderBy('created_at', 'desc')->get();


        return view('notes.notes',[
            'notes' => $notes
        ]);
    }



}
