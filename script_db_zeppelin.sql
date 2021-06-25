CREATE DATABASE IF NOT EXISTS zeppelin;

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

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `id_pessoa_fisica`, `id_pessoa_juridica`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL),
(2, 16, NULL, NULL, NULL),
(3, NULL, 1, NULL, NULL),
(4, NULL, 18, NULL, NULL),
(5, NULL, 19, NULL, NULL),
(6, 9, NULL, NULL, NULL),
(7, 8, NULL, NULL, NULL),
(9, 15, NULL, NULL, NULL),
(11, 31, NULL, NULL, NULL);

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
(18, '2021_03_21_180044_create_orcamentos_table', 2),
(19, '2021_03_21_190530_create_orcamento_items_table', 2),
(20, '2021_04_10_013121_add_estoque_table_produtos', 3);

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
  `id_user` int(10) UNSIGNED NOT NULL,
  `salvo` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `orcamentos`
--

INSERT INTO `orcamentos` (`id_orcamento`, `valor_desconto`, `percentual_desconto`, `valor_total_sem_desconto`, `valor_total`, `status_orcamento`, `id_cliente`, `id_veiculo`, `id_user`, `salvo`, `created_at`, `updated_at`) VALUES
(2, 0.00, 0.00, 128.00, 128.00, 'fechado', 3, 3, 1, '1', NULL, '2021-04-09 03:18:17'),
(3, 0.00, 0.00, 233.00, 233.00, 'aprovado', 1, 1, 1, '1', NULL, '2021-04-10 01:54:24'),
(4, 6.30, 1.50, 417.99, 411.69, 'aprovado', 1, 1, 1, '1', NULL, '2021-04-10 01:56:37'),
(5, 0.00, 0.00, 0.00, 0.00, 'aberto', 1, NULL, 1, '0', NULL, NULL),
(6, 0.00, 0.00, 128.00, 128.00, 'fechado', 2, 2, 1, '1', NULL, '2021-04-09 04:10:30'),
(7, 0.00, 0.00, 423.98, 423.98, 'aberto', 2, 2, 1, '1', NULL, '2021-04-09 03:56:02'),
(8, 103.28, 3.33, 1202.84, 1099.56, 'aberto', 5, 7, 1, '1', NULL, '2021-04-10 03:41:17'),
(9, 0.00, 0.00, 16125.04, 16125.04, 'cancelado', 1, 1, 1, '1', NULL, '2021-04-10 05:54:34'),
(10, 0.00, 0.00, 0.00, 0.00, 'aberto', 1, NULL, 1, '0', NULL, NULL),
(11, 0.00, 0.00, 0.00, 0.00, 'aberto', 6, NULL, 1, '0', NULL, NULL),
(12, 34.00, 5.00, 599.99, 565.99, 'aprovado', 6, 8, 1, '1', '2021-03-30 01:17:36', '2021-04-10 04:11:20'),
(13, 0.00, 0.00, 211.99, 211.99, 'aprovado', 9, 9, 1, '1', '2021-03-30 02:32:25', '2021-04-10 02:06:23'),
(14, 0.00, 0.00, 415.98, 415.98, 'cancelado', 9, 9, 1, '1', '2021-03-30 02:34:31', '2021-04-10 04:22:57'),
(15, 41.60, 10.00, 415.98, 374.38, 'aprovado', 1, 1, 1, '1', '2021-03-31 02:20:33', '2021-04-10 06:12:08'),
(16, 325.17, 10.00, 3251.74, 2926.57, 'cancelado', 9, 9, 1, '1', '2021-03-31 02:26:37', '2021-04-10 04:23:16'),
(17, 5.25, 0.56, 1436.97, 1431.72, 'aprovado', 9, 9, 1, '1', '2021-04-02 05:32:18', '2021-04-10 04:23:48'),
(18, 367.17, 6.67, 3879.73, 3512.56, 'aprovado', 9, 9, 1, '1', '2021-04-02 06:10:03', '2021-04-10 06:12:25'),
(19, 126.00, 20.00, 736.99, 611.00, 'cancelado', 5, 7, 1, '1', '2021-04-02 06:16:31', '2021-04-10 04:18:24'),
(20, 0.00, 0.00, 417.99, 417.99, 'aberto', 9, 9, 1, '0', '2021-04-06 02:14:58', '2021-04-06 03:00:32'),
(21, 0.00, 0.00, 630.00, 630.00, 'aprovado', 9, 9, 1, '1', '2021-04-09 01:49:43', '2021-04-10 04:26:47'),
(22, 0.00, 0.00, 100.00, 100.00, 'aprovado', 3, 3, 1, '1', '2021-04-09 04:26:03', '2021-04-10 03:40:24'),
(23, 0.00, 0.00, 190.00, 190.00, 'aberto', 1, 1, 1, '0', '2021-04-10 02:16:56', '2021-04-10 02:25:48'),
(24, 10.50, 5.00, 125.00, 114.50, 'aprovado', 11, 10, 1, '1', '2021-04-10 05:09:08', '2021-04-10 05:10:23'),
(25, 0.00, 0.00, 100.00, 100.00, 'cancelado', 11, 10, 1, '1', '2021-04-10 05:11:45', '2021-04-10 05:12:09'),
(26, 0.00, 0.00, 10120.50, 10120.50, 'aprovado', 11, 10, 1, '1', '2021-04-10 16:00:57', '2021-04-10 16:01:40');

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
-- Extraindo dados da tabela `orcamento_items`
--

