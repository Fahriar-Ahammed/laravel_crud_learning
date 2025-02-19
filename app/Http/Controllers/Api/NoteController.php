<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Note\CreateNoteRequest;
use App\Http\Requests\Api\Note\UpdateNoteRequest;
use App\Services\NoteService;
use Illuminate\Http\JsonResponse;
use Exception;

class NoteController extends Controller
{
    protected NoteService $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function index(): JsonResponse
    {
        try {
            $notes = $this->noteService->getAllNotes();
            return response()->json(['data' => $notes], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    public function store(CreateNoteRequest $request): JsonResponse
    {
        try {
            $note = $this->noteService->createNote($request);
            return response()->json(['data' => $note, 'message' => 'Note created successfully'], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $note = $this->noteService->getNoteById($id);
            return response()->json(['data' => $note], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    public function update(UpdateNoteRequest $request, int $id): JsonResponse
    {
        try {
            $note = $this->noteService->updateNote($request, $id);
            return response()->json(['data' => $note, 'message' => 'Note updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->noteService->deleteNote($id);
            return response()->json(['message' => 'Note deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }
}
