<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallsPage; //Adicionando Model
use App\Models\Teste; //Adicionando Model
use Illuminate\Support\LazyCollection;
use DateTime;
use PDO;
use DB;

class CallsPageController extends Controller
{
    private $dbh;

    function __construct()

    {
        try {

            $server = "10.168.105.233";
            $db_username = "WEBSERVICE";
            $db_password = "WS202300";
            $service_name = "mvtreina.hospitalsantamonica.org";
            $sid = "ORCL";
            $port = 1521;
            $dbtns = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = $server)(PORT = $port)) (CONNECT_DATA = (SERVICE_NAME = $service_name) (SID = $sid)))";

//            $this->dbh = new PDO("mysql:host=".$server.";dbname=".dbname, $db_username, $db_password);

            $this->dbh = new PDO("oci:dbname=" . $dbtns . ";charset=utf8", $db_username, $db_password, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
            );
        } catch (PDOException $e) {
            echo ($e->getMessage()=='could not find driver' ? 'Driver não encontrado, verifique a extensão no arquivo php.ini' : $e->getMessage());
        }
    }

    public function select($sql)
    {
        $sql_stmt = $this->dbh->prepare($sql);
        $sql_stmt->execute();
        $result = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->__destruct();
        return $result;
    }

    /* public function insert($sql)
    {
        $sql_stmt = $this->dbh->prepare($sql);
        try {
            $result = $sql_stmt->execute();
        } catch (PDOException $e) {
            trigger_error('Error occured while trying to insert into the DB:' . $e->getMessage(), E_USER_ERROR);
        }
        if ($result) {
            return $sql_stmt->rowCount();
        }
    } */

    function __destruct()
    {
        $this->dbh = NULL;
    }
    //  JANELA TABELA SOLICITAÇÕES FARMACIA
    public function tableRequest(){

        return view('pharmacy');

    }
    // BUSCAR DADOS SOLICITAÇÕES FARMACIA

    public function getRequests(Request $request)
    {

        $requests = $this->select(
        "SELECT
            a.cd_atendimento as CD_ATENDIMENTO,
            so.cd_solsai_pro as CODIGO_SOLICITACAO,
            so.dt_gravacao as DATA_GRAVACAO,
            so.dt_solsai_pro as DATA_PEDIDO,
            to_char(so.hr_solsai_pro, 'hh24:mi:ss') as HORA_PEDIDO,
            so.cd_usuario as SOLICITADO_POR,
            s.nm_setor as SETOR_SOLICITANTE,
            e.cd_estoque as CD_ESTOQUE,
            pa.nm_paciente as PACIENTE

            from solsai_pro so
                left join setor s on s.cd_setor = so.cd_setor
                left join estoque e on e.cd_estoque = so.cd_estoque
                left join multi_empresas m on m.cd_multi_empresa = e.cd_multi_empresa
                left join atendime a on a.cd_atendimento = so.cd_atendimento
                left join paciente pa on pa.cd_paciente = a.cd_paciente
            where e.cd_multi_empresa = 21 and ROWNUM <= 10 and
                TRUNC(so.dt_solsai_pro) >= to_date(sysdate - 1) and TRUNC(so.dt_solsai_pro) <= to_date(sysdate)
            order by so.dt_solsai_pro  ASC "

        );

        $table = [
            "draw" => $request->input('draw'),
            "recordsTotal" => count($requests),
            "recordsFiltered" => count($requests),
            'data' => $requests,
        ];

        return $table;
    }

    public function pharmacyRequest(Request $request, $id)
    {

        if($id){

            $requests = $this->select(
                "SELECT
                    p.cd_produto as CD_PRODUTO,
                    p.ds_produto  as ITEM,
                    it.qt_solicitado as QUANT,
                    so.cd_solsai_pro as CODIGO_SOLICITACAO,
                    so.dt_solsai_pro as DATA_PEDIDO,
                    to_char(so.hr_solsai_pro, 'hh24:mi:ss') as HORA_PEDIDO,
                    so.cd_usuario as SOLICITADO_POR,
                    s.nm_setor as SETOR_SOLICITANTE,
                    e.cd_estoque as CD_ESTOQUE,
                    e.ds_estoque as ESTOQUE,
                    so.cd_pre_med as CD_PRE_MED,
                    CASE so.sn_urgente
                        WHEN 'N' THEN 'NORMAL'
                        WHEN 'S' THEN 'URGENTE'
                    ELSE 'OUTRO' END AS TIPO,
                    a.cd_atendimento as CD_ATENDIMENTO,
                    pa.nm_paciente as PACIENTE,
                    pa.dt_nascimento as DT_NASCIMENTO,
                    trunc((months_between(sysdate, to_date( to_char(pa.DT_NASCIMENTO,'dd/mm/yyyy'),'dd/mm/yyyy')))/12) as IDADE,
                    pr.NM_prestador as PRESTADOR,
                    u.ds_unid_int as UNID_INTERNACAO,
                    a.cd_leito as LEITO,
                    c.nm_convenio as CONVENIO,
                    m.ds_multi_empresa as EMPRESA
                    from itsolsai_pro it
                        inner join solsai_pro so on it.cd_solsai_pro = so.cd_solsai_pro
                        left join setor s on s.cd_setor = so.cd_setor
                        left join estoque e on e.cd_estoque = so.cd_estoque
                        left join multi_empresas m on m.cd_multi_empresa = e.cd_multi_empresa
                        Left join produto p on p.cd_produto = it.cd_produto
                        left join atendime a on a.cd_atendimento = so.cd_atendimento
                        left join prestador pr on pr.cd_prestador = a.cd_prestador
                        left join paciente pa on pa.cd_paciente = a.cd_paciente
                        left join convenio c on c.cd_convenio = a.cd_convenio
                        left join leito l on l.cd_leito = a.cd_leito
                        left join unid_int u on u.cd_unid_int = l.cd_unid_int

                    where
                    so.cd_solsai_pro = $id"

                );

                return $requests;
        }
        else{
            return false;
        }

    }
    public function integraDRG(){

        $internacoesDB = $this->select(
            "SELECT --PACIENTE.CD_PACIENTE,
                DISTINCT ATENDIME.CD_ATENDIMENTO,
                PACIENTE.NM_PACIENTE,
                ATENDIME.NR_CARTEIRA AS CNS,
                PACIENTE.DT_NASCIMENTO AS DT_NASCIMENTO ,  /* yyyy-MM-ddTHH:mm:ss */
                PACIENTE.TP_SEXO AS SEXO,
                PACIENTE.DS_ENDERECO AS RUA,
                PACIENTE.NR_ENDERECO AS NUMERO,
                NVL(PACIENTE.DS_COMPLEMENTO, ' ') AS DS_COMPLEMENTO,
                PACIENTE.NM_BAIRRO AS BAIRRO,
                CIDADE.CD_UF AS UF,
                NVL(PACIENTE.NR_CEP, 'NAO INFORMADO') AS NR_CEP,
                ATENDIME.CD_PACIENTE,
                ATENDIME.DT_ATENDIMENTO AS DT_ATENDIMENTO , /* yyyy-MM-ddTHH:mm:ss */
                CONVENIO.NM_CONVENIO,
                NVL(CIDADE.NM_CIDADE, 'NAO INFORMADO') AS NATURALIDADE,
                CIDADE.CD_CIDADE AS CD_CIDADE,
                PRESTADOR.NM_PRESTADOR AS MEDICO,
                PRESTADOR.DS_CODIGO_CONSELHO AS CRM,
                CONSELHO.CD_UF AS UFCONSELHO,
                ESPECIALID.DS_ESPECIALID AS ESPECIALIDADE,
                ATENDIME.HR_ALTA_MEDICA AS ALTAMEDICA,
                ATENDIME.HR_ALTA AS ALTAHOSPITALAR,
                    CASE
                    WHEN ATENDIME.TP_CARATER_INTERNACAO = 'E' THEN 1
                    WHEN ATENDIME.TP_CARATER_INTERNACAO = 'U' THEN 2
                    END AS TP_CARATER_INTERNACAO,
                ATENDIME.CD_CID AS CID,
                MOT_ALT.TP_MOT_ALTA AS MOTIVOALTA
               /* FALTANDO CAMPOS ->  Código do caráter da internação ELETIVO, ADIMISSIONAL*/
            FROM ATENDIME
            left join DBAMV.PACIENTE on ATENDIME.CD_PACIENTE = PACIENTE.CD_PACIENTE

                left join DBAMV.CIDADE on PACIENTE.CD_CIDADE = CIDADE.CD_CIDADE
                left join DBAMV.PRESTADOR on ATENDIME.CD_PRESTADOR = PRESTADOR.CD_PRESTADOR
                left join DBAMV.CONVENIO ON atendime.cd_convenio = convenio.cd_convenio
                left join DBAMV.CID ON ATENDIME.CD_CID = CID.CD_CID
                left join DBAMV.CON_PLA ON Atendime.CD_CON_PLA = CON_PLA.CD_CON_PLA and atendime.CD_CONVENIO = CON_PLA.CD_CONVENIO
                left join DBAMV.CARTEIRA ON CARTEIRA.CD_PACIENTE = PACIENTE.CD_PACIENTE
                                            and Atendime.cd_con_pla = carteira.cd_con_pla
                                            and atendime.cd_convenio = carteira.cd_convenio
                left join DBAMV.ESPECIALID ON ATENDIME.CD_ESPECIALID = ESPECIALID.CD_ESPECIALID
                /*left join multi_empresas on multi_empresas.cd_multi_empresa = atendime.cd_multi_empresa*/
                left join DBAMV.CONSELHO ON CONSELHO.CD_CONSELHO = PRESTADOR.CD_CONSELHO
                left join mot_alt ON MOT_ALT.CD_MOT_ALT = ATENDIME.CD_MOT_ALT

                WHERE ATENDIME.TP_ATENDIMENTO = 'I'
                      AND ATENDIME.HR_ALTA_MEDICA IS NOT NULL
                      AND to_char(ATENDIME.HR_ALTA,'DD/MM/YYYY') = to_date(sysdate - 1)
                      AND CONVENIO.CD_CONVENIO = 293 AND ATENDIME.CD_ATENDIMENTO = 2982466"

        );

        $xml="<loteInternacao>";

        $internacoes="";

        foreach($internacoesDB AS $key=>$internacao){
            $internacoes .= "
               <Internacao>
                <situacao>1</situacao>
                <caraterInternacao>{$internacao['TP_CARATER_INTERNACAO']}</caraterInternacao>
                <numeroAtendimento>{$internacao['CD_ATENDIMENTO']}</numeroAtendimento>
                <numeroAutorizacao></numeroAutorizacao>
                <dataInternacao>{$internacao['DT_ATENDIMENTO']}</dataInternacao>
                <dataAlta>{$internacao['ALTAMEDICA']}</dataAlta>
                <condicaoAlta>{$internacao['MOTIVOALTA']}</condicaoAlta>
                <dataAutorizacao>{$internacao['DT_ATENDIMENTO']}</dataAutorizacao>
                <codigoCidPrincipal>{$internacao['CID']}</codigoCidPrincipal>
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
                    <dataNascimento>{$internacao['DT_NASCIMENTO']}</dataNascimento>
                    <sexo>{$internacao['SEXO']}</sexo>
                    <uf>{$internacao['UF']}</uf>
                    <cidade>{$internacao['CD_CIDADE']}</cidade>
                    <logradouro>{$internacao['RUA']}</logradouro>
                    <numeroLogradouro>{$internacao['NUMERO']}</numeroLogradouro>
                    <complementoLogradouro>{$internacao['DS_COMPLEMENTO']}</complementoLogradouro>
                    <bairro>{$internacao['BAIRRO']}</bairro>
                    <cep>{$internacao['NR_CEP']}</cep>
                </Beneficiario>
                <Operadora>
                    <codigo>10689</codigo>
                    <plano>{$internacao['NM_CONVENIO']}</plano>
                    <numeroCarteira>{$internacao['CNS']}</numeroCarteira>
                </Operadora>
                <Medico>
                    <nome>{$internacao['MEDICO']}</nome>
                    <uf>{$internacao['UFCONSELHO']}</uf>
                    <crm>{$internacao['CRM']}</crm>
                    <especialidade>{$internacao['ESPECIALIDADE']}</especialidade>
                    <medicoResponsavel>S</medicoResponsavel>
                </Medico>
            </Internacao>
            ";
        }

        $xml.=$internacoes."</loteInternacao>";
        echo $internacoes;
        exit;
        $params = array(
            'usuarioIAG' => '2827-import',
            'senhaIAG' => 'ZNTevMwD',
//    'xml' => "<![CDATA[{$xml}]]>",
            'xml' => $xml,
        );

        $wsdlUrl = 'http://iagwebservice.sigquali.com.br:80/iagwebservice/importaInternacao?wsdl';
        $endpoint = 'http://iagwebservice.sigquali.com.br:80/iagwebservice/importaInternacao';
        $client = new \SoapClient($wsdlUrl, array('trace' => 1, 'exceptions' => 1, 'location' => $endpoint));

        try {
            $method = 'importaInternacao';
            $response = $client->__soapCall($method, array($params));
            echo "SOAP Response:\n";
            print_r($response);

            echo "<br><br>Last SOAP Request:\n" . $client->__getLastRequest() . "\n";
        } catch (\SoapFault $fault) {
            echo "SOAP Fault: " . $fault->getMessage() . "\n";

        }
    }

    public function list(Request $request)
    {

        //$atendimentos = CallsPage::select("*")->get()->toArray();

        $atendimentos = $this->select(
        "SELECT --PACIENTE.CD_PACIENTE,
            PACIENTE.NM_PACIENTE,
            pro_fat.ds_pro_fat as PROCEDIMENTO,
            to_char(PACIENTE.DT_NASCIMENTO,'dd/mm/yyyy')DT_NASCIMENTO ,
            PACIENTE.TP_SEXO,
            PRESTADOR.NM_PRESTADOR,
            PACIENTE.NM_MAE,
            ATENDIME.CD_ATENDIMENTO,
            ATENDIME.NM_USUARIO,
            ORI_ATE.DS_ORI_ATE

        FROM ATENDIME
        left join DBAMV.PACIENTE on ATENDIME.CD_PACIENTE = PACIENTE.CD_PACIENTE

            left join DBAMV.CIDADE on PACIENTE.CD_CIDADE = CIDADE.CD_CIDADE
            aND PACIENTE.CD_NATURALIDADE = CIDADE.CD_CIDADE /**/
            left join DBAMV.ORI_ATE on ATENDIME.CD_ORI_ATE = ORI_ATE.CD_ORI_ATE
            left join DBAMV.PRO_FAT on ATENDIME.CD_PRO_INT = PRO_FAT.CD_PRO_FAT
            left join DBAMV.PRESTADOR on ATENDIME.CD_PRESTADOR = PRESTADOR.CD_PRESTADOR
            left join DBAMV.LEITO on ATENDIME.CD_LEITO = LEITO.CD_LEITO
            left join DBAMV.UNID_INT ON LEITO.CD_UNID_INT = UNID_INT.CD_UNID_INT
            left join DBAMV.CONVENIO ON atendime.cd_convenio = convenio.cd_convenio
            left join DBAMV.CID ON ATENDIME.CD_CID = CID.CD_CID
            left join DBAMV.SERVICO ON ATENDIME.CD_SERVICO = SERVICO.CD_SERVICO
            left join DBAMV.SER_DIS ON ATENDIME.CD_SER_DIS = SER_DIS.CD_SER_DIS
            left join DBAMV.TIP_ACOM ON ATENDIME.CD_TIP_ACOM = TIP_ACOM.CD_TIP_ACOM
            left join DBAMV.RESPONSA ON ATENDIME.CD_ATENDIMENTO = RESPONSA.CD_ATENDIMENTO
            left join DBAMV.ATENDIME_INFO ON ATENDIME.CD_ATENDIMENTO = ATENDIME_INFO.CD_ATENDIMENTO
            left join DBAMV.RELIGIAO ON PACIENTE.CD_RELIGIAO = RELIGIAO.CD_RELIGIAO
            left join DBAMV.ESPECIALID ON ATENDIME.CD_ESPECIALID = ESPECIALID.CD_ESPECIALID
            left join DBAMV.GRAU_INS ON PACIENTE.CD_GRAU_INS = GRAU_INS.CD_GRAU_INS
            left join DBAMV.CIDADANIAS ON PACIENTE.CD_CIDADANIA = CIDADANIAS.CD_CIDADANIA
            left join DBAMV.GUIA ON ATENDIME.CD_ATENDIMENTO = GUIA.CD_ATENDIMENTO
            left join DBAMV.PROFISSAO ON PACIENTE.CD_PROFISSAO = PROFISSAO.CD_PROFISSAO
        Where
        TRUNC(ATENDIME.DT_ATENDIMENTO) >= to_date(sysdate - 1) and TRUNC(ATENDIME.DT_ATENDIMENTO) <= to_date(sysdate)
            order by ATENDIME.DT_ATENDIMENTO  ASC"
        );

        $table = [
        "draw" => $request->input('draw'),
        "recordsTotal" => count($atendimentos),
        "recordsFiltered" => count($atendimentos),
        'data' => $atendimentos,
        ];

        return $table;
    }



    // GET DATA TO CHECKLIST INTERNAÇÃO PAGE
    public function getCheckList(Request $request, $id){

        if($id){

            $atendimento =  $this->select(
                "SELECT --PACIENTE.CD_PACIENTE,
                PACIENTE.NM_PACIENTE,
                ATENDIME.CD_ATENDIMENTO,
                ATENDIME.CD_PACIENTE,
                to_char(ATENDIME.DT_ATENDIMENTO,'dd/mm/yyyy') DT_ATENDIMENTO ,
                to_char(ATENDIME.HR_ATENDIMENTO,'hh24:mi') HR_ATENDIMENTO


            FROM ATENDIME
            left join DBAMV.PACIENTE on ATENDIME.CD_PACIENTE = PACIENTE.CD_PACIENTE

                left join DBAMV.PRESTADOR on ATENDIME.CD_PRESTADOR = PRESTADOR.CD_PRESTADOR
                left join DBAMV.LEITO on ATENDIME.CD_LEITO = LEITO.CD_LEITO
                left join DBAMV.UNID_INT ON LEITO.CD_UNID_INT = UNID_INT.CD_UNID_INT
                left join DBAMV.CONVENIO ON atendime.cd_convenio = convenio.cd_convenio
                left join DBAMV.CID ON ATENDIME.CD_CID = CID.CD_CID
                left join DBAMV.TIP_ACOM ON ATENDIME.CD_TIP_ACOM = TIP_ACOM.CD_TIP_ACOM
                left join DBAMV.RESPONSA ON ATENDIME.CD_ATENDIMENTO = RESPONSA.CD_ATENDIMENTO
                left join DBAMV.ATENDIME_INFO ON ATENDIME.CD_ATENDIMENTO = ATENDIME_INFO.CD_ATENDIMENTO
                left join DBAMV.GUIA ON ATENDIME.CD_ATENDIMENTO = GUIA.CD_ATENDIMENTO


                Where

                ATENDIME.CD_ATENDIMENTO =  $id"

            );

            $data = json_decode(json_encode($atendimento));

            return $data;
        }else{
            return FALSE;
        }
    }
    public function show(Request $request, $id){

        if($id){

           $atendimento =  $this->select(
            "SELECT --PACIENTE.CD_PACIENTE,
                PACIENTE.NM_PACIENTE,
                NVL(CARTEIRA.NR_CARTEIRA, ATENDIME.NR_CARTEIRA) AS CNS,
                NVL( ATENDIME.NR_CARTEIRA, CARTEIRA.NR_CARTEIRA) AS CNS_NOVA,
                NVL(pro_fat.ds_pro_fat, 'NAO INFORMADO') AS PROCEDIMENTO,
                to_char(PACIENTE.DT_NASCIMENTO,'dd/mm/yyyy')DT_NASCIMENTO ,
                PACIENTE.TP_SEXO,
                DBAMV.FNC_ESTADO_CIVIL(PACIENTE.TP_ESTADO_CIVIL) TP_ESTADO_CIVIL1,
                NVL(PACIENTE.NR_DOCUMENTO, 'NAO INFORMADO') AS NR_DOCUMENTO,
                multi_empresas.ds_multi_empresa,
                PACIENTE.NM_MAE,
                NVL(PACIENTE.NM_PAI, 'NAO INFORMADO') AS NM_PAI,
                /*PACIENTE.NM_CONJUGE,   */
                PACIENTE.DS_ENDERECO,
                PACIENTE.NR_ENDERECO,
                NVL(PACIENTE.DS_COMPLEMENTO, ' ') AS DS_COMPLEMENTO,
                PACIENTE.NM_BAIRRO,
                NVL(PACIENTE.NR_CEP, 'NAO INFORMADO') AS NR_CEP,
                PACIENTE.NR_FONE,
                /*PACIENTE.DT_CADASTRO, */
                NVL(PACIENTE.NR_CPF, '  ') AS NR_CPF,
                NVL(PACIENTE.NR_IDENTIDADE, '   ') AS NR_IDENTIDADE,
                /*PACIENTE.DS_OM_IDENTIDADE,    */
                ATENDIME.CD_ATENDIMENTO,
                ATENDIME.CD_PACIENTE,
                to_char(ATENDIME.DT_ATENDIMENTO,'dd/mm/yyyy') DT_ATENDIMENTO ,
                to_char(ATENDIME.HR_ATENDIMENTO,'hh24:mi') HR_ATENDIMENTO,
                /*ATENDIME.CD_SERVICO,
                ATENDIME.CD_SER_DIS,
                ATENDIME.TP_ATENDIMENTO,*/
                ATENDIME.NM_USUARIO,
            /* ATENDIME.CD_CONVENIO,
                ATENDIME_INFO.DS_INFO_ATENDIMENTO,  */
                ORI_ATE.DS_ORI_ATE,
                /*DECODE(CONVENIO.TP_CONVENIO,
                    'C',
                    ATENDIME.CD_PRO_INT,
                    'P',
                    ATENDIME.CD_PRO_INT,
                    'A',
                    PRO_FAT.CD_SUS,
                    'H',
                    PRO_FAT.CD_SUS) CD_PRO_INT,
                PRO_FAT.DS_PRO_FAT PROCED,
                PRESTADOR.CD_PRESTADOR,    */
                PRESTADOR.NM_PRESTADOR,
                CONVENIO.NM_CONVENIO,
                NVL(RESPONSA.NM_RESPONSAVEL, 'NAO INFORMADO') AS NM_RESPONSAVEL,
                NVL(RESPONSA.NR_FONE, 'NAO INFORMADO') AS NR_FONE_RESPONSAVEL,
                NVL(RESPONSA.DS_DOCUMENTO, 'NAO INFORMADO') AS DS_DOCUMENTO_RESPONSAVEL,
                NVL(RESPONSA.DS_ENDERECO, ' ') AS DS_ENDERECO_RESP,
                NVL(RESPONSA.NR_CPF, 'NAO INFORMADO') AS NR_CPF_RESP,
                NVL(RESPONSA.NR_CEP, 'NAO INFORMADO') AS RESPONSACEP,
                NVL(RESPONSA.NM_BAIRRO, 'NAO INFORMADO') AS bairroresp,
                /*RESPONSA.TP_ESTADO_CIVIL AS RESP_EST, */
                NVL(DBAMV.FNC_ESTADO_CIVIL(RESPONSA.TP_ESTADO_CIVIL), 'NAO INFORMADO') AS RESP_EST,
                RESPONSA.DT_NASCIMENTO AS RESP_DT_NASC,
                trunc((months_between(sysdate, to_date( to_char(PACIENTE.DT_NASCIMENTO,'dd/mm/yyyy'),'dd/mm/yyyy')))/12) AS idade,
                NVL(CIDADE.NM_CIDADE, 'NAO INFORMADO') AS NATURALIDADE,
                responsa.nr_endereco AS NR_ENDERECO_RESPONSAVEL,
                NVL(responsa.ds_complemento, '  ') AS DS_COMPLEMENTO_RESPONSAVEL,
                PACIENTE.DS_OBSERVACAO,
                paciente.nr_rg_nasc,
                GUIA.Cd_Guia,
                CON_PLA.DS_CON_PLA as PLANO,
                guia.nr_guia

            FROM ATENDIME
            left join DBAMV.PACIENTE on ATENDIME.CD_PACIENTE = PACIENTE.CD_PACIENTE

                left join DBAMV.CIDADE on PACIENTE.CD_CIDADE = CIDADE.CD_CIDADE
                /* aND PACIENTE.CD_NATURALIDADE = CIDADE.CD_CIDADE */
                left join DBAMV.ORI_ATE on ATENDIME.CD_ORI_ATE = ORI_ATE.CD_ORI_ATE
                left join DBAMV.PRO_FAT on ATENDIME.CD_PRO_INT = PRO_FAT.CD_PRO_FAT
                left join DBAMV.PRESTADOR on ATENDIME.CD_PRESTADOR = PRESTADOR.CD_PRESTADOR
                left join DBAMV.LEITO on ATENDIME.CD_LEITO = LEITO.CD_LEITO
                left join DBAMV.UNID_INT ON LEITO.CD_UNID_INT = UNID_INT.CD_UNID_INT
                left join DBAMV.CONVENIO ON atendime.cd_convenio = convenio.cd_convenio
                left join DBAMV.CID ON ATENDIME.CD_CID = CID.CD_CID
                left join DBAMV.SERVICO ON ATENDIME.CD_SERVICO = SERVICO.CD_SERVICO
                left join DBAMV.SER_DIS ON ATENDIME.CD_SER_DIS = SER_DIS.CD_SER_DIS
                left join DBAMV.TIP_ACOM ON ATENDIME.CD_TIP_ACOM = TIP_ACOM.CD_TIP_ACOM
                left join DBAMV.RESPONSA ON ATENDIME.CD_ATENDIMENTO = RESPONSA.CD_ATENDIMENTO
                left join DBAMV.CON_PLA ON Atendime.CD_CON_PLA = CON_PLA.CD_CON_PLA
                and atendime.CD_CONVENIO = CON_PLA.CD_CONVENIO
                left join DBAMV.CARTEIRA ON CARTEIRA.CD_PACIENTE = PACIENTE.CD_PACIENTE
                and Atendime.cd_con_pla = carteira.cd_con_pla
                and atendime.cd_convenio = carteira.cd_convenio
                left join CARTEIRA ON ATENDIME.NR_CARTEIRA = CARTEIRA.NR_CARTEIRA
                and ATENDIME.CD_CON_PLA = CARTEIRA.CD_CON_PLA
                and ATENDIME.CD_CONVENIO = CARTEIRA.CD_CONVENIO
                left join DBAMV.ATENDIME_INFO ON ATENDIME.CD_ATENDIMENTO = ATENDIME_INFO.CD_ATENDIMENTO
                left join DBAMV.RELIGIAO ON PACIENTE.CD_RELIGIAO = RELIGIAO.CD_RELIGIAO
                left join DBAMV.ESPECIALID ON ATENDIME.CD_ESPECIALID = ESPECIALID.CD_ESPECIALID
                left join DBAMV.GRAU_INS ON PACIENTE.CD_GRAU_INS = GRAU_INS.CD_GRAU_INS
                left join DBAMV.CIDADANIAS ON PACIENTE.CD_CIDADANIA = CIDADANIAS.CD_CIDADANIA
                left join DBAMV.GUIA ON ATENDIME.CD_ATENDIMENTO = GUIA.CD_ATENDIMENTO
                left join DBAMV.PROFISSAO ON PACIENTE.CD_PROFISSAO = PROFISSAO.CD_PROFISSAO
                left join multi_empresas on multi_empresas.cd_multi_empresa = atendime.cd_multi_empresa
                left join con_pla ON atendime.cd_con_pla = con_pla.cd_con_pla and atendime.cd_convenio = con_pla.cd_convenio


                Where

                ATENDIME.CD_ATENDIMENTO =  $id"

            );
            $data = json_decode(json_encode($atendimento));

            return $data;
        }else{
            return FALSE;
        }
    }
}