INSERT INTO `orcamento_items` (`id_orcamento_item`, `id_orcamento`, `id_produto`, `id_servico`, `quantidade`, `valor_desconto`, `percentual_desconto`, `valor_total_sem_desconto`, `valor_total`, `id_user`, `created_at`, `updated_at`) VALUES
(2, 12, 7, NULL, 1, 0.00, 0.00, 160.00, 160.00, 1, '2021-03-30 02:11:59', '2021-03-30 02:11:59'),
(6, 14, 3, NULL, 1, 0.00, 0.00, 207.99, 207.99, 1, '2021-03-30 03:35:20', '2021-03-30 03:35:20'),
(8, 14, 3, NULL, 1, 0.00, 0.00, 207.99, 207.99, 1, '2021-03-30 04:35:01', '2021-03-30 04:35:01'),
(9, 15, 3, NULL, 2, 41.60, 10.00, 415.98, 374.38, 1, '2021-03-31 02:21:12', '2021-03-31 02:21:12'),
(10, 16, 10, NULL, 2, 325.17, 10.00, 3251.74, 2926.57, 1, '2021-03-31 02:27:04', '2021-03-31 02:27:04'),
(11, 17, 3, NULL, 1, 0.00, 0.00, 207.99, 207.99, 1, '2021-04-02 05:32:38', '2021-04-02 05:32:38'),
(13, 17, 4, NULL, 1, 5.25, 5.00, 105.00, 99.75, 1, '2021-04-02 05:46:34', '2021-04-02 05:46:34'),
(17, 17, 4, NULL, 1, 0.00, 0.00, 105.00, 105.00, 1, '2021-04-02 05:51:13', '2021-04-02 05:51:13'),
(18, 17, 7, NULL, 1, 0.00, 0.00, 160.00, 160.00, 1, '2021-04-02 05:51:29', '2021-04-02 05:51:29'),
(19, 17, 3, NULL, 1, 0.00, 0.00, 207.99, 207.99, 1, '2021-04-02 06:04:32', '2021-04-02 06:04:32'),
(20, 17, 3, NULL, 1, 0.00, 0.00, 207.99, 207.99, 1, '2021-04-02 06:05:52', '2021-04-02 06:05:52'),
(22, 17, 4, NULL, 1, 0.00, 0.00, 105.00, 105.00, 1, '2021-04-02 06:07:44', '2021-04-02 06:07:44'),
(23, 17, 5, NULL, 1, 0.00, 0.00, 210.00, 210.00, 1, '2021-04-02 06:09:54', '2021-04-02 06:09:54'),
(24, 18, 10, NULL, 2, 325.17, 10.00, 3251.74, 2926.57, 1, '2021-04-02 06:10:15', '2021-04-02 06:10:15'),
(30, 20, 5, NULL, 1, 0.00, 0.00, 210.00, 210.00, 1, '2021-04-06 02:48:13', '2021-04-06 02:48:13'),
(32, 19, 2, NULL, 1, 106.00, 50.00, 211.99, 106.00, 1, '2021-04-06 03:52:49', '2021-04-06 03:52:49'),
(33, 8, 11, NULL, 4, 103.28, 10.00, 1032.84, 929.56, 1, '2021-04-06 03:54:43', '2021-04-06 03:54:43'),
(34, 8, 8, NULL, 2, 0.00, 0.00, 70.00, 70.00, 1, '2021-04-06 03:54:53', '2021-04-06 03:54:53'),
(38, 21, 5, NULL, 3, 0.00, 0.00, 630.00, 630.00, 1, '2021-04-09 02:38:56', '2021-04-09 02:38:56'),
(42, 6, 6, NULL, 1, 0.00, 0.00, 128.00, 128.00, 1, '2021-04-09 02:59:51', '2021-04-09 02:59:51'),
(43, 13, 2, NULL, 1, 0.00, 0.00, 211.99, 211.99, 1, '2021-04-09 03:02:46', '2021-04-09 03:02:46'),
(50, 3, 4, NULL, 1, 0.00, 0.00, 105.00, 105.00, 1, '2021-04-09 03:16:25', '2021-04-09 03:16:25'),
(51, 2, 6, NULL, 1, 0.00, 0.00, 128.00, 128.00, 1, '2021-04-09 03:18:13', '2021-04-09 03:18:13'),
(52, 7, 2, NULL, 2, 0.00, 0.00, 423.98, 423.98, 1, '2021-04-09 03:55:56', '2021-04-09 03:55:56'),
(55, 9, 4, NULL, 1, 0.00, 0.00, 105.00, 105.00, 1, '2021-04-09 04:32:32', '2021-04-09 04:32:32'),
(56, 9, 7, NULL, 100, 0.00, 0.00, 16000.00, 16000.00, 1, '2021-04-09 04:32:40', '2021-04-09 04:32:40'),
(57, 18, 5, NULL, 2, 42.00, 10.00, 420.00, 378.00, 1, '2021-04-09 05:42:37', '2021-04-09 05:42:37'),
(58, 18, 3, NULL, 1, 0.00, 0.00, 207.99, 207.99, 1, '2021-04-09 05:43:06', '2021-04-09 05:43:06'),
(59, 3, 6, NULL, 1, 0.00, 0.00, 128.00, 128.00, 1, '2021-04-10 01:23:53', '2021-04-10 01:23:53'),
(60, 4, 4, NULL, 2, 6.30, 3.00, 210.00, 203.70, 1, '2021-04-10 01:55:58', '2021-04-10 01:55:58'),
(61, 4, 3, NULL, 1, 0.00, 0.00, 207.99, 207.99, 1, '2021-04-10 01:56:06', '2021-04-10 01:56:06'),
(62, 23, 2, NULL, 1, 0.00, 0.00, 50.00, 50.00, 1, '2021-04-10 02:17:24', '2021-04-10 02:17:24'),
(63, 23, 7, NULL, 1, 0.00, 0.00, 20.00, 20.00, 1, '2021-04-10 02:20:24', '2021-04-10 02:20:24'),
(64, 23, 7, NULL, 1, 0.00, 0.00, 20.00, 20.00, 1, '2021-04-10 02:22:09', '2021-04-10 02:22:09'),
(65, 23, 3, NULL, 1, 0.00, 0.00, 100.00, 100.00, 1, '2021-04-10 02:25:48', '2021-04-10 02:25:48'),
(67, 22, NULL, 3, 1, 0.00, 0.00, 100.00, 100.00, 1, '2021-04-10 03:40:18', '2021-04-10 03:40:18'),
(68, 8, NULL, 9, 1, 0.00, 0.00, 100.00, 100.00, 1, '2021-04-10 03:41:17', '2021-04-10 03:41:17'),
(69, 12, NULL, 9, 1, 0.00, 0.00, 100.00, 100.00, 1, '2021-04-10 03:56:40', '2021-04-10 03:56:40'),
(70, 12, 2, NULL, 1, 21.20, 10.00, 211.99, 190.79, 1, '2021-04-10 03:56:55', '2021-04-10 03:56:55'),
(71, 12, 6, NULL, 1, 12.80, 10.00, 128.00, 115.20, 1, '2021-04-10 03:57:23', '2021-04-10 03:57:23'),
(72, 19, NULL, 9, 2, 20.00, 10.00, 200.00, 180.00, 1, '2021-04-10 04:12:16', '2021-04-10 04:12:16'),
(73, 19, 9, NULL, 1, 0.00, 0.00, 325.00, 325.00, 1, '2021-04-10 04:12:31', '2021-04-10 04:12:31'),
(74, 9, 12, NULL, 2, 0.00, 0.00, 20.04, 20.04, 1, '2021-04-10 05:00:55', '2021-04-10 05:00:55'),
(75, 24, 4, NULL, 1, 10.50, 10.00, 105.00, 94.50, 1, '2021-04-10 05:09:47', '2021-04-10 05:09:47'),
(76, 24, NULL, 7, 1, 0.00, 0.00, 20.00, 20.00, 1, '2021-04-10 05:09:56', '2021-04-10 05:09:56'),
(77, 25, NULL, 9, 1, 0.00, 0.00, 100.00, 100.00, 1, '2021-04-10 05:12:02', '2021-04-10 05:12:02'),
(78, 26, 1, NULL, 1, 0.00, 0.00, 120.50, 120.50, 1, '2021-04-10 16:01:16', '2021-04-10 16:01:16'),
(79, 26, NULL, 9, 100, 0.00, 0.00, 10000.00, 10000.00, 1, '2021-04-10 16:01:33', '2021-04-10 16:01:33');

