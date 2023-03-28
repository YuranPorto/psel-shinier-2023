# Configurações para acessar o banco de dados com o firebird
- Abrir o php.ini.<br>
- tirar os comentarios das linhas extension=pdo_firebird<br>
para retirar basta remover ";" da frente do nome<br>

# Criado uma view com nome FINANCEIRO_V:
A view FINANCEIRO_V Tem os seguites campos (Campos = Tabela : campos da tabela):<br>
NOME = NOME : EMD101<br>
CNPJ_CPF = TPAGAR : CNPJ_CPF<br>
DOCUMENTO = TPAGAR : DOCUMENTO<br>
EMISSAO = TPAGAR : EMISSAO<br>
VENCTO = TPAGAR : VENCTO<br>
DATA_PAGTO = TPAGAR : DATA_PAGTO<br>
ID_FORMA_PAGAMENTO = CONTAS_PAGAR_BAIXA : ID_FORMA_PAGAMENTO<br>
VALOR_PAGO = CONTAS_PAGAR_BAIXA : VALOR_PAGO<br>
<br>
## Query:
CREATE OR ALTER VIEW FINANCEIRO_V(<br>
    NOME,<br>
    CNPJ_CPF,<br>
    DOCUMENTO,<br>
    EMISSAO,<br>
    VENCTO,<br>
    DATA_PAGTO,<br>
    ID_FORMA_PAGAMENTO,<br>
    VALOR_PAGO,<br>
    DATA_BAIXA)<br>
AS<br>
SELECT<br>
    EMD101.NOME,<br>
    TPAGAR.CNPJ_CPF,<br>
    TPAGAR.DOCUMENTO,<br>
    TPAGAR.EMISSAO,<br>
    TPAGAR.VENCTO,<br>
    TPAGAR.DATA_PAGTO,<br>
    CONTAS_PAGAR_BAIXA.ID_FORMA_PAGAMENTO,<br>
    CONTAS_PAGAR_BAIXA.VALOR_PAGO,<br>
    CONTAS_PAGAR_BAIXA.DATA_BAIXA<br>
FROM TPAGAR<br>
LEFT JOIN CONTAS_PAGAR_BAIXA ON TPAGAR.DOCUMENTO = CONTAS_PAGAR_BAIXA.DOCUMENTO<br>
LEFT JOIN EMD101 ON TPAGAR.CNPJ_CPF = EMD101.CGC_CPF<br>
;

