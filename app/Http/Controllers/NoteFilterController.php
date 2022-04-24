<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteFilterController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $user = $request->user()->id;
        $notes = Note::orderBy('created_at', 'desc')->where('user_id', $user);






        switch ($request->input() != null) {
            case ($request->input('createdWhen')):

                $notes = $notes->where('updated_at', $request->input('createdWhen'))->get();
                break;
            case ($request->input('noteTitle')):
                $notes = $notes->where('title', $request->input('noteTitle'))->get();
                break;
            case ($request->input('noteBody')):
                $notes = $notes->where('body', $request->input('noteBody'))->get();
                break;
        }

            return view('notes.filter',[
                'notes' => $notes
            ]);
    }
}
