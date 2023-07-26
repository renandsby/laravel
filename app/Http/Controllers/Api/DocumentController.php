<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendDocumentRequest;
use App\Models\Document;
use App\Repositories\DocumentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
   public function __construct(protected DocumentRepository $repository)
    {
    }


    /**
     * Adicionar o documento.
     *
     * @param  App\Http\Requests\SendDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function send_document(SendDocumentRequest $request)
    {
        $user = Auth::user();
        $request['user_id'] = $user->id;
        return $this->repository->create($request->all());
    }

    public function get_documents(){
        return Document::with('category','user')->get();
    }
}
