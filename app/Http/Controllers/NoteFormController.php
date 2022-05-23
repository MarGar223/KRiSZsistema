<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteFormController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view('notes.createNote');
    }

    public function createNote(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $request->user()->notes()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return back()->with('success', 'Užrašas sėkmingai sukurtas');
    }

    public function showNote(Note $note)
    {
        return view('notes.editNote', [
            'note' => $note
        ]);
    }

    public function editNote(Request $request, Note $note)
    {

        $this->validate($request, [
            'titleMod' => 'required',
            'bodyMod' => 'required'
        ]);
        if(($request->titleMod != $note->title) || ($request->bodyMod != $note->body)){
            $request->user()->notes()->where('id', $note->id)->update([
                'title' => $request->titleMod,
                'body' => $request->bodyMod,
            ]);
            return back()->with('success', 'Užrašas redaguotas sėkmingai');
        } else {
            return back();
        }

    }

    public function deleteNote(Request $request, Note $note)
    {

        $request->user()->notes()->where('id', $note->id)->delete();

        return back()->with('success', 'Užrašas ištrintas');
    }

    public function editNoteFromDashboard(Request $request, Note $note)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        if(($request->title != $note->title) || ($request->body != $note->body)){
            $request->user()->notes()->where('id', $note->id)->update([
                'title' => $request->title,
                'body' => $request->body,
            ]);
            return back()->with('success', 'Užrašas redaguotas sėkmingai');
        } else {
            return back();
        }

    }

    public function deleteNoteFromDashboard(Request $request, Note $note)
    {

        $request->user()->notes()->where('id', $note->id)->delete();

        return back()->with('success', 'Užrašas ištrintas');
    }
}
