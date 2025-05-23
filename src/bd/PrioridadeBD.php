<?php

class PrioridadeBD extends InfraBD
{

    public function cadastrarPrioridade(PrioridadeDTO $dto)
    {
        return $this->cadastrar($dto);
    }

    public function alterarPrioridade(PrioridadeDTO $dto)
    {
        return $this->alterar($dto);
    }

    public function consultarPrioridadePorProcedimento($idProcedimento)
    {
        $dto = new PrioridadeDTO();
        $dto->setNumIdProcedimento($idProcedimento);
        $dto->retStrNivel();
        return $this->consultar($dto);
    }
}
