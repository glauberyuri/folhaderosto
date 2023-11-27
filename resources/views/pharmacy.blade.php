@extends('layouts.app')

@section('title', 'Lista de Farmácia')

@section('css')
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
        <link href="../PharmacyStyles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endsection

@section('content')
        <div class="modal fade" id="printAmbulatorio" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="container ps-0 px-0 pt-0 pb-3 "style="width: 380px; height: 170px; padding: 0px;" id="Ambulatorio" >
                            <div class="card h-100" id="card" >
                                <div class="card-header p-0 border-white bg-white">
                                    <div class="d-flex flex-fill">
                                        <div class="flex-shrink-1"><img src="../logo-hospital.png" class="rounded" alt="..." id="IDlogo"style="width: 80px; height: 50px;"> </div>
                                        <div class=" d-flex align-items-start flex-column p-0 w-100">
                                            <p class="p-0 m-0 text-center" style=" font-weight: bold; font-size: 16px;">Hospital das Clínicas Dr. Mario Ribeiro</p>
                                            <div class="d-flex p-0">
                                                <div class="p-0 flex-fill"> <p class="ps-1 m-0 text-center" style="font-size: 15px;">Presc: <span class="presc"></span></p></div>
                                                <div class="p-0 flex-fill"><p class="ps-1 m-0 text-center" style="font-size: 15px;">Solic: <span class="solic"></span></p></div>
                                            </div>
                                            <div class="d-flex p-0">
                                                <div class="p-0 flex-fill "> <p class="ps-1 m-0 text-center" style="font-size: 15px;">DN: <span class="dn"></span></p></div>
                                                <div class="p-0 flex-fill "> <p class="ps-2 m-0 text-center" style="font-size: 15px;">Idade: <span class="idade"></span></p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0 m-0">
                                        <div class="d-flex flex-column p-0 m-0">
                                            <div class="d-flex p-0">
                                                <div class="p-0 flex-fill "> <p class="ps-1 m-0 text-center turno" style="font-size: 15px;">Turno: <span style='font-weight: bold'> Dia </span></p></div>
                                                <div class="p-0 flex-fill "> <p class="ps-2 m-0 text-center" style="font-size: 15px;"><span class="Atendimento"></span></p></div>
                                                <div class="p-0 flex-fill "> <p class="ps-2 m-0 text-center " style="font-size: 15px;">Data: <span class="data"></span></p></div>
                                            </div>
                                            <div class="p-0 flex-fill"> <p class="ps-2 m-0 text-start paciente" style="font-size: 18px;"></p></div>
                                            <div class="d-flex p-0">
                                                <div class="p-0 flex-fill"> <p class="ps-1 m-0 text-center " style="font-size: 15px;"><span class="setor"></span></p></div>
                                                <div class="p-0 flex-fill"> <p class="ps-2 m-0 text-center " style="font-size: 15px;">Leito:<span class="leito"></span></div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="container ps-0 px-0 pt-4 pb-0"style="width: 380px; height: 170px; padding: 0px;" id="Ambulatorio" >
                            <div class="card h-100" id="card" >
                                <div class="card-header p-0 border-white bg-white">
                                    <div class="d-flex flex-fill">
                                        <div class="flex-shrink-1"><img src="../logo-hospital.png" class="rounded" alt="..." id="IDlogo"style="width: 80px; height: 50px;"> </div>
                                        <div class=" d-flex align-items-start flex-column p-0 w-100">
                                            <p class="p-0 m-0 text-center" style=" font-weight: bold; font-size: 16px;">Hospital das Clínicas Dr. Mario Ribeiro</p>
                                            <div class="d-flex p-0">
                                                <div class="p-0 flex-fill"> <p class="ps-1 m-0 text-center" style="font-size: 15px;">Presc: <span class="presc"></span></p></div>
                                                <div class="p-0 flex-fill"><p class="ps-1 m-0 text-center" style="font-size: 15px;">Solic: <span class="solic"></span></p></div>
                                            </div>
                                            <div class="d-flex p-0">
                                                <div class="p-0 flex-fill "> <p class="ps-1 m-0 text-center" style="font-size: 15px;">DN: <span class="dn"></span></p></div>
                                                <div class="p-0 flex-fill "> <p class="ps-2 m-0 text-center" style="font-size: 15px;">Idade: <span class="idade"></span></p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0 m-0">
                                    <div class="d-flex flex-column p-0 m-0">
                                        <div class="d-flex p-0">
                                            <div class="p-0 flex-fill "> <p class="ps-1 m-0 text-center turno" style="font-size: 15px;">Turno: <span style='font-weight: bold'> Noite </span></p></div>
                                            <div class="p-0 flex-fill "> <p class="ps-2 m-0 text-center" style="font-size: 15px;"><span class="Atendimento"></span></p></div>
                                            <div class="p-0 flex-fill "> <p class="ps-2 m-0 text-center " style="font-size: 15px;">Data: <span class="data"></span></p></div>
                                        </div>
                                        <div class="p-0 flex-fill"> <p class="ps-2 m-0 text-start paciente" style="font-size: 18px;"></p></div>
                                        <div class="d-flex p-0">
                                            <div class="p-0 flex-fill"> <p class="ps-1 m-0 text-center " style="font-size: 15px;"><span class="setor"></span></p></div>
                                            <div class="p-0 flex-fill"> <p class="ps-2 m-0 text-center " style="font-size: 15px;">Leito:<span class="leito"></span></div>
                                        </div>
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
<div id="printPage">

    <div id="printSolicitacao">
            <header>
                <nav class="navbar bg-body border-dark border-bottom">
                    <div class="container text-center">
                        <div class="d-flex justify-content-start">
                            <div class="p-2">SOULMV</div>
                        </div>
                        <div class="d-flex justify-content-start">
                            <div class="p-2">Solicitação de Produtos</div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="p-2" id="emitido"></div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="p-2" id="dataPedido">EM: 05/07/2023 14:40</div>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="container">
                <div class="d-flex justify-content-between ">
                    <div class="p-2" id="solicitacao"><b>Solicitação: 5330414</b></div>
                    <div class="p-2" id="dataHora">Data: 05/07/2023 14:40</div>
                    <div class="p-2" id="usuario">Usuario: FERNANDA.SANTANA</div>
                </div>
                <div class="d-flex justify-content-between ">
                    <div class="p-2" id="atendimento">Atendimento: 2952837</div>
                    <div class="p-2" id="paciente">Paciente: MARLENE DOS SANTOS PAIXAO</div>
                    <div class="p-2" id="idade">Idade: 61</div>
                </div>
                <div class="d-flex justify-content-between ">
                    <div class="p-2" id="estoque">Estoque: 65 - FARMACIA CENTRAL HCMR</div>
                    <div class="p-2" id="empresa">EMPRESA: HOSPITAL DR MARIO RIBEIRO DA SILV</div>
                </div>
                <div class="d-flex justify-content-between ">
                    <div class="p-2" id="setor">SETOR: 295 - INTERNAÇÃO CLINICA MEDICA HCMR</div>
                    <div class="p-2" id="unidade">Unid.int: 24 - INTERNAÇÃO CLINICA MEDICA </div>
                </div>
                <div class="d-flex justify-content-between ">
                    <div class="p-2" id="prestador">Prestador: 6603 - ANDRE ZUBA SILVEIRA</div>
                    <div class="p-2" id="leitos">Leito: 01.02 </div>
                </div>
            </div>
            <div class="div-container border-black border-top">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Unidade</th>
                        <th scope="col">Qt Solicit</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider" id="foreach-product">

                    </tbody>
                </table>
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
                        <div class="card-header justify-items-center">
                            <div class="overview-wrap">
                                <h5 class="title-5 d-flex justify-content-center">Codigo Solicitação</h5>
                            </div>
                            <div class="d-flex justify-content-center pt-2 pb-2">
                                <div class="input-group flex-nowrap w-50 ">
                                    <input type="text" class="form-control" id="id_request" aria-label="Username" aria-describedby="addon-wrapping" placeholder="Codigo Solicitação">
                                    <button type="button" id="id_button" class="btn btn-primary border  border-black border-2">Imprimir Solicitação</button>
                                    <button type="button" id="id_buttonEtiqueta" class="btn btn-danger border  border-black border-2">Imprimir Etiqueta</button>
                                </div>
                            </div>

                        </div>
                            <div class="col-lg-12">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Produtos Solicitados</h3>
                                    </div>
                                    <hr>
                                    <table id="list-request" class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Codigo</th>
                                                <th scope="col">Usuário</th>
                                                <th scope="col">Paciente</th>
                                                <th scope="col">Hora Solicitação</th>
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
@endsection

