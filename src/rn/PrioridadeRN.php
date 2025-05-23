<?php

class PrioridadeRN extends InfraRN
{

    public function cadastrarConectado(PrioridadeDTO $dto) {
        try {
            $bd = new PrioridadeBD($this->getObjInfraIBanco());

            $dtoConsulta = new PrioridadeDTO();
            $dtoConsulta->setNumIdProcedimento($dto->getNumIdProcedimento());
            $dtoConsulta->retDblIdPrioridade();
            $dtoConsulta->retStrNivel();

            $dtoExistente = $bd->consultar($dtoConsulta);

            if ($dtoExistente) {
                $dtoExistente->setStrNivel($dto->getStrNivel());
                return $bd->alterar($dtoExistente);
            } else {
                return $bd->cadastrar($dto);
            }

        } catch (Exception $e) {
            throw new InfraException('Erro ao salvar prioridade.', $e);
        }
    }


    public function consultarConectado($idProcedimento)
    {
        try {
            $dto = new PrioridadeDTO();
            $dto->setNumIdProcedimento($idProcedimento);
            $dto->retStrNivel();

            $bd = new PrioridadeBD($this->getObjInfraIBanco());
            $dto = $bd->consultar($dto);
            return $dto ? $dto->getStrNivel() : null;
        } catch (Exception $e) {
            throw new InfraException('Erro 2.', $e);
        }
    }

    protected function inicializarObjInfraIBanco()
    {
        return (new BancoSEI())->getInstance();
    }

    //try {
    //            $objDocumentoDTO = new DocumentoDTO();
    //            $objDocumentoDTO->retDblIdDocumento();
    //            $objDocumentoDTO->retStrNumero();
    //            $objDocumentoDTO->retNumIdSerie();
    //            $objDocumentoDTO->retStrSinArquivamento();
    //            $objDocumentoDTO->retStrAssinatura();
    //            $objDocumentoDTO->setDblIdProcedimento($_GET['id_procedimento'] ?: null);
    //            $objDocumentoDTO->retStrStaDocumento();
    //            $documentoDB = new DocumentoBD($this->getObjInfraIBanco());
    //            $arrDocumentos = $documentoDB->listar($objDocumentoDTO);
    //            return $arrDocumentos;
    //
    //        } catch (Exception $e) {
    //            throw new InfraException('Erro ao retornar a listagem de documentos.', $e);
    //        }
}
