create database if not exists zeppelin;

use zeppelin;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `zeppelin`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cobranca` (IN `in_id_orcamento` INT, IN `in_id_pagamento` INT, IN `in_id_orcamento_pagamento` INT)  begin
declare p_id_banco int;
declare p_id_cliente int;
declare p_id_agente int;
declare p_data_vencimento date;
declare p_data_pagamento date default '1900-01-01';
declare p_data_recebimento date default '1900-01-01';
declare p_status_pagamento varchar(20) default 'aberto';
declare p_num_parcela int;
declare p_valor_parcela decimal(10,2);
declare p_valor_recebido decimal(10,2) default (0.00);
declare p_valor_desconto decimal(10,2) default (0.00);
declare p_valor_multa decimal(10,2) default (0.00);
declare p_valor_juros decimal(10,2) default (0.00);
declare p_valor_total decimal(10,2) default (0.00);
declare j int;

set j = 1;

select 
orcamento_pagamentos.parcelas into p_num_parcela
from orcamento_pagamentos
inner join orcamentos on orcamento_pagamentos.id_orcamento = orcamentos.id_orcamento
    where 
    	orcamento_pagamentos.id_orcamento = in_id_orcamento
    and
    	orcamento_pagamentos.id_pagamento = in_id_pagamento
   and 
   		orcamento_pagamentos.id_orcamento_pagamento = in_id_orcamento_pagamento
    ;

select 
orcamento_pagamentos.valor_parcela into p_valor_parcela
from orcamento_pagamentos
inner join orcamentos on orcamento_pagamentos.id_orcamento = orcamentos.id_orcamento
    where 
    	orcamento_pagamentos.id_orcamento = in_id_orcamento
    and
	    orcamento_pagamentos.id_pagamento = in_id_pagamento
    and 
    	orcamento_pagamentos.id_orcamento_pagamento = in_id_orcamento_pagamento
   ;

select 
orcamento_pagamentos.id_agente into p_id_agente
from orcamento_pagamentos
inner join orcamentos on orcamento_pagamentos.id_orcamento = orcamentos.id_orcamento
    where 
    	orcamento_pagamentos.id_orcamento = in_id_orcamento
    and
	    orcamento_pagamentos.id_pagamento = in_id_pagamento
	and 
		orcamento_pagamentos.id_orcamento_pagamento = in_id_orcamento_pagamento;
   
select 
orcamento_pagamentos.id_banco into p_id_banco
from orcamento_pagamentos
inner join orcamentos on orcamento_pagamentos.id_orcamento = orcamentos.id_orcamento
    where 
    	orcamento_pagamentos.id_orcamento = in_id_orcamento
    and
    	orcamento_pagamentos.id_pagamento = in_id_pagamento
    and 
   		orcamento_pagamentos.id_orcamento_pagamento = in_id_orcamento_pagamento;


select 
orcamentos.id_cliente into p_id_cliente
from orcamento_pagamentos
inner join orcamentos on orcamento_pagamentos.id_orcamento = orcamentos.id_orcamento
    where 
    	orcamento_pagamentos.id_orcamento = in_id_orcamento
    and
    	orcamento_pagamentos.id_pagamento = in_id_pagamento
    and 
   		orcamento_pagamentos.id_orcamento_pagamento = in_id_orcamento_pagamento;
   

	while(j <= p_num_parcela) do

		insert
			into
			cobrancas
      (id_cliente, id_orcamento, data_geracao, data_vencimento, data_pagamento, data_recebimento, status_pagamento,id_agente,id_banco ,id_pagamento, num_parcela, valor_parcela, valor_recebido, valor_desconto, valor_multa, valor_juros, valor_total, created_at)
				values
			(p_id_cliente, in_id_orcamento, cast(now() as date), DATE_ADD(cast(now() as date), INTERVAL j MONTH), '1900-01-01',  '1900-01-01', p_status_pagamento, p_id_agente, p_id_banco, in_id_pagamento,j,p_valor_parcela, 0.0, 0.0,0.0,0.0,0.0, now() );
        set j = j+1;
		end while;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `agentes`
--

CREATE TABLE `agentes` (
  `id_agente` int(10) UNSIGNED NOT NULL,
  `codigo` int(11) NOT NULL,
  `titular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_banco` int(10) UNSIGNED DEFAULT NULL,
  `tipo_conta` enum('Conta Corrente','Conta Poupança') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_agente` tinyint(1) NOT NULL DEFAULT 1,
  `agencia` int(11) DEFAULT NULL,
  `conta` int(11) DEFAULT NULL,
  `digito` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bancos`
--

CREATE TABLE `bancos` (
  `id_banco` int(10) UNSIGNED NOT NULL,
  `codigo` int(11) NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_banco` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixas`
--

CREATE TABLE `caixas` (
  `id_caixa` int(10) UNSIGNED NOT NULL,
  `valor_recebido` double(8,2) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `data_recebimento` date NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa_cobranca`
--

