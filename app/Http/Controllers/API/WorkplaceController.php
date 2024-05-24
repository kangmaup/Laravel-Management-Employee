<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Workplace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkplaceController extends BaseController
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $workplaces = Workplace::paginate($perPage);

        $formattedWorkplaces = collect($workplaces->items())->map(function ($workplace) {
            return [
                'id' => $workplace->id,
                'name' => $workplace->name,
            ];
        });

        return $this->sendResponse([
            'workplaces' => $formattedWorkplaces,
            'per_page' => $workplaces->perPage(),
            'current_page' => $workplaces->currentPage(),
        ], 'List of workplaces');
    }

    public function show($id)
    {
        $workplace = Workplace::find($id);

        if (!$workplace) {
            return response()->json(['message' => 'Workplace not found'], 404);
        }

        return response()->json(['workplace' => $workplace], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $workplace = Workplace::create($validator->validated());

        return response()->json(['workplace' => $workplace], 201);
    }

    public function update(Request $request, $id)
    {
        $workplace = Workplace::find($id);

        if (!$workplace) {
            return response()->json(['message' => 'Workplace not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $workplace->update($validator->validated());

        return response()->json(['workplace' => $workplace], 200);
    }

    public function destroy($id)
    {
        $workplace = Workplace::find($id);

        if (!$workplace) {
            return response()->json(['message' => 'Workplace not found'], 404);
        }

        $workplace->delete();

        return response()->json(['message' => 'Workplace deleted successfully'], 200);
    }
}
