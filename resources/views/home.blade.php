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

<!-- IMPRIMIR CHECK LIST INTERNACAO -->
<div id="imprimirChecklist">
    <div class="container text-center py-5 ">
            <div class="row row-cols-2">
                    <!-- img logo hospital-->
                    <div class="col-4 border border-dark"><img src="../logo-hospital.png" class="rounded" alt="..." id="IDlogo"style="width: 180px; padding:10px;"/></div>
                    <div class="col-8 border border-dark text-center pt-4">HOSPITAL DAS CLÍNICAS DR. MÁRIO RIBEIRO DA SILVEIRA</div>
                    <div class="col-12 border border-dark border-top-0">CHECK LIST INTERNAÇÃO DO PACIENTE</div>
                    <div class="col-12 border border-dark border-top-0"  >
                        <div class="row justify-content-between">
                                <div class="col-8 text-start" id="divChecklistName">
                                </div>
                                <div class="col-4 text-start" id="divChecklistAtendimento">
                                </div>
                        </div>
                    </div>
                        <div class="col-12 border border-dark border-top-0">
                            <div class="row justify-content-between">
                                <div class="col-8 text-start" id="divChecklistInternacaoDate">
                                </div>
                                <div class="col-4 text-start" id="divChecklistHora">
                                </div>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="container text-start mx-auto">
                <div class="row">
                    <div class="col-12 ">
                        <div class="form-check">
                            <input class="form-check-input border-dark" type="checkbox" value="" id="flexCheckChecked" >
                            <label class="form-check-label" for="flexCheckChecked">
                                Xerox (identidade, carteirinha do plano e/ou SUS)
                            </label>
                        </div>
                    </div>

                    <!-- Force next columns to break to new line at md breakpoint and up -->
                    <div class="w-100 d-none d-md-block"></div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input border-dark" type="checkbox" value="" id="flexCheckChecked" >
                            <label class="form-check-label" for="flexCheckChecked">
                                Folha de rosto com a identificação do paciente (dados pessoais)
                            </label>
                        </div>
                    </div>

                    <!-- Force next columns to break to new line at md breakpoint and up -->
                    <div class="w-100 d-none d-md-block"></div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input border-dark" type="checkbox" value="" id="flexCheckChecked" >
                            <label class="form-check-label" for="flexCheckChecked">
                                Cópia da guia de internação (AIH e pedido de internação)
                            </label>
                        </div>
                    </div>
                    <!-- Force next columns to break to new line at md breakpoint and up -->
                    <div class="w-100 d-none d-md-block"></div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input border-dark" type="checkbox" value="" id="flexCheckChecked" >
                            <label class="form-check-label" for="flexCheckChecked">
                                Termo de consentimento da internação
                            </label>
                        </div>
                    </div>
                    <!-- Force next columns to break to new line at md breakpoint and up -->
                    <div class="w-100 d-none d-md-block"></div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input border-dark" type="checkbox" value="" id="flexCheckChecked" >
                            <label class="form-check-label" for="flexCheckChecked">
                                Termo de consentimento da cirurgia
                            </label>
                        </div>
                    </div>
                    <!-- Force next columns to break to new line at md breakpoint and up -->
                    <div class="w-100 d-none d-md-block"></div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input border-dark" type="checkbox" value="" id="flexCheckChecked" >
                            <label class="form-check-label" for="flexCheckChecked">
                                Termo de consentimento e a avaliação pré anestésica
                            </label>
                        </div>
                    </div>
                    <!-- Force next columns to break to new line at md breakpoint and up -->
                    <div class="w-100 d-none d-md-block"></div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input border-dark" type="checkbox" value="" id="flexCheckChecked" >
                            <label class="form-check-label" for="flexCheckChecked">
                                Pulseira de identificação
                            </label>
                        </div>
                    </div>
                    <!-- Force next columns to break to new line at md breakpoint and up -->
                    <div class="w-100 d-none d-md-block"></div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input border-dark" type="checkbox" value="" id="flexCheckChecked" >
                            <label class="form-check-label" for="flexCheckChecked">
                                Ausência de adornos e/ou bolsas
                            </label>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-3">
                        <div class="p-2"><p class="text-start fs-7">Outras observações:</p><p class="text-break">________________________________________________________________________________________________________________________________________________________________</p></div>
                        <div class="p-2"><p class="text-start fs-7">Horário da comunicação com a enfermagem e responsável:  ____________________________ </p></div>
                        <div class="p-2"><p class="text-start fs-7">Funcionário da recepção:  __________________________________________________________</p></div>
                        <div class="p-2"><p class="text-start fs-7">Responsável pelo paciente:  ________________________________________________________</p></div>
                        <div class="p-2"><p class="text-start fs-7">Funcionário da enfermagem:  _______________________________________________________</p></div>
                    </div>

                </div>
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
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid d-inline p-10">
                <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="overview-wrap">
                                    <h5 class="title-5 d-flex justify-content-center">Lista de Atendimentos</h5>
                                        <div class="d-flex flex-row-reverse">
                                        </div>
                                </div>
                            </div>
                                <div class="col-lg-12">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Pacientes</h3>
                                        </div>
                                        <hr>
                                        <table id="list-pacientes" class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                <th scope="col">Codigo Atendimento</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Procedimento</th>
                                                <th scope="col">Mãe</th>
                                                <th scope="col">Setor</th>
                                                <th scope="col" style="justify-content: space-around;">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>

                </div>

            </div>
        </div>
    </div>

    <!-- IMPRESSAO AMBULATORIAL -->

        <div class="modal fade" id="printAmbulatorio" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="container ps-0 px-0 pt-0 pb-0 "style="width: 250px; height: 150px; padding: 0px;" id="Ambulatorio" >
                            <div class="card" id="card" >
                            <div class="card-header ps-0 px-0 pt-0 pb-0  border-white bg-white">
                            </div>
                            <div class="card-body ps-0 px-0 pt-0 pb-1">
                                    <div class="d-flex flex-row">
                                    <div class="d-flex z-3 bg-black flex-fill  "><h6 class="fw-bolder mt-2 text-center text-light Paciente">FERNANDO DE PINHO GOMES LEITE</h6></div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="p-0 fw-bolder Atendimento" style="height:16px;">ATENDIMENTO : 2974204</div>
                                        <div class="p-0 fw-bolder DataNascimento" style="height:16px;">NASCIMENTO: 05/07/1973</div>
                                        <div class="p-0 fw-bolder Medico" style="height:16px;">MÉDICO: ALESSANDRA LEITE PASQUALINI</div>
                                        <div class="pt-1 pb-1 fw-bolder NomeMae" style="height:18px;">NOME MAE: MAGDA DE PINHO GOMES LEITE</div>
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

     <!-- Modal PRESCRICAO -->
    <div id="printThis">
            <div class="modal top fade"
                id="modal-presc"
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
                                    <div id="TituloPresc"></div>
                                    <div id="Subtitulo">PRESCRIÇÃO AMBULATORIAL</div>
                                </div>
                                <div class="card-body ">
                                    <p class="text-start fw-medium p-20">D A D O S    D O    A T E N D I M E N T O</p>
                                    <div class="d-flex p-2 ">
                                        <div class="d-flex flex-column mb-3">
                                            <div class="p-1" id="NomePacientePresc"></div>
                                            <div class="p-2" id="CodigoAtendimentoPresc"></div>
                                            <div class="p-2" id="divCodigoPacientePresc"></div>
                                            <div class="p-1" id="divMaePresc"></div>

                                        </div>
                                    </div>
                                    <!-- IMAGEM INFO HILTON ROCHA-->
                                    <img src="../hillton-best.png" class="rounded" alt="..." id="img-info">
                                    <div class="d-flex justify-content-center" id="assinaturas">
                                        <div class="d-flex flex-column  mb-3"id="assinaturaPaciente" >
                                            <div class="p-1">_______________________________________________</div>
                                            <div class="p-1 text-center">ASSINATURA MEDICO</div>
                                        </div>
                                        <div class="d-flex flex-column  mb-3">
                                            <div class="p-1">_______________________________________________</div>
                                            <div class="p-1 text-center">ASSINATURA RESPONSAVEL - ENFERMAGEM</div>
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
    </div>

    <!-- IMPRIMIR TERMO DE RESPONSABILIDADE -->
