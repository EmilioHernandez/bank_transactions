<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Bank Transactions

Proyecto de prueba para realizar transacciones bancarias usando event sourcing.

- Clonar el repo
- Copiar `.env.example` a `.env`
- Configurar las variables de entorno `DB_` en `.env` a su gusto
- Crear una base de datos con el nombre especificado en `DB_DATABASE`
- `composer install`
- `php artisan passport:install`
- Migrar e insertar datos de prueba en la base de datos con `php artisan migrate:fresh --seed`
- Ahora puedes iniciar sesión con el usuario "emilio25informatic@gmail.com", password "secret"

## Servicios disponibles.

#### POST [EndPoint para el obtener el token del usuario]

##### Resource URL
http://bank_transactions.test/v1/login

##### Headers
| Key    | Value            | 
| ------ | ---------------- |
| Accept | application/json |

##### Body
| Nombre   | Tipo   | Descripción            | Requerido
| -------- | ------ | ---------------------- | --------- |
| username | string | nombre del usuario     |     si    |
| password | string | contraseña del usuario |     si    |

##### Status de solicitud manejados
| Status    | Código  
| ----- | ------------------   | 
|  200  | Respuesta exitosa    |

##### Repuesta esperada
```json
{
    "token_type": "Bearer",
    "expires_in": 31536000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiOWJhNmYyODFkNWMxYTlmNzNiNDg2MDZlNmFhNWZkNGVmOTE1ZjRhMGFmNzQzNWFlZTQ3OTExY2U4MjQ4YTc2MDg4NjEyYjI2ZWIwNGRjOGUiLCJpYXQiOjE2NTU3NDkxMjguMTA0NTE2LCJuYmYiOjE2NTU3NDkxMjguMTA0NTE4LCJleHAiOjE2ODcyODUxMjguMDg0OCwic3ViIjoiNSIsInNjb3BlcyI6W119.MRM71KJvU614iwjx7P-EfyFKGn0n1M-R44o8S1lNAjai910K4F9-O5pzmpZL_I7PxG1hquc4nveBY_1JMZ6F_uRX3-pmQbb79SnW79sohS9W2FSOi-wq5BmdBm2F_l-HA6wQdzaN2nNdlGfYzkDVemCJGVEG-Ecd7JDw7J9RTpsTs55GkiaMWUtCYAHM_Dgbcnx0yOfnNw8OZqFd1UHYxxpylQcfXss_EVYA2sQMYsUm74sJQrH-IU1Qz5Kju0RYgwBt6CnrujAofKE1Ny4ZJDUMTXjNo6nbQYm6hng7UX51sowFulzIsPrqm4nJDKF5bLII838nwLNP7cnNv09Bjkw8sHrEFCewquknpwP_Q1CDw6h-H4LD4bADp4f-wy2SADbBw7DUfriDk2PwOYUyKdmqaL9hcWXwmMEQXHMJ6vLZ6zO6hpOe_x9qsiveBZdaaPPlsavU-NqLqWc7VffR70PZliJo2VCIG4S6KA4bjV6NENDTd-ApK16pG4phGZZv92fWXPGHGBlxx22DVVwZCxIAbyj1Bf5znEsDxLZshSYKnS9lDnp0fjsYO9wSuyk8aL06lhVo36m4g0_w4JvqKHuQgmA8LQ8gfq7VojMzAIg6CO8n9wOJpiTKsceasqW7L2uxSwlKN399Z0iWCDQ1f1ve1uJLvHJG_583ZyDgsFM",
    "refresh_token": "def50200ec09c55a553720d14c67882f40aee57d3749fefee9ee6729f92b87b96ef89c7d1d7627cf24125e2ca4aaf5fad83c8300835e1e059b1156705595ad98c4e05dd9ad74f165a22e2b8098677a8da5295fa859b0efdc34456916c6bd4bef44f34dd9b98cf961f0ff31311e7b5a2b580477261456438f0193ee7efa568b754d4ce272d986b9f80c54ff6efc5bf48a503a23d8c783947942809723cb1febc6d6ec6217a0d218486ee14ccdbd300914bed21cc1cc52f363cb25b117c75c7f22e4e3bd97f5fc8ad18101aba90604bf87b4adb26404d27e217c26817be52c0984bdd913ae38611515a5cda899f458f82260e148f3cd2f3e694e377fa50f880df4305b0011662411458ed2f3649e4f88bfe28406bd0166ef4da594e656f15d926c8540d800e1463ba27005352ffe489287b2222ea29508a03f32aea9a599749541b98737de665ab0f6db2130b2f46f688471e0bcb7da7c0a27a60a8ba79507851d89"
}
```

