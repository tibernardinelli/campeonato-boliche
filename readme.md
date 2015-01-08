## Boliche 2014

### Instrucoes de instalacao

```
git clone https://[substituirPeloUsuarioBitBucket]@bitbucket.org/vanzolini/gte-campeonato-boliche.git
cd gte-campeonato-boliche/src/
mkdir webroot/img/participants_pictures
chmod 777 webroot/img/participants_pictures
cp Config/database.prod.php Config/database.php
```
- Atualize as informacoes do Config/database.php para apontar para o seu banco de dados. Garanta que o usuario tenha permissao para criar tabelas.
```
./Vendor/cakephp/cakephp/lib/Cake/Console/cake schema create
```
- Lembre-se de verificar que a pasta gte-campeonato-boliche/src/tmp/ esta com permissao de escrita global (chmod 777)

### Carregar os participantes no banco de dados

- Exporte a planilha excel de participantes para arquivo .csv separado por virgulas e salve-o na pasta "gte-campeonato-boliche/data/". Lembre-se de respeitar as colunas ja existentes e a ORDEM em que elas se encontram no arquivo.
- Abra o arquivo no Sublime ou Notepad++ e salve-o com encoding UTF8 without BOM
- Atualize as chaves 'SUBSCRIPTION_END_DATE', 'PARTICIPANTS_CSV_FILE' (local onde esta o arquivo csv) e 'PARTICIPANTS_PER_TEAM' (quantidade de participantes que cada time devera conter) no arquivo 'gte-campeonato-boliche/src/Config/bootstrap.php'
- Execute os comandos abaixo:
```
./Vendor/cakephp/cakephp/lib/Cake/Console/cake LoadParticipants
```
- A partir deste momento voce ja pode abrir o sistema no Browser. Os usuarios da planilha ja estarao prontos para efetuar a propria inscricao

### Alocar participantes em turmas de forma aleatória
- Somente após as inscrições terminarem você deverá executar a "randomização" de participantes em times
- O script não executará se houverem menos pessoas inscritas do que o valor definido em 'PARTICIPANTS_PER_TEAM', ou seja, se o valor estiver = 3, inscreva ao menos 4 pessoas para que o sistema crie 2 equipes e aloque os participantes aleatoriamente nelas
- Execute os seguintes comandos
```
cd gte-campeonato-boliche/src/
./Vendor/cakephp/cakephp/lib/Cake/Console/cake RandomlyCreateTeams
```