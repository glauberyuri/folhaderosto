@extends('layouts.app')

@section('title', 'Lista de Atendimentos')

@section('css')
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
        <link href="../HomeStyles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endsection

@section('content')


    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../logo-hospital.png" alt="Bootstrap" style="width: 150px; height:50px;" height="30">
                </a>
            </div>
        </nav>
    </header>
    <div class="main-content vh-100">
        <div class="section__content section__content--p30">
            <div class="container d-flex justify-content-center pt-5">
                <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="overview-wrap">
                                    <h5 class="title-5 d-flex justify-content-center">Relatorios Folha de rosto</h5>
                                        <div class="d-flex flex-row-reverse">
                                        </div>
                                </div>
                            </div>
                                <div class="col-lg-12">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Folha de rosto</h3>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-center pt-2 pb-2">
                                            <div class="input-group flex-nowrap w-auto ">
                                                <input type="text" class="form-control" id="id_request" aria-label="Username" aria-describedby="addon-wrapping" placeholder="Codigo Atendimento">
                                                <button type="button" id="id_button" class="btn btn-primary border  border-black border-2">Imprimir Atendimento</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Modal FOLHA DE ROSTO -->
    <div class="modal top fade"
            id="modal-atendimento"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
            data-mdb-backdrop="true"
            data-mdb-keyboard="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border-dark mx-auto p-2 mb-3 w-100 gap-3" style="max-width: 100rem;">
                        <div class="text-center">
                            <!-- <img src="../logo-hospital.png" class="rounded" alt="..." id="IDlogo"style="width: 400px;"> -->
                            <div id="Titulo"></div>
                        </div>
                        <div class="card-body ">
                            <p class="text-center fw-medium p-20">D A D O S    D O    A T E N D I M E N T O</p>
                            <div class="d-flex p-2 ">
                                <div class="d-flex flex-column mb-3">
                                    <div class="p-2">
                                        <p class="card-text lh-base" id="CodigoAtendimento"></p>
                                    </div>
                                    <div class="p-1" id="divProcedimento"></div>
                                    <div class="p-1" id="NomeUsuario"></div>
                                    <div class="p-1" id="divConvenio"></div>
                                    <div class="p-1" id="NomePaciente"></div>
                                    <div class="p-1" id="divOrigem"></div>
                                    <div class="p-1" id="divMedico"></div>

                                </div>

                            </div>
                            <p class="text-center fw-medium p-20">D A D O S    D O    P A C I E N T E</p>
                            <div class="d-flex p-2 ">
                                <div class="d-flex flex-column mb-3">

                                    <div class="p-1" id="NomePaciente"></div>
                                    <div class="p-1" id="divDoc"></div>
                                    <div class="p-1" id="divIdade"></div>
                                    <div class="p-1" id="divMae"></div>
                                    <div class="p-1" id="divEstado"></div>
                                    <div class="p-1" id="divComplemento"></div>
                                    <div class="p-1" id="divEndereco"></div>
                                    <div class="p-1" id="divCEP"></div>
                                    <div class="p-1" id="divTelefone"></div>

                                </div>

                            </div>
                            <p class="text-center fw-medium p-20">DADOS DO RESPONSAVEL</p>
                            <div class="d-flex p-2 ">
                                <div class="d-flex flex-column mb-3">

                                    <div class="p-1" id="NomeResponsavel"></div>
                                    <div class="p-1" id="divEstadoResp"></div>
                                    <div class="p-1" id="divDocResp"></div>
                                    <div class="p-1" id="divEnderecoResp"></div>
                                    <div class="p-1" id="divBairroResp"></div>
                                    <div class="p-1" id="divTelefoneResp"></div>



                                </div>

                            </div>
                            <p class="text-end fs-5 fw-light" id="DataAtual"></p>
                            <div class="d-flex justify-content-center" id="assinaturas">
                                <div class="d-flex flex-column  mb-3"id="assinaturaPaciente" >
                                    <div class="p-1">_______________________________________________</div>
                                    <div class="p-1 text-center">Paciente / Responsavel</div>
                                </div>
                                <div class="d-flex flex-column  mb-3">
                                    <div class="p-1">_______________________________________________</div>
                                    <div class="p-1 text-center">Atendente</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script>
        $('#id_button').click(function(){
            try {
                let id = $('#id_request').val();
                imprimirPage(id);
            } catch (error) {
                alert('An error occurred: ' + error.message);
            }
        })

            function imprimirPage(CD_ATENDIMENTO){
            $.ajax({
                url : "/atendimento/"+CD_ATENDIMENTO,
                type : 'get',
                beforeSend : function(){
                // chamar loading.
                }
            })
            .done(function(data){
                $("#CodigoAtendimento").html("Atendimento:   <span style='font-weight: bold'>"+data[0]['CD_ATENDIMENTO']+"</span>   DATA: <span style='font-weight: bold'>"+data[0]['DT_ATENDIMENTO']+" - "+data[0]['HR_ATENDIMENTO']+" </span> &nbsp &nbsp  Codigo Paciente: <span style='font-weight: bold'>"+data[0]['CD_PACIENTE']+"</span>");
                $("#divProcedimento").html("Procedimento:  <span style='font-weight: bold'>"+data[0]['PROCEDIMENTO']+"</span>");
                $("#NomePaciente").html("Nome:  <span style='font-weight: bold'>"+data[0]['NM_PACIENTE']+"</span>");
                $("#NomeUsuario").html("USUARIO: <span style='font-weight: bold'>"+data[0]['NM_USUARIO']+"</span>");
                if (typeof data[0]['CNS'] == "undefined")
                    {
                        $("#divConvenio").html("Convenio: <span style='font-weight: bold'>"+data[0]['NM_CONVENIO']+"</span> &nbsp  <span style='font-weight: bold'>Plano:  "+data[0]['PLANO']+"</span>"+"&nbsp &nbsp "+"<span style='font-weight: bold'>Matricula:  "+data[0]['CNS']+"</span>")
                    }

                    if (typeof data[0]['CNS'] != "undefined")
                    {
                        $("#divConvenio").html("Convenio: <span style='font-weight: bold'>"+data[0]['NM_CONVENIO']+"</span> &nbsp  <span style='font-weight: bold'>Plano:  "+data[0]['PLANO']+"</span>"+"&nbsp &nbsp "+"<span style='font-weight: bold'>Matricula: "+data[0]['CNS_NOVA']+"</span>");
                }
                $("#divOrigem").html("Origem Atendimento:  <span style='font-weight: bold'>"+data[0]['DS_ORI_ATE']+"</span>");
                $("#divMedico").html("Medico: <span style='font-weight: bold'> "+data[0]['NM_PRESTADOR']+"</span>");
                $("#divIdade").html("Sexo: <span style='font-weight: bold'>"+data[0]['TP_SEXO']+"</span>  Data de Nascimento: <span style='font-weight: bold'> "+data[0]['DT_NASCIMENTO']+"</span>  Idade: <span style='font-weight: bold'>"+data[0]['IDADE']+"</span>");
                $("#divMae").html("Mae:  <span style='font-weight: bold'>"+data[0]['NM_MAE']+"</span>");
                $("#divEstado").html("Estado Civil: <span style='font-weight: bold'> "+data[0]['TP_ESTADO_CIVIL1']+"</span>");
                $("#divComplemento").html("Endereço: <span style='font-weight: bold'> "+data[0]['DS_ENDERECO']+"     "+data[0]['NR_ENDERECO']+"      "+data[0]['DS_COMPLEMENTO']+"</span>")
                $("#divCEP").html("CEP:  <span style='font-weight: bold'>"+data[0]['NR_CEP']+"</span>");
                $("#divDoc").html("Documento Identidade:  <span style='font-weight: bold'>"+data[0]['NR_IDENTIDADE']+"</span>  <span style='font-weight: bold'> CPF: "+data[0]['NR_CPF']+"</span>");
                $("#divEndereco").html(" Bairro: <span style='font-weight: bold'>"+data[0]['NM_BAIRRO']+"</span>  Cidade: <span style='font-weight: bold'>"+data[0]['NATURALIDADE']+"</span>");
                $("#divTelefone").html("Telefone:<span style='font-weight: bold'> "+data[0]['NR_FONE']+"</span>");
                $("#Titulo").html(data[0]['DS_MULTI_EMPRESA']);
                $("#NomeResponsavel").html("Nome: <span style='font-weight: bold'>"+data[0]['NM_RESPONSAVEL']+"</span>");
                $("#divEstadoResp").html("Estado Civil : <span style='font-weight: bold'>"+data[0]['RESP_EST']+"</span>");
                $("#DataAtual").html("<span style='font-weight: bold'>"+data[0]['DT_ATENDIMENTO']+"</span>");
                $("#divNaturalidadeResp").html("Naturalidade:");
                $("#divDocResp").html("Documento Identidade: <span style='font-weight: bold'> "+data[0]['DS_DOCUMENTO_RESPONSAVEL']+"</span>   CPF: <span style='font-weight: bold'>"+data[0]['NR_CPF_RESP']+"</span>");
                $("#divEnderecoResp").html("Endereco: <span style='font-weight: bold'> "+data[0]['DS_ENDERECO_RESP']+"    "+data[0]['NR_ENDERECO_RESPONSAVEL']+"      "+data[0]['DS_COMPLEMENTO_RESPONSAVEL']+"</span>");
                $("#divTelefoneResp").html("Telefone: <span style='font-weight: bold'> "+data[0]['NR_FONE_RESPONSAVEL']+"</span>");
                $("#modal-imprimir").modal('show');

                let style = "<style>"
                style += "#Titulo{padding: 100px 90px; font-weight:bold; text-align:center;} "
                style += "#assinaturas {text-align:center;} "
                style += "#DataAtual {text-align:end;} "
                style += "#assinaturaPaciente {padding: 50px 70px;} "
                style += "#IDlogo {padding: 40px 50px;} "
                style += "</style>";

                var print_ = document.getElementById("modal-atendimento");
                win = window.open("");
                win.document.write(style);
                win.document.write(print_.outerHTML);
                win.print();
                location.reload(true);
                win.close();
            })
            .fail(function(jqXHR, textStatus, msg){
                // chamar função de erro
                errormsg("Ocorreu um erro!!");
            });

            }

            // BOTÃO IMPRIMIR FOLHA DE ROSTO
            const btn_imp = document.getElementById("btn-imp");

            btn_imp.addEventListener("click", (evt) =>{
                $("#btn-imp").remove();

                let style = "<style>"
                style += "#Titulo{padding: 100px 90px; font-weight:bold; text-align:center;} "
                style += "#assinaturas {text-align:center;} "
                style += "#DataAtual {text-align:end;} "
                style += "#assinaturaPaciente {padding: 50px 70px;} "
                style += "#IDlogo {padding: 40px 50px;} "
                style += "</style>";

                var print_ = document.getElementById("modal-atendimento");
                win = window.open("");
                win.document.write(style);
                win.document.write(print_.outerHTML);
                win.print();
                location.reload(true);
                win.close();
            })

            // BOTÃO IMPRIMIR PRESCRICAO
            const btn_presc = document.getElementById("btn-impPresc");

                    btn_presc.addEventListener("click", (evt) =>{

                    let style = "<style>"
                    style += "#TituloPresc{padding: 10px 90px; font-weight:bold; text-align:center;} "
                    style += "#Subtitulo{padding: 20px 90px; font-weight:bold; text-align:center;} "
                    style += "#assinaturas {text-align:center;} "
                    style += "#DataAtual {text-align:end;} "
                    style += "#assinaturaPaciente {padding: 50px 70px;} "
                    style += "#divMaePresc {padding-bottom: 50px;} "
                    style += "#IDlogo {padding: 40px} "
                    style += "#img-info { display: block; margin-left: auto;margin-right: auto; width: 70%; }"
                    style += "</style>";

                    var print_ = document.getElementById("modal-presc");
                    win = window.open("");
                    win.document.write(style);
                    win.document.write(print_.outerHTML);
                    win.print();
                    location.reload(true);
                    win.close();
                })


            //botão voltar -> reaload
            const btn_close = document.getElementById("btn-close");

            btn_close.addEventListener("click", (evt) =>{

                $("#modal-imprimir").modal('hide');
                location.reload(true);
            })



            //botão PRESCRICAO voltar -> reaload
            const btn_close_presc = document.getElementById("btn-closePresc");

            btn_close_presc.addEventListener("click", (evt) =>{

                $("#modal-presc").modal('hide');
                location.reload(true);
            })




    </script>
@endpush
