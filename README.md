# Configurações para acessar o banco de dados com o firebird
<p>
    - Abrir o php.ini.
    - tirar os comentarios das linhas extension=pdo_firebird
    para retirar basta remover ";" da frente do nome
</p>

# Criado uma view com nome V_FINANCEIRO:
- <p>
    a view V_FINANCEIRO Tem os seguites campos (Campos = Tabela : campos da tabela):
    NOME = NOME : EMD101
    CNPJ_CPF = TPAGAR : CNPJ_CPF
    DOCUMENTO = TPAGAR : DOCUMENTO
    EMISSAO = TPAGAR : EMISSAO
    VENCTO = TPAGAR : VENCTO
    DATA_PAGTO = TPAGAR : DATA_PAGTO
    ID_FORMA_PAGAMENTO = CONTAS_PAGAR_BAIXA : ID_FORMA_PAGAMENTO
    VALOR_PAGO = CONTAS_PAGAR_BAIXA : VALOR_PAGO
</p>

## Query:
<p>
    CREATE OR ALTER VIEW FINANCEIRO_V(
        NOME,
        CNPJ_CPF,
        DOCUMENTO,
        EMISSAO,
        VENCTO,
        DATA_PAGTO,
        ID_FORMA_PAGAMENTO,
        VALOR_PAGO,
        DATA_BAIXA)
    AS
    SELECT
        EMD101.NOME,
        TPAGAR.CNPJ_CPF,
        TPAGAR.DOCUMENTO,
        TPAGAR.EMISSAO,
        TPAGAR.VENCTO,
        TPAGAR.DATA_PAGTO,
        CONTAS_PAGAR_BAIXA.ID_FORMA_PAGAMENTO,
        CONTAS_PAGAR_BAIXA.VALOR_PAGO,
        CONTAS_PAGAR_BAIXA.DATA_BAIXA
    FROM TPAGAR
    LEFT JOIN CONTAS_PAGAR_BAIXA ON TPAGAR.DOCUMENTO = CONTAS_PAGAR_BAIXA.DOCUMENTO
    LEFT JOIN EMD101 ON TPAGAR.CNPJ_CPF = EMD101.CGC_CPF
    ;
</p>

