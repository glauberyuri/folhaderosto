<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallsPage extends Model
{
    use HasFactory;

    public $table = "tb_atendimentos";

    protected $primaryKey = 'id_atendimento';

    protected $fillable = [

        'IDADE', // IDADE PACIENTE
        'NM_PACIENTE', // NOME PACIENTE
        'CNS', //CARTAO SUS
        'PROCEDIMENTO',
        'DT_NASCIMENTO', // DATA DE NASCIMENTO
        'TP_SEXO', // SEXO DO PACIENTE
        'TP_ESTADO_CIVIL1', // ESTADO CIVIL
        'NR_DOCUMENTO', // NUMERO DOCUMENTO
        'NM_MAE', // NOME MAE
        'DS_ENDERECO', // ENDERECO
        'NR_ENDERECO', // NUMERO ENDERECO
        'DS_COMPLEMENTO', //COMPLEMENTO
        'NM_BAIRRO', // BAIRRO
        'NR_CEP', // CEP
        'NR_FONE', // TELEFONE
        'NR_CPF',   // NUMERO CPF
        'DT_CADASTRO', // DATA CADASTRO
        'NR_IDENTIDADE',    //NUMERO IDENTIDADE
        'CD_ATENDIMENTO', // CODIGO ATENDIMENTO
        'CD_PACIENTE', // CODIGO PACIENTE
        'DT_ATENDIMENTO', // DATA ATENDIMENTO
        'HR_ATENDIMENTO', // HORA ATENDIMENTO
        'NM_USUARIO', //USUARIO ATENDENTE
        'DS_ORI_ATE', // SETOR DE ORIGEM
        'NM_PRESTADOR', // NOME MEDICO
        'NM_CONVENIO', // CONVENIO
        'NM_RESPONSAVEL', // NOME DO RESPONSAVEL PELO PACIENTE
        'NR_FONE_RESPONSAVEL', //TELEFONE RESPONSAVEL
        'DS_DOCUMENTO_RESPONSAVEL', // DOCUMENTO RESPONSAVEL
        'DS_ENDERECO_RESP', // ENDERECO RESPONSAVEL
        'NR_CPF_RESP', // CPF DO RESPONSAVEL
        'NM_CIDADE', // CIDADE 
        'RESPONSACEP' , //CEP DO RESPONSAVEL
        'BAIRRORESP', //BAIRRO RESPONSAVEL
        'RESP_EST', //RESPONSAVEL ESTADO
        'NATURALIDADE', //NATURALIDADE
        'RESP_DT_NASC' , //DATA NASCIMENTO
        'NR_ENDERECO_RESPONSAVEL', // NUMERO ENDERECO DO RESPONSAVEL
        'DS_COMPLEMENTO_RESPONSAVEL', //COMPLEMENTO RESPONSAVEL
        'DT_DOC', // DOCUMENTO DATA


    ];
}
