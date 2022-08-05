@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.financials.index') }}" class="btn btn-md btn-info" title="Adicionar novo registro">
            <i class="fa fa-table mr-1"></i> Listar registro
        </a>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.financials.update', ['id' => $financial->id]) }}"
            enctype="multipart/form-data" onsubmit="return mySubmit()">
            @csrf
            @method('PUT')
            <div class="card card-info" style="max-width: 900px; margin: auto">
                <div class="card-header">
                    <h3 class="card-title">Formulário edição do financeiro:</h3>
                </div>
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">

                            <div class="d-flex">
                                @if (isset($financial->user->image))
                                    <img src="{{ asset('storage/' . $financial->user->image) }}" alt="Photo"
                                        style="width: 32px; height: 32px;" class="img-circle img-size-32 mr-2">
                                @else
                                    <img src="https://dummyimage.com/28x28/b6b7ba/fff" alt="Photo"
                                        class="img-circle img-size-32 mr-2">
                                @endif
                                <p class="m-0" style="line-height: 1">
                                    <strong>Franqueado:</strong><br />
                                    {{ $financial->user->name }}<br />
                                    <small>
                                        @isset($financial->user->phone)
                                            {{ $financial->user->phone }}
                                            <br />
                                        @endisset
                                        {{ $financial->user->email }}
                                        @isset($financial->user->address)
                                            <br />
                                            {{ $financial->user->address }}, {{ $financial->user->number }},
                                            {{ $financial->user->district }}, {{ $financial->user->city }},
                                            {{ $financial->user->state }}
                                        @endisset
                                    </small>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <strong>Cliente:</strong>
                            <p class="m-0" style="line-height: 1">
                                {{ $financial->lead->name }}
                                <br /><small>{{ $financial->lead->address }}, {{ $financial->lead->number }},
                                    {{ $financial->lead->district }}, {{ $financial->lead->city }},
                                    {{ $financial->lead->state }}</small>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="invoice border-0">

                                <div class="card card-primary card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                                    href="#custom-tabs-four-home" role="tab"
                                                    aria-controls="custom-tabs-four-home" aria-selected="true">Pagamento do
                                                    Franqueado</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                                    href="#custom-tabs-four-profile" role="tab"
                                                    aria-controls="custom-tabs-four-profile"
                                                    aria-selected="false">Recebimento
                                                    da
                                                    Matriz</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="card-body">

                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            <div class="tab-pane fade active show" id="custom-tabs-four-home"
                                                role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">

                                                <div class="row">
                                                    @can('create-user')
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <small>Confirmação do pagamento pela matriz:</small>
                                                                <select name="confirmation" class="form-control">
                                                                    <option value="N"
                                                                        @if ($financial->confirmation == 'N') selected @endif>
                                                                        Em analise, aguardando confirmação.</option>
                                                                    <option value="S"
                                                                        @if ($financial->confirmation == 'S') selected @endif>
                                                                        Pagamento confirmado pela matriz.</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endcan

                                                    <div class="col-md-3">
                                                        <div class="form-group m-0">
                                                            <small>Número do Precatório:</small>
                                                            <input type="text" name="precatory" id="precatory"
                                                                value="{{ $financial->precatory ?? old('precatory') }}"
                                                                class="form-control" maxlength="30" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group m-0">
                                                            <small>Data do pagamento: *</small>
                                                            <input type="date" name="receipt_date" id="receipt_date"
                                                                value="{{ $financial->receipt_date ?? old('receipt_date') }}"
                                                                class="form-control @error('receipt_date') is-invalid @enderror" />
                                                            @error('receipt_date')
                                                                <div class="text-red">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group m-0">
                                                            @php
                                                                $banks = [1 => 'Banco do Brasil', 2 => 'Banco Ítau', 3 => 'Caixa Economica Federal', 4 => 'Bradesco', 5 => 'Banco Santander'];
                                                            @endphp
                                                            <small>Banco que realizou pagamento: *</small>
                                                            <select name="bank"
                                                                class="form-control @error('bank') is-invalid @enderror">
                                                                @foreach ($banks as $key => $bank)
                                                                    @if ($financial->bank == $key || old('bank') == $key)
                                                                        <option value="{{ $key }}" selected>
                                                                            {{ $bank }}</option>
                                                                    @else
                                                                        <option value="{{ $key }}">
                                                                            {{ $bank }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            @error('bank')
                                                                <div class="text-red">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group m-0">
                                                            <small>Valor da causa: *</small>
                                                            <input type="text" name="value_causa" id="value_causa"
                                                                onkeyup="moeda(this);"
                                                                value="{{ number_format($financial->lead->financial, 2, ',', '.') }}"
                                                                class="form-control @error('value_causa') is-invalid @enderror"
                                                                maxlength="13" placeholder="0,00" />
                                                            @error('value_causa')
                                                                <div class="text-red">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group m-0">
                                                            <small>Valor total do cliente:</small>
                                                            <input type="text" name="value_client" id="value_client"
                                                                onkeyup="moeda(this);"
                                                                value="{{ number_format($financial->value_client, 2, ',', '.') }}"
                                                                class="form-control" maxlength="13" placeholder="0,00" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group m-0">
                                                            <small>Valor dos honorários:</small>
                                                            <input type="text" name="fees" id="fees"
                                                                onkeyup="moeda(this);"
                                                                value="{{ number_format($financial->fees, 2, ',', '.') }}"
                                                                class="form-control" maxlength="13" placeholder="0,00" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group m-0">
                                                            <small>Honorários foram recebido?</small>
                                                            <select name="fees_received" class="form-control">
                                                                <option value="N"
                                                                    @if ($financial->fees_received == 'N') selected @endif>
                                                                    Aguardando pagamento.</option>
                                                                <option value="S"
                                                                    @if ($financial->fees_received == 'S') selected @endif>
                                                                    Sim, recebido.</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group m-0">
                                                            <small>Total de parcelas:</small>
                                                            <select name="installments" class="form-control">
                                                                @for ($i = 1; $i < 13; $i++)
                                                                    <option value="{{ $i }}" @if (count($financial->installments) == $i) @selected(true) @endif>
                                                                        {{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                                aria-labelledby="custom-tabs-four-profile-tab">
                                                <!-- start row -->
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group m-0">
                                                            <small>Data do recebimento da matriz:</small>
                                                            <input type="date" name="payday" id="payday"
                                                                value="{{ $financial->payday ?? old('payday') }}"
                                                                class="form-control @error('payday') is-invalid @enderror" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group m-0">
                                                            <small>Valor recebido pela matriz:</small>
                                                            <input type="text" name="payment_amount"
                                                                id="payment_amount" onkeyup="moeda(this);"
                                                                value="{{ number_format($financial->payment_amount, 2, ',', '.') ?? old('payment_amount') }}"
                                                                class="form-control @error('payment_amount') is-invalid @enderror"
                                                                maxlength="13" placeholder="0,00" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group m-0">
                                                            <small>Banco que recebeu pagamento:</small>
                                                            <select name="payment_bank"
                                                                class="form-control @error('payment_bank') is-invalid @enderror">
                                                                <option value=""></option>
                                                                @foreach ($banks as $key => $bank)
                                                                    @if ($financial->payment_bank == $key)
                                                                        <option value="{{ $key }}" selected>
                                                                            {{ $bank }}</option>
                                                                    @else
                                                                        <option value="{{ $key }}">
                                                                            {{ $bank }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group m-0">
                                                            <small>Data que recebeu o pagamento:</small>
                                                            <input type="date" name="confirmation_date"
                                                                id="confirmation_date"
                                                                value="{{ $financial->confirmation_date ?? old('confirmation_date') }}"
                                                                class="form-control @error('confirmation_date') is-invalid @enderror" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <small>Nome do responsável:</small>
                                                            <input type="text" name="people" id="people"
                                                                value="{{ $financial->people ?? old('people') }}"
                                                                class="form-control @error('people') is-invalid @enderror" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <small>Telefone para contato:</small>
                                                            <input type="text" name="contact" id="contact"
                                                                value="{{ $financial->contact ?? old('contact') }}"
                                                                class="form-control @error('contact') is-invalid @enderror" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group m-0">
                                                            <textarea name="comments" class="form-control" rows="3"
                                                                placeholder="Digite alguma comentário caso precise acrescenter mais informações.">{{ $financial->comments ?? old('comments') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>

                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-striped  table-head-fixed">
                                <thead>
                                    <tr>
                                        <th class="py-2 text-center">Data Pagamento</th>
                                        <th class="py-2">Valor</th>
                                        <th class="py-2">Pagamento</th>
                                        <th class="py-2 px-2 text-center" style="width: 60px;">Edit</th>
                                        <th class="py-2 px-2 text-center" style="width: 70px;">Del</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($financial->installments as $value)
                                        <tr>
                                            <td class="py-2 text-center">
                                                {{ \Carbon\Carbon::parse($value->date)->format('d/m/Y') }}</td>
                                            <td class="py-2">R$ {{ number_format($value->value, 2, ',', '.') }}</td>
                                            <td class="py-2">
                                                @if ($value->active == 'S')
                                                    <span>Aberto</span>
                                                @else
                                                    <span>Pago</span>
                                                @endif
                                            </td>
                                            <td class="py-2 px-0">
                                                @if ($value->active == 'S')
                                                    <a href="{{ route('admin.financials.confirm.payment', ['id' => $value->id]) }}"
                                                        class="btn btn-info btn-block btn-xs" onclick="return confirmaExcluir(1)" title="Confirmar pagamento da parcela">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @else
                                                    <a class="btn btn-block btn-default btn-xs"
                                                        title="Pagamento confirmado">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="py-2 px-1">
                                                <a href="{{route('admin.financials.destroy',['id' => $value ->id])}}"
                                                    class="btn btn-block btn-danger btn-xs" onclick="return confirmaExcluir(2)" title="Excluir parcela de pagamento">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <span>Nenhuma parcela gerada.</span>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <p>Adicione todas as <strong>fotos dos comprovantes de pagamentos</strong> como anexo para análise do
                                    financeiro, isto
                                    é importante para que a matriz aprove sua tranzação financeiro. Selecione, arraste e
                                    solte todos os documentos sobre o ficheiro.</p>
                                <input type="file" name="photos[]"
                                    style="border: 1px solid #cccccc; width: 100%; padding: 2px;" multiple>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.financials.index') }}" type="submit" class="btn btn-default">Cancelar</a>
                    <button id="button" type="submit" class="btn btn-md btn-info float-right"
                        style="display: block;">
                        <i class="fas fa-save mr-1"></i>
                        Salvar dados
                    </button>
                    <a id="spinner" class="btn btn-md btn-info float-right text-center" style="display: none;">
                        <div id="spinner" class="spinner-border" role="status" style="width: 20px; height: 20px;">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Atualizando...
                    </a>
                </div>
            </div>
        </form>
    </div>


    @if ($financial->photos && count($financial->photos))
        <div class="card card-default mt-2" style="max-width: 900px; margin: auto;">
            <div class="card-header">
                <h3 class="card-title">Documentos anexados pelo franqueado</h3>
            </div>
            <div class="card-body bg-white pb-0">
                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                    @foreach ($financial->photos as $file)
                        <li>
                            <span class="mailbox-attachment-icon"><i class="fa fa-file"></i></span>
                            <div class="mailbox-attachment-info">
                                <a href="{{ Storage::url($file->image) }}" target="blank"
                                    class="mailbox-attachment-name">
                                    <i class="fas fa-paperclip"></i> {{ $file->image }}
                                </a>
                                <span class="mailbox-attachment-size clearfix mt-1">
                                    <form method="POST" action="{{ route('admin.financials.remove.photo') }}"
                                        onsubmit="return confirmaExcluir(3)">
                                        @csrf
                                        @method('DELETE')
                                        <span>12455 byts</span>
                                        <input type="hidden" name="photo" value="{{ $file->image }}">
                                        <button type="submit" class="btn btn-default btn-sm float-right">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <br />

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        document.getElementById("button").style.display = "block";
        document.getElementById("spinner").style.display = "none";

        function mySubmit() {
            document.getElementById("button").style.display = "none";
            document.getElementById("spinner").style.display = "block";
        }

        function confirmaExcluir(value) {
            if(value == 1){
                var msg = "Deseja mesmo confirmar o pagamento?";
            } else if(value == 2){
                var msg = "Deseja mesmo excluir o paracela de pagamento?";
            } else {
                msg = "Deseja mesmo excluir o comprovante de pagamento em anexo?"
            }

            var conf = confirm(msg);

            if (conf) {
                return true;
            } else {
                return false;
            }
        }

        function moeda(i) {
            var v = i.value.replace(/\D/g, '');
            v = (v / 100).toFixed(2) + '';
            v = v.replace(".", ",");
            v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
            v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
            i.value = v;
        }

        //criação de mascara
        function mascara(t, mask) {
            var i = t.value.length;
            var saida = mask.substring(1, 0);
            var texto = mask.substring(i)
            if (texto.substring(0, 1) != saida) {
                t.value += texto.substring(0, 1);
            }
        }
    </script>
@stop
