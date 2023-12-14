@extends('layouts.app')

@section('title', 'Lista de Farmácia')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link href="../integraStyle.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Resposta SOAP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-content">
                    <!-- A tabela será exibida aqui -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../logo-hospital.png" alt="Bootstrap" style="width: 150px; height:50px;" height="30">
                </a>
            </div>
        </nav>
    </header>
{{--    <div id="loading-container">
        <div class="centered">
            <div class="loading">
                <div></div>
            </div>
            <p>Aguarde... Estamos importando os dados</p>
        </div>
    </div>--}}
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid d-inline p-10">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header justify-items-center">
                            <div class="overview-wrap">
                                <h5 class="title-5 d-flex justify-content-center">Data para Importação</h5>
                            </div>
                            <div class="d-flex justify-content-center pt-2 pb-2">
                                <div class="input-group flex-nowrap w-auto gap-3 justify-content-between">
                                    <input type="date" class="form-control text-center rounded-3" id="id_dtIntegra" aria-label="Data para Integrar" aria-describedby="addon-wrapping" placeholder="DD/MM/AAAA">
                                    <button type="button" id="id_button" class="btn btn-primary border  border-black rounded-3">Listar Atendimentos</button>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Atendimentos para Importação</h3>
                                </div>
                                <hr>
                                <table id="list-request" class="table"  style="display: none;">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Codigo</th>
                                        <th scope="col">Paciente</th>
                                        <th scope="col">Medico</th>
                                        <th scope="col">CRM</th>
                                        <th scope="col">UF</th>
                                        <th scope="col">ESPECIALIDADE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="6" class="text-right">Total: <span id="total-records">0</span></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="row justify-content-end">
                                    <div class="col-2 pt-2">
                                        <button type="button" id="id_button_importar" class="btn btn-success border  border-black rounded-3 "data-toggle="modal" data-target="#myModal" style="display: none;">Importar Atendimentos</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var tabela;

        function listRequest(date) {
            tabela = $('#list-request').DataTable({
                // DataTable configuration options
                searching: false,
                paging: false,
                processing: true,
                info: false,
                ordering: false,
                autoWidth: true,
                destroy: true,
                footerCallback: function (row, data, start, end, display) {
                    // Callback function for updating the total records in the footer
                    var api = this.api();
                    var apiTotal = api.column(0, { page: 'current' }).data().length;
                    $('#total-records').text(apiTotal);
                },
                dom: '<"pull-right"f><"pull-left"l>tip',
                language: {
                    // DataTable language settings
                    lengthMenu: "Exibindo _MENU_ registros por página",
                    zeroRecords: "Nenhum registro",
                    info: "Exibindo a página _PAGE_ de _PAGES_",
                    infoEmpty: "Nenhum registro",
                    infoFiltered: "(Exibindo _MAX_ resultados)",
                    sSearch: "Pesquisar",
                    oPaginate: {
                        sFirst: "Primeira",
                        sPrevious: "<",
                        sNext: ">",
                        sLast: "Ultima"
                    },
                },
                ajax: {
                    // AJAX configuration for fetching data
                    url: "/date_integracao_list",
                    dataSrc: 'data',
                    data: function (d) {
                        // Add the date to the parameters sent to the server
                        d.date = date;
                    }
                },
                columns: [
                    // Define the columns for the DataTable
                    { data: 'CD_ATENDIMENTO' },
                    { data: 'NM_PACIENTE' },
                    { data: 'MEDICO' },
                    { data: 'CRM' },
                    { data: 'UFCONSELHO' },
                    { data: 'ESPECIALIDADE' }
                ]
            });
        }


        $('#id_button').click(function(){
            try {
                $('#list-request').show();
                dataInput = $('#id_dtIntegra').val();
                listRequest(dataInput);
                $('#id_button_importar').show();
            } catch (error) {
                alert('An error occurred: ' + error.message);
            }
        });

        $('#id_button_importar').click(function () {
            try {
                // Obtém todos os dados da DataTable
                var dados = tabela.rows().data().toArray();
                // Chama a função para importar atendimentos e passa os dados
                importarAtendimentos(dados);

            } catch (error) {
                alert('An error occurred: ' + error.message);
            }
        });
        function importarAtendimentos(dados) {
            var xml = "<loteInternacao>";

            for (var i = 0; i < dados.length; i++) {
                var internacao = dados[i];

                // Verificar se as datas não são nulas ou indefinidas
                if (internacao['DT_NASCIMENTO'] && internacao['ALTAHOSPITALAR'] && internacao['DT_ATENDIMENTO']) {
                    var DT_NASCIMENTO = new Date(internacao['DT_NASCIMENTO']);
                    var ALTAHOSPITALAR = new Date(internacao['ALTAHOSPITALAR']);
                    var DT_ATENDIMENTO = new Date(internacao['DT_ATENDIMENTO']);

                    const dataNascimentoFormatada = formatarDataParaXML(DT_NASCIMENTO);
                    const dataInternacaoFormatada = formatarDataParaXML(DT_ATENDIMENTO);
                    const dataAltaFormatada = formatarDataParaXML(ALTAHOSPITALAR);

                    var CID_PRINCIPAL = (internacao['CID'] == null) ? internacao['CID_MAE'] : internacao['CID'];
                    var PESOATUAL = (internacao['STATUSRN'] == 'S' && internacao['RNPESO'] == 0) ? 251 : internacao['RNPESO'];
                    var rnSection = (internacao['STATUSRN'] == 'S') ? `<Rn>
                <pesoNascimento>${PESOATUAL}</pesoNascimento>
            </Rn>` : "";

                    xml += `
            <Internacao>
                <situacao>3</situacao>
                <caraterInternacao>${internacao['TP_CARATER_INTERNACAO']}</caraterInternacao>
                <numeroAtendimento>${internacao['CD_ATENDIMENTO']}</numeroAtendimento>
                <numeroAutorizacao></numeroAutorizacao>
                <dataInternacao>${dataInternacaoFormatada}</dataInternacao>
                <dataAlta>${dataAltaFormatada}</dataAlta>
                <condicaoAlta>${internacao['MOTIVOALTA']}</condicaoAlta>
                <dataAutorizacao>${dataInternacaoFormatada}</dataAutorizacao>
                <codigoCidPrincipal>${CID_PRINCIPAL}</codigoCidPrincipal>
                <Hospital>
                    <codigo>7595</codigo>
                    <nome>HOSPITAL DAS CLINICAS DR. MARIO RIBEIRO DA SILVEIRA</nome>
                    <cnes>7366108</cnes>
                    <porte>2</porte>
                    <complexidade>2</complexidade>
                    <esferaAdministrativa>3</esferaAdministrativa>
                    <uf>MG</uf>
                    <cidade>2065</cidade>
                    <tipoLogradouro>RUA</tipoLogradouro>
                    <logradouro>PLINIO RIBEIRO</logradouro>
                    <numeroLogradouro>539</numeroLogradouro>
                    <complementoLogradouro></complementoLogradouro>
                    <bairro>JARDIM BRASIL</bairro>
                    <cep>39401222</cep>
                </Hospital>
                <Beneficiario>
                    <dataNascimento>${dataNascimentoFormatada}</dataNascimento>
                    <sexo>${internacao['SEXO']}</sexo>
                    <particular>N</particular>
                    <recemNascido>${internacao['STATUSRN']}</recemNascido>
                    <uf>${internacao['UF']}</uf>
                    <logradouro>${internacao['RUA']}</logradouro>
                    <numeroLogradouro>${internacao['NUMERO']}</numeroLogradouro>
                    <complementoLogradouro>${internacao['DS_COMPLEMENTO']}</complementoLogradouro>
                    <bairro>${internacao['BAIRRO']}</bairro>
                    <cep>${internacao['NR_CEP']}</cep>
                </Beneficiario>
                <Operadora>
                    <codigo>293</codigo>
                    <plano>${internacao['NM_CONVENIO']}</plano>
                    <numeroCarteira>${internacao['CNS']}</numeroCarteira>
                </Operadora>
                <Medico>
                    <nome>${internacao['MEDICO']}</nome>
                    <uf>${internacao['UFCONSELHO']}</uf>
                    <crm>${internacao['CRM']}</crm>
                    <especialidade>${internacao['ESPECIALIDADE']}</especialidade>
                    <medicoResponsavel>S</medicoResponsavel>
                </Medico>
                ${rnSection}
            </Internacao>`;
                } else {
                    console.error('Valores de data inválidos para a internação:', internacao);
                }
            }

            xml += "</loteInternacao>";

            chamarSOAP(xml)

            // Adicione a lógica para enviar dados para o servidor, se necessário
            // ...
        }

        function formatarDataParaXML(data) {
            var ano = data.getFullYear();
            var mes = pad(data.getMonth() + 1, 2);
            var dia = pad(data.getDate(), 2);
            var horas = pad(data.getHours(), 2);
            var minutos = pad(data.getMinutes(), 2);
            var segundos = pad(data.getSeconds(), 2);

            return `${ano}-${mes}-${dia}T${horas}:${minutos}:${segundos}`;
        }

        function pad(number, length) {
            var str = '' + number;
            while (str.length < length) {
                str = '0' + str;
            }
            return str;
        }

        function chamarSOAP(xml) {

            showLoading();

            // Dados para a chamada SOAP
            var soapData = xml; // Substitua xml pela sua string XML

            // Requisição AJAX para o servidor PHP
            $.ajax({
                url: '/integraajax', // Substitua pelo caminho do seu script PHP
                type: 'post',
                dataType: 'json', // Espera-se um JSON como resposta
                data: {
                    soapData: soapData
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Exibe o modal com a resposta SOAP
                    exibirModal(response);
                },
                error: function (error) {
                    console.error('Erro na chamada SOAP:', error);
                },
                complete: function () {
                    // Hide loading overlay after the AJAX call is complete (success or error)
                    hideLoading();
                }
            });
        }



        function exibirModal(response) {
            var listaContainer = document.getElementById('modal-content');
            listaContainer.innerHTML = '';

            var dadosSoap = response.data; // Ajuste conforme a estrutura do seu JSON

            var lista = document.createElement('ul');
            lista.className = 'list-group';

            for (var i = 0; i < dadosSoap.Internacao.length; i++) {
                var internacao = dadosSoap.Internacao[i];
                var listItem = document.createElement('li');
                listItem.className = 'list-group-item';

                var itemContent = document.createElement('div');

                // Adicione propriedades da internação como itens à lista
                for (var prop in internacao) {
                    if (internacao.hasOwnProperty(prop)) {
                        var itemText = document.createElement('p');
                        itemText.textContent = prop + ': ' + internacao[prop];
                        itemContent.appendChild(itemText);
                    }
                }

                listItem.appendChild(itemContent);
                lista.appendChild(listItem);
            }

            listaContainer.appendChild(lista);
            $('#myModal').modal('show');
        }
    </script>

@endpush
