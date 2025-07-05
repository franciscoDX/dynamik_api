<?php
namespace App\Services;

use App\Models\Developer;
use App\Models\Stack;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
    * service class for managing developers.
*/
class DeveloperService
{
    private const RESULTS_LIMIT = 20;

    /**
     * create a new developer
    */
    public function create(array $data): Developer
    {
        $developer = Developer::create([
            'id' => Str::uuid(),
            'nickname' => $data['nickname'],
            'name' => $data['name'],
            'birth_date' => $data['birth_date'],
        ]);

        if (!empty($data['stack'])) {
            $this->attachStacks($developer, $data['stack']);
        }

        return $developer->load('stacks');
    }

    /**
     * obtain all developers
    */
    public function getAll(): Collection
    {
        return Developer::with('stacks')
            ->limit(self::RESULTS_LIMIT)
            ->get();
    }

    /**
     * search developers by nickname, name or stack name
    */
    public function search(string $term): Collection
    {
        $this->validateSearchTerm($term);

        return Developer::with('stacks')
            ->where(function ($query) use ($term) {
                $normalizedTerm = strtolower($term);
                $query->whereRaw('LOWER(nickname) LIKE ?', ["%{$normalizedTerm}%"])
                      ->orWhereRaw('LOWER(name) LIKE ?', ["%{$normalizedTerm}%"])
                      ->orWhereHas('stacks', function ($q) use ($normalizedTerm) {
                          $q->whereRaw('LOWER(name) LIKE ?', ["%{$normalizedTerm}%"]);
                      });
            })
            ->limit(self::RESULTS_LIMIT)
            ->get();
    }

    /**
     * find a developer by ID
    */
    public function findById(string $id): ?Developer
    {
        return Developer::with('stacks')->find($id);
    }

    /**
     * count the total number of developers
    */
    public function count(): int
    {
        return Developer::count();
    }

    /**
     * attach stacks to a developer
    */
    private function attachStacks(Developer $developer, array $stackNames): void
    {
        $stackIds = collect($stackNames)->map(function ($stackName) {
            return Stack::firstOrCreate(['name' => $stackName])->id;
        });

        $developer->stacks()->sync($stackIds);
    }

    /**
     * Validate the search term.
    */
    private function validateSearchTerm(string $term): void
    {
        if (empty(trim($term))) {
            throw new \InvalidArgumentException('O parâmetro "terms" é obrigatório.');
        }
    }
}