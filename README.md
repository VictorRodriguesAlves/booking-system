# 🏢 API de Reservas de Salas

<div align="center">

### Sistema de gerenciamento de reservas de salas de reunião

![Version](https://img.shields.io/badge/version-1.0.0-blue)
![PHP Version](https://img.shields.io/badge/php-%5E8.1-blue)
![Laravel Version](https://img.shields.io/badge/laravel-%5E10.0-red)
![License](https://img.shields.io/badge/license-MIT-green)

</div>

## 📑 Sobre o Projeto

API desenvolvida em Laravel para gerenciamento de reservas de salas de reunião, permitindo criar, listar, editar e cancelar reservas de forma eficiente e organizada.

### 🚀 Principais Funcionalidades

- Gerenciamento completo de reservas
- Verificação automática de conflitos de horário
- Sistema de aprovação de reservas
- Cancelamento com registro de motivo
- Listagem com filtros diversos

## 📌 Índice

- [Configuração](#-configuração-do-ambiente)
- [Endpoints](#-endpoints)
- [Validações](#-validações)
- [Verificação de Conflitos](#-verificação-de-conflitos)
- [Códigos de Status](#-códigos-de-status)
- [Formato de Datas](#-formato-de-datas)

## 🛠️ Tecnologias Utilizadas

- **PHP 8.2+**
- **Laravel 12.x**
- **MySQL 8.0**
- **RESTful API**

Vou atualizar a seção de Configuração do Ambiente para incluir o seed:

## 🔧 Configuração do Ambiente

1. Clone o repositório
```bash
  git clone https://github.com/VictorRodriguesAlves/booking-system.git
```

2. Instale as dependências
```bash
  composer install
```

3. Configure o arquivo .env
```bash
  cp .env.example .env
```

4. Gere a chave da aplicação
```bash
  php artisan key:generate
```

5. Execute as migrations com os seeders
```bash
  php artisan migrate --seed
```
> **Nota**: O comando `--seed` irá popular o banco de dados com:
> - Usuários padrão (admin e usuários comuns)
> - Salas de reunião pré-configuradas
> - Recursos básicos

6. Inicie o servidor de desenvolvimento
```bash
  php artisan serve
```

> **Acesso**: A aplicação estará disponível em `http://localhost:8000`



### Dados de Acesso Padrão

**Administrador**
```
Email: admin@empresa.com
Senha: password123
```

**Usuário Comum**
```
Email: user@empresa.com
Senha: password123
```

## 📋 Requisitos do Sistema

- PHP >= 8.1
- Composer
- MySQL >= 8.0
- Extensões PHP:
    - OpenSSL
    - PDO
    - Mbstring
    - Tokenizer
    - XML

## 🔚 Endpoints

> **Nota:** Todos os endpoints exigem o header `Accept: application/json` nas requisições.

### 1. Listar Reservas

> Retorna todas as reservas cadastradas no sistema.

**Endpoint:** `GET /api/reservations`

**Resposta de Sucesso:**
```json
{
    "success": true,
    "message": "Reservas listadas com sucesso",
    "data": [
        {
            "id": 1,
            "user": "João Silva",
            "room": {
                "name": "Sala de Reunião 1",
                "location": "2º andar"
            },
            "start_time": "17/04/2025 14:00:00",
            "end_time": "17/04/2025 15:00:00",
            "purpose": "Reunião de projeto",
            "status": "pending",
            "cancellation_reason": null,
            "approved": false,
            "approved_by": null,
            "created_at": "16/04/2025 09:37:34",
            "updated_at": "16/04/2025 09:37:34"
        }
    ]
}
```

**Status:** `200 OK`

### 2. Criar Reserva

> Cria uma nova reserva de sala.

**Endpoint:** `POST /api/reservations`

**Request Body:**
```json
{
    "user_id": 5,
    "room_id": 1,
    "start_time": "2025-04-17 14:00:00",
    "end_time": "2025-04-17 15:00:00",
    "purpose": "Reunião de projeto"
}
```

**Resposta de Sucesso:**
```json
{
    "success": true,
    "message": "Reserva criada com sucesso",
    "data": {
        "id": 1,
        "user": "João Silva",
        "room": {
            "name": "Sala de Reunião 1",
            "location": "2º andar"
        },
        "start_time": "17/04/2025 14:00:00",
        "end_time": "17/04/2025 15:00:00",
        "purpose": "Reunião de projeto",
        "status": "pending",
        "cancellation_reason": null,
        "approved": false,
        "approved_by": null,
        "created_at": "16/04/2025 09:37:34",
        "updated_at": "16/04/2025 09:37:34"
    }
}
```

**Resposta de Erro (Conflito):**
```json
{
    "success": false,
    "message": "Horário indisponível para reserva",
    "errors": null
}
```

**Status:**
- `201 Created`: Sucesso
- `422 Unprocessable Entity`: Erro de validação/conflito

### 3. Editar Reserva

> Atualiza uma reserva existente.

**Endpoint:** `PUT /api/reservations/{id}`

**Request Body:**
```json
{
    "start_time": "2025-04-17 15:00:00",
    "end_time": "2025-04-17 16:00:00",
    "purpose": "Reunião de projeto atualizada"
}
```

**Resposta de Sucesso:**
```json
{
    "success": true,
    "message": "Reserva atualizada com sucesso",
    "data": {
        "id": 1,
        "user": "João Silva",
        "room": {
            "name": "Sala de Reunião 1",
            "location": "2º andar"
        },
        "start_time": "17/04/2025 15:00:00",
        "end_time": "17/04/2025 16:00:00",
        "purpose": "Reunião de projeto atualizada",
        "status": "pending",
        "cancellation_reason": null,
        "approved": false,
        "approved_by": null,
        "created_at": "16/04/2025 09:37:34",
        "updated_at": "16/04/2025 10:15:22"
    }
}
```

**Status:**
- `200 OK`: Sucesso
- `422 Unprocessable Entity`: Erro de validação/conflito

### 4. Cancelar Reserva

> Cancela uma reserva existente.

**Endpoint:** `PATCH /api/reservations/{id}/cancel`

**Request Body:**
```json
{
    "cancellation_reason": "Cliente desmarcou a reunião"
}
```

**Resposta de Sucesso:**
```json
{
    "success": true,
    "message": "Reserva cancelada com sucesso",
    "data": {
        "id": 1,
        "user": "João Silva",
        "room": {
            "name": "Sala de Reunião 1",
            "location": "2º andar"
        },
        "start_time": "17/04/2025 14:00:00",
        "end_time": "17/04/2025 15:00:00",
        "purpose": "Reunião de projeto",
        "status": "cancelled",
        "cancellation_reason": "Cliente desmarcou a reunião",
        "approved": false,
        "approved_by": null,
        "created_at": "16/04/2025 09:37:34",
        "updated_at": "16/04/2025 09:45:12"
    }
}
```

**Status:**
- `200 OK`: Sucesso
- `422 Unprocessable Entity`: Reserva já cancelada

## ✅ Validações

- `user_id`: Obrigatório, deve existir na tabela de usuários
- `room_id`: Obrigatório, deve existir na tabela de salas
- `start_time`: Obrigatório, deve ser uma data futura
- `end_time`: Obrigatório, deve ser posterior ao `start_time`
- `purpose`: Obrigatório, entre 3 e 255 caracteres
- `cancellation_reason`: Opcional, máximo 255 caracteres

## 🔄 Verificação de Conflitos

O sistema verifica automaticamente se há conflitos de horário ao criar ou editar uma reserva. Um conflito ocorre quando:

1. Outra reserva para a mesma sala já existe no mesmo horário
2. O horário da nova reserva se sobrepõe a uma reserva existente
3. A reserva existente não está cancelada

## 📊 Códigos de Status

- `200 OK`: Requisição bem-sucedida
- `201 Created`: Recurso criado com sucesso
- `422 Unprocessable Entity`: Dados inválidos ou conflito de regras de negócio

## 📅 Formato de Datas

- **Entrada:** Formato ISO 8601 (`YYYY-MM-DD HH:MM:SS`)
- **Saída:** Formato brasileiro (`DD/MM/YYYY HH:MM:SS`)
