<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service
    ) {}

    public function index(Request $request)
    {
        // $supports = $this->service->getAll($request->filter);
        // $supports = Support::paginate(); PAGINAÇÃO PRA PROJETOS SIMPLES
        //{{ $supports->links() }} PAGINAÇÃO PRA PROJETOS SIMPLES
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 6),
            filter: $request->filter,
        );

        $filters = ['filter' => $request->get('filter', '')];

        //RETORNA TUDO Q TA NO BANCO, "além de utilizar filtro tbm"
        return view('admin/supports/index', compact('supports', 'filters')); //compact => array q armazena todos os dados de supports
    }

    public function show(string $id) //show(string|int $id), string ou inteiro
    {
        // Support::find($id) //recupera um item pelo ID
        // Support::where('id', $id)->first();
        // Support::where('id', '!=', $id)->first();
        if (!$support = $this->service->findOne($id)) {
            //SE N ENCONTROU NADA, REDIRECIONA O USER PARA A PAGINA ANTERIOR
            return back();
        }
        //redireciona para a pagina, manda com os dados adquiridos aqui
        return view('admin/supports/show', compact('support'));
    }

    public function create()
    {
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupport $request, Support $support)
    {
        // $data = $request->validated();
        // $data['status'] = 'a';

        // $support->create($data);

        $this->service->new(
            CreateSupportDTO::makeFromRequest($request) //CHAMA O MÉTODO ESTTÁTICO, OS DADOS CRIADOS SÃO ARMAZENADOS EM FORMATO DTO
        );

        return redirect()
                ->route('supports.index')
                ->with('message', 'Cadastrado com sucesso!');
    }

    public function edit(string $id)
    {
        // if (!$support = $support->where('id', $id)->first()) {
        if (!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin/supports.edit', compact('support'));
    }

    public function update(StoreUpdateSupport $request, Support $support, string $id)
    {
        // $support->update($request->only([
        //     'subject', 'body'
        // ]));

        // $support->update($request->validated());

        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request),
        );

        if (!$support) {
            return back();
        }

        return redirect()
                ->route('supports.index')
                ->with('message', 'Atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()
                ->route('supports.index')
                ->with('message', 'Deletado com sucesso!');
    }
}