CREATE TABLE `caixa_cobranca` (
  `id_caixa` int(10) UNSIGNED NOT NULL,
  `id_cobranca` int(10) UNSIGNED NOT NULL,
  `data_recebimento` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE `cidades` (
  `id_cidade` int(10) UNSIGNED NOT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_estado` int(10) UNSIGNED NOT NULL,
  `ibge` int(11) NOT NULL,
  `ddd` int(11) NOT NULL,
  `capital` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`id_cidade`, `cidade`, `id_estado`, `ibge`, `ddd`, `capital`, `created_at`, `updated_at`) VALUES
(1, 'GOIÂNIA', 1, 0, 62, 1, NULL, NULL),
(2, 'SÃO PAULO', 2, 0, 11, 1, NULL, NULL),
(3, 'RIO DE JANEIRO', 3, 0, 21, 1, NULL, NULL),
(4, 'RIO BRANCO', 4, 0, 68, 1, NULL, NULL),
(5, 'MACEIÓ', 5, 0, 82, 1, NULL, NULL),
(6, 'MACAPÁ', 6, 0, 96, 1, NULL, NULL),
(7, 'MANAUS', 7, 0, 92, 1, NULL, NULL),
(8, 'SALVADOR', 8, 0, 71, 1, NULL, NULL),
(9, 'FORTALEZA', 9, 0, 85, 1, NULL, NULL),
(10, 'VITORIA', 10, 0, 27, 1, NULL, NULL),
(11, 'SÃO LUÍS', 11, 0, 98, 1, NULL, NULL),
(12, 'CUIABA', 12, 0, 65, 1, NULL, NULL),
(13, 'CAMPO GRANDE', 13, 0, 67, 1, NULL, NULL),
(14, 'BELO HORIZONTE', 14, 0, 31, 1, NULL, NULL),
(15, 'BELO HORIZONTE', 14, 0, 31, 1, NULL, NULL),
(16, 'BELÉM', 15, 0, 91, 1, NULL, NULL),
(17, 'JOÃO PESSOA', 16, 0, 83, 1, NULL, NULL),
(18, 'CURITIBA', 17, 0, 41, 1, NULL, NULL),
(19, 'RECIFE', 18, 0, 81, 1, NULL, NULL),
(20, 'TERESINA', 19, 0, 86, 1, NULL, NULL),
(21, 'NATAL', 20, 0, 84, 1, NULL, NULL),
(22, 'PORTO ALEGRE', 21, 0, 51, 1, NULL, NULL),
(23, 'PORTO VELHO', 22, 0, 69, 1, NULL, NULL),
(24, 'BOA VISTA', 23, 0, 95, 1, NULL, NULL),
(25, 'FLORIANÓPOLIS', 24, 0, 48, 1, NULL, NULL),
(26, 'ARACAJU', 25, 0, 79, 1, NULL, NULL),
(27, 'PALMAS', 26, 0, 63, 1, NULL, NULL),
(28, 'BRASILIA', 27, 0, 61, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `id_pessoa_fisica` int(10) UNSIGNED DEFAULT NULL,
  `id_pessoa_juridica` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cobrancas`
--

CREATE TABLE `cobrancas` (
  `id_cobranca` int(10) UNSIGNED NOT NULL,
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `id_orcamento` int(10) UNSIGNED NOT NULL,
  `data_geracao` date NOT NULL DEFAULT current_timestamp(),
  `data_vencimento` date NOT NULL,
  `data_pagamento` date NOT NULL DEFAULT '1900-01-01',
  `data_recebimento` date NOT NULL DEFAULT '1900-01-01',
  `status_pagamento` enum('baixado','aberto','atrasado','estornado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_agente` int(10) UNSIGNED NOT NULL,
  `id_banco` int(10) UNSIGNED NOT NULL,
  `id_pagamento` int(10) UNSIGNED NOT NULL,
  `num_parcela` int(11) NOT NULL,
  `valor_parcela` double(8,2) NOT NULL,
  `valor_recebido` double(8,2) NOT NULL,
  `valor_desconto` double(8,2) NOT NULL,
  `valor_multa` double(8,2) NOT NULL,
  `valor_juros` double(8,2) NOT NULL,
  `valor_total` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(10) UNSIGNED NOT NULL,
  `uf` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`id_estado`, `uf`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'GO', 'GOIÁS', NULL, NULL),
(2, 'SP', 'SÃO PAULO', NULL, NULL),
(3, 'RJ', 'RIO DE JANEIRO', NULL, NULL),
(4, 'AC', 'ACRE', NULL, NULL),
(5, 'AL', 'ALAGOAS', NULL, NULL),
(6, 'AP', 'AMAPÁ', NULL, NULL),
(7, 'AM', 'AMAZONAS', NULL, NULL),
(8, 'BA', 'BAHIA', NULL, NULL),
(9, 'CE', 'CEARÁ', NULL, NULL),
(10, 'ES', 'ESPÍRITO SANTO', NULL, NULL),
(11, 'MA', 'MARANHÃO', NULL, NULL),
(12, 'MT', 'MATO GROSSO', NULL, NULL),
(13, 'MS', 'MATO GROSSO DO SUL', NULL, NULL),
(14, 'MG', 'MINAS GERAIS', NULL, NULL),
(15, 'PA', 'PARÁ', NULL, NULL),
(16, 'PA', 'PARAÍBA', NULL, NULL),
(17, 'PR', 'PARANÁ', NULL, NULL),
(18, 'PE', 'PERNAMBUCO', NULL, NULL),
(19, 'PI', 'PIAUÍ', NULL, NULL),
(20, 'RN', 'RIO GRANDE DO NORTE', NULL, NULL),
(21, 'RS', 'RIO GRANDE DO SUL', NULL, NULL),
(22, 'RO', 'RONDÔNIA', NULL, NULL),
(23, 'RR', 'RORAIMA', NULL, NULL),
(24, 'SC', 'SANTA CATARINA', NULL, NULL),
(25, 'SE', 'SERGIPE', NULL, NULL),
(26, 'TO', 'TOCANTINS', NULL, NULL),
(27, 'DF', 'DISTRITO FEDERAL', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_14_205449_create_estados_table', 1),
(5, '2020_07_15_120106_create_cidades_table', 1),
(6, '2020_07_16_204431_create_servicos_table', 1),
(7, '2020_07_18_131618_create_pessoa_fisicas_table', 1),
(8, '2020_07_22_112608_create_natureza_juridicas_table', 1),
(9, '2020_07_22_224248_create_pessoa_juridicas_table', 1),
(10, '2020_07_28_232512_create_perfils_table', 1),
(11, '2020_09_20_112749_create_produtos_table', 1),
(12, '2020_12_07_012245_create_clientes_table', 1),
(13, '2020_12_07_013939_create_veiculos_table', 1),
(14, '2021_03_21_180044_create_orcamentos_table', 1),
(15, '2021_03_21_190530_create_orcamento_items_table', 1),
(16, '2021_04_10_013121_add_estoque_table_produtos', 1),
(17, '2021_04_13_004506_add_perfil_pessoa_table_users', 1),
(18, '2021_04_17_171259_create_banco_table', 1),
(19, '2021_04_17_223835_create_agentes_table', 1),
(20, '2021_04_19_183917_create_pagamentos_table', 1),
(21, '2021_04_19_220819_create_orcamento_pagamentos_table', 1),
(22, '2021_05_19_154422_create_cobrancas_table', 1),
(23, '2021_05_19_162048_create_caixas_table', 1),
(24, '2021_05_27_011527_create_caixa_cobranca_table', 1),
(25, '2021_05_29_200933_add_users_foto', 1),
(26, '2021_06_12_152458_create_ordem_servicos_table', 1),
(27, '2021_06_14_233831_create_ordem_servico_servicos_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `natureza_juridicas`
--

CREATE TABLE `natureza_juridicas` (
  `cod_natureza_juridica` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `natureza_juridica` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `representante` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualificacao` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `natureza_juridicas`
--

INSERT INTO `natureza_juridicas` (`cod_natureza_juridica`, `natureza_juridica`, `representante`, `qualificacao`, `created_at`, `updated_at`) VALUES
('101-5', 'Órgão Público do Poder Executivo Federal', 'Administrador', '5', NULL, NULL),
('102-3', 'Órgão Público do Poder Executivo Estadual ou do Distrito Federal', 'Administrador', '5', NULL, NULL),
('103-1', 'Órgão Público do Poder Executivo Municipal', 'Administrador', '5', NULL, NULL),
('104-0', 'Órgão Público do Poder Legislativo Federal', 'Administrador', '5', NULL, NULL),
('105-8', 'Órgão Público do Poder Legislativo Estadual ou do Distrito Federal', 'Administrador', '5', NULL, NULL),
('106-6', 'Órgão Público do Poder Legislativo Municipal', 'Administrador', '5', NULL, NULL),
('107-4', 'Órgão Público do Poder Judiciário Federal', 'Administrador', '5', NULL, NULL),
('108-2', 'Órgão Público do Poder Judiciário Estadual', 'Administrador', '5', NULL, NULL),
('110-4', 'Autarquia Federal', 'Administrador ou Presidente', '05 ou 16', NULL, NULL),
('111-2', 'Autarquia Estadual ou do Distrito Federal', 'Administrador ou Presidente', '05 ou 16', NULL, NULL),
('112-0', 'Autarquia Municipal', 'Administrador ou Presidente', '05 ou 16', NULL, NULL),
('113-9', 'Fundação Federal', 'Presidente', '16', NULL, NULL),
('114-7', 'Fundação Estadual ou do Distrito Federal', 'Presidente', '16', NULL, NULL),
('115-5', 'Fundação Municipal', 'Presidente', '16', NULL, NULL),
('116-3', 'Órgão Público Autônomo Federal', 'Administrador', '5', NULL, NULL),
('117-1', 'Órgão Público Autônomo Estadual ou do Distrito Federal', 'Administrador', '5', NULL, NULL),
('118-0', 'Órgão Público Autônomo Municipal', 'Administrador', '5', NULL, NULL),
('119-8', 'Comissão Polinacional', 'Administrador', '5', NULL, NULL),
('120-1', 'Fundo Público', 'Administrador', '5', NULL, NULL),
('121-0', 'Associação Pública', 'Presidente', '16', NULL, NULL),
('201-1', 'Empresa Pública', 'Administrador, Diretor ou Presidente', '05, 10 ou 16', NULL, NULL),
('203-8', 'Sociedade de Economia Mista', 'Diretor ou Presidente', '10 ou 16', NULL, NULL),
('204-6', 'Sociedade Anônima Aberta', 'Administrador, Diretor ou Presidente', '05, 10 ou 16', NULL, NULL),
('205-4', 'Sociedade Anônima Fechada', 'Administrador, Diretor ou Presidente', '05, 10 ou 16', NULL, NULL),
('206-2', 'Sociedade Empresária Limitada', 'Administrador ou Sócio-Administrador', '05 ou 49', NULL, NULL),
('207-0', 'Sociedade Empresária em Nome Coletivo', 'Sócio-Administrador', '49', NULL, NULL),
('208-9', 'Sociedade Empresária em Comandita Simples', 'Sócio Comanditado', '24', NULL, NULL),
('209-7', 'Sociedade Empresária em Comandita por Ações', 'Diretor ou Presidente', '10 ou 16', NULL, NULL),
('212-7', 'Sociedade em Conta de Participação', 'Procurador ou Sócio Ostensivo', '17 ou 31', NULL, NULL),
('213-5', 'Empresário (Individual)', 'Empresário', '50', NULL, NULL),
('214-3', 'Cooperativa', 'Diretor ou Presidente', '10 ou 16', NULL, NULL),
('215-1', 'Consórcio de Sociedades', 'Administrador', '5', NULL, NULL),
('216-0', 'Grupo de Sociedades', 'Administrador', '5', NULL, NULL),
('217-8', 'Estabelecimento, no Brasil, de Sociedade Estrangeira', 'Procurador', '17', NULL, NULL),
('219-4', 'Estabelecimento, no Brasil, de Empresa Binacional Argentino-Brasileira', 'Procurador', '17', NULL, NULL),
('221-6', 'Empresa Domiciliada no Exterior', 'Procurador', '17', NULL, NULL),
('222-4', 'Clube/Fundo de Investimento', 'Responsável', '43', NULL, NULL),
('223-2', 'Sociedade Simples Pura', 'Administrador ou Sócio-Administrador', '05 ou 49', NULL, NULL),
('224-0', 'Sociedade Simples Limitada', 'Administrador ou Sócio-Administrador', '05 ou 49', NULL, NULL),
('225-9', 'Sociedade Simples em Nome Coletivo', 'Sócio-Administrador', '49', NULL, NULL),
('226-7', 'Sociedade Simples em Comandita Simples', 'Sócio Comanditado', '24', NULL, NULL),
('227-5', 'Empresa Binacional', 'Diretor', '10', NULL, NULL),
('228-3', 'Consórcio de Empregadores', 'Administrador', '5', NULL, NULL),
('229-1', 'Consórcio Simples', 'Administrador', '5', NULL, NULL),
('230-5', 'Empresa Individual de Responsabilidade Limitada (de Natureza Empresária)', 'Administrador, Procurador ou Titular Pessoa Física Residente ou Domiciliado no Brasil', '05, 17 ou 65', NULL, NULL),
('231-3', 'Empresa Individual de Responsabilidade Limitada (de Natureza Simples)', 'Administrador, Procurador ou Titular Pessoa Física Residente ou Domiciliado no Brasil', '05,17 ou 65', NULL, NULL),
('303-4', 'Serviço Notarial e Registral (Cartório)', 'Tabelião ou Oficial de Registro', '32 ou 42', NULL, NULL),
('306-9', 'Fundação Privada', 'Administrador, Diretor, Presidente ou Fundador', '05, 10, 16 ou 5', NULL, NULL),
('307-7', 'Serviço Social Autônomo', 'Administrador', '5', NULL, NULL),
('308-5', 'Condomínio Edilício', 'Administrador ou Síndico (Condomínio)', '05 ou 19', NULL, NULL),
('310-7', 'Comissão de Conciliação Prévia', 'Administrador', '5', NULL, NULL),
('311-5', 'Entidade de Mediação e Arbitragem', 'Administrador', '5', NULL, NULL),
('312-3', 'Partido Político', 'Administrador ou Presidente', '05 ou 16', NULL, NULL),
('313-1', 'Entidade Sindical', 'Administrador ou Presidente', '05 ou 16', NULL, NULL),
('320-4', 'Estabelecimento, no Brasil, de Fundação ou Associação Estrangeiras', 'Procurador', '17', NULL, NULL),
('321-2', 'Fundação ou Associação domiciliada no exterior', 'Procurador', '17', NULL, NULL),
('322-0', 'Organização Religiosa', 'Administrador, Diretor ou Presidente', '05, 10 ou 16', NULL, NULL),
('323-9', 'Comunidade Indígena', 'Responsável Indígena', '61', NULL, NULL),
('324-7', 'Fundo Privado', 'Administrador', '5', NULL, NULL),
('399-9', 'Associação Privada', 'Administrador, Diretor ou Presidente', '05, 10 ou 16', NULL, NULL),
('401-4', 'Empresa Individual Imobiliária', 'Titular', '34', NULL, NULL),
('408-1', 'Contribuinte Individual', 'Produtor Rural', '59', NULL, NULL),
('409-0', 'Candidato a Cargo Político Eletivo', 'Candidato a Cargo Político Eletivo', '51', NULL, NULL),
('501-0', 'Organização Internacional', 'Representante de Organização Internacional', '41', NULL, NULL),
('502-9', 'Representação Diplomática Estrangeira', 'Diplomata, Cônsul, Ministro de Estado das Relações Exteriores ou Cônsul Honorário', '39, 40, 46 ou 60', NULL, NULL),
('503-7', 'Outras Instituições Extraterritoriais', 'Representante da Instituição Extraterritorial', '62', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamentos`
--

CREATE TABLE `orcamentos` (
  `id_orcamento` int(10) UNSIGNED NOT NULL,
  `valor_desconto` double(8,2) NOT NULL DEFAULT 0.00,
  `percentual_desconto` double(8,2) NOT NULL DEFAULT 0.00,
  `valor_total_sem_desconto` double(8,2) NOT NULL DEFAULT 0.00,
  `valor_total` double(8,2) NOT NULL DEFAULT 0.00,
  `status_orcamento` enum('aberto','fechado','cancelado','aprovado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aberto',
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `id_veiculo` int(10) UNSIGNED DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `salvo` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Acionadores `orcamentos`
--
DELIMITER $$
CREATE TRIGGER `tg_orcamentos_update` AFTER UPDATE ON `orcamentos` FOR EACH ROW begin
	declare validador int;
	declare i int;
	declare new_id_pagamento int;
	declare new_id_orcamento_pagamento int;

	set i = 0;
	if new.status_orcamento = 'aprovado' then 
		select count(1) into validador from orcamento_pagamentos where id_orcamento = new.id_orcamento;
		while i < validador do
			select 
					id_pagamento into new_id_pagamento
				from orcamento_pagamentos 
				where 
					id_orcamento = new.id_orcamento 
					and 
					not exists (
						select 1 from cobrancas 
							where 
								id_orcamento = new.id_orcamento 
							and 
								cobrancas.id_pagamento = orcamento_pagamentos.id_pagamento)
				limit  1;
			
				select 
					id_orcamento_pagamento into new_id_orcamento_pagamento
				from orcamento_pagamentos 
				where 
					id_orcamento = new.id_orcamento 
					and 
					not exists (
						select 1 from cobrancas 
							where 
								id_orcamento = new.id_orcamento 
							and 
								cobrancas.id_pagamento = orcamento_pagamentos.id_pagamento)
				limit  1;
				
			call sp_cobranca(new.id_orcamento, new_id_pagamento, new_id_orcamento_pagamento);
			set i = i + 1;
		end while;
	end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento_items`
--

CREATE TABLE `orcamento_items` (
  `id_orcamento_item` int(10) UNSIGNED NOT NULL,
  `id_orcamento` int(10) UNSIGNED NOT NULL,
  `id_produto` int(10) UNSIGNED DEFAULT NULL,
  `id_servico` int(10) UNSIGNED DEFAULT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 0,
  `valor_desconto` double(8,2) NOT NULL DEFAULT 0.00,
  `percentual_desconto` double(8,2) NOT NULL DEFAULT 0.00,
  `valor_total_sem_desconto` double(8,2) NOT NULL DEFAULT 0.00,
  `valor_total` double(8,2) NOT NULL DEFAULT 0.00,
  `id_user` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Acionadores `orcamento_items`
--
DELIMITER $$
CREATE TRIGGER `tg_orcamento_item` AFTER INSERT ON `orcamento_items` FOR EACH ROW begin
	declare valor_desconto_tg float;
	declare percentual_desconto_tg float;
	declare valor_total_sem_desconto_tg float;
	declare valor_total_tg float;
	declare quantidade int;
	declare quantidade_prod int;

	select estoque into quantidade_prod from produtos where id_produto = new.id_produto;

	set quantidade = new.quantidade;

	select sum(valor_desconto) into valor_desconto_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select avg(percentual_desconto) into percentual_desconto_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total_sem_desconto) into valor_total_sem_desconto_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total) into valor_total_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	
	update orcamentos set valor_desconto = valor_desconto_tg, percentual_desconto = percentual_desconto_tg, valor_total_sem_desconto = valor_total_sem_desconto_tg , valor_total = valor_total_tg where id_orcamento = new.id_orcamento;
	
	update produtos set estoque = (quantidade_prod - quantidade) where id_produto = new.id_produto;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_orcamento_item_delete` AFTER DELETE ON `orcamento_items` FOR EACH ROW begin
	declare valor_desconto_tg float;
	declare percentual_desconto_tg float;
	declare valor_total_sem_desconto_tg float;
	declare valor_total_tg float;
	declare quantidade int;
	declare quantidade_prod int;

	select sum(valor_desconto) into valor_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select avg(percentual_desconto) into percentual_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total_sem_desconto) into valor_total_sem_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total) into valor_total_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;

	select estoque into quantidade_prod from produtos where id_produto = old.id_produto;

	set quantidade = old.quantidade;

	if old.id_orcamento is null then
		set valor_desconto_tg = 0;
		set percentual_desconto_tg = 0;
		set valor_total_sem_desconto_tg = 0;
		set valor_total_tg = 0;
	end if;

	update orcamentos set valor_desconto = ifnull(valor_desconto_tg,0), percentual_desconto = ifnull(percentual_desconto_tg,0), valor_total_sem_desconto = ifnull(valor_total_sem_desconto_tg,0) , valor_total = ifnull(valor_total_tg,0) where id_orcamento = OLD.id_orcamento;
	update produtos set estoque = (quantidade_prod + quantidade) where id_produto = old.id_produto;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento_pagamentos`
--

CREATE TABLE `orcamento_pagamentos` (
  `id_orcamento_pagamento` int(10) UNSIGNED NOT NULL,
  `id_orcamento` int(10) UNSIGNED NOT NULL,
  `id_agente` int(10) UNSIGNED NOT NULL,
  `id_pagamento` int(10) UNSIGNED NOT NULL,
  `id_banco` int(10) UNSIGNED NOT NULL,
  `parcelas` int(11) NOT NULL,
  `valor_parcela` double NOT NULL,
  `valor_total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_servicos`
--

CREATE TABLE `ordem_servicos` (
  `id_ordemservico` int(10) UNSIGNED NOT NULL,
  `id_orcamento` int(10) UNSIGNED NOT NULL,
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `id_funcionario` bigint(20) UNSIGNED DEFAULT NULL,
  `data_geracao` date NOT NULL DEFAULT current_timestamp(),
  `data_previsao` date DEFAULT '1900-01-01',
  `data_finalizacao` date DEFAULT '1900-01-01',
  `prioridade` enum('baixa','media','alta') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baixa',
  `status_servico` enum('não iniciado','iniciado','pausado','finalizado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'não iniciado',
  `id_veiculo` int(10) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `observacao` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_servico_servicos`
--

CREATE TABLE `ordem_servico_servicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ordemservico` int(10) UNSIGNED NOT NULL,
  `id_servico` int(10) UNSIGNED NOT NULL,
  `data_hora_inicio` datetime DEFAULT NULL,
  `data_hora_finalizacao` datetime DEFAULT NULL,
  `status_servico` enum('Não Iniciado','Em Andamento','Finalizado','Pausado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Não Iniciado',
  `id_funcionario` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id_pagamento` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_agente` int(10) UNSIGNED NOT NULL,
  `numero_parcelas` int(11) NOT NULL,
  `intervalo_parcelas` int(11) NOT NULL,
  `status_pagamento` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfils`
--

CREATE TABLE `perfils` (
  `id_perfil` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `perfils`
--

INSERT INTO `perfils` (`id_perfil`, `descricao`, `admin`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'ADMINISTRADOR', 1, 1, NULL, NULL),
(2, 'MECÂNICO', 0, 1, NULL, NULL),
(3, 'SECRETÁRIO', 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_fisicas`
--

CREATE TABLE `pessoa_fisicas` (
  `id_pessoa_fisica` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtnascimento` date NOT NULL,
  `cpf` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` enum('f','m','o') COLLATE utf8mb4_unicode_ci NOT NULL,
  `rg` int(11) NOT NULL,
  `orgaoexpedidor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cidade` int(10) UNSIGNED NOT NULL,
  `cep` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` int(11) NOT NULL DEFAULT 0,
  `complemento` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celular` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fornecedor` tinyint(1) NOT NULL DEFAULT 0,
  `cliente` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Acionadores `pessoa_fisicas`
--
DELIMITER $$
CREATE TRIGGER `tg_cliente_pf_insert` AFTER INSERT ON `pessoa_fisicas` FOR EACH ROW BEGIN
	IF NEW.cliente = 1 THEN
    	INSERT INTO clientes (id_pessoa_fisica) VALUES (new.id_pessoa_fisica);
	END IF; 
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_cliente_pf_update` AFTER UPDATE ON `pessoa_fisicas` FOR EACH ROW BEGIN
	if new.cliente <> old.cliente && new.cliente = 0 then 
    	DELETE FROM clientes WHERE id_pessoa_fisica = new.id_pessoa_fisica;
    elseif new.cliente <> old.cliente && new.cliente = 1 THEN
    	INSERT INTO clientes (id_pessoa_fisica) VALUES (new.id_pessoa_fisica);
    end if; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_juridicas`
--

CREATE TABLE `pessoa_juridicas` (
  `id_pessoa_juridica` int(10) UNSIGNED NOT NULL,
  `razao_social` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fantasia` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cod_natureza_juridica` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_abertura` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cidade` int(10) UNSIGNED NOT NULL,
  `cep` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` int(11) NOT NULL DEFAULT 0,
  `complemento` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celular` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fornecedor` tinyint(1) NOT NULL DEFAULT 0,
  `cliente` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Acionadores `pessoa_juridicas`
--
DELIMITER $$
CREATE TRIGGER `tg_cliente_pj_insert` AFTER INSERT ON `pessoa_juridicas` FOR EACH ROW BEGIN
	IF NEW.cliente = 1 THEN
    	INSERT INTO clientes ( id_pessoa_juridica) VALUES (new.id_pessoa_juridica);
	END IF; 
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_cliente_pj_update` AFTER UPDATE ON `pessoa_juridicas` FOR EACH ROW BEGIN
	if new.cliente <> old.cliente && new.cliente = 0 then 
    	DELETE FROM clientes WHERE id_pessoa_juridica = new.id_pessoa_juridica;
    elseif new.cliente <> old.cliente && new.cliente = 1 THEN
    	INSERT INTO clientes (id_pessoa_juridica) VALUES (new.id_pessoa_juridica);
    end if; 
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estoque` int(11) NOT NULL DEFAULT 0,
  `unidade` enum('UN','PC','CX','DZ','GS','PA','PR','PT','RL','CT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` double(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `id_servico` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidade` enum('UN','PC','CX','DZ','GS','PA','PR','PT','RL','CT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` double(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id_servico`, `descricao`, `unidade`, `preco`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'MÃO DE OBRA SIMPLES', 'UN', 20.00, 1, NULL, NULL),
(2, 'MÃO DE OBRA INTERMEDIÁRIA', 'UN', 50.00, 1, NULL, NULL),
(3, 'MÃO DE OBRA COMPLEXA', 'UN', 100.00, 1, NULL, NULL),
(4, 'TROCA DE ÓLEO', 'UN', 60.00, 1, NULL, NULL),
(5, 'ALINHAMENTO E BALANCEAMENTO COMPLETO', 'UN', 100.00, 1, NULL, NULL),
(6, 'ALINHAMENTO E BALANCEAMENTO UNITARIO', 'UN', 25.00, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `cod_cadastro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_perfil` int(10) UNSIGNED DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `id_pessoa_fisica` int(10) UNSIGNED DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '/img/user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `cod_cadastro`, `password`, `remember_token`, `created_at`, `updated_at`, `id_perfil`, `ativo`, `id_pessoa_fisica`, `foto`) VALUES
(1, 'ADMIN', 'admin@admin.com', NULL, 'CF00001', '$2y$10$Pgo5wr8PKl/1/JGxPQu2gOGCAmiqytm3uccTY29fb91o.pl5OLHyO', NULL, '2021-06-25 22:33:14', '2021-06-25 22:33:14', NULL, 1, NULL, '/img/user.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id_veiculo` int(10) UNSIGNED NOT NULL,
  `descricao_veiculo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fabricante` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano` int(11) NOT NULL,
  `fabricacao` int(11) NOT NULL,
  `cor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacao` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_clientes`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_clientes` (
`id_cliente` int(10) unsigned
,`nome` varchar(255)
,`documento` varchar(20)
,`count_orcamento` bigint(21)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_cobranca`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_cobranca` (
`id_cobranca` int(10) unsigned
,`id_pagamento` int(10) unsigned
,`nome` varchar(255)
,`documento` varchar(20)
,`num_parcela` int(11)
,`valor_parcela` double(8,2)
,`status_pagamento` enum('baixado','aberto','atrasado','estornado')
,`data_geracao` date
,`data_pagamento` date
,`data_recebimento` date
,`data_vencimento` date
,`descricao` varchar(255)
,`tipo_conta` enum('Conta Corrente','Conta Poupança')
,`titular` varchar(255)
,`agencia` int(11)
,`conta` int(11)
,`codigo` int(11)
,`banco` varchar(255)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_dashboard_one`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_dashboard_one` (
`quantidade_aberta` decimal(22,0)
,`quantidade_cancelado` decimal(22,0)
,`quantidade_aprovado` decimal(22,0)
,`valor_em_aberto` double(19,2)
,`valor_recebido` double(19,2)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_estoque`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_estoque` (
`id_produto` int(10) unsigned
,`descricao` varchar(255)
,`estoque` int(11)
,`reservado` decimal(32,0)
,`total_estoque` decimal(33,0)
,`unidade` enum('UN','PC','CX','DZ','GS','PA','PR','PT','RL','CT')
,`preco` double(10,2)
,`valor_total` double(19,2)
,`ativo` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_forma_pagamento`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_forma_pagamento` (
`id_pagamento` int(10) unsigned
,`forma_pagamento` varchar(255)
,`id_agente` int(10) unsigned
,`numero_parcelas` int(11)
,`intervalo_parcelas` int(11)
,`id_banco` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_item_orcamento`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_item_orcamento` (
`id_orcamento_item` int(10) unsigned
,`id_orcamento` int(10) unsigned
,`cod_item` int(10) unsigned
,`descricao` varchar(255)
,`unidade` varchar(2)
,`valor_unitario` double(10,2)
,`quantidade` int(11)
,`valor_desconto` double(8,2)
,`percentual_desconto` double(8,2)
,`valor_total` double(8,2)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_itens`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_itens` (
`id_produto` int(10) unsigned
,`descricao` varchar(255)
,`unidade` varchar(2)
,`preco` double(10,2)
,`ativo` tinyint(4)
,`estoque` int(11)
,`tipo` varchar(7)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_orcamento_pagamento`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_orcamento_pagamento` (
`id_orcamento` int(10) unsigned
,`forma_pagamento` varchar(255)
,`parcelas` int(11)
,`valor_parcela` double
,`valor_total` double
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_orcamento_pagamento_consolidado`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_orcamento_pagamento_consolidado` (
`id_orcamento` int(10) unsigned
,`valor_parcela` decimal(10,2)
,`valor_total_recebido` decimal(10,2)
,`valor_total` double(8,2)
,`valor_a_receber` double(19,2)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_orcamento_qtd_item`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_orcamento_qtd_item` (
`id_orcamento` int(10) unsigned
,`total` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_ordem_servico`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_ordem_servico` (
`id_orcamento` int(10) unsigned
,`status_orcamento` enum('aberto','fechado','cancelado','aprovado')
,`id_cliente` int(10) unsigned
,`nome` varchar(255)
,`documento` varchar(20)
,`fabricante` varchar(255)
,`id_veiculo` int(10) unsigned
,`modelo` varchar(255)
,`observacao` varchar(5000)
,`status_servico` varchar(12)
,`id_ordemservico` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_clientes`
--
DROP TABLE IF EXISTS `vw_clientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_clientes`  AS SELECT `c`.`id_cliente` AS `id_cliente`, CASE WHEN `pf`.`nome` is null THEN `pj`.`razao_social` ELSE `pf`.`nome` END AS `nome`, CASE WHEN `pf`.`cpf` is null THEN `pj`.`cnpj` ELSE `pf`.`cpf` END AS `documento`, (select count(0) from `orcamentos` `o2` where `o2`.`id_cliente` = `c`.`id_cliente`) AS `count_orcamento` FROM ((`clientes` `c` left join `pessoa_fisicas` `pf` on(`c`.`id_pessoa_fisica` = `pf`.`id_pessoa_fisica`)) left join `pessoa_juridicas` `pj` on(`c`.`id_pessoa_juridica` = `pj`.`id_pessoa_juridica`)) WHERE exists(select 1 from `veiculos` `v` where `v`.`id_cliente` = `c`.`id_cliente` limit 1) ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_cobranca`
--
DROP TABLE IF EXISTS `vw_cobranca`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_cobranca`  AS SELECT `c`.`id_cobranca` AS `id_cobranca`, `c`.`id_pagamento` AS `id_pagamento`, `vc`.`nome` AS `nome`, `vc`.`documento` AS `documento`, `c`.`num_parcela` AS `num_parcela`, `c`.`valor_parcela` AS `valor_parcela`, `c`.`status_pagamento` AS `status_pagamento`, `c`.`data_geracao` AS `data_geracao`, `c`.`data_pagamento` AS `data_pagamento`, `c`.`data_recebimento` AS `data_recebimento`, `c`.`data_vencimento` AS `data_vencimento`, `p`.`descricao` AS `descricao`, `a`.`tipo_conta` AS `tipo_conta`, `a`.`titular` AS `titular`, `a`.`agencia` AS `agencia`, `a`.`conta` AS `conta`, `b`.`codigo` AS `codigo`, `b`.`descricao` AS `banco` FROM (((((`cobrancas` `c` join `orcamentos` `o` on(`c`.`id_orcamento` = `o`.`id_orcamento`)) join `vw_clientes` `vc` on(`c`.`id_cliente` = `vc`.`id_cliente`)) join `pagamentos` `p` on(`c`.`id_pagamento` = `p`.`id_pagamento`)) join `agentes` `a` on(`p`.`id_agente` = `a`.`id_agente`)) join `bancos` `b` on(`a`.`id_banco` = `b`.`id_banco`)) ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_dashboard_one`
--
DROP TABLE IF EXISTS `vw_dashboard_one`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_dashboard_one`  AS SELECT sum(case when `o`.`status_orcamento` = 'aberto' then 1 else 0 end) AS `quantidade_aberta`, sum(case when `o`.`status_orcamento` = 'cancelado' then 1 else 0 end) AS `quantidade_cancelado`, sum(case when `o`.`status_orcamento` = 'aprovado' then 1 else 0 end) AS `quantidade_aprovado`, sum(case when `o`.`status_orcamento` = 'aberto' then `o`.`valor_total` else 0 end) AS `valor_em_aberto`, sum(case when `o`.`status_orcamento` = 'aprovado' then `o`.`valor_total` else 0 end) AS `valor_recebido` FROM `orcamentos` AS `o` ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_estoque`
--
DROP TABLE IF EXISTS `vw_estoque`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_estoque`  AS SELECT `p`.`id_produto` AS `id_produto`, `p`.`descricao` AS `descricao`, `p`.`estoque` AS `estoque`, ifnull(`x`.`reservado`,0) AS `reservado`, `p`.`estoque`+ ifnull(`x`.`reservado`,0) AS `total_estoque`, `p`.`unidade` AS `unidade`, `p`.`preco` AS `preco`, `p`.`preco`* (`p`.`estoque` + ifnull(`x`.`reservado`,0)) AS `valor_total`, `p`.`ativo` AS `ativo` FROM (`produtos` `p` left join (select `oi`.`id_produto` AS `id_produto`,sum(`oi`.`quantidade`) AS `reservado` from (`orcamentos` `o` join `orcamento_items` `oi` on(`o`.`id_orcamento` = `oi`.`id_orcamento`)) where `o`.`status_orcamento` = 'aberto' and `oi`.`id_produto` is not null group by `oi`.`id_produto`) `x` on(`p`.`id_produto` = `x`.`id_produto`)) ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_forma_pagamento`
--
DROP TABLE IF EXISTS `vw_forma_pagamento`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_forma_pagamento`  AS SELECT `p`.`id_pagamento` AS `id_pagamento`, `p`.`descricao` AS `forma_pagamento`, `a`.`id_agente` AS `id_agente`, `p`.`numero_parcelas` AS `numero_parcelas`, `p`.`intervalo_parcelas` AS `intervalo_parcelas`, `b`.`id_banco` AS `id_banco` FROM ((`pagamentos` `p` join `agentes` `a` on(`p`.`id_agente` = `a`.`id_agente`)) join `bancos` `b` on(`a`.`id_banco` = `b`.`id_banco`)) WHERE `p`.`status_pagamento` = 1 ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_item_orcamento`
--
DROP TABLE IF EXISTS `vw_item_orcamento`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_item_orcamento`  AS SELECT `oi`.`id_orcamento_item` AS `id_orcamento_item`, `oi`.`id_orcamento` AS `id_orcamento`, `p2`.`id_produto` AS `cod_item`, `p2`.`descricao` AS `descricao`, `p2`.`unidade` AS `unidade`, `p2`.`preco` AS `valor_unitario`, `oi`.`quantidade` AS `quantidade`, `oi`.`valor_desconto` AS `valor_desconto`, `oi`.`percentual_desconto` AS `percentual_desconto`, `oi`.`valor_total` AS `valor_total` FROM (`orcamento_items` `oi` join `produtos` `p2` on(`oi`.`id_produto` = `p2`.`id_produto`)) ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_itens`
--
DROP TABLE IF EXISTS `vw_itens`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_itens`  AS SELECT `p`.`id_produto` AS `id_produto`, `p`.`descricao` AS `descricao`, `p`.`unidade` AS `unidade`, `p`.`preco` AS `preco`, `p`.`ativo` AS `ativo`, `p`.`estoque` AS `estoque`, 'produto' AS `tipo` FROM `produtos` AS `p` ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_orcamento_pagamento`
--
DROP TABLE IF EXISTS `vw_orcamento_pagamento`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_orcamento_pagamento`  AS SELECT `op`.`id_orcamento` AS `id_orcamento`, `vfp`.`forma_pagamento` AS `forma_pagamento`, `op`.`parcelas` AS `parcelas`, `op`.`valor_parcela` AS `valor_parcela`, `op`.`valor_total` AS `valor_total` FROM (`orcamento_pagamentos` `op` join `vw_forma_pagamento` `vfp` on(`op`.`id_pagamento` = `vfp`.`id_pagamento`)) ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_orcamento_pagamento_consolidado`
--
DROP TABLE IF EXISTS `vw_orcamento_pagamento_consolidado`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_orcamento_pagamento_consolidado`  AS SELECT `vop`.`id_orcamento` AS `id_orcamento`, cast(sum(`vop`.`valor_parcela`) as decimal(10,2)) AS `valor_parcela`, cast(sum(`vop`.`valor_total`) as decimal(10,2)) AS `valor_total_recebido`, (select `o`.`valor_total` from `orcamentos` `o` where `o`.`id_orcamento` = `vop`.`id_orcamento`) AS `valor_total`, (select `o`.`valor_total` from `orcamentos` `o` where `o`.`id_orcamento` = `vop`.`id_orcamento`) - cast(sum(`vop`.`valor_total`) as decimal(10,2)) AS `valor_a_receber` FROM `vw_orcamento_pagamento` AS `vop` GROUP BY `vop`.`id_orcamento` ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_orcamento_qtd_item`
--
DROP TABLE IF EXISTS `vw_orcamento_qtd_item`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_orcamento_qtd_item`  AS SELECT `oi`.`id_orcamento` AS `id_orcamento`, sum(`oi`.`quantidade`) AS `total` FROM `orcamento_items` AS `oi` GROUP BY `oi`.`id_orcamento` ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_ordem_servico`
--
DROP TABLE IF EXISTS `vw_ordem_servico`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ordem_servico`  AS SELECT `o`.`id_orcamento` AS `id_orcamento`, `o`.`status_orcamento` AS `status_orcamento`, `vc`.`id_cliente` AS `id_cliente`, `vc`.`nome` AS `nome`, `vc`.`documento` AS `documento`, `v`.`fabricante` AS `fabricante`, `v`.`id_veiculo` AS `id_veiculo`, `v`.`modelo` AS `modelo`, `v`.`observacao` AS `observacao`, ifnull(`os`.`status_servico`,'Não Iniciado') AS `status_servico`, `os`.`id_ordemservico` AS `id_ordemservico` FROM (((`orcamentos` `o` join `vw_clientes` `vc` on(`o`.`id_cliente` = `vc`.`id_cliente`)) join `veiculos` `v` on(`o`.`id_veiculo` = `v`.`id_cliente`)) left join `ordem_servicos` `os` on(`o`.`id_orcamento` = `os`.`id_orcamento`)) WHERE `o`.`status_orcamento` = 'aprovado' ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agentes`
--
ALTER TABLE `agentes`
  ADD PRIMARY KEY (`id_agente`),
  ADD KEY `agentes_id_banco_foreign` (`id_banco`);

--
-- Índices para tabela `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id_banco`);

--
-- Índices para tabela `caixas`
--
ALTER TABLE `caixas`
  ADD PRIMARY KEY (`id_caixa`),
  ADD KEY `caixas_id_user_foreign` (`id_user`);

--
-- Índices para tabela `caixa_cobranca`
--
ALTER TABLE `caixa_cobranca`
  ADD KEY `caixa_cobranca_id_caixa_foreign` (`id_caixa`),
  ADD KEY `caixa_cobranca_id_cobranca_foreign` (`id_cobranca`);

--
-- Índices para tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id_cidade`),
  ADD KEY `cidades_id_estado_foreign` (`id_estado`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `clientes_id_pessoa_fisica_foreign` (`id_pessoa_fisica`),
  ADD KEY `clientes_id_pessoa_juridica_foreign` (`id_pessoa_juridica`);

--
-- Índices para tabela `cobrancas`
--
ALTER TABLE `cobrancas`
  ADD PRIMARY KEY (`id_cobranca`),
  ADD KEY `cobrancas_id_cliente_foreign` (`id_cliente`),
  ADD KEY `cobrancas_id_orcamento_foreign` (`id_orcamento`),
  ADD KEY `cobrancas_id_agente_foreign` (`id_agente`),
  ADD KEY `cobrancas_id_banco_foreign` (`id_banco`),
  ADD KEY `cobrancas_id_pagamento_foreign` (`id_pagamento`);

--
-- Índices para tabela `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `natureza_juridicas`
--
ALTER TABLE `natureza_juridicas`
  ADD PRIMARY KEY (`cod_natureza_juridica`);

--
-- Índices para tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD PRIMARY KEY (`id_orcamento`),
  ADD KEY `orcamentos_id_cliente_foreign` (`id_cliente`),
  ADD KEY `orcamentos_id_veiculo_foreign` (`id_veiculo`),
  ADD KEY `orcamentos_id_user_foreign` (`id_user`);

--
-- Índices para tabela `orcamento_items`
--
ALTER TABLE `orcamento_items`
  ADD PRIMARY KEY (`id_orcamento_item`),
  ADD KEY `orcamento_items_id_orcamento_foreign` (`id_orcamento`),
  ADD KEY `orcamento_items_id_produto_foreign` (`id_produto`),
  ADD KEY `orcamento_items_id_servico_foreign` (`id_servico`);

--
-- Índices para tabela `orcamento_pagamentos`
--
ALTER TABLE `orcamento_pagamentos`
  ADD PRIMARY KEY (`id_orcamento_pagamento`),
  ADD KEY `orcamento_pagamentos_id_orcamento_foreign` (`id_orcamento`),
  ADD KEY `orcamento_pagamentos_id_agente_foreign` (`id_agente`),
  ADD KEY `orcamento_pagamentos_id_pagamento_foreign` (`id_pagamento`),
  ADD KEY `orcamento_pagamentos_id_banco_foreign` (`id_banco`);

--
-- Índices para tabela `ordem_servicos`
--
ALTER TABLE `ordem_servicos`
  ADD PRIMARY KEY (`id_ordemservico`),
  ADD KEY `ordem_servicos_id_cliente_foreign` (`id_cliente`),
  ADD KEY `ordem_servicos_id_orcamento_foreign` (`id_orcamento`),
  ADD KEY `ordem_servicos_id_funcionario_foreign` (`id_funcionario`),
  ADD KEY `ordem_servicos_id_user_foreign` (`id_user`),
  ADD KEY `ordem_servicos_id_veiculo_foreign` (`id_veiculo`);

--
-- Índices para tabela `ordem_servico_servicos`
--
ALTER TABLE `ordem_servico_servicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordem_servico_servicos_id_funcionario_foreign` (`id_funcionario`),
  ADD KEY `ordem_servico_servicos_id_ordemservico_foreign` (`id_ordemservico`),
  ADD KEY `ordem_servico_servicos_id_servico_foreign` (`id_servico`);

--
-- Índices para tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id_pagamento`),
  ADD KEY `pagamentos_id_agente_foreign` (`id_agente`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `perfils`
--
ALTER TABLE `perfils`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Índices para tabela `pessoa_fisicas`
--
ALTER TABLE `pessoa_fisicas`
  ADD PRIMARY KEY (`id_pessoa_fisica`),
  ADD UNIQUE KEY `pessoa_fisicas_cpf_unique` (`cpf`),
  ADD KEY `pessoa_fisicas_id_cidade_foreign` (`id_cidade`);

--
-- Índices para tabela `pessoa_juridicas`
--
ALTER TABLE `pessoa_juridicas`
  ADD PRIMARY KEY (`id_pessoa_juridica`),
  ADD KEY `pessoa_juridicas_cod_natureza_juridica_foreign` (`cod_natureza_juridica`),
  ADD KEY `pessoa_juridicas_id_cidade_foreign` (`id_cidade`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id_servico`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_perfil_foreign` (`id_perfil`),
  ADD KEY `users_id_pessoa_fisica_foreign` (`id_pessoa_fisica`);

--
-- Índices para tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id_veiculo`),
  ADD KEY `veiculos_id_cliente_foreign` (`id_cliente`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agentes`
--
ALTER TABLE `agentes`
  MODIFY `id_agente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id_banco` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `caixas`
--
ALTER TABLE `caixas`
  MODIFY `id_caixa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id_cidade` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cobrancas`
--
ALTER TABLE `cobrancas`
  MODIFY `id_cobranca` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  MODIFY `id_orcamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `orcamento_items`
--
ALTER TABLE `orcamento_items`
  MODIFY `id_orcamento_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `orcamento_pagamentos`
--
ALTER TABLE `orcamento_pagamentos`
  MODIFY `id_orcamento_pagamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ordem_servicos`
--
ALTER TABLE `ordem_servicos`
  MODIFY `id_ordemservico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ordem_servico_servicos`
--
ALTER TABLE `ordem_servico_servicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id_pagamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perfils`
--
ALTER TABLE `perfils`
  MODIFY `id_perfil` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pessoa_fisicas`
--
ALTER TABLE `pessoa_fisicas`
  MODIFY `id_pessoa_fisica` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoa_juridicas`
--
ALTER TABLE `pessoa_juridicas`
  MODIFY `id_pessoa_juridica` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id_servico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id_veiculo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agentes`
--
ALTER TABLE `agentes`
  ADD CONSTRAINT `agentes_id_banco_foreign` FOREIGN KEY (`id_banco`) REFERENCES `bancos` (`id_banco`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `caixas`
--
ALTER TABLE `caixas`
  ADD CONSTRAINT `caixas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `caixa_cobranca`
--
ALTER TABLE `caixa_cobranca`
  ADD CONSTRAINT `caixa_cobranca_id_caixa_foreign` FOREIGN KEY (`id_caixa`) REFERENCES `caixas` (`id_caixa`),
  ADD CONSTRAINT `caixa_cobranca_id_cobranca_foreign` FOREIGN KEY (`id_cobranca`) REFERENCES `cobrancas` (`id_cobranca`);

--
-- Limitadores para a tabela `cidades`
--
ALTER TABLE `cidades`
  ADD CONSTRAINT `cidades_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_id_pessoa_fisica_foreign` FOREIGN KEY (`id_pessoa_fisica`) REFERENCES `pessoa_fisicas` (`id_pessoa_fisica`) ON DELETE CASCADE,
  ADD CONSTRAINT `clientes_id_pessoa_juridica_foreign` FOREIGN KEY (`id_pessoa_juridica`) REFERENCES `pessoa_juridicas` (`id_pessoa_juridica`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `cobrancas`
--
ALTER TABLE `cobrancas`
  ADD CONSTRAINT `cobrancas_id_agente_foreign` FOREIGN KEY (`id_agente`) REFERENCES `agentes` (`id_agente`),
  ADD CONSTRAINT `cobrancas_id_banco_foreign` FOREIGN KEY (`id_banco`) REFERENCES `bancos` (`id_banco`),
  ADD CONSTRAINT `cobrancas_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `cobrancas_id_orcamento_foreign` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamentos` (`id_orcamento`),
  ADD CONSTRAINT `cobrancas_id_pagamento_foreign` FOREIGN KEY (`id_pagamento`) REFERENCES `pagamentos` (`id_pagamento`);

--
-- Limitadores para a tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD CONSTRAINT `orcamentos_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `orcamentos_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orcamentos_id_veiculo_foreign` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id_veiculo`);

--
-- Limitadores para a tabela `orcamento_items`
--
ALTER TABLE `orcamento_items`
  ADD CONSTRAINT `orcamento_items_id_orcamento_foreign` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamentos` (`id_orcamento`),
  ADD CONSTRAINT `orcamento_items_id_produto_foreign` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`),
  ADD CONSTRAINT `orcamento_items_id_servico_foreign` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id_servico`);

--
-- Limitadores para a tabela `orcamento_pagamentos`
--
ALTER TABLE `orcamento_pagamentos`
  ADD CONSTRAINT `orcamento_pagamentos_id_agente_foreign` FOREIGN KEY (`id_agente`) REFERENCES `agentes` (`id_agente`),
  ADD CONSTRAINT `orcamento_pagamentos_id_banco_foreign` FOREIGN KEY (`id_banco`) REFERENCES `bancos` (`id_banco`),
  ADD CONSTRAINT `orcamento_pagamentos_id_orcamento_foreign` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamentos` (`id_orcamento`),
  ADD CONSTRAINT `orcamento_pagamentos_id_pagamento_foreign` FOREIGN KEY (`id_pagamento`) REFERENCES `pagamentos` (`id_pagamento`);

--
-- Limitadores para a tabela `ordem_servicos`
--
ALTER TABLE `ordem_servicos`
  ADD CONSTRAINT `ordem_servicos_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `ordem_servicos_id_funcionario_foreign` FOREIGN KEY (`id_funcionario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ordem_servicos_id_orcamento_foreign` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamentos` (`id_orcamento`),
  ADD CONSTRAINT `ordem_servicos_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ordem_servicos_id_veiculo_foreign` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id_veiculo`);

--
-- Limitadores para a tabela `ordem_servico_servicos`
--
ALTER TABLE `ordem_servico_servicos`
  ADD CONSTRAINT `ordem_servico_servicos_id_funcionario_foreign` FOREIGN KEY (`id_funcionario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ordem_servico_servicos_id_ordemservico_foreign` FOREIGN KEY (`id_ordemservico`) REFERENCES `ordem_servicos` (`id_ordemservico`),
  ADD CONSTRAINT `ordem_servico_servicos_id_servico_foreign` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id_servico`);

--
-- Limitadores para a tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_id_agente_foreign` FOREIGN KEY (`id_agente`) REFERENCES `agentes` (`id_agente`);

--
-- Limitadores para a tabela `pessoa_fisicas`
--
ALTER TABLE `pessoa_fisicas`
  ADD CONSTRAINT `pessoa_fisicas_id_cidade_foreign` FOREIGN KEY (`id_cidade`) REFERENCES `cidades` (`id_cidade`);

--
-- Limitadores para a tabela `pessoa_juridicas`
--
ALTER TABLE `pessoa_juridicas`
  ADD CONSTRAINT `pessoa_juridicas_cod_natureza_juridica_foreign` FOREIGN KEY (`cod_natureza_juridica`) REFERENCES `natureza_juridicas` (`cod_natureza_juridica`),
  ADD CONSTRAINT `pessoa_juridicas_id_cidade_foreign` FOREIGN KEY (`id_cidade`) REFERENCES `cidades` (`id_cidade`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_perfil_foreign` FOREIGN KEY (`id_perfil`) REFERENCES `perfils` (`id_perfil`),
  ADD CONSTRAINT `users_id_pessoa_fisica_foreign` FOREIGN KEY (`id_pessoa_fisica`) REFERENCES `pessoa_fisicas` (`id_pessoa_fisica`);

--
-- Limitadores para a tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD CONSTRAINT `veiculos_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
COMMIT;