<?php

namespace App\Repositories;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Enums\SupportStatus;
use App\Models\Support;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use stdClass;

class SupportEloquentORM implements SupportRepositoryInterface
{
    public function __construct(
        protected Support $model
    ) {
    }

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model
            // ->with(['replies' => function ($query) {
            //     $query->limit(4);
            //     $query->latest();
            //     $query->with('user');
            // }])
            ->with('replies.user')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })
            //já pega o $page por parametro, n precisa definir
            ->paginate($totalPerPage, ['*'], 'page', $page); //"*" => select all from columns, 'page' => nome do parametro, $page => qual pagina q é

        // dd($result->toArray()); MOSTRA TODOS OS RESULTADOS NUM ARRAY
        return new PaginationPresenter($result);
    }

    public function getAll(string $filter = null): array
    {
        //SELECT * FROM supports WHERE...
        // QUERY = CONSULTA
        return $this->model
            ->with('user')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })
            ->get() //->all() => se n tivesse dado uma query acima (consulta)
            ->toArray();
    }

    public function findOne(string $id): stdClass|null
    {
        $support = $this->model->with('user')->find($id);
        if (!$support) {
            return null;
        }

        return (object) $support->toArray(); //converte esse array para objeto, sendo este objeto do tipo stdClass
    }

    public function delete(string $id): void
    {
        $support = $this->model->findOrFail($id); //ENCONTRA OU FALHA

        if (Gate::denies('owner', $support->user->id)) {
            abort(403, 'Not Authorized');
        }

        $support->delete();
    }

    public function new(CreateSupportDTO $dto): stdClass
    {
        $support = $this->model->create(
            (array) $dto
        );

        return (object) $support->toArray();
    }

    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        if (!$support = $this->model->find($dto->id)) {
            return null;
        }

        if (Gate::denies('owner', $support->user->id)) {
            abort(403, 'Not Authorized');
        }

        $support->update(
            (array) $dto
        );

        return (object) $support->toArray();
    }

    public function updateStatus(string $id, SupportStatus $status): void
    {
        $this->model
            ->where('id', $id)
            ->update([
                'status' => $status->name,
            ]);
    }
}