<div id="PrintTerms">
    <div class="container text-center ">
        <div class="row border border-black">
          <div class="col-4  "><img src="../logo-hospital.png" class="rounded" alt="..." style="width: 180px; padding:10px;"></div>
          <div class="col-8 border-start border-black  pt-4"><span class="fw-bold">HOSPITAL DAS CLÍNICAS DR. MÁRIO RIBEIRO DA SILVEIRA</span></div>
        </div>
        <div class="row border border-black border-top-0 ">
          <div class="col-sm-12"><span class="fw-bold">TERMO DE RESPONSABILIDADE </span></div>
        </div>
        <div class="row border border-black border-top-0 border-bottom-0">
          <div class="col-sm-12 "><span class="fw-bold">IDENTIFICAÇÃO DO PACIENTE</span></div>
        </div>
        <div class="row border border-black">
          <div class="col-6 text-start PacienteTerms">Nome :</div>
          <div class="col-6 DataNascimentoTerms" >Data de Nascimento :</div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row border border-black border-top-0 border-bottom-0">
          <div class="col-6 text-start NomeMaeTerms">Mãe : </div>
          <div class="col-6 text-cemter NomePaiTerms">Pai : </div>
        </div>
        <div class="row border border-black">
          <div class="col-3 text-start CPFTerms">CPF : </div>
          <div class="col-3 RGTerms">RG :</div>
          <div class="col-6 EstCivilTerms">Estado Civil :</div>
        </div>
        <div class="row border border-black border-top-0 border-bottom-0">
          <div class="col-4 text-start DataInternacaoTerms">Data de Internação : </div>
          <div class="col-3 HoraTerms">Horário :</div>
          <div class="col-5 ConvenioTerms">Convênio :</div>
        </div>
        <div class="row border border-black">
          <div class="col-12 text-start MedicoTerms">Medico : </div>
        </div>
        <div class="row">
          <div class="col-12 text-center"> AUTORIZAÇÃO </div>
        </div>
        <div class="row border border-black">
          <p class="text-start lh-sm mt-2">Autorização para tratamento clinico e/ou cirurgico.Eu abaixo assinado autorizo o médico ou médicos assistentes do(a) paciente administrarem qualquer tratamento ou anestesicos, a realizarem as operações necessárias ou indicadas para diagnostico e tratamento do (a) paciente..</p>
        </div>
        <div class="row">
          <div class="col-12 text-center"> TERMO DE RESPONSABILIDADE </div>
        </div>
        <div class="row border border-black">
          <p class="text-justify lh-sm mt-2">O paciente ou resonsavel abaixo assinado declara estar ciente das disposições do <span class="fw-bold">Hospital das Clinicas Dr. Mario Ribeiro da Silveira</span>, com as quais concorda e autoriza os medicos fazerem as investigações necessárias para diagnostico e tratamento do paciente. Reconhece que em caso de abandono ou fuga premeditada do paciente acima,<span class="fw-bold"> NÃO </span> nenhuma responsabilidade medica ou legal ao hospital, podendo entretanto sua administração comunicar o fato as autoridades quando se fizer necessário. Esta ciente que o hospital <span class="fw-bold">NÃO </span> se responsabilizará de forma alguma por valores, (dinheiro, jóias, titulos, aparelhos etc), do paciente e/ou do seu acompanhante responsavel. Declara ainda que caso o atendimento seja pelo regime PARTICULAR ou CONVENIO, assumir perante ao Hospital das clinicas Dr. Mario Ribeiro da Silveira, toda a responsabilidade pelo pagamento das despesas hospitalares em acomodações especiais (APTO), estando também ciente do pagamento das despesas dos honorarios medicos conforme entendimento com o profissional medico responsavel peio paciente.</p>
        </div>
        <div class="row">
          <div class="col-12 text-center"> DECLARAÇÃO DE RESIDENCIA </div>
        </div>
        <div class="row border border-black ">
          <p class="text-start lh-sm mt-1"style="height: 5px;">Declaro para comprovação de residencia que o (a) sr (a),</p>
          <p  class="text-start" style="height: 5px;">inscrito no CPF sob o N°             é residente no seguinte endereço:</p>
          <p  class="text-start" style="height: 10px;">Logradouro:</p>
          <div class="row pt-0 pb-0 mb-0 mt-0" style="height: 20px;">
            <div class="col-6 text-start"><p>Bairro: </p> </div>
            <div class="col-6 text-center"><p  class="text-start">Complemento: </p></div>
          </div>
          <div class="row pt-0  pb-0 mb-0 "  style="height: 20px;">
            <div class="col-6 text-start"><p>Cidade:  </p> </div>
            <div class="col-6 text-center"><p  class="text-start">Estado: </p></div>
          </div>
          <p class="text-start">Declara ainda estar ciente de que a falsidade da presente declaração pode implicar em sanssoes civeis
            auministrativas e criminais previstas na legislaçao aplicavel, contorme a Lei. 7.115/83, e demais regis/agões
            vigentes.
            Montes Claros -MG</p>
        </div>
        <div class="row">
          <div class="col-12 text-end mt-3"> Montes Claros -MG ________/_______/________ </div>
        </div>
        <div class="row">
          <div class="col-12 text-center mt-5"> _______________________________________________________ </div>
          <div class="col-12 text-center mt-0"> Assinatura do paciente / responsável </div>
        </div>

        </div>
    </div>

