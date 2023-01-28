# Tor REST API
Esta é uma aplicação com o objetivo de obter uma lista de IPs de redes Tor vindos de duas fontes externas: https://www.dan.me.uk/tornodes e https://onionoo.torproject.org/summary?limit=5000. Esses IPs são mostrados de maneira única na interface do usuário, ou seja, como se fosse uma única lista – no entanto, com o uso de paginação, sendo mostrados na tela um limite variável de valores (que o usuário consiga alterar) por página divididos em 3 colunas -, juntamente com as opções de “buscar IP”, “ocultar IP” ou “desocultar IP”, “mostrar IPs não ocultados” e “mostrar IPs ocultos”.<br>
Ao ocultarmos um IP, ele é mostrado apenas na página principal do servidor, a qual lista todos aqueles buscados das duas fontes, e na página de “IPs ocultos”, listando os que estão presentes no banco de dados; portanto, ao acessarmos “ips-desocultos”, o usuário somente poderá ver os IPs que não foram ocultados, logo não fazem parte da base de dados.<br>
Além disso, foi inserida uma funcionalidade de “desocultar IP” como função de tornar acessível novamente o nó que “banimos” anteriormente, fazendo com que o dado informado seja deletado do banco de dados e, consequentemente, tornando-o visível novamente na página de “IPs desocultos”.<br><br>

## Endpoints:
<ul>
    <li><h3 style="display: inline">RestAPI/index.php</h3> – 
    quando é feita a requisição via GET, o servidor nos retorna uma página HTML com uma lista dos IPs buscados em “onionoo.torproject.or” e de um arquivo JSON (danMeIPs.json) armazenado no servidor. Já ao enviarmos um endereço IP via GET, a API faz uma filtragem procurando os valores que correspondam ao passado pela url.
    <li><h3 style="display: inline">RestAPI/ips-desocultos/</h3> – ao acessarmos este endereço via GET, obtemos uma página HTML com os IPs não ocultos, isto é, os que não se encontram no banco de dados.
    <li><h3 style="display: inline">RestAPI/ocultar-ip/</h3> – enviado o IP via POST, o back-end valida se o dado é um IPv4 ou IPv6, se ele já está presente na base de dados e, por fim, se ele é encontrado nas fontes externas. Se houver algum erro na validação, é retornada uma mensagem de erro o informando, caso contrário, o IP é inserido no banco e uma mensagem de sucesso é criada. Logo após, o usuário é redirecionado à página de “IPs desocultos” com a mensagem respectiva.
    <li><h3 style="display: inline">RestAPI/ips-desocultos/desocultarIP.php</h3> - neste endpoint, o IP recebido via POST é validado (se está presente no banco de dados e se é um IPv4 ou IPv6), deletado da base de dados e o usuário é redirecionado a “ips-desocultos”.
    <li><h3 style="display: inline">RestAPI/ips-ocultos/</h3> - já aqui o usuário acessa via GET, obtendo todos os IPs ocultados por ele.
</ul><br>

## Tecnologias utilizadas
<ol>
    <li>PHP - backend;
    <li>Bootstrap 5 - estilização;
    <li>MySQL - banco de dados;
    <li>Docker - ambiente de execução;
    <li>Visio e Word - documentação
</ol>

## Como executar?
<ol>
<h3><li>Clone do repositório</h3>
        
    git clone https://github.com/GustavoMartinsSantos/TorAPI.git
<h3><li>Inicialização dos containers</h3>

    docker-compose up
</ol>

Feito isso, ao acessarmos o servidor apache em um navegador, uma tela do tipo abaixo será vista por você
![Screenshot 2023-01-28 132951](https://user-images.githubusercontent.com/62625567/215277945-7906c78b-26a9-47f8-a8ea-7b1035535559.png)