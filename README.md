# Configurações para acessar o banco de dados com o firebird
```
- Abrir o php.ini.
- tirar os comentarios das linhas extension=pdo_firebird
para retirar basta remover ";" da frente do nome
```

## Query:
```
Criado uma query para busca dos dados, sem a necessídade de uma query

SELECT
em.nome, 'Documento '||cr.documento as DOCUMENTO, CAST(cr.valor AS NUMERIC(10,2)) as A_PAGAR, CAST(bx.valor AS NUMERIC(10,2)) as PAGO,CAST(cr.emissao as DATE) as DATA_LANCAMENTO ,CAST(cr.vencto as DATE) as VENCIMENTO,
bx.transmissao as CONFIRMA_PAGAMENTO, CAST(bx.baixa AS DATE) as DT_RECEBIDO
FROM CRD111 as cr
LEFT JOIN BXD111 as bx
    ON cr.documento = bx.documento
JOIN EMD101 as em
    ON cr.CGC_CPF = em.cgc_cpf
where cr.documento = '23404/18' or cr.documento = '25259/01'
UNION
SELECT
first 10 em.nome, ma.nome_tipo,ma.valor_orig ,ma.valor, ma.emissao, ma.vencto, ma.data_pagto, CAST(ma.data_modificado as DATE)
FROM MAN111 as ma
JOIN EMD101 as em
    ON ma.CNPJ_CPF = em.cgc_cpf
```

A query pode ser modificada no arquivo DB dentro da pasta SQL
