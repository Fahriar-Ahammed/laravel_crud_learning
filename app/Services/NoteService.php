<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class NoteService
{
    public function createNote(Request $request)
    {
        try {
            $note = new Note();
            $note->title = $request->title;
            $note->desc = $request->desc;
            $note->date = $request->date;
            $note->status = $request->status;
            $note->save();
            return $note;
        } catch (Exception $e) {
            Log::error("Note creation failed: " . $e->getMessage());
            throw new Exception('Failed to create note.', 500);
        }
    }

    public function getAllNotes()
    {
        try {
            return Note::latest()->get();
        } catch (Exception $e) {
            Log::error("Fetching all notes failed: " . $e->getMessage());
            throw new Exception('Failed to fetch notes.', 500);
        }
    }

    public function getNoteById(int $id)
    {
        try {
            $note = Note::findOrFail($id);
            return $note;
        } catch (Exception $e) {
            Log::error("Fetching note by ID failed: " . $e->getMessage());
            throw new Exception('Failed to fetch note.', 404);
        }
    }

    public function updateNote(Request $request, int $id)
    {
        try {
            $note = Note::findOrFail($id);
            $note->title = $request->title ?? $note->title;
            $note->desc = $request->desc ?? $note->desc;
            $note->date = $request->date ?? $note->date;
            $note->status = $request->status ?? $note->status;
            $note->save();
            return $note;
        } catch (Exception $e) {
            Log::error("Note update failed: " . $e->getMessage());
            throw new Exception('Failed to update note.', 500);
        }
    }

    public function deleteNote(int $id)
    {
        try {
            $note = Note::findOrFail($id);
            $note->delete();
            return true;
        } catch (Exception $e) {
            Log::error("Note deletion failed: " . $e->getMessage());
            throw new Exception('Failed to delete note.', 500);
        }
    }
}
