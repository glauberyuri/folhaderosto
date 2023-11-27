<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_atendimentos', function (Blueprint $table) {
            $table->id('id_atendimento');
            $table->string('IDADE');
            $table->string('NM_PACIENTE');
            $table->string('CNS');
            $table->string('PROCEDIMENTO');
            $table->string('DT_NASCIMENTO');
            $table->string('TP_SEXO');
            $table->string('TP_ESTADO_CIVIL1');
            $table->string('NR_DOCUMENTO');
            $table->string('NM_MAE');
            $table->string('DS_ENDERECO');
            $table->string('NR_ENDERECO');
            $table->string('DS_COMPLEMENTO');
            $table->string('NM_BAIRRO');
            $table->string('NR_CEP');
            $table->string('NR_FONE');
            $table->string('NR_CPF');
            $table->string('NR_IDENTIDADE');
            $table->string('CD_ATENDIMENTO');
            $table->string('CD_PACIENTE');
            $table->string('DT_ATENDIMENTO');
            $table->string('HR_ATENDIMENTO');
            $table->string('NM_USUARIO');
            $table->string('DS_ORI_ATE');
            $table->string('NM_PRESTADOR');
            $table->string('NM_CONVENIO');
            $table->string('NM_RESPONSAVEL');
            $table->string('NR_FONE_RESPONSAVEL');
            $table->string('DS_DOCUMENTO_RESPONSAVEL');
            $table->string('DS_ENDERECO_RESP');
            $table->string('NR_CPF_RESP');
            $table->string('RESPONSACEP');
            $table->string('BAIRRORESP');
            $table->string('RESP_EST');
            $table->string('RESP_DT_NASC');
            $table->string('NM_CIDADE');
            $table->string('NATURALIDADE');
            $table->string('NR_ENDERECO_RESPONSAVEL');
            $table->string('DS_COMPLEMENTO_RESPONSAVEL');
            $table->string('DT_DOC');

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_atendimentos');
    }
};
