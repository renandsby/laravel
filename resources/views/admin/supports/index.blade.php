<h1> Listagem dos Suportes</h1>

<a href="{{ route('supports.create') }}" >Adicionar Dúvida</a>

<table>
    <thead>
        <th>Assunto</th>
        <th>Status</th>
        <th>Descrição</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($supports->items() as $support)
            <tr>
                <td>{{ $support->subject }}</td>
                <td>{{ getStatusSupport($support->status) }}</td>
                <td>{{ $support->body }}</td>
                <td>
                    <a href="{{ route('supports.show', $support->id) }}"> ir </a>
                    <a href="{{ route('supports.edit', $support->id) }}"> edit </a>
                </td>
            </tr>
        @endforeach
        {{-- {{$supports->links()}} --}}
    </tbody>

</table>
<x-pagination :paginator="$supports" :appends="$filters" />
