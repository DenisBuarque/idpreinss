@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <div>
            @can('search-document')
                <form method="GET" action="{{ route('admin.trainings.index') }}">
                    <div class="input-group input-group-md">
                        <input type="text" name="search" class="form-control" placeholder="Título">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-info btn-flat">
                                <i class="fa fa-search mr-1"></i> Buscar
                            </button>
                        </span>
                    </div>
                </form>
            @endcan
        </div>
        @can('creat-document')
            <a href="{{ route('admin.trainings.create') }}" class="btn btn-md btn-info" title="Adicionar novo registro">
                <i class="fa fa-plus mr-1"></i> Adicionar novo
            </a>
        @endcan
    </div>
@stop

@section('content')

    @if (session('success'))
        <div id="message" class="alert alert-success mb-2" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session('alert'))
        <div id="message" class="alert alert-warning mb-2" role="alert">
            {{ session('alert') }}
        </div>
    @elseif (session('error'))
        <div id="message" class="alert alert-danger mb-2" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de arquivos de treinamento</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="py-2">Título</th>
                        <th class="py-2">Criado</th>
                        <th class="py-2">Atualizado</th>
                        @can('down-document')
                            <th class="py-2 px-2 text-center" style="width: 70px;">Down</th>
                        @endcan
                        @can('edit-document')
                            <th class="py-2 px-2 text-center" style="width: 70px;">Edit</th>
                        @endcan
                        @can('delete-document')
                            <th class="py-2 px-2 text-center" style="width: 70px;">Del</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trainings as $training)
                        <tr>
                            <td class="py-2">{{ $training->title }}</td>
                            <td class="py-2">{{ \Carbon\Carbon::parse($training->created_at)->format('d/m/Y H:m:s') }}
                            </td>
                            <td class="py-2">{{ \Carbon\Carbon::parse($training->updated_at)->format('d/m/Y H:m:s') }}
                            </td>
                            @can('down-document')
                                <td class="py-2 px-2">
                                    <a href="{{ Storage::url($training->file) }}" target="blank"
                                        class="btn btn-block btn-default btn-xs" title="Baixar arquivo">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </td>
                            @endcan
                            @can('edit-document')
                                <td class="py-2 px-2">
                                    <a href="{{ route('admin.trainings.edit', ['id' => $training->id]) }}"
                                        class="btn btn-block btn-info btn-xs" title="Alterar registro">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            @endcan
                            @can('delete-document')
                                <td class="py-2 px-2">
                                    <form method="POST" onsubmit="return(confirmaExcluir())"
                                        action="{{ route('admin.trainings.destroy', ['id' => $training->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block btn-xs" title="Excluir registro">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td class="py-2 text-center" colspan="6">
                                <span>Nenhum registro cadastrado.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($trainings)
                <div class="px-2 pt-3">
                    {{ $trainings->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        function confirmaExcluir() {
            var conf = confirm("Deseja mesmo excluir? Os dados serão perdidos e não poderão ser recuperados.");
            if (conf) {
                return true;
            } else {
                return false;
            }
        }

        setTimeout(() => {
            document.getElementById('message').style.display = 'none';
        }, 6000);
    </script>
@stop
