<?php

namespace App\Services;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Enums\SupportStatus;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use stdClass;

class SupportService
{
    public function __construct(
        protected SupportRepositoryInterface $repository,
    ) {
    }

    public function paginate(
        int $page = 1,
        int $totalPerPage = 15,
        string $filter = null
    ): PaginationInterface {
        return $this->repository->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter,
        );
    }

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    //stdClass => (classe Genérica) tipo especifico não pré-determinado pelo laravel, como é id vai vir um "X8xXNoCHIA78a"
    //primeiro findOne pode retornar null da API
    //null => caso passe um id inválido
    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    // public function new(string $subject, string $status, string $body): stdClass
    // {
    //     return $this->repository->new($subject, $status, $body);
    // }

    public function new(CreateSupportDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }

    // public function update(string $id, string $subject, string $status, string $body): stdClass|null
    // {
    //     return $this->repository->update($id, $subject, $status, $body);
    // }

    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

    public function updateStatus(string $id, SupportStatus $status): void
    {
        $this->repository->updateStatus($id, $status);
    }
}
