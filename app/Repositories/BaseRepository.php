<?php

namespace App\Repositories;

use App\Models\ModelFront\Base\BaseModel;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseRepository
{
    protected $model;

    public function __construct(BaseModel $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    private function baseQuery(Model $model, array $select = [], array|string $with = [], array $orderBy = [], array $withCount = [], string $has = null)
    {
        $model = $this->model->query();
        $model->select(...$select);

        if (count($orderBy) > 0 && is_array($orderBy[0])) {
            foreach ($orderBy as $order) {
                $model->orderBy(...$order);
            }
        } else if(count($orderBy) > 0) {
            $model->orderBy(...$orderBy);
        }

        if ($has) {
            $model->has($has);
        }

        return $model->with($with)->withCount($withCount);
    }

    public function find(array $select = [], array|string $with = [], array $withCount = [], string $has = null, array $orderBy = [])
    {
        return $this->baseQuery(model: $this->model, select: $select, with: $with, withCount: $withCount, has: $has, orderBy: $orderBy);
    }


    private function baseFindByKey(Model $model, array $query, array $select = [], array|string $with = [], array $withCount = [], string $has = null, array $orderBy = [])
    {
        $model = $this->baseQuery(model: $model, select: $select, with: $with, withCount: $withCount, has: $has, orderBy: $orderBy);

        if (is_array($query[0])) {

            foreach ($query as $arg) {
                $model->where(...$arg);
            }
        } else {
            $model->where(...$query);
        }

        return $model;
    }

    public function findByKey(array $query, array $select = [], array|string $with = [], array $withCount = [], string $has = null, array $orderBy = [])
    {
        return $this->baseFindByKey(model: $this->model, query: $query, select: $select, with: $with, withCount: $withCount, has: $has, orderBy: $orderBy);
    }

    public function create(array $inputData)
    {
        return $this->model->create($inputData);
    }

    public function createRelations(mixed $createdData, array $inputData, array $relations): mixed
    {
        foreach ($relations as $relationKey => $relation) {
            $relationData = $inputData[$relation] ?? null;
    
            if ($relationData) {
                if (!is_numeric($relationKey)) {
                    $this->createManyRelation($createdData, $relation, $relationKey, $relationData);
                } elseif (isset($relationData[0]) && is_array($relationData[0])) {
                    $createdData->$relation()->createMany($relationData);
                } else {
                    $createdData->$relation()->create($relationData);
                }
            }
        }
    
        return $createdData;
    }
    
    protected function createManyRelation($createdData, $relation, $key, $relationData)
    {
        $transformedRelation = collect($relationData)->map(fn($currentRelation) => [$key => $currentRelation])->toArray();
        $createdData->$relation()->createMany($transformedRelation);
    }
    
    public function update(int $id, array $inputData)
    {
        $model = $this->model->findOrFail($id);
        $model->update($inputData);
        return $model;
    }

    public function updateRelations(mixed $updatedData, array $inputData, array $relations = [])
    {
        foreach ($relations as $relationKey => $relation) {
            $relation_snake_case = Str::snake($relation);
            $relationData = $inputData[$relation_snake_case] ?? null;
    
            if ($relationData) {
                if (!is_numeric($relationKey)) {
                    $this->updateManyRelation($updatedData, $relation, $relationKey, $relationData);
                } elseif (isset($relationData[0]) && is_array($relationData[0])) {
                    $this->updateManyRelations($updatedData, $relation, $relationData);
                } else {
                    $this->updateSingleRelation($updatedData, $relation, $relationData);
                }
            }
        }
    
        return $updatedData;
    }
    
    protected function updateManyRelation($updatedData, $relation, $key, $relationData)
    {
        $transformedRelation = collect($relationData)->map(fn($currentRelation) => [$key => $currentRelation])->toArray();
        $updatedData->$relation()->createMany($transformedRelation);
    }
    
    protected function updateManyRelations($updatedData, $relation, $relationData)
    {
        $currentRelations = $updatedData->$relation;
        $updatedRelations = collect($relationData)->filter(fn($item) => isset($item['id']))->keyBy('id')->all();
    
        $currentRelations->each(function ($relationInstance) use ($updatedRelations) {
            if (!isset($updatedRelations[$relationInstance->id])) {
                $relationInstance->delete();
            } else {
                $relationInstance->update($updatedRelations[$relationInstance->id]);
                unset($updatedRelations[$relationInstance->id]);
            }
        });
    
        if (!empty($updatedRelations)) {
            $updatedData->$relation()->createMany(array_values($updatedRelations));
        }
    }
    
    protected function updateSingleRelation($updatedData, $relation, $relationData)
    {
        $currentRelation = $updatedData->$relation()->first();
    
        if ($currentRelation) {
            $currentRelation->update($relationData);
        } else {
            $updatedData->$relation()->create($relationData);
        }
    }
    
    public function delete(int $id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
