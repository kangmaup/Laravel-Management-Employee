<?php

namespace App\Http\Controllers\Api;


use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class PositionController extends BaseController
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $positions = Position::paginate($perPage);

        $formattedPositions = collect($positions->items())->map(function ($position) {
        return [
            'id' => $position->id,
            'name' => $position->name,
        ];
    });

    return $this->sendResponse([
        'positions' => $formattedPositions,
        'per_page' => $positions->perPage(),
        'current_page' => $positions->currentPage(),
    ], 'List of positions');
    }

    public function show($id)
    {
        $position = Position::find($id);

        if (!$position) {
            return response()->json(['message' => 'Position not found'], 404);
        }

        return response()->json(['position' => $position], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $position = Position::create($validator->validated());

        return response()->json(['position' => $position], 201);
    }

    public function update(Request $request, $id)
    {
        $position = Position::find($id);

        if (!$position) {
            return response()->json(['message' => 'Position not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $position->update($validator->validated());

        return response()->json(['position' => $position], 200);
    }

    public function destroy($id)
    {
        $position = Position::find($id);

        if (!$position) {
            return response()->json(['message' => 'Position not found'], 404);
        }

        $position->delete();

        return response()->json(['message' => 'Position deleted successfully'], 200);
    }
}
