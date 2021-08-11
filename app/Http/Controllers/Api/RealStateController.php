<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RealState;
use Illuminate\Http\Request;

class RealStateController extends Controller
{
    private $realState;

    public function __construct(RealState $realState) {
        $this->realState = $realState;
    }

    public function index() {
        $realState = $this->realState->paginate('10');

        return response()->json($realState, 200);
    }

    public function store(Request $request) {
        $data = $request->all();

        try {
            $realState = $this->realState->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'Imovel cadastrado com sucesso'
                ]
                ], 200);
        } catch(\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 401);
        }
    }

    public function show($id) {
        try {
            $realState = $this->realState->findOrFail($id);

            return response()->json([
                'data' =>  $realState
            ], 200);

        } catch(\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 404);
        }
    }

    public function update($id, Request $request) {

        $data = $request->all();

        $realState = $this->realState->findOrFail($id);
        $realState->update($data);

        return response()->json([
            'data' => [
                'msg' => 'Imovel atualizado com sucesso'
            ]
            ], 200);

        try {

        } catch(\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 404);
        }
    }

   
}
