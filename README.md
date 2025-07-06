# Backend - Laravel API

API REST desenvolvida com Laravel 10.10 e PHP 8.1, utilizando MariaDB como base de dados.

## 🚀 Tecnologias Utilizadas

- **Laravel**: 10.10
- **PHP**: 8.1
- **MariaDB**: 10.4.22
- **Docker**: Para containerização
- **Composer**: Para gestão de dependências

## 📋 Pré-requisitos

### Opção 1: Docker (Recomendado)
- Docker Compose

### Opção 2: Instalação Local
- PHP 8.1 ou superior
- Composer
- MariaDB/MySQL 8.0+

## 🐳 Instalação com Docker (Recomendado)

### 1. Clonar o repositório
```bash
git clone URL DO REPOSITORIO
```

### 2. Configurar variáveis de ambiente
```bash
cp .env.example .env
```

### 3. Levantar contentores
```bash
docker-compose up -d
```

### 4. Instalar dependências dentro do contentor
```bash
# Entrar no contentor PHP
docker-compose exec php bash

# Instalar dependências
composer install

# Gerar chave da aplicação
php artisan key:generate

# Executar migrações
php artisan migrate

```

### 5. Aceder à aplicação
- **API**: http://localhost:8000
- **Base de dados**: Porta 3306

## 🛠️ Instalação Local (Sem Docker)

### 1. Instalar dependências
```bash
composer install
```

### 2. Configurar ambiente
```bash
cp .env.example .env
```

### 3. Configurar base de dados no .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dynamikdb
DB_USERNAME=dynamik
DB_PASSWORD=dynamik
```

### 4. Executar migrações
```bash
php artisan key:generate
php artisan migrate
```

### 5. Iniciar servidor
```bash
php artisan serve
```

## 🗄️ Configuração da Base de Dados

### Docker Compose (Automático)
A base de dados é configurada automaticamente com:
- **Base de dados**: dynamikdb
- **Utilizador**: dynamik
- **Palavra-passe**: dynamik
- **Palavra-passe root**: root

### Acesso à Base de Dados
```bash
# Conectar via Docker
docker-compose exec mariadb mysql -u dynamik -p dynamikdb

# Conectar de fora (porta 3306)
mysql -h 127.0.0.1 -P 3306 -u dynamik -p dynamikdb
```

## 📝 Comandos Úteis

### Comandos Docker
```bash
# Levantar contentores
docker-compose up -d

# Ver registos
docker-compose logs -f

# Parar contentores
docker-compose down

# Entrar no contentor PHP
docker-compose exec php bash

# Entrar no contentor MariaDB
docker-compose exec mariadb bash

# Reiniciar contentores
docker-compose restart
```

### Comandos Laravel (dentro do contentor)
```bash
# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Migrações
php artisan migrate
php artisan migrate:rollback
php artisan migrate:fresh --seed

# Ver rotas
php artisan route:list
```

## 🌐 Endpoints da API

URL Base: `http://localhost:8000/api`

### Principais Endpoints:
```
POST   /api/devs             - Criar um novo desenvolvedor
GET    /api/devs             - Listar todos os desenvolvedores
GET    /api/devs/{id}        - Obter detalhes de um desenvolvedor específico

```

## 🔧 Configurações Importantes

### Variáveis de Ambiente (.env)
```env
APP_NAME=Api
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mariadb
DB_PORT=3306
DB_DATABASE=dynamikdb
DB_USERNAME=dynamik
DB_PASSWORD=dynamik

```

## 🚀 Deploy

### Para produção:
1. Configurar variáveis de ambiente para produção
2. Executar `composer install --no-dev --optimize-autoloader`
3. Executar `php artisan config:cache`
4. Executar `php artisan route:cache`
5. Executar `php artisan view:cache`

## 🔍 Resolução de Problemas

### Permissões
```bash
# Dentro do contentor
chown -R www-data:www-data /app/storage /app/bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache
```

### Reiniciar base de dados
```bash
docker-compose down
docker volume rm backend_database
docker-compose up -d
```

## 📞 Informação do Projeto

- **Versão Laravel**: 10.10
- **Versão PHP**: 8.1
- **Base de dados**: MariaDB 10.4.22
- **Porta API**: 8000
- **Porta BD**: 3306

---

**Nota**: Este backend foi desenvolvido como parte de um teste técnico, seguindo as melhores práticas do Laravel e desenvolvimento com Docker.