<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\RealStateRequest;
use App\Models\RealState;

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

    public function store(RealStateRequest $request) {
        $data = $request->all();

        try {
            $realState = $this->realState->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'Imovel cadastrado com sucesso'
                ]
                ], 200);
        } catch(\Exception $err) {
            $message = new ApiMessages($err->getMessage());
            return response()->json([ $message->getMessage()], 404);
        }
    }

    public function show($id) {
        try {
            $realState = $this->realState->findOrFail($id);

            return response()->json([
                'data' =>  $realState
            ], 200);

        } catch(\Exception $err) {
            $message = new ApiMessages($err->getMessage());
            return response()->json([ $message->getMessage()], 404);
        }
    }

    public function update($id, RealStateRequest $request) {

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
            $message = new ApiMessages($err->getMessage());
            return response()->json([ $message->getMessage()], 404);
        }
    }

    public function destroy($id) {
        try {

            $realState = $this->realState->findOrFail($id);
            $realState->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Imovel deletado com sucesso'
                ]
                ], 200);

        } catch(\Exception $err) {
            $message = new ApiMessages($err->getMessage());
            return response()->json([ $message->getMessage()], 404);
        }
    }
}
