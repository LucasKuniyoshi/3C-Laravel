<?php

namespace App\Repositories\Contracts;

use App\DTO\Supports\{
    CreateSupportDTO,
    UpdateSupportDTO
};
use App\Enums\SupportStatus;
use stdClass;

interface SupportRepositoryInterface
{//qual pagina q está, total de itens por página (máx)
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface /*array stdClass[]*/;
    public function getAll(string $filter = null): array;
    public function findOne(string $id): stdClass|null;
    public function delete(string $id): void;
    public function new(CreateSupportDTO $dto): stdClass;
    public function update(UpdateSupportDTO $dto): stdClass|null;
    public function updateStatus(string $id, SupportStatus $status): void;
}
