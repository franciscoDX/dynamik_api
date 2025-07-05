<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreDeveloperRequest;
use App\Services\DeveloperService;
use App\Http\Resources\DeveloperResource;
use App\Http\Resources\DeveloperCollection;

/**
 * Controller to manage developers
*/
class DeveloperController extends Controller
{
    public function __construct(
        private DeveloperService $developerService
    ) {}

    /**
     * Create a new developer
    */
    public function store(StoreDeveloperRequest $request): JsonResponse
    {
        $developer = $this->developerService->create($request->validated());
        
        return response()->json(
            new DeveloperResource($developer),
            201
        )->header('Location', "/devs/{$developer->id}");
    }

    /**
     * List all developers or search by terms
    */
    public function index(Request $request): JsonResponse
    {
        $developers = $request->has('terms')
            ? $this->developerService->search($request->query('terms'))
            : $this->developerService->getAll();

        return response()->json(
            new DeveloperCollection($developers),
            200
        )->header('X-Total-Count', $this->developerService->count());
    }

    /**
     * Show a specific developer by ID
    */
    public function show(string $id): JsonResponse
    {
        $developer = $this->developerService->findById($id);
        
        if (!$developer) {
            return response()->json(['error' => 'Desenvolvedor não encontrado.'], 404);
        }

        return response()->json(new DeveloperResource($developer));
    }
}