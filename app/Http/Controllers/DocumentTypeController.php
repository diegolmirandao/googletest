<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentTypeRequest;
use App\Models\DocumentType;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentTypes = DocumentType::all();

        return $documentTypes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DocumentTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentTypeRequest $request)
    {
        $documentType = DocumentType::create($request->validated());

        return $documentType;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $documentTypeId
     * @return \Illuminate\Http\Response
     */
    public function show($documentTypeId)
    {
        $documentType = DocumentType::findOrFail($documentTypeId);
        return $documentType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DocumentTypeRequest  $request
     * @param  int  $documentTypeId
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentTypeRequest $request, $documentTypeId)
    {
        $documentType = DocumentType::findOrFail($documentTypeId);
        $documentType->update($request->validated());

        return $documentType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $documentTypeId
     * @return \Illuminate\Http\Response
     */
    public function destroy($documentTypeId)
    {
        $documentType = DocumentType::findOrFail($documentTypeId);
        $documentType->delete();

        return $documentType;
    }
}
