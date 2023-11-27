<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
    ])->toArray(),

];

    define('QUERYATENDIMENTO', "SELECT --PACIENTE.CD_PACIENTE,
    PACIENTE.NM_PACIENTE,
    PACIENTE.NR_CNS AS CNS,
    pro_fat.ds_pro_fat as PROCEDIMENTO,
    to_char(PACIENTE.DT_NASCIMENTO,'dd/mm/yyyy')DT_NASCIMENTO ,
    PACIENTE.TP_SEXO,
    DBAMV.FNC_ESTADO_CIVIL(PACIENTE.TP_ESTADO_CIVIL) TP_ESTADO_CIVIL1,
    PACIENTE.NR_DOCUMENTO,
    PACIENTE.NM_MAE,
    /*PACIENTE.NM_PAI,    
   PACIENTE.NM_CONJUGE,   */
    PACIENTE.DS_ENDERECO,
    PACIENTE.NR_ENDERECO,
    PACIENTE.DS_COMPLEMENTO,
    PACIENTE.NM_BAIRRO,
    PACIENTE.NR_CEP,
    PACIENTE.NR_FONE,
    /*PACIENTE.DT_CADASTRO, */
    PACIENTE.NR_CPF,
    PACIENTE.NR_IDENTIDADE,
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
    /*PRESTADOR.NR_CPF_CGC,
    PRESTADOR.DS_CODIGO_CONSELHO,  
    LEITO.DS_ENFERMARIA,
    LEITO.DS_LEITO,
    UNID_INT.CD_UNID_INT,
    UNID_INT.DS_UNID_INT,
    UNID_INT.DS_LOCALIZACAO,      */
    CONVENIO.NM_CONVENIO,
   /* CID.DS_CID,
    SERVICO.DS_SERVICO,
    SERVICO.TP_ANAMNESE TP_ANAM_SERVICO,
    SER_DIS.DS_SER_DIS,
    SER_DIS.TP_ANAMNESE TP_ANAM_SER_DIS,
    TIP_ACOM.DS_TIP_ACOM, */
    RESPONSA.NM_RESPONSAVEL,
    RESPONSA.NR_FONE NR_FONE_RESPONSAVEL,
    RESPONSA.DS_DOCUMENTO DS_DOCUMENTO_RESPONSAVEL,
    RESPONSA.DS_ENDERECO DS_ENDERECO_RESP,
    RESPONSA.NR_CPF NR_CPF_RESP,  
    RESPONSA.NR_CEP RESPONSACEP,
    RESPONSA.NM_BAIRRO AS bairroresp,
    /*RESPONSA.TP_ESTADO_CIVIL AS RESP_EST, */
    DBAMV.FNC_ESTADO_CIVIL(RESPONSA.TP_ESTADO_CIVIL) RESP_EST,
    RESPONSA.DT_NASCIMENTO AS RESP_DT_NASC,
    /*RESPONSA.DS_CONTATO_FAMILIA,
    CARTEIRA.NR_CARTEIRA,
    CARTEIRA.NM_EMPRESA,
    CARTEIRA.NM_TITULAR,
    CARTEIRA.SN_TITULAR,
    CARTEIRA.SN_PENSIONISTA,
    to_char(CARTEIRA.DT_VALIDADE, 'dd/mm/yyyy')DT_VALIDADE,
    CARTEIRA.DT_ULT_PGTO,
    CATEGORIA_PLANO.DS_CATEGORIA_PLANO,
    CON_PLA.DS_CON_PLA,   */
    SUBSTR(CIDADE.NM_CIDADE, 1, 100) NM_CIDADE,
   /* CIDADE.CD_UF,
    ATENDIME.CD_CID,
    RELIGIAO.DS_RELIGIAO,
    ESPECIALID.DS_ESPECIALID,
    GRAU_INS.DS_GRAU_INS,   */
    CIDADE.NM_CIDADE AS NATURALIDADE,
   /* CIDADANIAS.DS_CIDADANIA,
    GUIA.CD_SENHA,    
    PROFISSAO.NM_PROFISSAO,
    PRO_FAT.NR_DIAS_INTERNACAO DIAS_MAX_INTERNACAO,
    (FLOOR(PRO_FAT.NR_DIAS_INTERNACAO / 2)) DIAS_MIN_INTERNACAO,
    paciente.ds_trabalho,   */
    responsa.nr_endereco NR_ENDERECO_RESPONSAVEL,
    responsa.ds_complemento DS_COMPLEMENTO_RESPONSAVEL,  
    PACIENTE.DS_OBSERVACAO,
    paciente.nr_rg_nasc,
    GUIA.Cd_Guia,
    guia.nr_guia  

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
    left join DBAMV.CARTEIRA ON atendime.nr_carteira = carteira.nr_carteira
    and ATENDIME.CD_PACIENTE = CARTEIRA.CD_PACIENTE/**/
    left join DBAMV.CATEGORIA_PLANO ON CARTEIRA.CD_CATEGORIA_PLANO = CATEGORIA_PLANO.CD_CATEGORIA_PLANO
    left join DBAMV.CON_PLA ON Atendime.CD_CON_PLA = CON_PLA.CD_CON_PLA
    and Atendime.cd_con_pla = carteira.cd_con_pla/**/
    and atendime.CD_CONVENIO = CON_PLA.CD_CONVENIO/**/
    and atendime.cd_convenio = carteira.cd_convenio/**/
    left join DBAMV.ATENDIME_INFO ON ATENDIME.CD_ATENDIMENTO = ATENDIME_INFO.CD_ATENDIMENTO
    left join DBAMV.RELIGIAO ON PACIENTE.CD_RELIGIAO = RELIGIAO.CD_RELIGIAO
    left join DBAMV.ESPECIALID ON ATENDIME.CD_ESPECIALID = ESPECIALID.CD_ESPECIALID
    left join DBAMV.GRAU_INS ON PACIENTE.CD_GRAU_INS = GRAU_INS.CD_GRAU_INS
    left join DBAMV.CIDADANIAS ON PACIENTE.CD_CIDADANIA = CIDADANIAS.CD_CIDADANIA
    left join DBAMV.GUIA ON ATENDIME.CD_ATENDIMENTO = GUIA.CD_ATENDIMENTO
    left join DBAMV.PROFISSAO ON PACIENTE.CD_PROFISSAO = PROFISSAO.CD_PROFISSAO
Where 
/*ATENDIME.CD_PACIENTE = PACIENTE.CD_PACIENTE*/
/*AND ATENDIME.CD_PRO_INT = PRO_FAT.CD_PRO_FAT(+)*/
/*AND PACIENTE.CD_CIDADE = CIDADE.CD_CIDADE(+)squi*/
/*AND ATENDIME.CD_ORI_ATE = ORI_ATE.CD_ORI_ATE(+) /*squi*/
/*AND ATENDIME.CD_PRESTADOR = PRESTADOR.CD_PRESTADOR(+) AQUI*/
/*AND ATENDIME.CD_LEITO = LEITO.CD_LEITO(+) squi*/
/*AND LEITO.CD_UNID_INT = UNID_INT.CD_UNID_INT(+)*/
/*AND ATENDIME.CD_CID = CID.CD_CID(+)*/
/*AND ATENDIME.CD_SERVICO = SERVICO.CD_SERVICO(+)*/
/*AND ATENDIME.CD_SER_DIS = SER_DIS.CD_SER_DIS(+) */
/*AND ATENDIME.CD_TIP_ACOM = TIP_ACOM.CD_TIP_ACOM(+)*/
/*AND ATENDIME.CD_ATENDIMENTO = RESPONSA.CD_ATENDIMENTO(+)*/
/*AND ATENDIME.CD_PACIENTE = CARTEIRA.CD_PACIENTE(+)===============================*/
/*AND atendime.CD_CONVENIO = CON_PLA.CD_CONVENIO(+) ===============================*/
/*AND atendime.cd_convenio = convenio.cd_convenio */
/*AND Atendime.CD_CON_PLA = CON_PLA.CD_CON_PLA(+) */
/*AND ATENDIME.CD_ATENDIMENTO = ATENDIME_INFO.CD_ATENDIMENTO(+) */
/*AND ATENDIME.CD_ESPECIALID = ESPECIALID.CD_ESPECIALID(+)*/
/*AND CARTEIRA.CD_CATEGORIA_PLANO = CATEGORIA_PLANO.CD_CATEGORIA_PLANO(+)*/
/*and Atendime.cd_con_pla = carteira.cd_con_pla (+)======================================*/
/*and atendime.cd_convenio = carteira.cd_convenio (+)================================*/
/*AND PACIENTE.CD_RELIGIAO = RELIGIAO.CD_RELIGIAO(+) */
/*AND PACIENTE.CD_GRAU_INS = GRAU_INS.CD_GRAU_INS(+)*/
/*AND PACIENTE.CD_NATURALIDADE = CIDADE2.CD_CIDADE(+)=========================*/
/*AND PACIENTE.CD_CIDADANIA = CIDADANIAS.CD_CIDADANIA(+) */
/*AND ATENDIME.CD_ATENDIMENTO = GUIA.CD_ATENDIMENTO(+)*/
/*AND PACIENTE.CD_PROFISSAO = PROFISSAO.CD_PROFISSAO(+)*/
/*(guia.tp_guia = 'I' or atendime.tp_atendimento in ('U','E','A') /*or atendime.cd_convenio in ( 2, 294, 295 ))*/
/*and atendime.nr_carteira = carteira.nr_carteira (+) */   

ATENDIME.DT_ATENDIMENTO =  to_date(sysdate) 
/*and atendime.NM_usuario in ('BRUNA.ESTEVAM',
'JACQUELINNE.CAMARA',
'JEAN.MELO',
'JUSSARA.SILVA',
'LUCIENE.OLIVEIRA',
'SOLANGE.SANTOS')
 
    order by atendime.nm_usuario,ori_ate.ds_ori_ate,paciente.nm_paciente   */");