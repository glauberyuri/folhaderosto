@extends('layouts.app')

@section('title', 'CheckList Recepção')

@section('css')
  <link href="../ResponsableStyles.css" rel="stylesheet" />

@endsection
    
@push('script')
    <script>

    </script>
@endpush
@section('content')
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
      <div class="col-6 text-start">Nome :</div>
      <div class="col-6">Data de Nascimento :</div>
    </div>
</div>
<div class="container text-center">
    <div class="row border border-black border-top-0 border-bottom-0">
      <div class="col-6 text-start ">Mãe : </div>
      <div class="col-6 text-cemter">Pai : </div>
    </div>
    <div class="row border border-black">
      <div class="col-3 text-start">CPF : </div>
      <div class="col-3">RG :</div>
      <div class="col-6">Estado Civil :</div>
    </div>
    <div class="row border border-black border-top-0 border-bottom-0">
      <div class="col-3 text-start">Data de Internação : </div>
      <div class="col-3">Horário :</div>
      <div class="col-6">Convênio :</div>
    </div>
    <div class="row border border-black">
      <div class="col-12 text-start">Medico : </div>
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

@endsection
    {{-- <div class="container" style="max-width: 380px;" >
      <div class="card">
        <div class="card-header px-1 pt-1 pb-0 border-white bg-white">
          <div class="d-flex flex-row ">
            <div class="d-flex w-100">
              <div class="p-0 flex-fill"><h5 class="fw-bold  px-3 pt-3" >AMBULATÓRIO</h5></div>
              <div class="p-0 flex-fill" ><img src="../fhcr-logo.jpeg"style="width: 150px; height: 50px; padding: 0px;" alt="LOGO HOSPITAL DE OLHOS HILTON ROCHA" ></div>
            </div>
          </div>
        </div>
        <div class="card-body pt-0 px-2">
          <div class="d-flex flex-row">
            <div class="d-flex z-3 bg-black flex-fill "><h6 class="fw-bolder mt-2 text-center text-light">FERNANDO DE PINHO GOMES LEITE</h6></div>
          </div>
          <div class="d-flex flex-column">
            <div class="p-1">ATENDIMENTO : 2974204</div>
            <div class="p-1 ">NASCIMENTO: 05/07/1973</div>
            <div class="p-1 ">MÉDICO: ALESSANDRA LEITE PASQUALINI</div>
            <div class="p-1">NOME MAE: MAGDA DE PINHO GOMES LEITE</div>
          </div>
        </div>
      </div>
    </div> --}}