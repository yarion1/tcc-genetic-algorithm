<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BaseService
{
    protected $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find(array $select = [], array|string $with = [], array $withCount = [], string $has = null, array $orderBy = ['id', 'desc'])
    {
        return $this->repository->find($select, $with, $withCount, $has, $orderBy);
    }

    public function findByKey(array $query, array $select = [], array|string $with = [], array $withCount = [], string $has = null, array $orderBy = ['id', 'desc'])
    {
        return $this->repository->findByKey($query, $select, $with, $withCount, $has, $orderBy);
    }

    private function preventFileSerialization(array $inputData): array
    {
        foreach ($inputData as $key => $value) {
            if (gettype($value) == 'object') {
                $inputData[$key] = 'url';
            }
        }

        return $inputData;
    }

    function regexNumeros(string $value = null): string
    {
        return preg_replace('/[^0-9]/', '', $value);
    }


    private function verificaCpf($valor)
    {
        if (strlen($valor) === 11) {
            return 'CPF';
        } else {
            return false;
        }
    }

    private function validaCpf($valor)
    {
        $digitos = substr($valor, 0, 9);

        $novo_cpf = $this->calc_digitos_posicoes($digitos);

        $novo_cpf = $this->calc_digitos_posicoes($novo_cpf, 11);

        if ($novo_cpf === $valor) {
            return true;
        } else {
            return false;
        }
    }

    private function calc_digitos_posicoes($digitos, $posicoes = 10, $soma_digitos = 0)
    {
        for ($i = 0; $i < strlen($digitos); $i++) {
            $soma_digitos = $soma_digitos + ($digitos[$i] * $posicoes);

            $posicoes--;

            if ($posicoes < 2) {
                $posicoes = 9;
            }
        }

        $soma_digitos = $soma_digitos % 11;

        if ($soma_digitos < 2) {
            $soma_digitos = 0;
        } else {
            $soma_digitos = 11 - $soma_digitos;
        }

        $cpf = $digitos . $soma_digitos;

        return $cpf;
    }



    public function validarCpf($valor)
    {
        $valor = $this->regexNumeros($valor);

        $valor = (string)$valor;

        if ($this->verificaCpf($valor) === 'CPF') {
            return $this->validaCpf($valor) && $this->verificaSequencia(11, $valor);
        } else {
            return false;
        }
    }

    private function verificaSequencia($multiplos, $valor)
    {
        for ($i = 0; $i < 10; $i++) {
            if (str_repeat($i, $multiplos) == $valor) {
                return false;
            }
        }

        return true;
    }

    public function create(array $inputData, array $relations = [])
    {
        return DB::transaction(function () use ($inputData, $relations) {
            $toCreate = $this->preventFileSerialization($inputData);
            $createdData = $this->repository->create($toCreate);
            $createReturn = $this->afterCreate($createdData, $inputData);

            if ($createReturn) return $createReturn;
            return $this->createRelations($createdData, $inputData, $relations);
        });
    }

    private function createRelations(mixed $createdData, array $inputData, array $relations): mixed
    {
        return $this->repository->createRelations($createdData, $inputData, $relations);
    }

    protected function beforeCreate(array $inputData): array
    {
        return $inputData;
    }

    public function advancedCreate(array $inputData, array $relations = [])
    {
        return DB::transaction(function () use ($inputData, $relations) {
            $inputData = $this->beforeCreate($inputData);
            $createdData = $this->create($inputData, $relations);
            $this->afterCreate($createdData, $inputData);
            return $createdData;
        });
    }

    protected function afterCreate(mixed $createdData, array $inputData): mixed
    {
        return $createdData;
    }

    public function update(int $id, array $inputData, array $relations = [])
    {
        return DB::transaction(function () use ($id, $inputData, $relations) {
            $toUpdate = $this->preventFileSerialization($inputData);
            $inputData = $this->beforeUpdate($toUpdate, $id);
            $updatedData = $this->repository->update($id, $inputData);
            $this->updateRelations($updatedData, $inputData, $relations);
            $updateReturn = $this->afterUpdate($updatedData, $inputData);

            if ($updateReturn) return $updateReturn;

            return $updatedData;
        });
    }


    private function convertToSnakeCase(string $value): string
    {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])_([^_])/'], '$1_$2', $value));
    }


    public function updateRelations(mixed $result, array $dados, array $relations = [])
    {
        try {
            foreach ($relations as $key => $relation) {
                $relation_snake_case = $this->convertToSnakeCase($relation);
                if (isset($dados[$relation_snake_case])) {
                    $relationResult = $result->$relation();

                    if (!is_numeric($key)) {
                        $current_relations = $relationResult->pluck($key)->all();
                        $new_relations = array_diff($dados[$relation_snake_case], $current_relations);

                        if (!empty($new_relations)) {
                            $transformedRelation = array_map(fn ($currentRelation) => [$key => $currentRelation], $new_relations);
                            $relationResult->createMany($transformedRelation);
                        }

                        $deleted_relations = array_diff($current_relations, $dados[$relation_snake_case]);
                        if (!empty($deleted_relations)) {
                            $relationResult->whereIn("$key", $deleted_relations)->delete();
                        }
                    } else if (isset($dados[$relation_snake_case]) && is_array($dados[$relation_snake_case])) {
                        $current_relations = $relationResult->get();
                        $updated_relations = [];
                        $deleted_relations = [];

                        foreach ($dados[$relation_snake_case] as $updated) {
                            if (isset($updated['id'])) {
                                $updated_relations[] = $updated;
                            }
                        }

                        $updated_relations_id = collect($updated_relations)->pluck('id')->all();

                        foreach ($current_relations as $current) {
                            if (!in_array($current->id, $updated_relations_id)) {
                                $deleted_relations[] = $current->id;
                                $current->delete();
                            }
                        }

                        $new_relations = collect($dados[$relation_snake_case])->reject(fn ($item) => isset($item['id']))->all();
                        if (!empty($new_relations)) {

                            $relationResult->createMany($new_relations);
                        }

                        foreach ($updated_relations as $updated) {
                            $model = $relationResult->findOrFail($updated['id']);

                            $model->update(array_except($updated, ['id']));
                        }
                    } else {
                        $current = $relationResult->first();
                        if (is_null($current)) {
                            $relationResult->create($dados[$relation_snake_case]);
                        } else {
                            $current->update($dados[$relation_snake_case]);
                        }
                    }
                }
            }
        } catch (QueryException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
            // throw new AppError(message: $e->getMessage(), customMessage: 'Erro ao atualizar relações do registro.');
        }

    }


    protected function updateNonNumericKeyRelation($updatedData, $relation, $key, $relationData)
    {
        $currentRelations = $updatedData->$relation->pluck($key)->all();
        $newRelations = array_diff($relationData, $currentRelations);

        if (!empty($newRelations)) {
            $transformedRelation = collect($newRelations)->map(fn ($currentRelation) => [$key => $currentRelation])->toArray();
            $updatedData->$relation()->createMany($transformedRelation);
        }

        $deletedRelations = array_diff($currentRelations, $relationData);

        if (!empty($deletedRelations)) {
            $updatedData->$relation()->whereIn($key, $deletedRelations)->delete();
        }
    }

    protected function updateManyRelations($updatedData, $relation, $relationData)
    {
        $currentRelations = $updatedData->$relation;
        $updatedRelations = collect($relationData)->filter(fn ($item) => isset($item['id']))->keyBy('id')->all();

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

    protected function beforeUpdate(array $inputData, int $id): array
    {
        return $inputData;
    }

    public function advancedUpdate(int $id, array $inputData, array $relations = [])
    {

        return DB::transaction(function () use ($id, $inputData, $relations) {
            $inputData = $this->beforeUpdate($inputData, $id);
            $updatedData = $this->update($id, $inputData, $relations);
            return $this->afterUpdate($updatedData, $inputData);
        });
    }

    protected function afterUpdate(mixed $updatedData, array $inputData): mixed
    {
        return $updatedData;
    }

    protected function beforeDelete(int $id)
    {
        //
    }

    public function delete(int $id, array $withCount = [])
    {
        $this->beforeDelete($id);

        if (count($withCount) > 0) {
            $model = $this->repository->find(withCount: $withCount)->findOrFail($id);
            foreach ($withCount as $relation) {
                $count = $model[Str::snake($relation) . '_count'];
                if ($count > 0) {
                    throw new Exception(
                        "Não é possível excluir este item porque existem $count registro(s) associados a ele!"
                    );
                }
            }
        }
        return $this->repository->delete($id);
    }

    private function preventDuplicatedFileName(string $path, string $fileName, string $extension): string
    {
        $fullFileName = "$fileName.$extension";

        if (Storage::exists($path . '/' . $fullFileName)) {
            $matchingFiles = preg_grep("/^" . preg_quote($path . '/' . $fileName, '/') . "/", Storage::files($path));
            $fileName .= '(' . count($matchingFiles) . ')';
        }

        return $fileName;
    }

    private function removeExtensionFromFileName(string $fileName, string $extension): string
    {
        $fileName = preg_replace("/\.$extension$/", "", $fileName);

        return $fileName;
    }

    public function saveFile(mixed $file, string $folder, string $fileName = null, string $disk = 'public', bool $hashFolder = false)
    {
        if (!$disk) {
            $disk = env('FILESYSTEM_DISK');
        }

        if (gettype($file) == 'object' && $file->isValid()) {
            if ($hashFolder) {
                $folder = hash('sha256', $folder . now());
            }

            $extension = $file->getClientOriginalExtension();
            $fileName = $fileName ?? $this->removeExtensionFromFileName($file->getClientOriginalName(), $extension);
            $fileName = $this->preventDuplicatedFileName($folder, $fileName, $extension);

            $allowedMimeTypes = [
                'application/pdf',
                'image/jpeg',
                'image/png',
                'text/csv',
                'text/plain',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/zip',
                'application/x-rar-compressed',
                'image/gif'
            ];

            $fileMimeType = mime_content_type($file->path());

            if (!in_array($fileMimeType, $allowedMimeTypes)) {
                throw new Exception('Arquivo com extensão ' . $fileMimeType . ' inválido.');
            }

            $path = Storage::disk($disk)->putFileAs($folder, $file, "$fileName.$extension");

            return $path;
        }

        return $file;
    }
}
