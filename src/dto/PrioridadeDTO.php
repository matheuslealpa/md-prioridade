<?php

class PrioridadeDTO extends InfraDTO {

    public function getStrNomeTabela() {
        return 'md_prioridade';
    }

    public function montar() {
        $this->adicionarAtributoTabela(InfraDTO::$PREFIXO_DBL, 'IdPrioridade', 'id_prioridade');
        $this->adicionarAtributoTabela(InfraDTO::$PREFIXO_NUM, 'IdProcedimento', 'id_procedimento');
        $this->adicionarAtributoTabela(InfraDTO::$PREFIXO_STR, 'Nivel', 'nivel');

        $this->configurarPK('IdPrioridade', InfraDTO::$TIPO_PK_NATIVA);
    }
}
