<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteBookRequest;
use App\Http\Resources\NoteBookResource;
use App\Models\NoteBook;
use Illuminate\Http\Request;

class NoteBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NoteBookResource::collection(NoteBook::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteBookRequest $request)
    {
        $noteBook = NoteBook::create($request->validated());
        return new NoteBookResource($noteBook);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NoteBook  $noteBook
     * @return \Illuminate\Http\Response
     */
    public function show(NoteBook $notebook)
    {
        return new NoteBookResource($notebook);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NoteBook  $noteBook
     * @return \Illuminate\Http\Response
     */
    public function update(NoteBookRequest $request, NoteBook $notebook)
    {
        $notebook->update($request->validated());
        return new NoteBookResource($notebook);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NoteBook  $noteBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(NoteBook $notebook)
    {
        $notebook->delete();
        return response()->noContent();
    }
}