--
-- Acionadores `orcamento_items`
--
DELIMITER $$
CREATE TRIGGER `tg_orcamento_item` AFTER INSERT ON `orcamento_items` FOR EACH ROW begin
	declare valor_desconto_tg float;
	declare percentual_desconto_tg float;
	declare valor_total_sem_desconto_tg float;
	declare valor_total_tg float;

	select sum(valor_desconto) into valor_desconto_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select avg(percentual_desconto) into percentual_desconto_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total_sem_desconto) into valor_total_sem_desconto_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total) into valor_total_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	
	update orcamentos set valor_desconto = valor_desconto_tg, percentual_desconto = percentual_desconto_tg, valor_total_sem_desconto = valor_total_sem_desconto_tg , valor_total = valor_total_tg where id_orcamento = new.id_orcamento;

end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_orcamento_item_delete` AFTER DELETE ON `orcamento_items` FOR EACH ROW begin
	declare valor_desconto_tg float;
	declare percentual_desconto_tg float;
	declare valor_total_sem_desconto_tg float;
	declare valor_total_tg float;

	select sum(valor_desconto) into valor_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select avg(percentual_desconto) into percentual_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total_sem_desconto) into valor_total_sem_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total) into valor_total_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;


	if old.id_orcamento is null then
		set valor_desconto_tg = 0;
		set percentual_desconto_tg = 0;
		set valor_total_sem_desconto_tg = 0;
		set valor_total_tg = 0;
	end if;

	update orcamentos set valor_desconto = ifnull(valor_desconto_tg,0), percentual_desconto = ifnull(percentual_desconto_tg,0), valor_total_sem_desconto = ifnull(valor_total_sem_desconto_tg,0) , valor_total = ifnull(valor_total_tg,0) where id_orcamento = OLD.id_orcamento;

end
$$
DELIMITER ;

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
-- Extraindo dados da tabela `pessoa_fisicas`
--

INSERT INTO `pessoa_fisicas` (`id_pessoa_fisica`, `nome`, `dtnascimento`, `cpf`, `sexo`, `rg`, `orgaoexpedidor`, `email`, `id_cidade`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `telefone`, `celular`, `fornecedor`, `cliente`, `created_at`, `updated_at`) VALUES
(1, 'Vanessa Emilly Sandra Assis', '1953-08-04', '137.112.911-80', 'f', 459400976, 'SSPGO', 'vanessaemillysandraassis_@homail.com', 1, '74.351-005', 'Alameda das Figueiras', 874, '0', 'Jardim Florença', '(62) 2518-2430', '(62) 9858-37616', 0, 1, NULL, '2021-03-23 02:17:55'),
(2, 'Bento Anderson Cavalcanti', '1963-05-17', '415.882.951-84', 'm', 134352981, 'SSPGO', 'bentoandersoncavalcanti-92@fertau.com.br', 1, '74484-443', 'Rua GV 16', 194, '0', 'Residencial Goiânia Viva', '(62) 2932-5441', '(62) 99660-0237', 0, 0, NULL, NULL),
(3, 'Andrea Marcela Marlene Bernardes', '1954-09-09', '486.087.321-14', 'f', 484844672, 'SSPGO', 'andreamarcelamarlenebernardes_@mac.com', 1, '74.481-710', 'Rua Boa Vista', 103, '0', 'Residencial Mansões Paraíso', '(62) 2727-1680', '(62) 9827-88018', 0, 0, NULL, '2021-04-10 05:03:10'),
(4, 'Diego Kevin Cauã Porto', '2003-11-21', '792.572.661-09', 'm', 396232607, 'SSPGO', 'diegokevincauaporto-83@dizain.com.br', 1, '74493-880', 'Rua N 24', 311, '0', 'Setor das Nações Extensão', '(62) 2704-3570', '(62) 99586-8852', 0, 0, NULL, NULL),
(5, 'Stefany Carolina Daiane Pires', '1993-12-14', '318.996.511-01', 'f', 128838395, 'SSPGO', 'stefanycarolinadaianepires-70@premierpet.com.br', 1, '74391-090', 'Rua Jorge Luís de Abreu', 282, '0', 'Jardim Marques de Abreu', '(62) 2892-8397', '(62) 98988-5964', 0, 0, NULL, NULL),
(6, 'Henrique Henry Sérgio Novaes', '1998-02-09', '775.634.371-93', 'm', 176022855, 'SSPGO', 'henriquehenrysergionovaes-90@puenteimoveis.com.br', 1, '74055-100', 'Rua 68', 290, '0', 'Setor Central', '(62) 2723-4784', '(62) 98368-3762', 0, 0, NULL, NULL),
(7, 'Augusto Thomas Noah Mendes', '1968-11-08', '507.435.061-11', 'm', 367130427, 'SSPGO', 'augustothomasnoahmendes-74@centerdiesel.com.br', 1, '74693-185', 'Rua ACP 12', 305, '0', 'Residencial Antônio Carlos Pires', '(62) 2905-1514', '(62) 98409-0372', 0, 0, NULL, NULL),
(8, 'Otávio Bento Almeida', '1990-09-06', '889.980.351-03', 'm', 182903059, 'SSPGO', 'otaviobentoalmeida..otaviobentoalmeida@ppe.ufrj.br', 1, '74.640-080', 'Rua 204', 288, '0', 'Setor Leste Vila Nova', '(62) 3670-0993', '(62) 9966-94919', 0, 1, NULL, '2021-03-26 01:28:20'),
(9, 'Clarice Márcia Julia Silveira', '1964-12-08', '341.946.851-21', 'f', 322495398, 'SSPGO', 'claricemarciajuliasilveira..claricemarciajuliasilveira@timbrasil.com.br', 1, '74.460-445', 'Rua Monte Cristo', 162, '0', 'Jardim Petrópolis', '(62) 3657-9021', '(62) 9916-55520', 0, 1, NULL, '2021-03-23 05:05:13'),
(10, 'Kevin Tiago da Mota', '1969-01-04', '324.080.601-09', 'm', 132019279, 'SSPGO', 'kevintiagodamota__kevintiagodamota@unicamp.br', 1, '74375-740', 'Rua das Palmas', 721, '0', 'Parque Oeste Industrial', '(62) 2648-9852', '(62) 99507-9230', 0, 0, NULL, NULL),
(11, 'Theo Eduardo Matheus Brito', '1994-10-24', '375.355.681-57', 'm', 339897168, 'SSPGO', 'theoeduardomatheusbrito_@orthoi.com.br', 1, '74850-190', 'Rua PR 1', 146, '0', 'Vila Redenção', '(62) 3995-8900', '(62) 99706-4370', 0, 0, NULL, NULL),
(12, 'Luiz Marcelo Moraes', '1951-06-25', '379.333.611-53', 'm', 241759249, 'SSPGO', 'luizmarcelomoraes_@emcinfo.com.br', 1, '74484-406', 'Rua GV 4', 536, '0', 'Residencial Goiânia Viva', '(62) 2722-4413', '(62) 98980-5397', 0, 0, NULL, NULL),
(13, 'Arthur Juan Murilo Baptista', '1993-07-06', '869.922.891-01', 'm', 485218136, 'SSPGO', 'arthurjuanmurilobaptista-71@recantoalmeida.com.br', 1, '74255-370', 'Rua C 119', 971, '0', 'Jardim América', '(62) 3836-7452', '(62) 99410-6363', 0, 0, NULL, NULL),
(14, 'Jéssica Sophia Laura de Paula', '1949-01-06', '515.721.181-30', 'f', 280952636, 'SSPGO', 'jessicasophialauradepaula_@tpltransportes.com.br', 1, '74785-705', 'Rua Serra Norte', 837, '0', 'Setor Recanto das Minas Gerais', '(62) 3615-5617', '(62) 98277-1357', 0, 0, NULL, NULL),
(15, 'Aline Jaqueline Luiza Pires', '1944-08-23', '180.851.211-15', 'f', 489651148, 'SSPGO', 'aalinejaquelineluizapires@teadit.com.br', 1, '74.730-515', 'Rua Perimetral Quatro', 865, '0', 'Residencial Sonho Verde', '(62) 2622-5847', '(62) 9971-69966', 1, 1, NULL, '2021-03-26 02:44:50'),
(16, 'José Isaac Almeida', '1954-08-14', '442.511.571-68', 'm', 242770708, 'SSPGO', 'joseisaacalmeida..joseisaacalmeida@fcfar.unesp.br', 1, '74.496-080', 'Avenida Trindade', 920, '0', 'Residencial Tempo Novo', '(62) 3860-6355', '(62) 9947-63429', 0, 1, NULL, '2021-03-23 03:06:53'),
(17, 'Joaquim Nelson Pedro Henrique Cardoso', '1994-07-16', '427.281.601-20', 'm', 198445829, 'SSPGO', 'joaquimnelsonpedrohenriquecardoso__joaquimnelsonpedrohenriquecardoso@abdalathomaz.adv.br', 1, '74369-660', 'Rua MMM10', 673, '0', 'Setor Três Marias I', '(62) 3586-5471', '(62) 99441-1355', 0, 0, NULL, NULL),
(18, 'Gabriel Miguel da Silva', '1998-05-26', '055.466.821-16', 'm', 177230915, 'SSPGO', 'gabrielmigueldasilva_@cladm.com.br', 1, '74093-091', 'Rua 127 A', 442, '0', 'Setor Sul', '(62) 3865-5061', '(62) 99628-4598', 0, 0, NULL, NULL),
(19, 'Bruna Ana Emilly Almada', '1977-05-14', '500.884.371-08', 'f', 207682537, 'SSPGO', 'brunaanaemillyalmada__brunaanaemillyalmada@vizzacchi.com.br', 1, '74594-003', 'Rua JI 3', 305, '0', 'Jardim Ipê', '(62) 2670-9879', '(62) 98299-4832', 0, 0, NULL, NULL),
(20, 'Caleb André Murilo Souza', '1985-12-18', '499.347.761-97', 'm', 485842658, 'SSPGO', 'calebandremurilosouza-98@hotmail', 1, '74663-520', 'Avenida Pedro Paulo de Souza', 735, '0', 'Setor Goiânia 2', '(62) 2931-9263', '(62) 98499-4294', 0, 0, NULL, NULL),
(21, 'Aparecida Eliane Barbosa', '2003-09-01', '133.037.221-29', 'f', 216648919, 'SSPGO', 'aaparecidaelianebarbosa@moppe.com.br', 1, '74313-680', 'Rua U 78', 726, '0', 'Setor União', '(62) 2706-4060', '(62) 98397-2874', 0, 0, NULL, NULL),
(22, 'Manuel Thiago Manoel Campos', '1979-08-26', '589.307.151-41', 'm', 242168073, 'SSPGO', 'manuelthiagomanoelcampos-98@amordeconvite.com.br', 1, '74475-265', 'Rua 24 de Maio', 203, '0', 'Setor Estrela Dalva', '(62) 3794-8044', '(62) 99489-7296', 0, 0, NULL, NULL),
(23, 'Yago Enzo Moreira', '1961-12-19', '449.346.531-04', 'm', 475652757, 'SSPGO', 'yagoenzomoreira..yagoenzomoreira@machina8.com.br', 1, '74720-180', 'Rua Chile', 489, '0', 'Vila Maria Luiza', '(62) 2879-6384', '(62) 98557-5540', 0, 0, NULL, NULL),
(24, 'Lorena Ayla Elza da Conceição', '1999-01-13', '523.289.791-81', 'f', 217866591, 'SSPGO', 'lorenaaylaelzadaconceicao-92@tanby.com.br', 1, '74310-290', 'Rua Flemington', 557, '0', 'Vila dos Alpes', '(62) 2724-9200', '(62) 98449-1914', 0, 0, NULL, NULL),
(25, 'Larissa Raimunda Freitas', '1952-03-27', '627.118.021-32', 'f', 233042763, 'SSPGO', 'larissaraimundafreitas__larissaraimundafreitas@brf-br.com', 1, '74533-190', 'Rua 270', 768, '0', 'Setor Coimbra', '(62) 2518-9844', '(62) 99854-7229', 0, 0, NULL, NULL),
(26, 'Tomás Calebe Ribeiro', '1997-08-14', '854.226.521-18', 'm', 358245655, 'SSPGO', 'tomascaleberibeiro-95@deskprint.com.br', 1, '74594-452', 'Avenida Lúcio Rebelo', 318, '0', 'Setor Alto do Vale', '(62) 2700-4807', '(62) 98364-6770', 0, 0, NULL, NULL),
(27, 'Flávia Luana Regina Sales', '1946-12-25', '885.353.061-88', 'f', 144605818, 'SSPGO', 'flavialuanareginasales-96@sebrace.com.br', 1, '74484-424', 'Travessa 1', 732, '0', 'Residencial Goiânia Viva', '(62) 2956-9916', '(62) 98356-9420', 0, 0, NULL, NULL),
(28, 'Caleb Benício Vieira', '1988-07-27', '024.583.001-46', 'm', 263746355, 'SSPGO', 'calebbeniciovieira__calebbeniciovieira@rabelloadvogados.com.br', 1, '74815-160', 'Alameda Juiz de Fora', 934, '0', 'Vila Alto da Glória', '(62) 3982-7712', '(62) 98567-5088', 0, 0, NULL, NULL),
(29, 'Gabrielly Heloisa Campos', '1984-07-03', '512.373.161-03', 'f', 182476182, 'SSPGO', 'gabriellyheloisacampos-87@startingfitness.com.br', 1, '74491-477', 'Rua dos Ananás', 945, '0', 'Residencial Jardins do Cerrado 2', '(62) 2892-3388', '(62) 99419-6252', 0, 0, NULL, NULL),
(30, 'Francisco Renan Baptista', '1974-06-05', '727.823.181-79', 'm', 379496203, 'SSPGO', 'franciscorenanbaptista__franciscorenanbaptista@acaocontabilsjc.com.br', 1, '74355-075', 'Via Tubarão', 274, '0', 'Condomínio Amin Camargo', '(62) 2503-3494', '(62) 98815-9603', 0, 0, NULL, NULL),
(31, 'ALISSON DA SILVA ALMEIDA OLIVEIRA', '1990-03-04', '026.360.761-58', 'm', 2431, 'SSP', 'alisson_sao@hotmail.com', 1, '74.000-000', 'RUA TESTE', 0, 'TESTE', 'TESTE', '(62) 9999-9999', '(62) 9999-99999', 0, 1, '2020-07-24 00:07:58', '2021-04-10 05:03:20');

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
-- Extraindo dados da tabela `pessoa_juridicas`
--

INSERT INTO `pessoa_juridicas` (`id_pessoa_juridica`, `razao_social`, `fantasia`, `cnpj`, `cod_natureza_juridica`, `data_abertura`, `email`, `id_cidade`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `telefone`, `celular`, `fornecedor`, `cliente`, `created_at`, `updated_at`) VALUES
(1, 'FÁBIO E VERA CONSULTORIA FINANCEIRA LTDA', 'FÁBIO E VERA', '78.676.520/0001-06', '213-5', '2015-07-07', '78.676.520/0001-06', 1, '74.936-120', 'RUA H 61', 654, 'CONDOMÍNIO CIDADE EMPRESARIAL', 'CIDADE VERA CRUZ', '(62) 9856-3516', '(62) 9856-35160', 1, 1, '2021-03-23 04:01:59', '2021-03-23 04:42:22'),
(18, 'INDUSTRIA DE ALIMENTOS E FRIOS LTDA', 'TONYNHO FRIOS LTDA', '60.835.001/0001-88', '231-3', '2002-06-23', 'admin@tonynho.com.br', 1, '74.000-000', 'AVENIDA RIO VERDE', 243, 'CONDOMÍNIO CIDADE EMPRESARIAL', 'CIDADE VERA CRUZ', '(62) 9856-3516', '(62) 9856-35160', 1, 1, '2020-07-24 05:27:09', '2020-07-29 05:00:55'),
(19, 'CELG DISTRIBUICAO S.A. - CELG D', 'ENEL DISTRIBUICAO GOIAS', '01.543.032/0001-04', '205-4', '1966-09-19', 'contato@enel.com.br', 1, '74.805-180', 'RUA 2', 505, 'QD. A-37', 'JARDIM GOIÁS', '(62) 9856-3516', '(62) 9856-35160', 1, 1, '2020-07-24 05:33:01', '2021-03-23 04:51:11'),
(20, 'SANEAMENTO DE GOIAS S/A', 'SANEAGO', '01.616.929/0001-02', '203-8', '1969-03-12', 'contabilidade@saneago.com.br', 1, '74.805-100', 'AV FUED JOSE SEBBA', 1245, 'N', 'JARDIM GOIAS', '(62) 3243-3297', '(62) 99999-9999', 1, 0, '2020-07-29 05:11:26', '2020-07-29 05:11:26');

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

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `descricao`, `estoque`, `unidade`, `preco`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'KIT CORREIA DENTADA VOLKSWAGEN GOL, CROSSFOX, FOX', 0, 'UN', 120.50, 0, '2021-03-23 03:40:03', '2021-03-23 03:40:03'),
(2, 'KIT CORREIA DENTADA GM CORSA E CELTA', 0, 'UN', 211.99, 1, '2021-03-23 03:40:17', '2021-03-23 03:51:50'),
(3, 'KIT REVISÃO CELTA/PRISMA', 0, 'UN', 207.99, 1, '2021-03-23 03:40:38', '2021-03-23 04:45:32'),
(4, 'KIT CORREIA DENTADA VOLKSWAGEN GOL, CROSSFOX, FOX', 0, 'UN', 105.00, 1, NULL, NULL),
(5, 'KIT CORREIA DENTADA GM CORSA E CELTA', 0, 'UN', 210.00, 1, NULL, NULL),
(6, 'KIT REVISÃO CELTA/PRISMA', 0, 'UN', 128.00, 1, NULL, NULL),
(7, 'Coxim Completo Do Amortecedor Dianteiro Original Renault Clio E Kangoo Todos 99 Até 2016', 0, 'UN', 160.00, 1, NULL, NULL),
(8, 'Terminal Maciço 95mm Curto Tcm', 0, 'UN', 35.00, 1, NULL, NULL),
(9, 'Kit 4 Bucha Braço Barra Estabilizadora Traseira Peugeot 206 207 Sw', 0, 'UN', 325.00, 1, NULL, NULL),
(10, 'FAROL DIANTEIRO L.E - ONIX - 2020 A 2021', 0, 'UN', 1625.87, 0, '2021-03-30 02:33:26', '2021-03-30 02:33:26'),
(11, 'AMORTECEDOR DIANTEIRO LD - ZAFIRA - 2001 A 2012', 0, 'UN', 258.21, 0, '2021-03-30 02:34:09', '2021-03-30 02:34:09'),
(12, 'FILTRO ÓLEO CHEVROLET CELTA 1.0 1.4 2001 A 2016 PSL18M TECFIL', 0, 'UN', 10.02, 1, '2021-04-10 04:58:02', '2021-04-10 04:58:02'),
(13, 'FILTRO AR CHEVROLET CELTA 1.0 1.4 8V 2000 A 2016 WEGA', 0, 'UN', 9.39, 1, '2021-04-10 04:58:26', '2021-04-10 04:58:26'),
(14, 'CAIXA DIREÇÃO HIDRÁULICA CHEVROLET CELTA 2001 A 2015 COM PONTEIRA AMPRI', 0, 'UN', 9.39, 1, '2021-04-10 04:58:46', '2021-04-10 04:58:46'),
(15, 'CAIXA DIREÇÃO HIDRÁULICA CHEVROLET CELTA 2001 A 2015 COM PONTEIRA AMPRI', 0, 'UN', 1418.99, 1, '2021-04-10 04:59:03', '2021-04-10 04:59:03');

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
(6, 'ALINHAMENTO E BALANCEAMENTO UNITARIO', 'UN', 25.00, 1, NULL, NULL),
(7, 'MÃO DE OBRA SIMPLES', 'UN', 20.00, 1, NULL, NULL),
(8, 'MÃO DE OBRA INTERMEDIÁRIA', 'UN', 50.00, 1, NULL, NULL),
(9, 'MÃO DE OBRA COMPLEXA', 'UN', 100.00, 1, NULL, NULL),
(10, 'TROCA DE ÓLEO', 'UN', 60.00, 1, NULL, NULL),
(11, 'ALINHAMENTO E BALANCEAMENTO COMPLETO', 'UN', 100.00, 1, NULL, NULL),
(12, 'ALINHAMENTO E BALANCEAMENTO UNITARIO', 'UN', 25.00, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `id_perfil` int(11) NOT NULL,
  `cod_cadastro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `id_perfil`, `cod_cadastro`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'admin@admin.com', NULL, 1, 'CF00001', '$2y$10$rBFemAVNeZ.27zlc1YVIwefYfBUcxU2Qyl.KIUseV2Sb.murfZT56', NULL, '2021-03-23 02:12:08', '2021-03-23 02:12:08');

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

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`id_veiculo`, `descricao_veiculo`, `modelo`, `fabricante`, `placa`, `ano`, `fabricacao`, `cor`, `observacao`, `id_cliente`, `created_at`, `updated_at`) VALUES
(1, 'CELTA 1.0, 4 P., FLEX', 'CELTA 1.0 LIFE', 'GM', 'IPCH6789', 2010, 2010, 'BRANCA', 'REVISAO', 1, '2021-03-23 03:02:43', '2021-03-23 03:02:43'),
(2, 'KOMBI 1.6 DISEL 1997', 'KOMBI DISEL', 'VW', 'OPCH9988', 1976, 1976, 'BRANCA', 'TROCA DE VELA DO MOTOR', 2, '2021-03-23 03:08:04', '2021-03-23 03:08:04'),
(3, 'S10 CABINE DUPLA 2.4 DISEL', 'S10 2.4 DISEL', 'GM', 'OZWX3399', 2010, 2010, 'PRETA', 'TROCA DE ÓLEO E LUBRIFICANTES.', 3, '2021-03-23 04:43:59', '2021-03-23 04:43:59'),
(4, 'S10 CABINE SIMPLES, 2.4, FLEX', 'S10 CABINE SIMPLES, 2.4 FLEX', 'GM', 'OWHC3243', 2010, 2010, 'BRANCA', 'REVISÃO DE ROTINA', 5, '2021-03-23 04:53:08', '2021-03-23 04:53:08'),
(5, 'S10 CABINE SIMPLES, 2.4, FLEX', 'S10 CABINE SIMPLES, 2.4 FLEX', 'GM', 'OWHC3229', 2010, 2010, 'BRANCA', 'REVISÃO DE ROTINA', 5, '2021-03-23 04:53:20', '2021-03-23 04:53:20'),
(6, 'S10 CABINE SIMPLES, 2.4, FLEX', 'S10 CABINE SIMPLES, 2.4 FLEX', 'GM', 'OWXY3229', 2009, 2010, 'BRANCA', 'REVISÃO DE ROTINA', 5, '2021-03-23 04:53:39', '2021-03-23 04:53:39'),
(7, 'S10 CABINE SIMPLES, 2.4, FLEX', 'S10 CABINE SIMPLES, 2.4 FLEX', 'GM', 'PPXY1012', 2009, 2010, 'BRANCA', 'REVISÃO DE ROTINA', 5, '2021-03-23 04:53:51', '2021-03-23 04:53:51'),
(8, 'CELTA 4P, 1.0, FLEX', 'CELTA 4 PORTAS, 1.0, FLEX', 'GM', 'PCHI2340', 2010, 2010, 'BRANCA', 'REVISÃO E ALINHAMENTO.', 6, '2021-03-23 05:07:55', '2021-03-23 05:07:55'),
(9, 'GM CHEVROLET ONIX 1.0, 4P, FLEX', 'ONIX', 'GM', 'XXX6969', 2019, 2019, 'BRETA', 'TROCA DE KIT DE VELAS', 9, '2021-03-26 02:47:00', '2021-03-26 02:47:00'),
(10, 'FOX 1.0, FLEX, 4 PORTAS', 'FOX', 'VOLKSWAGEN', 'XXX3344', 2012, 2012, 'PRATA', 'REVISÃO 1000KM', 11, '2021-04-10 05:05:04', '2021-04-10 05:05:04');

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
-- Estrutura stand-in para vista `vw_orcamento_qtd_item`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_orcamento_qtd_item` (
`id_orcamento` int(10) unsigned
,`total` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_clientes`
--
DROP TABLE IF EXISTS `vw_clientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_clientes`  AS SELECT `c`.`id_cliente` AS `id_cliente`, CASE WHEN `pf`.`nome` is null THEN `pj`.`razao_social` ELSE `pf`.`nome` END AS `nome`, CASE WHEN `pf`.`cpf` is null THEN `pj`.`cnpj` ELSE `pf`.`cpf` END AS `documento`, (select count(0) from `orcamentos` `o2` where `o2`.`id_cliente` = `c`.`id_cliente`) AS `count_orcamento` FROM ((`clientes` `c` left join `pessoa_fisicas` `pf` on(`c`.`id_pessoa_fisica` = `pf`.`id_pessoa_fisica`)) left join `pessoa_juridicas` `pj` on(`c`.`id_pessoa_juridica` = `pj`.`id_pessoa_juridica`)) WHERE exists(select 1 from `veiculos` `v` where `v`.`id_cliente` = `c`.`id_cliente` limit 1) ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_dashboard_one`
--
DROP TABLE IF EXISTS `vw_dashboard_one`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_dashboard_one`  AS SELECT sum(case when `o`.`status_orcamento` = 'aberto' then 1 else 0 end) AS `quantidade_aberta`, sum(case when `o`.`status_orcamento` = 'cancelado' then 1 else 0 end) AS `quantidade_cancelado`, sum(case when `o`.`status_orcamento` = 'aprovado' then 1 else 0 end) AS `quantidade_aprovado`, sum(case when `o`.`status_orcamento` = 'aberto' then `o`.`valor_total` else 0 end) AS `valor_em_aberto`, sum(case when `o`.`status_orcamento` = 'aprovado' then `o`.`valor_total` else 0 end) AS `valor_recebido` FROM `orcamentos` AS `o` ;

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
-- Estrutura para vista `vw_orcamento_qtd_item`
--
DROP TABLE IF EXISTS `vw_orcamento_qtd_item`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_orcamento_qtd_item`  AS SELECT `oi`.`id_orcamento` AS `id_orcamento`, sum(`oi`.`quantidade`) AS `total` FROM `orcamento_items` AS `oi` GROUP BY `oi`.`id_orcamento` ;

--
-- Índices para tabelas despejadas
--

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
  ADD KEY `orcamentos_id_veiculo_foreign` (`id_veiculo`);

--
-- Índices para tabela `orcamento_items`
--
ALTER TABLE `orcamento_items`
  ADD PRIMARY KEY (`id_orcamento_item`),
  ADD KEY `orcamento_items_id_orcamento_foreign` (`id_orcamento`),
  ADD KEY `orcamento_items_id_produto_foreign` (`id_produto`),
  ADD KEY `orcamento_items_id_servico_foreign` (`id_servico`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id_cidade` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  MODIFY `id_orcamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `orcamento_items`
--
ALTER TABLE `orcamento_items`
  MODIFY `id_orcamento_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `perfils`
--
ALTER TABLE `perfils`
  MODIFY `id_perfil` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pessoa_fisicas`
--
ALTER TABLE `pessoa_fisicas`
  MODIFY `id_pessoa_fisica` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `pessoa_juridicas`
--
ALTER TABLE `pessoa_juridicas`
  MODIFY `id_pessoa_juridica` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id_servico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id_veiculo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

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
-- Limitadores para a tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD CONSTRAINT `orcamentos_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `orcamentos_id_veiculo_foreign` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id_veiculo`);

--
-- Limitadores para a tabela `orcamento_items`
--
ALTER TABLE `orcamento_items`
  ADD CONSTRAINT `orcamento_items_id_orcamento_foreign` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamentos` (`id_orcamento`),
  ADD CONSTRAINT `orcamento_items_id_produto_foreign` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`),
  ADD CONSTRAINT `orcamento_items_id_servico_foreign` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id_servico`);

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
-- Limitadores para a tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD CONSTRAINT `veiculos_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