##### En el caso de no enviar alguno de los parámetro
``` json
{
    "message": "El campo username es requerido (and 1 more error)",
    "errors": {
        "username": [
            "El campo username es requerido"
        ],
        "password": [
            "El campo password es requerido"
        ]
    }
}
```

#### GET [EndPoint para mostrar la lista de cuentas del usuario autenticado]
##### Resource URL
http://bank_transactions.test/v1/accounts

##### Headers
| Key    | Value
| ------------- | ------------------- |
| Accept        | application/json    |
| Authorization | Bearer access_token |


##### Status de solicitud manejados
| Status    | Código
| ----- | ------------------   | 
|  200  | Respuesta exitosa    |
|  401  | Unauthorized         | 

##### Repuesta esperada
```json
[
    {
        "id": 2,
        "uuid": "6236cf04-4185-4901-825d-102866985411",
        "name": "My 9 account",
        "user_id": 5,
        "balance": 2000,
        "created_at": "2022-06-20T18:36:46.000000Z",
        "updated_at": "2022-06-20T18:49:19.000000Z"
    }
]
```

#### POST [EndPoint para crear una cuenta]
##### Resource URL
http://bank_transactions.test/v1/accounts

##### Headers
| Key    | Value            
| ------------- | ------------------- |
| Accept        | application/json    |
| Authorization | Bearer access_token |

##### Body
| Nombre   | Tipo   | Descripción            | Requerido
| -------- | ------ | ---------------------- | --------- |
| name     | string | nombre de la cuenta    |     si    |

##### Status de solicitud manejados
| Status    | Código
| ----- | ------------------   | 
|  200  | Respuesta exitosa    |
|  401  | Unauthorized         |

##### Repuesta esperada
```json
{
    "response": "success"
}
```
#### PUT [EndPoint para actualizar el monto de una cuenta]
##### Resource URL
http://bank_transactions.test/v1/accounts/{account_uuid}

##### Headers
| Key    | Value
| ------------- | ------------------- |
| Accept        | application/json    |
| Authorization | Bearer access_token |

##### Body
| Nombre   | Tipo   | Descripción            | Requerido
| -------- | ------ | ---------------------- | -------------------------------------------------------------- |
| name     | string | nombre de la cuenta    |     si                                                         |
| addMoney | string | Si se envia este parámetro se hace un depósito en caso contrario se realiza un retiro   |     no    |

##### Status de solicitud manejados
| Status    | Código
| ----- | ------------------   | 
|  200  | Respuesta exitosa    |
|  401  | Unauthorized         |

##### Repuesta esperada
```json
{
    "response": "success"
}
```
#### DELETE [EndPoint para eliminar una cuenta]
##### Resource URL
http://bank_transactions.test/v1/accounts/{account_uuid}

##### Headers
| Key    | Value
| ------------- | ------------------- |
| Accept        | application/json    |
| Authorization | Bearer access_token |

##### Status de solicitud manejados
| Status    | Código
| ----- | ------------------   | 
|  200  | Respuesta exitosa    |
|  401  | Unauthorized         | 

##### Repuesta esperada
```json
{
    "response": "success"
}
```
#### GET [EndPoint Cuenta las transacciones realizadas por un usuario]
##### Resource URL
http://bank_transactions.test/v1/transactions

##### Headers
| Key    | Value
| ------------- | ------------------- |
| Accept        | application/json    |
| Authorization | Bearer access_token |

##### Status de solicitud manejados
| Status    | Código
| ----- | ------------------   | 
|  200  | Respuesta exitosa    |
|  401  | Unauthorized         | 

##### Repuesta esperada
```json
[
    {
        "id": 2,
        "uuid": "6236cf04-4185-4901-825d-102866985411",
        "user_id": 5,
        "count": 2,
        "created_at": "2022-06-20T18:36:46.000000Z",
        "updated_at": "2022-06-20T18:49:19.000000Z",
        "user": {
            "id": 5,
            "name": "Emilio Hernández",
            "email": "emilio25informatic@gmail.com",
            "email_verified_at": "2022-06-20T18:16:13.000000Z",
            "created_at": "2022-06-20T18:16:13.000000Z",
            "updated_at": "2022-06-20T18:16:13.000000Z"
        }
    }
]
```
## Ejecutar pruebas
- `php artisan test
  `
