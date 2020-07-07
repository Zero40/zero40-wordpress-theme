![Logo Zero40](https://zero40.com.br/wp-content/uploads/2017/05/logo_zero40_horizontal_fundo_claro.png)


# Tema Wordpress Zero40

Tema do wordpress do site do [Zero40 - ecossistema empreendedor de JF](https://zero40.com.br/).   

# Participe!

Se você quiser participar de um projeto tão legal, você precisa:
- Conhecer PHP
- Saber lidar com temas de wordpress
- Saber trabalhar em equipe

Veja as [issues](https://github.com/TiagoGouvea/zero40-wordpress-theme/issues) atuais e comente na issue na qual deseja trabalhar (as issues marcadas como "Boa primeira issue" são mais fáceis).

# O tema

O tema foi criado a partir do [Integral](https://wordpress.org/themes/integral/), e customizado pela equipe da [App Masters](https://appmasters.io) para melhor atender ao Zero40. 

O tema atual importa o [bootstrap](https://getbootstrap.com/) para facilitar implementar algumas interfaces.

# Ambiente de desenvolvimento

Se você deseja colaborar no projeto, provavelmente será necessário ter o wordpress rodando em sua máquina. Para este projeto isso pode ser feito de duas maneiras.

### Instalação wordpress

- É necessário já ter o PHP e o MySQL funcionando
- Instale o wordpress em uma pasta local
- Dentro da pasta `wp-content/themes` execute um `git clone https://github.com/Zero40/zero40-wordpress-theme.git` para que este repositório esteja disponível como tema no seu wordpress
- Substituia o banco de dados inicial por [este banco de dados](https://zero40.com.br/neopange_wp_z40.sql.zip) para ter todo o conteúdo dos posts e posttypes
- [Altere a url](https://kinsta.com/knowledgebase/change-wordpress-url/) do site para seu endereço local (de zero40.com.br para algo como localhost/zero40)
- Acesse o admin com o usuário `admin@admin.com.br` e senha `admin` (só funciona em localhost, claro)
- Instale e ative todos os plugins
- Opcionalmente, baixe a pasta [wp-content/uploads](https://zero40.com.br/wp-content-uploads.zip) se quiser ter algumas das imagens em seu ambiente local.

Pronto! O site deve estar funcionando em sua máquina local agora. 🎉

### Utilizando o docker

- Crie uma pasta local para o projeto
- Crie uma pasta `wp-content` e `wp-content/themes`
- Dentro da pasta `wp-content/themes` execute um `git clone https://github.com/Zero40/zero40-wordpress-theme.git` para que este repositório esteja disponível como tema no seu wordpress
- Baixe este [docker-compose](https://gist.github.com/TiagoGouvea/bd067e7a375501c46e7d8a5bcc8e17c6). Ele irá montar sua pasta local `wp-content` para a máquina docker
- Acesse o PhpMyAdmin do docker, e substituia o banco de dados inicial por [este banco de dados](https://zero40.com.br/neopange_wp_z40.sql.zip) para ter todo o conteúdo dos posts e posttypes
- [Altere a url](https://kinsta.com/knowledgebase/change-wordpress-url/) do site para seu endereço local (de zero40.com.br para algo como localhost/zero40)
- Acesse o admin com o usuário `admin@admin.com.br` e senha `admin` (só funciona em localhost, claro)
- Instale e ative todos os plugins
- Opcionalmente, baixe a pasta [wp-content/uploads](https://zero40.com.br/wp-content-uploads.zip) se quiser ter algumas das imagens em seu ambiente local.