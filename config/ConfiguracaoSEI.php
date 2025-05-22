<?

class ConfiguracaoSEI extends InfraConfiguracao  {

    private static $instance = null;

    public static function getInstance(){
        if (ConfiguracaoSEI::$instance == null) {
            ConfiguracaoSEI::$instance = new ConfiguracaoSEI();
        }
        return ConfiguracaoSEI::$instance;
    }

    public function getArrConfiguracoes(){
        return array(

            'SEI' => array(
                'URL' => getenv('APP_PROTOCOLO').'://'.getenv('APP_HOST').'/sei',
                'Producao' => getenv('APP_PRODUCAO'),
                'DigitosDocumento' => getenv('APP_DIGITOS_DOCUMENTO'),
                'RepositorioArquivos' => '/sei-dados',
              'Modulos' => array(
				'MdPrioridadeIntegracao' => 'md-prioridade',
			  ),

            ),

            'PaginaSEI' => array(
                'NomeSistema' => 'SEI',
                'NomeSistemaComplemento' => getenv('APP_NOMECOMPLEMENTO'),
                'LogoMenu' => ''),

            'SessaoSEI' => array(
                'SiglaOrgaoSistema' => getenv('APP_ORGAO'),
                'SiglaSistema' => 'SEI',
                'PaginaLogin' => getenv('APP_PROTOCOLO').'://'.getenv('APP_HOST').'/sip/login.php',
                'SipWsdl' => getenv('APP_PROTOCOLO').'://'.getenv('APP_HOST').'/sip/controlador_ws.php?servico=sip',
# 	          'ChaveAcesso' => getenv('7babf8627b583551a993d59f3f1ed074f7dd1ef58768ac91dd1ce2f071f66be78d28a814'),
                'ChaveAcesso' => '7babf862e12bd48f3101075c399040303d94a493c7ce9306470f719bb453e0428c6135dc',
                'https' => (getenv('APP_PROTOCOLO') == 'https' ? true : false)),

            'BancoSEI'  => array(
                'Servidor' => getenv('DB_HOST'),
                'Porta' => getenv('DB_PORTA'),
                'Banco' => getenv('DB_SEI_BASE'),
                'Usuario' => getenv('DB_SEI_USERNAME'),
                'Senha' => getenv('DB_SEI_PASSWORD'),
                'UsuarioScript' => getenv('DB_SEI_USERNAME'),
                'SenhaScript' => getenv('DB_SEI_PASSWORD'),
                'Tipo' => getenv('DB_TIPO')), //MySql, SqlServer, Oracle ou PostgreSql

            /*
         'BancoAuditoriaSEI'  => array(
                'Servidor' => '[servidor BD]',
                'Porta' => '',
                'Banco' => '',
                'Usuario' => '',
                'Senha' => '',
                'Tipo' => ''), //MySql, SqlServer, Oracle ou PostgreSql
         */

            'CacheSEI' => array('Servidor' => getenv('MEMCACHED_HOST'),
                'Porta' => '11211'),

            'Federacao' => array(
                'Habilitado' => false
            ),

            'JODConverter' => array('Servidor' => 'http://'.getenv('JOD_HOST').':8088/converter/service'),

            'Solr' => array(
                'Servidor' => getenv('SOLR_URL'),
                'CoreProtocolos' => getenv('SOLR_CORE_PROTOCOLOS'),
                'TempoCommitProtocolos' => getenv('SOLR_TEMPO_COMMIT_PROTOCOLOS'),
                'CoreBasesConhecimento' => getenv('SOLR_CORE_BASECONHECIMENTO'),
                'TempoCommitBasesConhecimento' => getenv('SOLR_TEMPO_COMMIT_BASECONHECIMENTO'),
                'CorePublicacoes' => getenv('SOLR_CORE_PUBLICACOES'),
                'TempoCommitPublicacoes' => getenv('SOLR_TEMPO_COMMIT_PUBLICACOES')),

            'HostWebService' => array(
                'Sip' => array('localhost', getenv('APP_HOST'), '127.0.0.1'),
                #'Publicacao' => array('10.1.0.64','10.1.1.76', '10.1.1.101'),
                'Ouvidoria' => array('localhost', getenv('APP_HOST'), '*'),
            ),
            'InfraMail' => array(
                'Tipo' => getenv('MAIL_TIPO'), //1 = sendmail (neste caso n?o ? necess?rio configurar os atributos abaixo), 2 = SMTP
                'Servidor' => getenv('MAIL_SERVIDOR'),
                'Porta' => getenv('MAIL_PORTA'),
                'Codificacao' => getenv('MAIL_CODIFICACAO'), //8bit, 7bit, binary, base64, quoted-printable
                'MaxDestinatarios' => getenv('MAIL_MAXDESTINATARIOS'), //numero maximo de destinatarios por mensagem
                'MaxTamAnexosMb' => getenv('MAIL_MAXTAMANHOANEXOSMB'), //tamanho maximo dos anexos em Mb por mensagem
                'Seguranca' => getenv('MAIL_SEGURANCA'), //TLS, SSL ou vazio
                'Autenticar' => getenv('MAIL_AUTENTICAR'), //se true ent?o informar Usuario e Senha
                'Usuario' => getenv('MAIL_USUARIO'),
                'Senha' => getenv('MAIL_SENHA'),
                'Protegido' => getenv('MAIL_PROTEGIDO') //campo usado em desenvolvimento, se tiver um email preenchido entao todos os emails enviados terao o destinatario ignorado e substitu?do por este valor evitando envio incorreto de email
            )
        );
    }
}
?>
