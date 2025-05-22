<?php

class MdPrioridadeIntegracao extends SeiIntegracao
{
    public function __construct()
    {
    }

    public function getNome()
    {
        return 'Módulo de Indicador de Prioridade';
    }

    public function getVersao()
    {
        return '1.0.0';
    }

    public function getInstituicao()
    {
        return "LEAL";
    }


    public function montarIconeControleProcessos($arrObjProcedimentoAPI) {
        $arrIcones = array();

        foreach ($arrObjProcedimentoAPI as $objProcedimentoAPI) {
            $idProcesso = $objProcedimentoAPI->getIdProcedimento();

            $link = SessaoSEI::getInstance()->assinarLink(
                    'controlador.php?acao=md_prioridade_int_abrir_pagina_prioridade&id_procedimento=' . $idProcesso
            );

            $icone = '<a href="' . $link . '" '
                    . PaginaSEI::montarTitleTooltip('Definir Prioridade', 'Módulo de Prioridade') . '>'
                    . '<img src="modulos/md-prioridade/assets/svg/prioridade.svg" id="imgPrioridadeProcesso" class="imgPrioridadeProcesso" style="width:24px; height:24px;" />'
                    . '</a>';


            $arrIcones[$idProcesso][] = $icone;
        }

        return $arrIcones;
    }


    public function processarControlador($strAcaoPadrao)
    {
        if ($strAcaoPadrao == 'md_prioridade_int_abrir_pagina_prioridade') {
            require_once dirname(__FILE__) . '/view/prioridade_formulario.tpl.php';
            return true;
        }
        return false;
    }

    public function processarControladorAjax($strAcaoAjax)
    {
        if ($strAcaoAjax == 'md_prioridade_ajax_salvar') {
            require_once dirname(__FILE__) . '/ws/PrioridadeWS.php';
            $ws = new PrioridadeWS();
            $ws->salvarPrioridadeAjax();
        }
    }

}
