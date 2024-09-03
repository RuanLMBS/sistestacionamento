SOLUÇÃO PARA CONTROLE DE ESTACIONAMENTO
Este é um projeto de gestão de estacionamento desenvolvido em PHP. 
Ele oferece funcionalidades para gerenciar a entrada, saída e verificar histórico de entradas/saídas de um veículo no estacionamento.

Recomenda-se o uso do XAMPP Control Panel, a fim da utilização do Apache e do MySQL.

---------------------
Funcionalidades:

Cadastro de Veículos:
Cadastro de novos veículos informando a placa, modelo e categoria.

---------------------
Entrada e Saída de Veículos:

Registre a entrada e saída de veículos no estacionamento, mantendo um registro de horários, tempo de permanência e valor a ser pago.
O tempo de permanência é calculado em segundos.
--------------------

Cálculo de Tarifas:

Calcule automaticamente as tarifas de estacionamento com base na categoria do veículo e no tempo de permanência.

--------------------
Histórico:

Visualize o histórico completo de movimentação de cada veículo, incluindo todas as entradas, saídas e valores cobrados.
----------------------


Instruções de Uso:

1 - Configure o arquivo database.php com as informações de conexão com o banco de dados MySQL.
2 - Importe o arquivo SQL fornecido (database.sql) para criar as tabelas necessárias no banco de dados.
3 - Execute o servidor web PHP e acesse index.php para começar a utilizar o sistema.


Este projeto é uma solução simples para gerenciamento de estacionamento,
 e pode ser expandido e personalizado de acordo com as necessidades específicas do seu estabelecimento.

OBS: Os arquivos em CSS pararam de funcionar a partir de certo ponto, sendo necessária a estilização utilizando CSS INLINE.