# Configurações para acessar o banco de dados com o firebird

### - Abrir o php.ini.
### - Verifique se a sua extensão pdo_firebird está ativa.
### - Abrir o seu PHP.ini e procure pelo campo extension=pdo_firebird.
### - Se ele estiver escrito dessa maneira: ;extension-pdo_firebird remova o ; da frente deixando somente extension=pdo_firebird.

<hr><br>

## Query:
<br>

### Criada uma query para busca dos dados, sem a necessídade de uma query muito grande no arquivo principal.
### A query pode ser modificada no arquivo DB dentro da pasta SQL.
```
SELECT
  em.nome, 
  'Documento ' || cr.documento as DOCUMENTO, 
  CAST(cr.valor AS NUMERIC(10,2)) as A_PAGAR, 
  CAST(bx.valor AS NUMERIC(10,2)) as PAGO, 
  SUBSTRING(CAST(cr.emissao as DATE) FROM 9 FOR 2) || '/' || 
  SUBSTRING(CAST(cr.emissao as DATE) FROM 6 FOR 2) || '/' || 
  SUBSTRING(CAST(cr.emissao as DATE) FROM 1 FOR 4) as DATA_LANCAMENTO, 

  SUBSTRING(CAST(cr.vencto as DATE) FROM 9 FOR 2) || '/' || 
  SUBSTRING(CAST(cr.vencto as DATE) FROM 6 FOR 2) || '/' || 
  SUBSTRING(CAST(cr.vencto as DATE) FROM 1 FOR 4) as VENCIMENTO,

  SUBSTRING(CAST(bx.transmissao as DATE) FROM 9 FOR 2) || '/' || 
  SUBSTRING(CAST(bx.transmissao as DATE) FROM 6 FOR 2) || '/' || 
  SUBSTRING(CAST(bx.transmissao as DATE) FROM 1 FOR 4) as CONFIRMA_PAGAMENTO,

  SUBSTRING(CAST(bx.baixa as DATE) FROM 9 FOR 2) || '/' || 
  SUBSTRING(CAST(bx.baixa as DATE) FROM 6 FOR 2) || '/' || 
  SUBSTRING(CAST(bx.baixa as DATE) FROM 1 FOR 4) as DT_RECEBIDO


FROM CRD111 as cr
LEFT JOIN BXD111 as bx ON cr.documento = bx.documento
JOIN EMD101 as em ON cr.CGC_CPF = em.cgc_cpf
UNION
SELECT
  em.nome, 
  ma.nome_tipo,
  ma.valor_orig,
  ma.valor, 
  SUBSTRING(CAST(ma.emissao as DATE) FROM 9 FOR 2) || '/' || 
  SUBSTRING(CAST(ma.emissao as DATE) FROM 6 FOR 2) || '/' || 
  SUBSTRING(CAST(ma.emissao as DATE) FROM 1 FOR 4) as emissao, 
  
  SUBSTRING(CAST(ma.vencto as DATE) FROM 9 FOR 2) || '/' || 
  SUBSTRING(CAST(ma.vencto as DATE) FROM 6 FOR 2) || '/' || 
  SUBSTRING(CAST(ma.vencto as DATE) FROM 1 FOR 4) as vencto, 

  SUBSTRING(CAST(ma.data_pagto as DATE) FROM 9 FOR 2) || '/' || 
  SUBSTRING(CAST(ma.data_pagto as DATE) FROM 6 FOR 2) || '/' || 
  SUBSTRING(CAST(ma.data_pagto as DATE) FROM 1 FOR 4) as data_pagto,


  SUBSTRING(CAST(ma.data_modificado as DATE) FROM 9 FOR 2) || '/' || 
  SUBSTRING(CAST(ma.data_modificado as DATE) FROM 6 FOR 2) || '/' || 
  SUBSTRING(CAST(ma.data_modificado as DATE) FROM 1 FOR 4) as vencto
FROM MAN111 as ma
JOIN EMD101 as em ON ma.CNPJ_CPF = em.cgc_cpf

```

<hr><br>

# INSTALAÇÃO DO COMPOSER.

### - Verifique se você sua versão do PHP.
### - Baixe o composer pelo download manual ou pela linha de comando.
### - Mais instruções em https://getcomposer.org/download/.

<hr><br>

# Instalação do PhpSpreadsheet

