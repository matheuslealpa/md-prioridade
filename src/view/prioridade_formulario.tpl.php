<?php
try {
    require_once dirname(__FILE__) . '/../../../SEI.php';
    session_start();

    SessaoSEI::getInstance()->validarLink();
    SessaoSEI::getInstance()->validarPermissao($_GET['acao']);

    $idProcesso = $_GET['id_procedimento'] ?? null;
    if (!$idProcesso) {
        throw new InfraException('ID do processo não informado.');
    }

    $objEntradaConsultarProcedimentoAPI = new EntradaConsultarProcedimentoAPI();
    $objEntradaConsultarProcedimentoAPI->setIdProcedimento($idProcesso);

    $objSeiRN = new SeiRN();
    $objSaidaConsultarProcedimentoAPI = $objSeiRN->consultarProcedimento($objEntradaConsultarProcedimentoAPI);

    $strNumeroProcesso = $objSaidaConsultarProcedimentoAPI->getProcedimentoFormatado();

    $strTitulo = 'Definir Prioridade do Processo ' . $strNumeroProcesso;


    $nivelAtual = (new PrioridadeRN())->consultar($idProcesso);
    $arrComandos = [];

    // Botão Salvar
    $arrComandos[] = '<button type="submit" accesskey="S" name="sbmSalvarPrioridade" value="Salvar" class="infraButton"><span class="infraTeclaAtalho">S</span>alvar</button>';

    if (isset($_POST['sbmSalvarPrioridade'])) {
        try {
            $dto = new PrioridadeDTO();
            $dto->setNumIdProcedimento((int) $_POST['hdnIdProcesso']);
            $dto->setStrNivel($_POST['selNivelPrioridade']);

            $rn = new PrioridadeRN();
            $rn->cadastrarConectado($dto);

            $strMensagemSucesso = 'Prioridade definida com sucesso!';
            $nivelAtual = $_POST['selNivelPrioridade'];
        } catch (Exception $e) {
            PaginaSEI::getInstance()->processarExcecao($e);
        }
    }

} catch (Exception $e) {
    PaginaSEI::getInstance()->processarExcecao($e);
}

PaginaSEI::getInstance()->montarDocType();
PaginaSEI::getInstance()->abrirHtml();
PaginaSEI::getInstance()->abrirHead();
PaginaSEI::getInstance()->montarMeta();
PaginaSEI::getInstance()->montarTitle(PaginaSEI::getInstance()->getStrNomeSistema() . ' - ' . $strTitulo);
PaginaSEI::getInstance()->montarStyle();
PaginaSEI::getInstance()->abrirStyle();
?>
/* Estilos customizados, se necessário */
<?
PaginaSEI::getInstance()->fecharStyle();
PaginaSEI::getInstance()->montarJavaScript();
PaginaSEI::getInstance()->abrirJavaScript();
?>
function inicializar() {
document.getElementById('selNivelPrioridade').focus();
}

function validarCadastro() {
if (infraTrim(document.getElementById('selNivelPrioridade').value) === '') {
alert('Selecione o nível de prioridade.');
document.getElementById('selNivelPrioridade').focus();
return false;
}
return true;
}

function OnSubmitForm() {
return validarCadastro();
}
<?
PaginaSEI::getInstance()->fecharJavaScript();
PaginaSEI::getInstance()->fecharHead();
PaginaSEI::getInstance()->abrirBody($strTitulo, 'onload="inicializar();"');
?>

<?php if (!empty($strMensagemSucesso)) : ?>
    <div class="infraMensagemSucesso"><?= $strMensagemSucesso ?></div>
<?php endif; ?>


<form id="frmPrioridadeProcesso" method="post" onsubmit="return OnSubmitForm();" action="<?= SessaoSEI::getInstance()->assinarLink('controlador.php?acao=' . $_GET['acao'] . '&id_procedimento=' . $idProcesso) ?>">
    <?php
    PaginaSEI::getInstance()->montarBarraComandosSuperior($arrComandos);
    PaginaSEI::getInstance()->abrirAreaDados('50em');
    ?>

    <input type="hidden" name="hdnIdProcesso" id="hdnIdProcesso" value="<?= $idProcesso ?>"/>

    <fieldset class="infraFieldset">
        <legend class="infraLegend">Nível de Prioridade</legend>

        <table class="infraTable" id="tblPrioridadeProcesso">
            <tr>
                <td class="infraTd">Prioridade:</td>
                <td class="infraTd">
                    <select name="selNivelPrioridade" id="selNivelPrioridade" class="infraSelect">
                        <option value="">Selecione</option>
                        <option value="BAIXA"   <?= $nivelAtual === 'BAIXA'   ? 'selected' : '' ?>>Baixa</option>
                        <option value="MEDIA"   <?= $nivelAtual === 'MEDIA'   ? 'selected' : '' ?>>Média</option>
                        <option value="ALTA"    <?= $nivelAtual === 'ALTA'    ? 'selected' : '' ?>>Alta</option>
                        <option value="CRITICA" <?= $nivelAtual === 'CRITICA' ? 'selected' : '' ?>>Crítica</option>
                    </select>
                </td>
            </tr>
        </table>
    </fieldset>

    <?php
    PaginaSEI::getInstance()->fecharAreaDados();
    ?>
</form>

<?php
PaginaSEI::getInstance()->fecharBody();
PaginaSEI::getInstance()->fecharHtml();
?>
