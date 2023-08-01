<?php

namespace App\Http\Controllers\Admin;


use App\DTO\Support\{CreateSupportDTO};
use App\DTO\Support\{UpdateSupportDTO};
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupports;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function __construct( protected SupportService $service)
    {

    }

    public function index(Request $request)
    {

        $supports = $this->service->paginate(
            page : $request->get('page', 1),
            totalPerPage: $request->get('per_page',2),
            filter : $request->filter,
        );

        $filters = ['filter' => $request->get('filter','')];
        // $support = new Support();
        // $supports = $this->service->getAll($request->filter);
        // $supports = Support::paginate();
        // $xss = '<script>alert("sou um hacker");</script>';
        // dd($supports);
        return view('admin/supports/index', compact('supports', 'filters'));
    }

    public function show(string $id)
    {
        // Support::find($id);
        // Support::where('id', $id)->first()
        // Support::where('id','=', $id)->first()
        if(!$support = $this->service->findOne($id)){
            return back();
        }
        return view('admin/supports/show', compact('support'));
        // dd($support->subject);
    }


    public function create()
    {
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupports $request, Support $support)
    {

        // dd($request->only(['body']));
        // pega apenas um valor específico pode ser array com os campos
        // ou chamar direto $request->body
        // $data = $request->all();
        // $data['status'] = 'a';
        // $support->create($data);

        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return redirect()->route('supports.index');
    }

    public function edit(string $id)
    {
        // if(!$support = $support->where('id', $id)->first()){
        //     return back();
        // };
        if(!$support = $this->service->findOne($id)){
            return back();
        };

        return view('admin/supports.edit', compact('support'));

    }

    public function update(StoreUpdateSupports $request, Support $support, string $id)
    {

        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request)
        );

        if(!$support){
            return back();
        }

        // $support->subject = $request->subject;
        // $support->body = $request->body;
        // $support->save();

        // $support->update($request->only(['subject','body']));

        return redirect()->route('supports.index');
    }

    public function destroy(string $id)
    {
        // if(!$support = Support::find($id)){
        //     return back();
        // }
        // $support->delete();

        $this->service->delete($id);

        return redirect()->route('supports.index');
    }
}