### Crie um arquivo composer.json na raiz do projeto.
### No terminal ou no prompt execute:
### composer require phpoffice/phpspreadsheet
### 
### Caso esteja usando XAMPP crie um arquivo chamado composer.json na pasta raiz do projeto.
### dentro do composer.json adicione as seguintes linhas:
```
{
    "require": {
        "phpoffice/phpspreadsheet": "^1.28"
    }
}
```
### Caso tenha algum problema, veja as instruções da documentação https://github.com/PHPOffice/PhpSpreadsheet.
### Verifique seu arquivo php.ini se a sua extenção ext-dg  e extension=zip estão ativas.
### Para isso, abra seu php.ini e procure pela extenção extension=dg e extension=zip, ambas, ou alaguma delas tiver 
### com um ; na frente basta remove-lo assim, como é necessário para ativar a instenção pdo_firebird.
### No terminal execute o comando composer instal.

<br><hr>

# Classes:

## CSV:
<br>

#### A classe CSV possui métodos para lidar com arquivos CSV, como ler e criar arquivos CSV. Esses métodos são estáticos,
#### o que significa que podem ser chamados sem instanciar um objeto da classe.

### **Método lerCsv**
#### O método lerCsv lê um arquivo CSV e retorna um array de dados.
<br>

#### **Parâmetros**:
#### - string $arquivo: O caminho completo para o arquivo CSV a ser lido.
#### - boolean $cabecalho: Indica se o arquivo CSV possui um cabeçalho. O valor padrão é true.
#### - string $delimitador: O caractere usado para separar os valores no arquivo CSV. O valor padrão é ;.
#### - Retorno
#### - O método retorna um array de dados, onde cada item do array representa uma linha do arquivo CSV. Se o arquivo CSV possui um cabeçalho,
#### os nomes das colunas são usados como chaves para cada item do array.
<br>

### Método criarCsv
#### O método criarCsv cria um arquivo CSV a partir de um array de dados.
<br>

#### **Parâmetros**
#### string $arquivo: O caminho completo para o arquivo CSV a ser criado.
#### array $dados: O array de dados a ser gravado no arquivo CSV.
#### string $delimitador: O caractere usado para separar os valores no arquivo CSV. O valor padrão é ;.
#### Retorno
#### O método retorna true se o arquivo CSV foi criado com sucesso e false caso contrário.
<br>

### **Exemplo de uso**
```
// Lendo um arquivo CSV
$dados = CSV::lerCsv('caminho/para/o/arquivo.csv');

// Criando um arquivo CSV
$dados = [
    ['Nome', 'Idade', 'Email'],
    ['João', 25, 'joao@example.com'],
    ['Maria', 30, 'maria@example.com'],
    ['José', 35, 'jose@example.com'],
];
CSV::criarCsv('caminho/para/o/novo-arquivo.csv', $dados);

```
<br><hr>

# Class DataBase
<br>

#### A classe Database é responsável por estabelecer uma conexão com um banco de dados Firebird e executar consultas SQL nessa conexão.
<br>

### **Métodos:**
#### **setConnection()**
#### O método setConnection() é responsável por estabelecer uma conexão com o banco de dados utilizando as informações de acesso
#### definidas como constantes dentro da classe (DNS_CON, #### USER_NAME e DB_PASSWORD). Caso ocorra algum erro na conexão, 
#### uma exceção é lançada com a mensagem de erro correspondente.
<br>

#### **execute($query, $params = [])**
#### O método execute() é responsável por executar uma consulta SQL no banco de dados utilizando a conexão estabelecida pelo método setConnection(). 
#### O parâmetro $query deve ser uma string contendo a consulta SQL a ser executada. O parâmetro $params é opcional e deve ser um array 
#### contendo os valores a serem substituídos nos parâmetros da consulta SQL. Caso ocorra algum erro durante a execução da consulta, 
#### uma exceção é lançada com a mensagem de erro correspondente.
<br>

#### O método retorna um objeto PDOStatement que contém os resultados da consulta executada.
<br>
<blockquote>
  Observações:
  
  <blockquote>
  Gostaria de agradecer a Shinier pela oportunidade de me desafiar e aprender com exemplos de práticas reais de dentro de uma empresa
  Essa semana foi muito desafiadora, e aprendi muito com esse pouco tempo.
  após o termino da semana tabém fiz uma versão do projeto usando python, claro, que foi muito mais facil após realizar o desafio, então consegui re-faze-lo sem ocupar muito tempo.
    https://github.com/YuranPorto/psel-shinier-2023-python-version/tree/master
  
</blockquote>
</blockquote>