@push('scripts')
    <script>
        $(function(){
            listRequest();
        });

        function listRequest(){

            $('#list-request').DataTable( {
                searching: false,
                paging: false,
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
                    url: "/pharmacy_requests",
                    dataSrc: 'data'
                },
                columns: [

                    { data: 'CODIGO_SOLICITACAO' },
                    { data: 'SOLICITADO_POR' },
                    { data: 'PACIENTE'},
                    { data: 'HORA_PEDIDO'},
                    { data: 'SETOR_SOLICITANTE'},
                    { data: null, render: function(data, idx, tp){
                        return '<div class="container">'
                                    +'<div class="row row-cols-auto">'
                                        +'<div class="col p-1">'
                                            +'<a href="javascript:void(0)" onclick="imprimirPage('+data.CODIGO_SOLICITACAO+')" class="btn btn-primary  btn-sm">'
                                                +'<i class="fa fa-edit">Imprimir Solicitação</i>'
                                            +'</a>'
                                        +'</div>'
                                        +'<div class="col pt-1">'
                                            +'<a  href="javascript:void(0)" onClick="imprimirEtiquetaDia('+data.CODIGO_SOLICITACAO+')"  class="btn btn-danger  btn-sm">'
                                                +'<i class="fa fa-edit">Imprimir Etiqueta</i>'
                                            +'</a>'
                                        +'</div>'
                                    +'</div>'
                                +'</div>';
                    }},
                ]
            });
        }

                    // IMPRIMIR CHECKLIST
        function imprimirPage(CODIGO_SOLICITACAO){

            try{
            $.ajax({
                url : "/pharmacy_request/"+CODIGO_SOLICITACAO,
                type : 'get',
                beforeSend : function(){
                // chamar loading.
                }
            })
            .done(function(data){
                    $("#emitido").html("Emitido por : <span style='font-weight: bold'>"+data[0]['SOLICITADO_POR']+"</span>");
                    $("#dataPedido").html("Em: <span style='font-weight: bold'>"+data[0]['DATA_PEDIDO']+"</span>");
                    $("#solicitacao").html("Solicitação: <span style='font-weight: bold'>"+data[0]['CODIGO_SOLICITACAO']+"</span>");
                    $("#dataHora").html("Data: <span style='font-weight: bold'>"+data[0]['DATA_PEDIDO']+"     "+data[0]['HORA_PEDIDO']+"</span>");
                    $("#usuario").html("Usuario:   <span style='font-weight: bold'>"+data[0]['SOLICITADO_POR']+"</span>");
                    $("#atendimento").html("Atendimento: <span style='font-weight: bold'>"+data[0]['CD_ATENDIMENTO']+"</span>");
                    $("#paciente").html("Paciente:  <span style='font-weight: bold'>"+data[0]['PACIENTE']+"</span>");
                    $("#idade").html("Idade:  <span style='font-weight: bold'>"+data[0]['IDADE']+"</span>");
                    $("#estoque").html("Estoque:  <span style='font-weight: bold'>"+data[0]['CD_ESTOQUE']+" - "+data[0]['ESTOQUE']+"</span>");
                    $("#empresa").html("EMPRESA:  <span style='font-weight: bold'>"+data[0]['EMPRESA']+"</span>");
                    $("#setor").html("SETOR:  <span style='font-weight: bold'>"+data[0]['SETOR_SOLICITANTE']+"</span>");
                    $("#unidade").html("Unid.int:  <span style='font-weight: bold'>"+data[0]['UNID_INTERNACAO']+"</span>");
                    $("#prestador").html("Medico:  <span style='font-weight: bold'>"+data[0]['PRESTADOR']+"</span>");
                    $("#leitos").html("leitos:  <span style='font-weight: bold'>"+data[0]['LEITO']+"</span>");
                        data.sort(function(a, b) {
                            var textA = a.ITEM.toUpperCase();
                            var textB = b.ITEM.toUpperCase();
                            return textA.localeCompare(textB);
                        });

                        var tableBody = $('#foreach-product');
                        tableBody.empty(); // Clear the existing table rows

                        $.each(data, function(index, item) {
                        var row = $('<tr>');
                        row.append($('<td>').text(item.CD_PRODUTO));
                        row.append($('<td>').text(item.ITEM));
                        row.append($('<td>').text('UND'));
                        row.append($('<td>').text(item.QUANT));
                        tableBody.append(row);
                        });

                        print();
                    $("#foreach-product").empty();
                })
                .fail(function(jqXHR, textStatus, msg){
                    // chamar função de erro
                    errormsg("Ocorreu um erro!!");
                    alert('An error occurred: ' + error.message);

                });
            }catch (error) {
                alert("An error occurred: " + error.message);
            }



        }

         //IMPRIMIR ETIQUETA DIA

         function imprimirEtiquetaDia(CODIGO_SOLICITACAO) {
            $.ajax({
                url: "/pharmacy_request/"+CODIGO_SOLICITACAO,
                type: 'get',
                beforeSend: function () {
                    // chamar loading.
                }
            })
            .done(function (data) {
                console.log(data)
                $(".Atendimento").html("Atend: <span style='font-weight: bold'>" + data[0]['CD_ATENDIMENTO'] + "</span>");
                $(".paciente").html("<span style='font-weight: bold'; >" + data[0]['PACIENTE'] + "</span>");
                $(".presc").html("<span style='font-weight: bold'; >" + data[0]['CD_PRE_MED'] + "</span>");
                $(".solic").html("<span style='font-weight: bold'; >" + data[0]['CODIGO_SOLICITACAO'] + "</span>");
                $(".dn").html("<span style='font-weight: bold'>" + data[0]['DT_NASCIMENTO'] + "</span>");
                $(".data").html("<span style='font-weight: bold'>" + data[0]['DATA_PEDIDO'] + "</span>");
                $(".idade").html("<span style='font-weight: bold'>" + data[0]['IDADE'] + "</span>");
                $(".setor").html("<span style='font-weight: bold'>" + data[0]['UNID_INTERNACAO'] + "</span>");
                $(".leito").html("<span style='font-weight: bold'>" + data[0]['LEITO'] + "</span>");

                // Get the content of the 'PrintTerms' div
                var content = $("#printAmbulatorio").html();

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


                setTimeout(() =>{
                    newWindow.print();
                    newWindow.close();
                }, 500)
            })
            .fail(function (jqXHR, textStatus, msg) {
                // chamar função de erro
                errormsg("Ocorreu um erro!!");
            });
        }

        //IMPRIMIR ETIQUETA Noite

        $('#id_button').click(function(){
            try {
                    let id = $('#id_request').val();
                    imprimirPage(id);
                } catch (error) {
                    alert('An error occurred: ' + error.message);
                }
        })

        $('#id_buttonEtiqueta').click(function(){
            try {
                let id = $('#id_request').val();
                imprimirEtiquetaDia(id);
            } catch (error) {
                alert('An error occurred: ' + error.message);
            }
        })


    </script>

@endpush