<!-- Modal FICHA DE ANOTAÇÃO DE ENFERMAGEM -->
<div id="PrintAnotaEnfermagem" class="container-fluid">
    <div id="AnotaEnfermagem" class="container-fluid border-black small-font">
        <div class="d-flex">
            <div class="p-2 flex-shrink-1"><img src="../fhcr-logo.jpeg" class="rounded" alt="..." id="img-info" style="width: 90px; height:50px;"></div>
            <div class="p-2 w-100">
                <p class="text-center fw-bold pt-2">FICHA DE ANOTAÇÃO DE ENFERMAGEM</p>
            </div>
        </div>
        <div class="container-fluid text-center border border-black">
            <div class="row border-bottom border-black">
                <div class="col-12 bg-primary-subtle pt-1">
                    <p class="text-start fw-bold m-0">INFORMAÇÕES DO PACIENTE</p>
                </div>
            </div>
            <!-- Stack the columns on mobile by making one full-width and the other half-width -->
            <div class="row pt-2">
                <div class="col-6 text-start Paciente">Nome Completo: Glauber iury França Bomfim</div>
                <div class="col-6 text-start DataNascimento">Data Nascimento: 16/04/1997</div>
            </div>

            <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
            <div class="row  pt-2 pb-2">
                <div class="col-6 col-md-4 text-start Procedimento">PRONTUÁRIO: 2515485996</div>
                <div class="col-2 col-md-4 text-center Sexo">SEXO: MASCULINO</div>
                <div class="col-4 col-md-4 text-start Atendimento">ATENDIMENTO: 29588575 </div>
            </div>
        </div>
        <div class="container-fluid text-center border border-top-0 border-black">
            <div class="row border-bottom  bg-primary-subtle border-black">
                <div class="col-12 pt-1">
                    <p class="text-start fw-bold m-0">ASSISTÊNCIA DE ENFERMAGEM AMBULATORIAL</p>
                </div>
            </div>
            <!-- Stack the columns on mobile by making one full-width and the other half-width -->
            <div class="d-flex pt-2">
                <div class="pe-2 text-start"><p class="fw-bold">SETOR DE ATENDIMENTO:</p></div>
                <div class="pe-2">( ) REFRAÇÃO ( ) DEPARTAMENTO</div>
            </div>
            <div class="d-flex align-content-start flex-wrap  pt-2">
                <div class="row row-cols-auto">
                    <div class="col"><p class="fw-bold">DEPARTAMENTO,QUAL:</p></div>
                    <div class="col">( ) GLAUCOMA</div>
                    <div class="col">( ) RETINA</div>
                    <div class="col">( ) PLÁSTICA</div>
                    <div class="col">( ) CÓRNEA </div>
                    <div class="col">( ) ESTRABISMO</div>
                    <div class="col"> ( ) LENTE DE CONTATO</div>
                    <div class="col"> ( ) VSN E NEURO</div>
                    <div class="col">( ) RETORNO PÓS-CIRÚRGICO </div>
                </div>
            </div>
            <div class="d-flex flex-column pt-2">
                <div class="pe-2 text-start"><p class="fw-bold">PREPARAÇÃO PARA AVALIAÇÃO OFTALMOLÓGICA:</p></div>
                <div class="pe-2 text-start">( ) ACOLHIMENTO/ ORIENTAÇÃO DO EXAME OFTALMOLOGICO</div>
                <div class="pe-2 text-start">( ) DILATAÇÃO</div>
                <div class="pe-2 text-start">( ) AVALIAÇÃO REFRATOMETRICA</div>
                <div class="pe-2 text-start">( ) RETIRADA DE CURATIVO PÓS-CIRURGICO</div>
            </div>
            <div class="d-flex pt-2">
                <div class="pe-2 text-start"><p class="fw-bold">APÓS DILATAÇÃO NECESSITA DE ACOMPANHANTE:</p></div>
                <div class="pe-2">( ) SIM </div>
                <div class="pe-2">   ( ) NÃO</div>
            </div>
            <div class="d-flex flex-column pt-2">
                <div class="pe-2 text-start"><p class="fw-bold">RESTRIÇÃO PARA O EXAME OFTALMOLÓGICO:</p></div>
                <div class="pe-2 text-start">( ) SEM RESTRIÇÃO</div>
                <div class="pe-2 text-start">( ) USO DE LENTE DE CONTATO GELATINOSA NO DIA</div>
                <div class="pe-2 text-start">( ) USO DE LENTE DE CONTATO RÍGIDA NO DIA</div>
                <div class="pe-2 text-start">( ) OUTRO: _______________________________</div>
            </div>
            <div class="d-flex align-content-start flex-wrap  pt-2">
                <div class="pe-2 text-start"><p class="fw-bold">ORIENTAÇÕES PÓS-EXAME OFTALMOLOGICO:</p></div>
                <div class="pe-2 text-start">( ) PRESCRIÇÃO DO ENFERMEIRO</div>
                <div class="pe-2 text-start">( ) PRESCRIÇÃO DO OFTALMOLOGISTA</div>
            </div>
        </div>
        <div class="container-fluid text-center border border-top-0 border-black">
            <div class="row border-bottom border-black">
                <div class="col-12 bg-primary-subtle pt-1">
                    <p class="text-center fw-bold m-0">AVALIAÇÃO ESTADO GERAL</p>
                </div>
            </div>
            <div class="d-flex pt-2">
                <div class="pe-2 text-start"><p class="fw-bold">NIVEL DE CONSCIENCIA: </p></div>
                <div class="pe-2">( ) LUCIDA</div>
                <div class="pe-2">( ) ORIENTADA</div>
                <div class="pe-2"> ( ) DESORIENTADA</div>
            </div>
            <div class="d-flex pt-2">
                <div class="pe-2 text-start"><p class="fw-bold">NIVEL DE COMPORTAMENTO: </p></div>
                <div class="pe-2"> ( ) AGITACAO PSICOMOTORA</div>
                <div class="pe-2"> ( ) APATICO</div>
                <div class="pe-2"> ( ) SEM ALTERAÇÃO</div>
            </div>
            <div class="d-flex align-content-start flex-wrap pt-2">
                <div class="pe-2 text-start"><p class="fw-bold">MOBILIDADE: </p></div>
                <div class="pe-2"> ( ) DEAMBULANDO</div>
                <div class="pe-2"> ( ) AUXILIO DE CADEIRA DE RODAS</div>
                <div class="pe-2"> ( ) UTILIZA ANDADOR OU MULETAS</div>
                <div class="p-2"> ( ) NECESSITA DE ACOMPANHANTE</div>
                <div class="p-2"> ( ) OUTRO: _____</div>
            </div>

        </div>
        <div class="container-fluid text-center border border-top-0 border-black">
            <div class="row border-bottom border-black">
                <div class="col-12 bg-primary-subtle pt-1">
                    <p class="text-center fw-bold m-0">GESTAO DE RISCO</p>
                </div>
            </div>
            <div class="d-flex align-content-start flex-wrap pt-2">
                <div class="pe-2 text-start"><p class="fw-bold">IDENTIFICAÇÃO DO PACIENTE: </p></div>
                <div class="pe-2">( ) PULSEIRA </div>
                <div class="pe-2">( ) ETIQUETA</div>
                <div class="pe-2">( ) SEM IDENTIFICAÇÃO</div>
            </div>
            <div class="d-flex align-content-start flex-wrap pt-2">
                <div class="row row-cols-auto">
                    <div class="col text-start"><p class="fw-bold">RISCO DE QUEDA: </p></div>
                    <div class="col"> ( ) IDOSO</div>
                    <div class="col"> ( ) DEAMBULA COM AUXILIO</div>
                    <div class="col"> ( ) DIFICULDADE DE AMBULAÇÃO</div>
                    <div class="col"> ( ) USA MULETAS OU ANDADOR</div>
                    <div class="col"> ( ) CRIANÇA COM IDADE INFERIOR A 6 ANOS </div>
                    <div class="col"> OUTROS: ________</div>
                </div>
            </div>
            <div class="d-flex pt-2">
                <div class="pe-2 text-start"><p class="fw-bold">APRESENTA ALGUMA ALERGIA:</p></div>
                <div class="pe-2">( ) SIM </div>
                <div class="pe-2"> ( ) NÃO</div>
                <div class="pe-2"> ESPECIFICAR: ____________________</div>
            </div>
        </div>
        <div class="container-fluid text-center pt-5">
            <div class="row row-cols-auto">
                <div class="col-6"> ________________________________________</div>
                <div class="col-6"> ________________________________________</div>
                <div class="col-6 text-center fw-bold">Assinatura e carimbo da enfermagem </div>
                <div class="col-6 text-center fw-bold">Local e data</div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
    $(function(){
                listPacientes();
            });

            function listPacientes(){
            $('#list-pacientes').DataTable( {
                processing: true,
                //serverSide: true,
                autoWidth: true,
                "dom": '<"pull-right"f><"pull-left"l>tip',
                "language": {
                        "lengthMenu": "Exibindo _MENU_ registros por página",
                        "zeroRecords": "Nenhum registro",
                        "info": "Exibindo a página _PAGE_ de _PAGES_",
                        "infoEmpty": "Nenhum registro",
                        "infoFiltered": "(Exibindo _MAX_ resultados)",
                        "sSearch":       	"Pesquisar",
                        "oPaginate": {
                            "sFirst":    	"Primeira",
                            "sPrevious": 	"<",
                            "sNext":     	">",
                            "sLast":     	"Ultima"
                        },
                },
                ajax: {
                    url: "/atendimentos",
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'CD_ATENDIMENTO' },
                    { data: 'NM_PACIENTE' },
                    { data: 'PROCEDIMENTO'},
                    { data: 'NM_MAE'},
                    { data: 'DS_ORI_ATE'},
                    { data: null, render: function(data, idx, tp){
                        return '<div class="container">'
                                    +'<div class="row row-cols">'
                                        +'<div class="col pt-1d">'
                                            +'<a href="javascript:void(0)" onclick="imprimirPage('+data.CD_ATENDIMENTO+')" class="edit btn btn-primary btn-sm">'
                                                +'<i class="fa fa-edit" style="font-weight: bold; font-size: 12px;">Folha de Rosto</i>'
                                            +'</a>'
                                        +'</div>'
                                        +'<div class="col pt-1">'
                                            +'<a  href="javascript:void(0)" onClick="imprimirTerms('+data.CD_ATENDIMENTO+')"  class="btn btn-warning  btn-sm">'
                                                +'<i class="fa fa-edit">Termo de Responsabilidade</i>'
                                            +'</a>'
                                        +'</div>'
                                        +'<div class="col pt-1">'
                                            +'<a  href="javascript:void(0)" onClick="imprimirChecklist('+data.CD_ATENDIMENTO+')"  class="btn btn-dark  btn-sm">'
                                                +'<i class="fa fa-edit" style="font-weight: bold; font-size: 12px;">Checklist Internação</i>'
                                            +'</a>'
                                        +'</div>'
                                        +'<div class="col pt-1">'
                                            +'<a href="javascript:void(0)" onclick="imprimirPresc('+data.CD_ATENDIMENTO+')" class="btn btn-danger  btn-sm">'
                                                +'<i class="fa fa-edit" style="font-weight: bold; font-size: 12px;">Prescrição Ambulatorio</i>'
                                            +'</a>'
                                        +'</div>'
                                        +'<div class="col pt-1">'
                                            +'<a  href="javascript:void(0)" onClick="imprimirAmbulatorio('+data.CD_ATENDIMENTO+')"  class="btn btn-success  btn-sm">'
                                                +'<i class="fa fa-edit">Imprimir Etiqueta</i>'
                                            +'</a>'
                                        +'</div>'
                                        +'<div class="col pt-1">'
                                            +'<a  href="javascript:void(0)" onClick="imprimirEnfermagem('+data.CD_ATENDIMENTO+')"  class="btn btn-info  btn-sm">'
                                                +'<i class="fa fa-edit">Imprimir Enfermagem</i>'
                                             +'</a>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>';
                    }},
                ]
            });
            }

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

            // IMPRIMIR PRESCRICAO HILTON ROCHA
            function imprimirPresc(CD_ATENDIMENTO){
            $.ajax({
                url : "/atendimento/"+CD_ATENDIMENTO,
                type : 'get',
                beforeSend : function(){
                // chamar loading.
                }
            })
            .done(function(data){
                $("#CodigoAtendimentoPresc").html("Atendimento:   <span style='font-weight: bold'>"+data[0]['CD_ATENDIMENTO']+"</span>   DATA: <span style='font-weight: bold'>"+data[0]['DT_ATENDIMENTO']+" - "+data[0]['HR_ATENDIMENTO']+" </span> ");
                $("#NomePacientePresc").html("Nome:  <span style='font-weight: bold'>"+data[0]['NM_PACIENTE']+"</span>");
                $("#divCodigoPacientePresc").html("Codigo Paciente: <span style='font-weight: bold'>"+data[0]['CD_PACIENTE']+"</span>");
                $("#divMaePresc").html("Mae:  <span style='font-weight: bold'>"+data[0]['NM_MAE']+"</span>");
                $("#TituloPresc").html(data[0]['DS_MULTI_EMPRESA']);
                $("#modal-presc").modal('show');

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
            .fail(function(jqXHR, textStatus, msg){
                // chamar função de erro
                errormsg("Ocorreu um erro!!");
            });

            }

            // IMPRIMIR CHECKLIST
            function imprimirChecklist(CD_ATENDIMENTO){
            $.ajax({
                url : "/checklistrecep/"+CD_ATENDIMENTO,
                type : 'get',
                beforeSend : function(){
                // chamar loading.
                }
            })
            .done(function(data){
                $("#divChecklistName").html("Nome:  <span style='font-weight: bold'>"+data[0]['NM_PACIENTE']+"</span>");
                $("#divChecklistAtendimento").html("Nº Atendimento: <span style='font-weight: bold'>"+data[0]['CD_PACIENTE']+"</span>");
                $("#divChecklistInternacaoDate").html("Data da Internação:  <span style='font-weight: bold'>"+data[0]['DT_ATENDIMENTO']+"</span>");
                $("#divChecklistHora").html("Hora:  <span style='font-weight: bold'>"+data[0]['HR_ATENDIMENTO']+"</span>");
                $("#modal-checklist").modal('show');

                print();
                location.reload(true);
            })
            .fail(function(jqXHR, textStatus, msg){
                // chamar função de erro
                errormsg("Ocorreu um erro!!");
            });

            }

            // BOTÃO IMPRIMIR CHECK LIST

            $(document).on("click", "#btn-checklist", function () {
                $("#modal-checklist").modal('show');

            });



            //IMPRIMIR AMBULATORIO FICHA

            function imprimirAmbulatorio(CODIGO_SOLICITACAO) {
            $.ajax({
                url: "/atendimento/" + CODIGO_SOLICITACAO,
                type: 'get',
                beforeSend: function () {
                    // chamar loading.
                }
            })
            .done(function (data) {
                $(".Atendimento").html("Atendimento: <span style='font-weight: bold'>" + data[0]['CD_ATENDIMENTO'] + "</span>");
                $(".Paciente").html("<span style='font-weight: bold'; color: white;>" + data[0]['NM_PACIENTE'] + "</span>");
                $(".DataNascimento").html("Data de Nascimento: <span style='font-weight: bold'>" + data[0]['DT_NASCIMENTO'] + "</span>");
                $(".Medico").html("Med: <span style='font-weight: bold'>" + data[0]['NM_PRESTADOR'] + "</span>");
                $(".NomeMae").html("Mae:  <span style='font-weight: bold'>" + data[0]['NM_MAE'] + "</span>");
                $("#printAmbulatorio").modal('show');

                $('#printAmbulatorio').on('shown.bs.modal', function () {
                const element = document.getElementById("Ambulatorio");
                // Gerar PDF
                if (element) {
                    // Verifica se o elemento existe antes de ajustar suas dimensões
                    const labelWidth = 100; // Largura da etiqueta em mm
                    const labelHeight = 30; // Altura da etiqueta em mm

                    // Ajustar o tamanho da div para o tamanho do conteúdo
                    element.style.width = labelWidth + 'mm';
                    element.style.height = labelHeight + 'mm';

                    // Garantir que o conteúdo esteja disponível na hora de gerar o PDF
                    setTimeout(() => {
                        const options = {
                            margin: 0, // Margem zero
                            filename: 'etiquetas.pdf',
                            jsPDF: { unit: 'mm', format: [labelWidth, labelHeight], orientation: 'landscape' }
                        };

                        html2pdf().from(element).set(options).save();

                        // Redefinir o tamanho da div para exibir corretamente no modal após a geração do PDF
                        element.style.width = '';
                        element.style.height = '';
                    }, 100);
                }

                setTimeout(() =>{

                    $("#printAmbulatorio").modal('hide');
                    location.reload(true);
                }, 1500)
            });

            })
            .fail(function (jqXHR, textStatus, msg) {
                // chamar função de erro
                errormsg("Ocorreu um erro!!");
            });
        }

        function imprimirEnfermagem(CODIGO_SOLICITACAO) {
            $.ajax({
                url: "/atendimento/" + CODIGO_SOLICITACAO,
                type: 'get',
                beforeSend: function () {
                    // chamar loading.
                }
            })
            .done(function (data) {
                    $(".Atendimento").html("Atendimento: <span style='font-weight: bold'>" + data[0]['CD_ATENDIMENTO'] + "</span>");
                    $(".Paciente").html("<span style='font-weight: bold'; color: white;>" + data[0]['NM_PACIENTE'] + "</span>");
                    $(".DataNascimento").html("Data de Nascimento: <span style='font-weight: bold'>" + data[0]['DT_NASCIMENTO'] + "</span>");
                    $(".Sexo").html("Sexo: <span style='font-weight: bold'>"+data[0]['TP_SEXO']+"</span>");
                    $(".Procedimento").html("Procedimento:  <span style='font-weight: bold'>"+data[0]['PROCEDIMENTO']+"</span>");
                  // Get the content of the 'PrintAnotaEnfermagem' div
                    var content = $('#PrintAnotaEnfermagem').html();

                    // Open a new window
                    var newWindow = window.open('', '_blank');

                    // Create the HTML structure for the new window
                    var html = `
                    <html>
                        <head>
                        <title>Print Preview</title>
                        <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                        <link href="../EnfermagemPrint.css" rel="stylesheet" />
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
                        <!-- Include any other required CSS files -->
                        </head>
                        <body>
                            ${content}
                        </body>

                    </html>
                    `;

                    // Write the HTML content to the new window
                    newWindow.document.open();
                    newWindow.document.write(html);
                    newWindow.document.close();

                    setTimeout(function() {
                        newWindow.print();
                        newWindow.close();

                    }, 500);
            })
            .fail(function (jqXHR, textStatus, msg) {
                // chamar função de erro
                errormsg("Ocorreu um erro!!");
            });
        }

    function imprimirTerms(CODIGO_SOLICITACAO) {
        $.ajax({
            url: "/atendimento/" + CODIGO_SOLICITACAO,
            type: 'get',
            beforeSend: function () {
                // chamar loading.
            }
        })
            .done(function (data) {
                $(".PacienteTerms").html("Nome: <span style='font-weight: bold'; color: white;>" + data[0]['NM_PACIENTE']+"</span>");
                $(".NomeMaeTerms").html("Mae:  <span style='font-weight: bold'>" + data[0]['NM_MAE'] + "</span>");
                $(".NomePaiTerms").html("Pai:  <span style='font-weight: bold'>" + data[0]['NM_PAI'] + "</span>");
                $(".DataNascimentoTerms").html(" Data de Nascimento: <span style='font-weight: bold'>" + data[0]['DT_NASCIMENTO'] + "</span>");
                $(".CPFTerms").html("CPF: <span style='font-weight: bold'>" + data[0]['NR_CPF'] + "</span>");
                $(".RGTerms").html("RG: <span style='font-weight: bold'>" + data[0]['NR_IDENTIDADE'] + "</span>");
                $(".ConvenioTerms").html("Convênio: <span style='font-weight: bold'>" + data[0]['NM_CONVENIO'] + "</span>");
                $(".EstCivilTerms").html("Estado Civil: <span style='font-weight: bold'>" + data[0]['TP_ESTADO_CIVIL1'] + "</span>");
                $(".HoraTerms").html("Horário: <span style='font-weight: bold'>" + data[0]['HR_ATENDIMENTO'] + "</span>");
                $(".DataInternacaoTerms").html("Data Internação: <span style='font-weight: bold'>" + data[0]['DT_ATENDIMENTO'] + "</span>");
                $(".MedicoTerms").html("Médico: <span style='font-weight: bold'>" + data[0]['NM_PRESTADOR'] + "</span>");

                // Get the content of the 'PrintTerms' div
                var content = $('#PrintTerms').html();

                // Open a new window
                var newWindow = window.open('', '_blank');

                // Create the HTML structure for the new window
                var html = `
                    <html>
                        <head>
                        <title>Print Preview</title>
                        <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
                        <!-- Include any other required CSS files -->
                        </head>
                        <body>
                            ${content}
                        </body>

                    </html>
                    `;

                // Write the HTML content to the new window
                newWindow.document.open();
                newWindow.document.write(html);
                newWindow.document.close();

                setTimeout(function() {
                    newWindow.print();
                    newWindow.close();

                }, 500);
            })
            .fail(function (jqXHR, textStatus, msg) {
                // chamar função de erro
                errormsg("Ocorreu um erro!!");
            });
    }




    </script>
@endpush
