# Space Flight News


REST API utilizando dados do [Space Flight News](https://api.spaceflightnewsapi.net/v3/documentation) para obter informações relacionadas a voos espaciais.

**Frameworks e tecnologias utilizadas:**
- PHP 8.0+
- [Laravel 8](https://laravel.com/)
- [Laravel Sail (Docker)](https://laravel.com/docs/sail)
- [Pest PHP](https://pestphp.com/)

**Instruções:**

Clone o projeto:

```bash
$ git clone git@github.com:webmasterdro/laravel-backend-challenge.git
```

Instale as dependências do projeto:

```bash
$ composer install
```
Para subir os containers rode:

```bash
$ ./vendor/bin/sail up -d
```

Rodando as migrates e testes:

```bash
$ ./vendor/bin/sail artisan migrate --seed
$ ./vendor/bin/sail artisan test
```
Acessando a documentação da API:

[http://laravel-backend-challenge.test/docs](http://laravel-backend-challenge.test/docs)

---

> This is a challenge by [Coodesh](https://coodesh.com/)
