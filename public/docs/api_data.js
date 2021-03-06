define({ "api": [
  {
    "type": "post",
    "url": "/api/v1/system/mailing",
    "title": "Envio masivo de emails",
    "version": "1.0.0",
    "name": "postMailing",
    "group": "Administrador",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "email_destinatario",
            "description": "<p>Destinatario</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "ind_multiusuario",
            "description": "<p>Indicador Multiusuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "asunto",
            "description": "<p>Asunto del Email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "mensaje",
            "description": "<p>Mensaje del Email</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"email_destinatario\": [\"productora@psp.com\", ...] ,\n  --------------------------------------------------\n  \"ind_multiusuario\": true,\n  --------------------------------------------------\n  \"asunto\": \"asunto\",\n  \"mensaje\": \"mensaje\"\n }",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "true.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Sent\n{\n   \"errors\": \"MailNotSent\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/AdministradorController.php",
    "groupTitle": "Administrador"
  },
  {
    "type": "get",
    "url": "/activate/{id}/{hash}",
    "title": "Activacion",
    "version": "1.0.0",
    "name": "activarUsuario",
    "description": "<p>Realiza la activacion del usuario. Este proceso no genera un email notificando la activa. Si la peticion es procesada, devuelve un JSON con un mensaje y con la data del usuario registrado. Adicionalmente, en este mismo proceso se realiza la primera asociacion del perfil del usuario; el cual, por defecto es un perfil tipo USUARIO</p>",
    "group": "Autenticacion",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID del Usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "hash",
            "description": "<p>HASH generado al momento del registro. Este se envia junto al email de activacion y es necesario para activar la cuenta</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "http://psp.app/api/v1/activate/1/ffcc3171108863b41a0f8e1e8487bbe3365c7704",
          "type": "Request"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Resultado de la Operacion</p>"
          },
          {
            "group": "200",
            "type": "Object",
            "optional": false,
            "field": "usuario",
            "description": "<p>Informacion del usuario</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.token",
            "description": "<p>Token generado por el sistema</p>"
          },
          {
            "group": "200",
            "type": "Object",
            "optional": false,
            "field": "usuario.roles",
            "description": "<p>Roles del usuario</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.roles.nombre",
            "description": "<p>Nombre del Rol asociado al usuario</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.roles.permissions",
            "description": "<p>Json con los permisos asociados al rol</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.roles.slug",
            "description": "<p>Codigo del rol (utilizado para la gestion de roles)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.rol_activo",
            "description": "<p>Ultimo rol utilizado por el usuario (Este valor cambia solo si el campo <code>recordarme</code> esta en <code>true</code>)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.recordarme",
            "description": "<p>Indica si se debe guardar el ultimo rol utilizado</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.code",
            "description": "<p>Codigo devuelto por la peticion (200 = Ok, 404 = Error)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\": \"Bienvenido Sr(a) :usuario\",\n  \"usuario\": {\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI\",\n      \"roles\": [\n          {\n              \"nombre\": \"Administrador\",\n              \"permissions\": \"{\\\"superusuario\\\":true, \\\"ver.opciones.administrador\\\":true, \\\"ver.datos_personales\\\":true,\\\"ver.cambiar_contrase\\\\u00f1a\\\":true}\", \n              \"slug\": \"administrador\",\n              \"pivot\": {\n                  \"usuario_id\": 1,\n                  \"rol_id\": 1\n              }\n          }\n      ],\n      \"rol_activo\": \"usuario\",\n      \"recordarme\": 0,\n      \"code\": 200\n   }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: &quot;mensaje&quot; }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Errors\n{\n   \"errors\": [\"Listado de Errores\"]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Auth/RegisterController.php",
    "groupTitle": "Autenticacion"
  },
  {
    "type": "post",
    "url": "/authenticate",
    "title": "Login",
    "version": "1.0.0",
    "name": "authenticate",
    "description": "<p>Realiza la autenticacion en el servidor. Si la peticion es procesada, devuelve un JSON con el token generado. Este token debe ser enviado para cada peticion que requiera de un usuario autenticado</p>",
    "group": "Autenticacion",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Correo del Usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Contraseña del usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": true,
            "field": "remember",
            "description": "<p>Valor del Checkbox para recordar al usuario</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"email\": \"correo@dominio.com\",\n  \"password\": \"123456789\",\n  \"remember\": 0\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Object",
            "optional": false,
            "field": "usuario",
            "description": "<p>Informacion del usuario</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.token",
            "description": "<p>Token generado por el sistema</p>"
          },
          {
            "group": "200",
            "type": "Object",
            "optional": false,
            "field": "usuario.roles",
            "description": "<p>Roles del usuario</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.roles.nombre",
            "description": "<p>Nombre del Rol asociado al usuario</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.roles.permissions",
            "description": "<p>Json con los permisos asociados al rol</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.roles.slug",
            "description": "<p>Codigo del rol (utilizado para la gestion de roles)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.rol_activo",
            "description": "<p>Ultimo rol utilizado por el usuario (Este valor cambia solo si el campo <code>recordarme</code> esta en <code>true</code>)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"usuario\": {\n      \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI\",\n      \"roles\": [\n          {\n              \"nombre\": \"Administrador\",\n              \"permissions\": \"{\\\"superusuario\\\":true, \\\"ver.opciones.administrador\\\":true, \\\"ver.datos_personales\\\":true,\\\"ver.cambiar_contrase\\\\u00f1a\\\":true}\", \n              \"slug\": \"administrador\",\n              \"pivot\": {\n                  \"usuario_id\": 1,\n                  \"rol_id\": 1\n              }\n          }\n      ],\n      \"rol_activo\": \"usuario\",\n      \"recordarme\": 0\n   }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "value",
            "description": "<p>Retorna <code>false</code> si las credenciales suministradas no son válidas</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 TokenNoTCreate\n{\n   \"errors\": \"could_not_create_token\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Auth/LoginController.php",
    "groupTitle": "Autenticacion"
  },
  {
    "type": "get",
    "url": "/finish",
    "title": "Logout",
    "version": "1.0.0",
    "name": "finish",
    "description": "<p>Invalida el token, y el usuario no podra volver a utilizarlo. Se debera ejecutar nuevamente el proceso de login</p>",
    "group": "Autenticacion",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token generado por el sistema al momento de la autenticacion</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "message",
            "description": "<p>Mensaje del sistema indicando la finalizacion de la sesion del usuario en el servidor</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\": \"OK\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: &quot;mensaje&quot; }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 TokenExpired\n{\n   \"errors\": \"Token is invalid\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Auth/LoginController.php",
    "groupTitle": "Autenticacion"
  },
  {
    "type": "post",
    "url": "/register",
    "title": "Registro",
    "version": "1.0.0",
    "name": "register",
    "description": "<p>Ejecuta el registro del usuario. Este proceso tambien notifica por email al usuario para que sea activada la cuenta. Si la peticion es procesada, devuelve un JSON con un mensaje y con la data del usuario registrado. Adicionalmente, en este mismo proceso se realiza la primera asociacion del perfil del usuario; el cual, por defecto es un perfil tipo USUARIO</p>",
    "group": "Autenticacion",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre del Usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "apellido",
            "description": "<p>Apellido del usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "fecha_nacimiento",
            "description": "<p>Fecha de Nacimiento del Usuario (La fecha es parseada a Date en formato yyyy-mm-dd). Se debe enviar en formato mm/dd/yyyy</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "correo",
            "description": "<p>Correo electronico del Usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "correo_confirmation",
            "description": "<p>Confirmacion del Correo electronico del Usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "clave",
            "description": "<p>Contraseña del Usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "clave_confirmation",
            "description": "<p>Confirmacion de la Contraseña del Usuario</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"nombre\": \"NOMBRE\",\n  \"apellido\": \"APELLIDO\",\n  \"correo\": \"cuenta@correo.com\",\n  \"correo_confirmation\": \"cuenta@correo.com\",\n  \"clave\": \"12345678\",\n  \"clave_confirmation\": \"12345678\",\n  \"fecha_nacimiento\" : \"12/31/1980\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Resultado de la Operacion</p>"
          },
          {
            "group": "200",
            "type": "Object",
            "optional": false,
            "field": "usuario",
            "description": "<p>Data del Usuario registrado</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "usuario.id",
            "description": "<p>ID del Usuario</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.nombre",
            "description": "<p>Nombres del Usuario</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.apellido",
            "description": "<p>Apellidos del Usuario</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.email",
            "description": "<p>Email del Usuario</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.password",
            "description": "<p>Contraseña del usuario (encriptada)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.fecha_nacimiento",
            "description": "<p>Fecha de Nacimiento en formato yyyy-mm-dd</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.username",
            "description": "<p>UserName del Usuario</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "usuario.productora_activa",
            "description": "<p>Codigo de la Productora Activa</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.rol_activo",
            "description": "<p>Rol Activo (este valor solo cambia si el usuario asigna en <code>true</code> el atributo <code>recordarme</code>)</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "usuario.recordarme",
            "description": "<p>Atributo para indicar que se debe almacenar el ultimo rol utilizado. El rol del usuario es tomado de la ruta de acceso a la API; es decir, si ingreso a api/v1/administrador/codigos, el ultimo rol sera <code>Administrador</code></p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.avatar",
            "description": "<p>Ruta de la Imagen para el avatar del usuario</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "usuario.social",
            "description": "<p>Indica si el usuario fue creado mediante autenticacion de red social</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.status",
            "description": "<p>Status (Activo o Inactivo)</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "usuario.activado",
            "description": "<p>Identifica al usuario como activado. Este valor cambia cuando el usuario valida la direccion de correo suministrada mediante un link de activacion enviado a su email.</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.nombre_contacto",
            "description": "<p>Nombre de Contacto</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.prefijo_contacto",
            "description": "<p>Prefijo del Contacto (Sr, Sra, etc)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.telefono_contacto",
            "description": "<p>Telefono del Contacto</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.derivacion_contacto",
            "description": "<p>Referencia del Contacto</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.hash_activacion",
            "description": "<p>Hash de activacion enviado al email suministrado en el registro. Este valor pasa a <code>null</code> cuando el usuario activa la cuenta</p>"
          },
          {
            "group": "200",
            "type": "Date",
            "optional": false,
            "field": "usuario.deleted_at",
            "description": "<p>Fecha de eliminacion logica (softdelete)</p>"
          },
          {
            "group": "200",
            "type": "Date",
            "optional": false,
            "field": "usuario.created_at",
            "description": "<p>Fecha de Registro</p>"
          },
          {
            "group": "200",
            "type": "Date",
            "optional": false,
            "field": "usuario.updated_at",
            "description": "<p>Ultima Fecha de Actualizacion de datos del Usuario</p>"
          },
          {
            "group": "200",
            "type": "Object",
            "optional": false,
            "field": "usuario.perfil",
            "description": "<p>Perfil registrado y asociado al Usuario</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "usuario.perfil.usuario_id",
            "description": "<p>ID del Usuario al cual se le asocia el perfil</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.proveedor",
            "description": "<p>Proveedor (psp, facebook, google+, instagram, etc)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.usuario_social_id",
            "description": "<p>Identificador del usuario en la red social</p>"
          },
          {
            "group": "200",
            "type": "Json",
            "optional": false,
            "field": "usuario.perfil.usuario_social_attributes",
            "description": "<p>Objeto Json con los valores suministrador por la red social al momento de la autenticacion</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.identificacion",
            "description": "<p>Identificador del Usuario</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.foto",
            "description": "<p>Ruta de la Fotografia del Usuario (suministrada por la red social)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.foto_original",
            "description": "<p>Ruta de la Fotografia del Usuario</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.genero",
            "description": "<p>Genero (masculino, femenino)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.prefijo",
            "description": "<p>Prefijo Telefonico</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.telefono",
            "description": "<p>Telefono</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.pais",
            "description": "<p>Pais</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.provincia",
            "description": "<p>Provincia</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.ciudad",
            "description": "<p>Ciudad</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.grupo",
            "description": "<p>Grupo</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.profesion",
            "description": "<p>Profesion</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "usuario.perfil.descripcion",
            "description": "<p>Descripcion</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"message\": \"OK\",\n    \"usuario\": {\n        \"id\": 5,\n        \"nombre\": \"NOMBRE\",\n        \"apellido\": \"APELLIDO\",\n        \"email\": \"cuenta@correo.com\",\n        \"password\": \"$2y$10$kRdXInI/iJGOZANl3L9GRumqfRojFKVNjvMOR7if7NYIiSyS7gxA.\",\n        \"fecha_nacimiento\": \"1980-12-31\",\n        \"username\": null,\n        \"last_login\": null,\n        \"usuario\": 1,\n        \"productora_activa\": \"0\",\n        \"rol_activo\": \"usuario\",\n        \"recordarme\": 0,\n        \"avatar\": null,\n        \"avatar_original\": null,\n        \"social\": 0,\n        \"status\": \"activo\",\n        \"activado\": 0,\n        \"nombre_contacto\": null,\n        \"prefijo_contacto\": null,\n        \"telefono_contacto\": null,\n        \"derivacion_contacto\": null,\n        \"hash_activacion\": \"ffcc3171108863b41a0f8e1e8487bbe3365c7704\",\n        \"deleted_at\": null,\n        \"created_at\": \"2016-10-19 18:50:15\",\n        \"updated_at\": \"2016-10-19 18:50:15\",\n        \"perfil\": [\n            {\n                \"usuario_id\": 5,\n                \"proveedor\": \"psp\",\n                \"usuario_social_id\": null,\n                \"usuario_social_attributes\": null,\n                \"identificacion\": null,\n                \"foto\": \"unknown-person.jpg\",\n                \"foto_original\": \"unknown-person.jpg\",\n                \"genero\": \"female\",\n                \"prefijo\": null,\n                \"telefono\": null,\n                \"pais\": null,\n                \"provincia\": null,\n                \"ciudad\": null,\n                \"grupo\": null,\n                \"profesion\": null,\n                \"descripcion\": null\n            }\n        ]\n    }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: &quot;mensaje&quot; }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Errors\n{\n   \"errors\": [\"Listado de Errores\"]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Auth/RegisterController.php",
    "groupTitle": "Autenticacion"
  },
  {
    "type": "post",
    "url": "/password/reset",
    "title": "Reseteo de contraseña",
    "version": "1.0.0",
    "name": "resetPassword",
    "description": "<p>Proceso para realizar el reseteo de una contraseña Este proceso es posterior a la solicitud de reseteo de contraseña. El usuario al solicitar el reseteo, recibe un email con un link. El sistema adjunta este link un token. Para el procesamiento efectivo, se debe suministrar este token como un elemento de formulario tipo Hidden</p>",
    "group": "Autenticacion",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\":  \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token enviado al usuario via email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Correo del Usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Contraseña</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>Confirmacion de Contraseña</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"token\": \"7cef60ef22fd2780e9c4d1d1c5c8df8c4a44e6f5bbc0ef152c4958f2d0e22f64\",\n  \"email\": \"correo@dominio.com\",\n  \"password\": \"123456789\",\n  \"password_confirmation\": \"123456789\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "message",
            "description": "<p>Mensaje del sistema indicando la que el proceso se proceso sin problemas</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\": \"OK\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: &quot;mensaje&quot; }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Error\n{\n   \"error\": [\"descripcion del error\"]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Auth/ResetPasswordController.php",
    "groupTitle": "Autenticacion"
  },
  {
    "type": "post",
    "url": "/password/email",
    "title": "Solicitud de Reseteo de contraseña",
    "version": "1.0.0",
    "name": "sendEmailResetPassword",
    "description": "<p>Proceso para solicitar el reseteo de una contraseña. Al indicar el email, el sistema envia un email al solicitante del reseteo, siempre y cuando sea un usuario registrado. En este email, se adjunto un link para finalizar el proceso de reseteo. El paso posterior a este proceso esta indicado en el apendice RESETEO DE CONTRASEÑA, previsto en esta documentacion</p>",
    "group": "Autenticacion",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\":  \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Correo del Usuario</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"email\": \"correo@dominio.com\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "message",
            "description": "<p>Mensaje del sistema indicando la que el proceso se proceso sin problemas</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\": \"OK\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: &quot;mensaje&quot; }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Error\n{\n   \"error\": [\"descripcion del error\"]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Auth/ForgotPasswordController.php",
    "groupTitle": "Autenticacion"
  },
  {
    "type": "delete",
    "url": "/api/v1/productora/categorias/{categoria_id}",
    "title": "Elimina un registro de categorias",
    "version": "1.0.0",
    "name": "EliminarCategoria",
    "group": "Categoria",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "categoria_id",
            "description": "<p>Id Categoria</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Categoria Eliminada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Delete\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CategoriasController.php",
    "groupTitle": "Categoria"
  },
  {
    "type": "put",
    "url": "/api/v1/productora/categorias/{categoria_id}",
    "title": "Actualiza un registro de categorias",
    "version": "1.0.0",
    "name": "ModificarCategoria",
    "group": "Categoria",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "categoria_id",
            "description": "<p>Id Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "edad_inicio",
            "description": "<p>Edad de Inicio Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "edad_final",
            "description": "<p>Edad de Final Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "texto_informativo",
            "description": "<p>Texto Informativo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "tipo",
            "description": "<p>Tipo Categoria</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"productora_id\": 1,\n    \"nombre\": \"distancia1\",\n    \"edad_inicio\": 15,\n    \"edad_final\": 25,\n    \"texto_informativo\": \"texto\",\n    \"tipo\": \"general\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Categoria Modificada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"data\": false\n   \"errors\": \"CategoriaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CategoriasController.php",
    "groupTitle": "Categoria"
  },
  {
    "type": "get",
    "url": "/api/v1/productora/categorias/{categoria_id}",
    "title": "Muestra un registro de categorias",
    "version": "1.0.0",
    "name": "MostrarCategoria",
    "group": "Categoria",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "categoria_id",
            "description": "<p>Id Categoria</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Categoria",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n\"data\": {\n  \"id\": 6,\n  \"productora_id\": 1,\n  \"nombre\": \"distancia1\",\n  \"edad_inicio\": 15,\n  \"edad_final\": 25,\n  \"texto_informativo\": \"texto\",\n  \"tipo\": \"general\",\n  \"deleted_at\": null,\n  \"created_at\": \"2016-10-19 00:34:53\",\n  \"updated_at\": \"2016-10-19 00:34:53\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CategoriasController.php",
    "groupTitle": "Categoria"
  },
  {
    "type": "get",
    "url": "/api/v1/productora/categorias",
    "title": "Muestra varios registros de categorias",
    "version": "1.0.0",
    "name": "MostrarCategorias",
    "group": "Categoria",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Categorias.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n   \"data\": [\n     {\n      \"id\": 6,\n      \"productora_id\": 1,\n      \"nombre\": \"distancia1\",\n      \"edad_inicio\": 15,\n      \"edad_final\": 25,\n      \"texto_informativo\": \"texto\",\n      \"tipo\": \"general\",\n      \"deleted_at\": null,\n      \"created_at\": \"2016-10-19 00:34:53\",\n      \"updated_at\": \"2016-10-19 00:34:53\"\n     },\n     ...\n ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CategoriasController.php",
    "groupTitle": "Categoria"
  },
  {
    "type": "post",
    "url": "/api/v1/productora/categorias",
    "title": "Crea un nuevo registro de categorias",
    "version": "1.0.0",
    "name": "crearCategoria",
    "group": "Categoria",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "edad_inicio",
            "description": "<p>Edad de Inicio Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "edad_final",
            "description": "<p>Edad de Final Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "texto_informativo",
            "description": "<p>Texto Informativo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "tipo",
            "description": "<p>Tipo Categoria</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"productora_id\": 1,\n    \"nombre\": \"distancia1\",\n    \"edad_inicio\": 15,\n    \"edad_final\": 25,\n    \"texto_informativo\": \"texto\",\n    \"tipo\": \"general\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "Id",
            "description": "<p>Categoria Creada</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\": 5\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"errors\": \"CategoriaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CategoriasController.php",
    "groupTitle": "Categoria"
  },
  {
    "type": "post",
    "url": "/api/v1/productora/grupo-categorias",
    "title": "Crea un nuevo registro de grupo de categorias",
    "version": "1.0.0",
    "name": "crearGrupoCategoria",
    "group": "Categoria",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "categorias",
            "description": "<p>Ids Categorias Hijas</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "grupo_id",
            "description": "<p>Id Grupo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "edad_inicio",
            "description": "<p>Edad de Inicio Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "edad_final",
            "description": "<p>Edad de Final Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "texto_informativo",
            "description": "<p>Texto Informativo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "tipo",
            "description": "<p>Tipo Categoria</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"categorias\":[\n        1,2\n    ],\n    \"productora_id\": 1,\n    \"grupo_id\": null,\n    \"nombre\": \"distancia1\",\n    \"edad_inicio\": 15,\n    \"edad_final\": 25,\n    \"texto_informativo\": \"texto\",\n    \"tipo\": \"general\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Grupo Creado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"errors\": \"GrupoCategoriaNotSave\"\n   \"data\" : false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CategoriasController.php",
    "groupTitle": "Categoria"
  },
  {
    "type": "delete",
    "url": "/api/v1/productora/grupo-categorias/{grupo_id} Elimina un registro de",
    "title": "grupo de categorias",
    "version": "1.0.0",
    "name": "eliminarGrupoCategoria",
    "group": "Categoria",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "grupo_id",
            "description": "<p>Id Grupo Categoria</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Grupo Categoria Eliminado.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Delete\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CategoriasController.php",
    "groupTitle": "Categoria"
  },
  {
    "type": "put",
    "url": "/api/v1/productora/grupo-categorias/{grupo_id} Actualiza un registro de",
    "title": "grupos categorias",
    "version": "1.0.0",
    "name": "modificarGrupoCategoria",
    "group": "Categoria",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "categorias",
            "description": "<p>Ids Categorias Hijas</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "grupo_id",
            "description": "<p>Id Grupo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "edad_inicio",
            "description": "<p>Edad de Inicio Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "edad_final",
            "description": "<p>Edad de Final Categoria</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "texto_informativo",
            "description": "<p>Texto Informativo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "tipo",
            "description": "<p>Tipo Categoria</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n   \"categorias\":[\n        1,2\n    ],\n    \"productora_id\": 1,\n    \"grupo_id\": null,\n    \"nombre\": \"distancia1\",\n    \"edad_inicio\": 15,\n    \"edad_final\": 25,\n    \"texto_informativo\": \"texto\",\n    \"tipo\": \"general\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Grupo Categoria Modificado.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"data\": false\n   \"errors\": \"GrupoCategoriaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CategoriasController.php",
    "groupTitle": "Categoria"
  },
  {
    "type": "get",
    "url": "/api/v1/productora/grupo-categorias/{grupo_id}",
    "title": "Muestra un registro de grupo categorias",
    "version": "1.0.0",
    "name": "mostrarGrupoCategoria",
    "group": "Categoria",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "grupo_id",
            "description": "<p>Id Grupo Categoria</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Categoria",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n\"data\": {\n  \"id\": 6,\n  \"grupo_id\": 6,\n  \"productora_id\": 1,\n  \"nombre\": \"distancia1\",\n  \"edad_inicio\": 15,\n  \"edad_final\": 25,\n  \"texto_informativo\": \"texto\",\n  \"tipo\": \"general\",\n  \"deleted_at\": null,\n  \"created_at\": \"2016-10-19 00:34:53\",\n  \"updated_at\": \"2016-10-19 00:34:53\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CategoriasController.php",
    "groupTitle": "Categoria"
  },
  {
    "type": "get",
    "url": "/api/v1/productora/grupo-categorias",
    "title": "Muestra varios registros de grupos categorias",
    "version": "1.0.0",
    "name": "mostrarTodosGrupoCategoria",
    "group": "Categoria",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Categorias.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n   \"data\": [\n     {\n      \"id\": 6,\n      \"grupo_id\": 6,\n      \"productora_id\": 1,\n      \"nombre\": \"distancia1\",\n      \"edad_inicio\": 15,\n      \"edad_final\": 25,\n      \"texto_informativo\": \"texto\",\n      \"tipo\": \"general\",\n      \"deleted_at\": null,\n      \"created_at\": \"2016-10-19 00:34:53\",\n      \"updated_at\": \"2016-10-19 00:34:53\"\n     },\n     ...\n ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CategoriasController.php",
    "groupTitle": "Categoria"
  },
  {
    "type": "get",
    "url": "/{role}/codigos/{codigo_id}/estatus/{estatus}",
    "title": "Cambio de estatus de un codigo",
    "version": "1.0.0",
    "name": "cambiarEstatus",
    "description": "<p>Realiza el cambio de estatus de un determinado codigo. Si se recibe el <code>estatus</code> con valor activo, se cambia a inactivo o viceversa</p>",
    "group": "Codigos",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token generado por el sistema al momento de la autenticacion</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "data",
            "description": "<p>Boolean que indica el resultado de la operacion. True: Exitoso. False: Error</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\":   true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "data",
            "description": "<p>Retorna <code>false</code> si las credenciales suministradas no son válidas o si se encontraron errores procesando la peticion</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 NotProcess\n{\n    \"data\":   false,\n    \"errors\": [\"Listado de errores\"]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CodigoController.php",
    "groupTitle": "Codigos"
  },
  {
    "type": "delete",
    "url": "/{role}/codigos/{codigo_id}",
    "title": "Eliminacion logica de un Codigo",
    "version": "1.0.0",
    "name": "destroyCodigo",
    "description": "<p>Elimina de forma logica un codigo. Se eliminan tambien (de forma definitiva) las asociaciones con competencias</p>",
    "group": "Codigos",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token generado por el sistema al momento de la autenticacion</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "data",
            "description": "<p>Boolean que indica el resultado de la operacion. True: Exitoso. False: Error</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\":   true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "data",
            "description": "<p>Retorna <code>false</code> si las credenciales suministradas no son válidas o si se encontraron errores procesando la peticion</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 NotProcess\n{\n    \"data\":   false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CodigoController.php",
    "groupTitle": "Codigos"
  },
  {
    "type": "get",
    "url": "/{role}/codigos",
    "title": "Listado de Codigos",
    "version": "1.0.0",
    "name": "listaCodigo",
    "description": "<p>Muestra una lista de Codigos registrados. Si la consulta la ejecuta una administradora, los codigos consultados seran aquellos que pertenezcan a las productoras de esa administradora. Si la consulta la ejecuta una productora, los codigos consultados seran solamente los de la productora. Si la consulta la ejecuta un administrador del sistema, devuelve todos los codigos</p>",
    "group": "Codigos",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token generado por el sistema al momento de la autenticacion</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n      \"token\":             \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Array",
            "optional": false,
            "field": "data",
            "description": "<p>Contiene objetos JSON con informacion de codigos</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "data.id",
            "description": "<p>ID del codigo</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "data.codigo",
            "description": "<p>Identificador</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "data.usuario",
            "description": "<p>Nombre del Usuario que administra a la productora que registro el codigo</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "data.productora_id",
            "description": "<p>ID de la Productora dueña del codigo</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "data.productora",
            "description": "<p>Nombre de la productora que registro el codigo</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "data.tipo",
            "description": "<p>Tipo de descuento (voucher, descuento, free, notacredito, team)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "data.estatus",
            "description": "<p>Estatus (activo, inactivo, utilizado)</p>"
          },
          {
            "group": "200",
            "type": "Date",
            "optional": false,
            "field": "data.fecha_inicio",
            "description": "<p>Fecha de inicio (entrada en vigencia) del codigo</p>"
          },
          {
            "group": "200",
            "type": "Date",
            "optional": false,
            "field": "data.fecha_vencimiento",
            "description": "<p>Fecha de vencimiento del codigo</p>"
          },
          {
            "group": "200",
            "type": "Double",
            "optional": false,
            "field": "data.porcentaje_descuento",
            "description": "<p>Porcentaje de Descuento</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "data.limite_uso_cupon",
            "description": "<p>Valor maximo de usos del cupon (en toda una competencia)</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "data.limite_uso_usuario",
            "description": "<p>Valor maximo de usos de un cupon por parte de un usuario</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "data.usos",
            "description": "<p>Total de usos del cupon</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"codigo\": \"3229775082\",\n            \"usuario\": \"Soporte PSP\",\n            \"productora_id\": 12,\n            \"productora\": \"Hane, Streich and Botsford\",\n            \"tipo\": \"notacredito\",\n            \"estatus\": \"activo\",\n            \"fecha_inicio\": \"2014-10-01\",\n            \"fecha_vencimiento\": \"2016-12-25\",\n            \"porcentaje_descuento\": \"27.27\",\n            \"limite_uso_cupon\": 13,\n            \"limite_uso_usuario\": 2,\n            \"usos\": 0\n        },\n        .\n        .\n        .\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "String",
            "description": "<p>Devuelve un mensaje error indicando falta de permisologias</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 NotResult\n{\n    \"errors\": \"Usted no tiene el role necesario para acceder al módulo solicitado\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CodigoController.php",
    "groupTitle": "Codigos"
  },
  {
    "type": "get",
    "url": "/{role}/codigos/search",
    "title": "Busqueda avanzada de codigos",
    "version": "1.0.0",
    "name": "searchCodigo",
    "description": "<p>Ejecuta una consulta de codigos, dependiendo de los parametros que se suministren. Si la consulta la ejecuta una administradora, los codigos consultados seran aquellos que pertenezcan a las productoras de esa administradora. Si la consulta la ejecuta una productora, los codigos consultados seran solamente los de la productora. Si la consulta la ejecuta un administrador del sistema, devuelve todos los codigos</p>",
    "group": "Codigos",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token generado por el sistema al momento de la autenticacion</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "codigo",
            "description": "<p>Codigo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "tipo",
            "description": "<p>Tipo de Codigo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "fecha_inicio",
            "description": "<p>Fecha de Inicio (entrada en vigencia) del codigo. Formato yyyy-mm-dd</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "fecha_vencimiento",
            "description": "<p>Fecha de Vencimiento del codigo. Formato yyyy-mm-dd</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "estatus",
            "description": "<p>Estatus del codigo. (activo, inactivo, utilizado)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n      \"token\":             \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI\",\n      \"codigo\"             \"123456\",\n      \"tipo\":              \"descuento\",\n      \"fecha_inicio\":      \"2000-01-01\",\n      \"fecha_vencimiento\": \"2000-12-31\",\n      \"estatus\":           \"activo\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "JSON",
            "optional": false,
            "field": "data",
            "description": "<p>JSON con informacion de codigos</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    [\n        {\n            \"id\": 1,\n            \"codigo\": \"3229775082\",\n            \"usuario\": \"Soporte PSP\",\n            \"productora_id\": 12,\n            \"productora\": \"Hane, Streich and Botsford\",\n            \"tipo\": \"notacredito\",\n            \"estatus\": \"activo\",\n            \"fecha_inicio\": \"2014-10-01\",\n            \"fecha_vencimiento\": \"2016-12-25\",\n            \"porcentaje_descuento\": \"27.27\",\n            \"limite_uso_cupon\": 13,\n            \"limite_uso_usuario\": 2,\n            \"usos\": 0\n        },\n        .\n        .\n        .\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "Array",
            "description": "<p>Retorna un Array vacio</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 NotResult\n{\n    []\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CodigoController.php",
    "groupTitle": "Codigos"
  },
  {
    "type": "get",
    "url": "/{role}/codigos/{codigo_id}",
    "title": "Datos de un Codigo",
    "version": "1.0.0",
    "name": "showCodigo",
    "description": "<p>Realiza la consulta de datos asociados a un Codigo</p>",
    "group": "Codigos",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token generado por el sistema al momento de la autenticacion</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3NjkwMzEyMSwiZXhwI\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Array",
            "optional": false,
            "field": "data",
            "description": "<p>Contiene objetos JSON con informacion de codigos</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "data.usuario_id",
            "description": "<p>ID de Usuario que tipo Administradora</p>"
          },
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "data.productora_id",
            "description": "<p>ID de la Productora dueña del codigo</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "data.codigo",
            "description": "<p>Identificador</p>"
          },
          {
            "group": "200",
            "type": "Date",
            "optional": false,
            "field": "data.fecha_inicio",
            "description": "<p>Fecha de inicio (entrada en vigencia) del codigo</p>"
          },
          {
            "group": "200",
            "type": "Date",
            "optional": false,
            "field": "data.fecha_vencimiento",
            "description": "<p>Fecha de vencimiento del codigo</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "data.tipo",
            "description": "<p>Tipo de descuento (voucher, descuento, free, notacredito, team)</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "data.estatus",
            "description": "<p>Estatus (activo, inactivo, utilizado)</p>"
          },
          {
            "group": "200",
            "type": "Double",
            "optional": false,
            "field": "data.porcentaje_descuento",
            "description": "<p>Porcentaje de Descuento</p>"
          },
          {
            "group": "200",
            "type": "Date",
            "optional": false,
            "field": "data.deleted_at",
            "description": "<p>Fecha de eliminacion logica</p>"
          },
          {
            "group": "200",
            "type": "Date",
            "optional": false,
            "field": "data.created_at",
            "description": "<p>Fecha de registro</p>"
          },
          {
            "group": "200",
            "type": "Date",
            "optional": false,
            "field": "data.updated_at",
            "description": "<p>Ultima fecha de actualizacion</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": [\n        {\n            \"id\": 1,\n            \"usuario_id\": 7,\n            \"productora_id\": 12,\n            \"codigo\": \"3229775082\",\n            \"fecha_inicio\": \"2014-10-01\",\n            \"fecha_vencimiento\": \"2016-12-25\",\n            \"limite_uso_cupon\": 13,\n            \"limite_uso_usuario\": 2,\n            \"tipo\": \"notacredito\",\n            \"estatus\": \"activo\",\n            \"porcentaje_descuento\": \"27.27\",\n            \"deleted_at\": null,\n            \"created_at\": \"2005-09-21 05:03:56\",\n            \"updated_at\": \"1972-12-07 02:19:21\"\n        },\n        .\n        .\n        .\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "data",
            "description": "<p>Retorna <code>false</code> si no se encontro el codigo solicitado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 NotProcess\n{\n    \"data\":      false,\n    \"errors\":    \"No se encontraron los valores solicitados\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CodigoController.php",
    "groupTitle": "Codigos"
  },
  {
    "type": "post",
    "url": "/{role}/codigos",
    "title": "Registro de un nuevo Codigo",
    "version": "1.0.0",
    "name": "storeCodigo",
    "description": "<p>Registro de un nuevo Codigo. La clase RulesCodigo hace las validaciones de entrada Este proceso varia segun el role que se suministre en la URL. su la ruta recibida es api/v1/system/codigos, el codigo se procesara como un usuario administrador. Si por el contrario, el <code>{role}</code> es administradora, el registro se puede aplicar para todas las productoras de esa administradora</p>",
    "group": "Codigos",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Tipo de Autorizacion. Se debe indicar la palabra Bearer con el valor del token generado por el sistema. Sin esto, la peticion no se procesa</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\":  \"application/json\"\n \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3ODExMzc5NCwiZXhwIjoxNDc4MTE3Mzk0LCJuYmYiOjE0NzgxMTM3OTQsImp0aSI6IjYxZDM3ZDBjMzE3MWE0NjZmMjM3YmVjNzdiMGMwYmFmIn0.TmoorRLZBiN95XuBYmXucRoPfn5tA6VpjHSD4MmHJHM\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "codigo",
            "description": "<p>Cadena que identifica al Codigo en el sistema</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fecha_inicio",
            "description": "<p>Fecha de inicio (validez) del codigo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fecha_vencimiento",
            "description": "<p>Fecha de vencimiento del codigo</p>"
          },
          {
            "group": "Parameter",
            "type": "Double",
            "optional": false,
            "field": "porcentaje_descuento",
            "description": "<p>Porcentaje de descuento. Si tipo es 'free', el sistema le asigna 100 al porcentaje</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "competencia",
            "description": "<p>Id de la competencia. Si es -1, se asigna a todas las competencias de la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora",
            "description": "<p>Id de la productora. Si es -1, se asigna a todas las productoras de la administradora</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "limite_uso_cupon",
            "description": "<p>Limite establecido para que un codigo sea usado</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "limite_uso_usuario",
            "description": "<p>Limite establecido para que un codigo sea usado por un usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "tipo",
            "description": "<p>Tipo de Descuento. Valores permitidos: voucher, descuento, free, notacredito, team. Por default es 'descuento'</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "estatus",
            "description": "<p>Valor del Checkbox para recordar al usuario</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"codigo\": \"1234561239\",\n    \"fecha_inicio\": \"01/01/2016\",\n    \"fecha_vencimiento\": \"01/12/2016\",\n    \"porcentaje_descuento\": 20,\n    \"competencia\": -1,\n    \"productora\": -1,\n    \"limite_uso_cupon\": 10,\n    \"limite_uso_usuario\": 10,\n    \"tipo\" : \"descuento\",\n    \"estatus\" : \"activo\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "data",
            "description": "<p>Booleano que indica el resultado de la operacion. True: Exitoso. False: Error</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\":   true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "data",
            "description": "<p>Retorna <code>false</code> si las credenciales suministradas no son válidas</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 NotProcess\n{\n    \"data\":   false\n    \"errors\": [\"Listado de errores\"]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CodigoController.php",
    "groupTitle": "Codigos"
  },
  {
    "type": "put",
    "url": "/{role}/codigos/{codigo_id}",
    "title": "Actualizacion de un Codigo",
    "version": "1.0.0",
    "name": "updateCodigo",
    "description": "<p>Actualizacion de un Codigo. La clase RulesCodigo hace las validaciones de entrada Este proceso varia segun el role que se suministre en la URL. su la ruta recibida es api/v1/system/codigos, el codigo se procesara como un usuario administrador. Si por el contrario, el <code>{role}</code> es administradora, el registro se puede aplicar para todas las productoras de esa administradora</p>",
    "group": "Codigos",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Tipo de Autorizacion. Se debe indicar la palabra Bearer con el valor del token generado por el sistema. Sin esto, la peticion no se procesa</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\":  \"application/json\"\n \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL3BzcC5hcHBcL2FwaVwvdjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ3ODExMzc5NCwiZXhwIjoxNDc4MTE3Mzk0LCJuYmYiOjE0NzgxMTM3OTQsImp0aSI6IjYxZDM3ZDBjMzE3MWE0NjZmMjM3YmVjNzdiMGMwYmFmIn0.TmoorRLZBiN95XuBYmXucRoPfn5tA6VpjHSD4MmHJHM\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "codigo",
            "description": "<p>Cadena que identifica al Codigo en el sistema</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fecha_inicio",
            "description": "<p>Fecha de inicio (validez) del codigo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fecha_vencimiento",
            "description": "<p>Fecha de vencimiento del codigo</p>"
          },
          {
            "group": "Parameter",
            "type": "Double",
            "optional": false,
            "field": "porcentaje_descuento",
            "description": "<p>Porcentaje de descuento. Si tipo es 'free', el sistema le asigna 100 al porcentaje</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "competencia",
            "description": "<p>Id de la competencia. Si es -1, se asigna a todas las competencias de la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora",
            "description": "<p>Id de la productora. Si es -1, se asigna a todas las productoras de la administradora</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "limite_uso_cupon",
            "description": "<p>Limite establecido para que un codigo sea usado</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "limite_uso_usuario",
            "description": "<p>Limite establecido para que un codigo sea usado por un usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "tipo",
            "description": "<p>Tipo de Descuento. Valores permitidos: voucher, descuento, free, notacredito, team. Por default es 'descuento'</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "estatus",
            "description": "<p>Valor del Checkbox para recordar al usuario</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"codigo\": \"1234561239\",\n    \"fecha_inicio\": \"01/01/2016\",\n    \"fecha_vencimiento\": \"01/12/2016\",\n    \"porcentaje_descuento\": 20,\n    \"competencia\": -1,\n    \"productora\": -1,\n    \"limite_uso_cupon\": 10,\n    \"limite_uso_usuario\": 10,\n    \"tipo\" : \"descuento\",\n    \"estatus\" : \"activo\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "data",
            "description": "<p>Booleano que indica el resultado de la operacion. True: Exitoso. False: Error</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\":   true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "optional": false,
            "field": "data",
            "description": "<p>Retorna <code>false</code> si las credenciales suministradas no son válidas o si se encontraron errores procesando la peticion</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 NotProcess\n{\n    \"data\":   false,\n    \"errors\": [\"Listado de errores\"]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CodigoController.php",
    "groupTitle": "Codigos"
  },
  {
    "type": "delete",
    "url": "/api/v1/Disciplinas/{disciplina_id}",
    "title": "Elimina un registro de Disciplinas",
    "version": "1.0.0",
    "name": "EliminarDisciplina",
    "group": "Disciplina",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "Disciplina_id",
            "description": "<p>Id de Disciplina</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Disciplina Eliminada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Delete\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DisciplinasController.php",
    "groupTitle": "Disciplina"
  },
  {
    "type": "put",
    "url": "/api/v1/Disciplinas/{disciplina_id}",
    "title": "Actualiza un registro de Disciplinas",
    "version": "1.0.0",
    "name": "ModificarDisciplina",
    "group": "Disciplina",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "fecha_id",
            "description": "<p>Id de fecha</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre de Disciplina</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Estatus de Disciplina</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"fecha_id\": 2,\n  \"nombre\": \"Disciplina2\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Disciplina Modificada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"data\": false\n   \"errors\": \"DisciplinaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DisciplinasController.php",
    "groupTitle": "Disciplina"
  },
  {
    "type": "put",
    "url": "/api/v1/Disciplinas/{disciplina_id}",
    "title": "Actualiza un registro de Disciplinas",
    "version": "1.0.0",
    "name": "ModificarDisciplina",
    "group": "Disciplina",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "fecha_id",
            "description": "<p>Id de fecha</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre de Disciplina</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Estatus de Disciplina</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"fecha_id\": 2,\n  \"nombre\": \"Disciplina2\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Disciplina Modificada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"data\": false\n   \"errors\": \"DisciplinaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DisciplinasController.php",
    "groupTitle": "Disciplina"
  },
  {
    "type": "get",
    "url": "/api/v1/Disciplinas/{disciplina_id}",
    "title": "Muestra un registro de Disciplinas",
    "version": "1.0.0",
    "name": "MostrarDisciplina",
    "group": "Disciplina",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "Disciplina_id",
            "description": "<p>Id de Disciplina</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Disciplina.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n\"data\": {\n  \"id\": 6,\n  \"subdisciplina\": 2,\n  \"nombre\": \"Disciplinamodificada\",\n  \"deleted_at\": null,\n  \"created_at\": \"2016-10-26 20:48:44\",\n  \"updated_at\": \"2016-10-26 21:11:20\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DisciplinasController.php",
    "groupTitle": "Disciplina"
  },
  {
    "type": "get",
    "url": "/api/v1/Disciplinas/",
    "title": "Muestra varios registros de Disciplinas",
    "version": "1.0.0",
    "name": "MostrarDisciplinas",
    "group": "Disciplina",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Disciplinas.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n   \"data\": [\n       {\n         \"id\": 1,\n         \"fecha_id\": 29,\n         \"nombre\": \"recusandae\",\n         \"status\": \"activo\",\n         \"deleted_at\": null,\n         \"created_at\": \"2016-10-26 10:31:41\",\n         \"updated_at\": \"2016-10-26 09:01:56\"\n       },\n     ...\n ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DisciplinasController.php",
    "groupTitle": "Disciplina"
  },
  {
    "type": "delete",
    "url": "/api/v1/Disciplinas/all",
    "title": "Muestra las disciplinas con sus subdisciplinas",
    "version": "1.0.0",
    "name": "showSubDisciplinasByDisciplinas",
    "group": "Disciplina_",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": [\n                {\n                \"nombre\": \"autem\",\n                \"id\": 1,\n                \"subdisciplinas\": []\n                }\n        ];\n\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DisciplinasController.php",
    "groupTitle": "Disciplina_"
  },
  {
    "type": "post",
    "url": "/api/v1/Disciplinas",
    "title": "Crea un nuevo registro de Disciplinas",
    "version": "1.0.0",
    "name": "crearDisciplina",
    "group": "Disciplina",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre de Disciplina</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"nombre\": \"Disciplina1\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>Id Disciplina creada</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\": 1\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 DisciplinaNotSave\n{\n   \"errors\": \"DisciplinaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DisciplinasController.php",
    "groupTitle": "Disciplina"
  },
  {
    "type": "post",
    "url": "/api/v1/Disciplinas",
    "title": "Crea un nuevo registro de Disciplinas",
    "version": "1.0.0",
    "name": "crearSubDisciplina",
    "group": "Disciplina",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre de Disciplina</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"subdisciplina\": 1,\n  \"nombre\": \"Disciplina1\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>Id Disciplina creada</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\": 1\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 DisciplinaNotSave\n{\n   \"errors\": \"DisciplinaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DisciplinasController.php",
    "groupTitle": "Disciplina"
  },
  {
    "type": "delete",
    "url": "/api/v1/productora/distancias/{distancia_id}",
    "title": "Elimina un registro de distancias",
    "version": "1.0.0",
    "name": "EliminarDistancia",
    "group": "Distancia",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "distancia_id",
            "description": "<p>Id de distancia</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Distancia Eliminada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Delete\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DistanciasController.php",
    "groupTitle": "Distancia"
  },
  {
    "type": "put",
    "url": "/api/v1/productora/distancias/{distancia_id}",
    "title": "Actualiza un registro de distancias",
    "version": "1.0.0",
    "name": "ModificarDistancia",
    "group": "Distancia",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "fecha_id",
            "description": "<p>Id de fecha</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre de distancia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Estatus de distancia</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"fecha_id\": 2,\n  \"nombre\": \"distancia2\",\n  \"status\": \"inactivo\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Distancia Modificada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"data\": false\n   \"errors\": \"DistanciaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DistanciasController.php",
    "groupTitle": "Distancia"
  },
  {
    "type": "get",
    "url": "/api/v1/productora/distancias/{distancia_id}",
    "title": "Muestra un registro de distancias",
    "version": "1.0.0",
    "name": "MostrarDistancia",
    "group": "Distancia",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "distancia_id",
            "description": "<p>Id de distancia</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Distancia.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n\"data\": {\n  \"id\": 6,\n  \"fecha_id\": 2,\n  \"nombre\": \"distanciamodificada\",\n  \"status\": \"inactivo\",\n  \"deleted_at\": null,\n  \"created_at\": \"2016-10-17 20:48:44\",\n  \"updated_at\": \"2016-10-17 21:11:20\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DistanciasController.php",
    "groupTitle": "Distancia"
  },
  {
    "type": "get",
    "url": "/api/v1/productora/distancias/",
    "title": "Muestra varios registros de distancias",
    "version": "1.0.0",
    "name": "MostrarDistancias",
    "group": "Distancia",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Distancias.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n   \"data\": [\n       {\n         \"id\": 1,\n         \"fecha_id\": 29,\n         \"nombre\": \"recusandae\",\n         \"status\": \"activo\",\n         \"deleted_at\": null,\n         \"created_at\": \"1970-06-19 10:31:41\",\n         \"updated_at\": \"1996-09-14 09:01:56\"\n       },\n     ...\n ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DistanciasController.php",
    "groupTitle": "Distancia"
  },
  {
    "type": "post",
    "url": "/api/v1/productora/distancias",
    "title": "Crea un nuevo registro de distancias",
    "version": "1.0.0",
    "name": "crearDistancia",
    "group": "Distancia",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "fecha_id",
            "description": "<p>Id de fecha</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre de distancia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Estatus de distancia</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"fecha_id\": 1,\n  \"nombre\": \"distancia1\",\n  \"status\": \"activo\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>Id distancia creada</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\": 6\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 DistanciaNotSave\n{\n   \"errors\": \"DistanciaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/DistanciasController.php",
    "groupTitle": "Distancia"
  },
  {
    "type": "put",
    "url": "/api/v1/administradora/premios/{premio_id}",
    "title": "Actualiza un registro de premios",
    "version": "1.0.0",
    "name": "ModificarPremio",
    "group": "Premio",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "premio_id",
            "description": "<p>Id Premio</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "competencia_id",
            "description": "<p>Id Competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "foto_id",
            "description": "<p>Id Foto</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "fecha",
            "description": "<p>Fecha</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre del premio</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "descripcion",
            "description": "<p>Descripcion</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "puesto",
            "description": "<p>Puesto</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "monto",
            "description": "<p>Monto</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     \"productora_id\": 1,\n     \"competencia_id\": 1,\n     \"foto_id\": 1,\n     \"fecha\": \"2007-12-25\",\n     \"nombre\": \"premio1\",\n     \"descripcion\": \"primer lugar\",\n     \"puesto\": \"primero\",\n     \"monto\": 450.36,\n }",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Premio Modificada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"data\": false\n   \"errors\": \"PremioNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/PremiosController.php",
    "groupTitle": "Premio"
  },
  {
    "type": "get",
    "url": "/api/v1/administradora/premios/{premio_id}",
    "title": "Muestra un registro de premios",
    "version": "1.0.0",
    "name": "MostrarPremio",
    "group": "Premio",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "premio_id",
            "description": "<p>Id Premio</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Premio",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n   \"data\": {\n      \"id\": 1,\n      \"productora_id\": 1,\n      \"competencia_id\": 8,\n      \"foto_id\": 9,\n      \"fecha\": \"2007-03-05\",\n      \"nombre\": \"in\",\n      \"descripcion\": \"Id beatae doloribus sit rerum iusto eius vitae distinctio, \n      \"puesto\": \"6\",\n      \"monto\": 238.55,\n      \"deleted_at\": null,\n      \"created_at\": \"2014-04-28 12:46:16\",\n      \"updated_at\": \"2007-04-13 16:39:31\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/PremiosController.php",
    "groupTitle": "Premio"
  },
  {
    "type": "get",
    "url": "/api/v1/administradora/premios",
    "title": "Muestra varios registros de premios",
    "version": "1.0.0",
    "name": "MostrarPremios",
    "group": "Premio",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Premios.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n   \"data\": [\n    {\n      \"id\": 1,\n      \"productora_id\": 1,\n      \"competencia_id\": 8,\n      \"foto_id\": 9,\n      \"fecha\": \"2007-03-05\",\n      \"nombre\": \"in\",\n      \"descripcion\": \"Id beatae doloribus sit rerum iusto eius vitae distinctio, \n      \"puesto\": \"6\",\n      \"monto\": 238.55,\n      \"deleted_at\": null,\n      \"created_at\": \"2014-04-28 12:46:16\",\n      \"updated_at\": \"2007-04-13 16:39:31\"\n    },\n     ...\n ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/PremiosController.php",
    "groupTitle": "Premio"
  },
  {
    "type": "delete",
    "url": "/api/v1/administradora/premios/{premio_id} Elimina un",
    "title": "registro de premios",
    "version": "1.0.0",
    "name": "EliminarPremio",
    "group": "Premios",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "premio_id",
            "description": "<p>Id Premio</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Premio Eliminada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Delete\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/PremiosController.php",
    "groupTitle": "Premios"
  },
  {
    "type": "post",
    "url": "/api/v1/administradora/premios/fotos Crea un nuevo registro de",
    "title": "fotos y asocia la foto a un premio existente",
    "version": "1.0.0",
    "name": "agregarFoto",
    "group": "Premios",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"multipart/form-data\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "premio_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "Image",
            "optional": false,
            "field": "foto",
            "description": "<p>Foto</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": " \npremio_id = 1\nfoto = imagen.jpg  || imagen.png || imagen.jpeg",
          "type": "form-data"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "Foto",
            "description": "<p>ID.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\": 3\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"errors\": \"FotoNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/PremiosController.php",
    "groupTitle": "Premios"
  },
  {
    "type": "post",
    "url": "/api/v1/administradora/premios Crea un nuevo registro de",
    "title": "premios",
    "version": "1.0.0",
    "name": "crearPremio",
    "group": "Premios",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "competencia_id",
            "description": "<p>Id Competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "foto_id",
            "description": "<p>Id Foto</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "fecha",
            "description": "<p>Fecha</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre del premio</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "descripcion",
            "description": "<p>Descripcion</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "puesto",
            "description": "<p>Puesto</p>"
          },
          {
            "group": "Parameter",
            "type": "Float",
            "optional": false,
            "field": "monto",
            "description": "<p>Monto</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n     \"productora_id\": 1,\n     \"competencia_id\": 1,\n     \"foto_id\": 1,\n     \"fecha\": \"2007-12-25\",\n     \"nombre\": \"premio1\",\n     \"descripcion\": \"primer lugar\",\n     \"puesto\": \"primero\",\n     \"monto\": 450.36,\n }",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "Premio",
            "description": "<p>ID.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\": 3\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"errors\": \"PremioNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/PremiosController.php",
    "groupTitle": "Premios"
  },
  {
    "type": "post",
    "url": "/api/v1/productora/{productora_id}/image",
    "title": "Actualiza la imagen asociada a la productora",
    "version": "1.0.0",
    "name": "CambiarImagenProductora",
    "group": "Productora",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "file",
            "optional": false,
            "field": "file",
            "description": "<p>Imagen perfil productora</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Imagen actualizada</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Delete\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/ProductoraController.php",
    "groupTitle": "Productora"
  },
  {
    "type": "delete",
    "url": "/api/v1/productora/{productora_id}/competencias/{competencia_id} Elimina",
    "title": "una competencia especifica de una productora",
    "version": "1.0.0",
    "name": "EliminarCompetencias",
    "group": "Productora",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "competencia_id",
            "description": "<p>Id Competencia</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Competencia Eliminada</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Delete\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CompetenciasController.php",
    "groupTitle": "Productora"
  },
  {
    "type": "delete",
    "url": "/api/v1/productora/{productora_id}/competencias Elimina",
    "title": "todas las competencias asociadas a una productora",
    "version": "1.0.0",
    "name": "EliminarCompetencias",
    "group": "Productora",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Competencias Eliminadas</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Delete\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CompetenciasController.php",
    "groupTitle": "Productora"
  },
  {
    "type": "put",
    "url": "/api/v1/productora/{productora_id}/competencias/{competencia_id}",
    "title": "Actualiza un registro de competencia",
    "version": "1.0.0",
    "name": "ModificarCompetencia",
    "group": "Productora",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "competencia_id",
            "description": "<p>Id Competencia</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "   {\n        \"disciplina_id\" : 1,\n        \"nombre\" : \"Competencia Test\",\n        \"dominio\" : \"dominio.test\",\n        \"subdominio\" : \"sugdominio.test\",\n        \"google\" : \"google test\",\n        \"facebook\" : \"facebook test\",\n        \"twitter\" : \"twitter test\",\n        \"tipo\": \"campeonato\",\n        \"status\": \"activo\",\n        \"cantidad_integrantes\": 10,\n        \"fechas\":[ \n         \"2016-11-01\",\n         \"2016-11-02\",\n         \"2016-11-03\"\n        ],\n        \"ubicaciones\": [\n         \"Caracas\",\n         \"Valcencia\",\n         \"Maracay\"\n        ]\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Competencia Modificada</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"data\": false\n   \"errors\": \"CompetenciaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CompetenciasController.php",
    "groupTitle": "Productora"
  },
  {
    "type": "get",
    "url": "/api/v1/productora/{productora_id}/competencias",
    "title": "Muestra las competencias de una productora",
    "version": "1.0.0",
    "name": "MostrarCompetencia",
    "group": "Productora",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Competencias",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "  HTTP/1.1 200 OK\n {\n\"data\": [\n  ...\n   {\n     \"id\": 11,\n     \"productora_id\": 3,\n     \"disciplina_id\": 5,\n     \"nombre\": \"quaerat\",\n     \"dominio\": \"at\",\n     \"subdominio\": \"molestias\",\n     \"costo\": \"384.59\",\n     \"costo_individual\": \"215.23\",\n     \"titulo\": \"pariatur\",\n     \"texto\": \"Pariatur similique et quaerat sed qui nihil fuga. Qui magnam ea nihil totam laudantium.\",\n     \"subtitulado\": \"dolor\",\n     \"descripcion\": \"Neque harum animi sequi itaque. Quibusdam soluta nihil veniam vitae.\",\n     \"bases\": \"Provident et ea et dolor. Ipsam aliquam ut voluptatum necessitatibus. \n     \"cantidad_integrantes\": 12,\n     \"status\": \"activo\",\n     \"tipo\": \"competencia\",\n     \"facebook\": \"et\",\n     \"twitter\": \"sapiente\",\n     \"google\": \"tenetur\",\n     \"deleted_at\": null,\n     \"created_at\": \"1989-11-28 22:18:49\",\n     \"updated_at\": \"1996-09-07 20:28:46\"\n   },\n    ...\n ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CompetenciasController.php",
    "groupTitle": "Productora"
  },
  {
    "type": "get",
    "url": "/api/v1/productora/{productora_id}/competencias/{competencia_id}",
    "title": "Muestra la competencia de una productora",
    "version": "1.0.0",
    "name": "MostrarCompetencia",
    "group": "Productora",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "competencia_id",
            "description": "<p>Id Competencia</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Competencia",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "  HTTP/1.1 200 OK\n {\n\"data\":\n   {\n     \"id\": 11,\n     \"productora_id\": 3,\n     \"disciplina_id\": 5,\n     \"nombre\": \"quaerat\",\n     \"dominio\": \"at\",\n     \"subdominio\": \"molestias\",\n     \"costo\": \"384.59\",\n     \"costo_individual\": \"215.23\",\n     \"titulo\": \"pariatur\",\n     \"texto\": \"Pariatur similique et quaerat sed qui nihil fuga. Qui magnam ea nihil totam laudantium.\",\n     \"subtitulado\": \"dolor\",\n     \"descripcion\": \"Neque harum animi sequi itaque. Quibusdam soluta nihil veniam vitae.\",\n     \"bases\": \"Provident et ea et dolor. Ipsam aliquam ut voluptatum necessitatibus. \n     \"cantidad_integrantes\": 12,\n     \"status\": \"activo\",\n     \"tipo\": \"competencia\",\n     \"facebook\": \"et\",\n     \"twitter\": \"sapiente\",\n     \"google\": \"tenetur\",\n     \"deleted_at\": null,\n     \"created_at\": \"1989-11-28 22:18:49\",\n     \"updated_at\": \"1996-09-07 20:28:46\"\n   },\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CompetenciasController.php",
    "groupTitle": "Productora"
  },
  {
    "type": "post",
    "url": "/api/v1/productora/{productora_id}",
    "title": "actualizar registro de Productora",
    "version": "1.0.0",
    "name": "actualizarProductora",
    "group": "Productora",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>id de la productora que se actualizara</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "usuario_id",
            "description": "<p>id del usuario asociado a la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre de prodcutora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "razon",
            "description": "<p>Razon social de la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cuit",
            "description": "<p>CUIT asociado a la prodcutora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pais",
            "description": "<p>Pais de la prodcutora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ciudad",
            "description": "<p>provincia de la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "direccion",
            "description": "<p>direccion de donde esta ubicada la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "correo",
            "description": "<p>Email asociado a la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "prefijo",
            "description": "<p>Prefijo asociado al telefono de la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "telefono",
            "description": "<p>Telefono de la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "web",
            "description": "<p>pagina web oficial de la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "descripcion",
            "description": "<p>Descripcion sobre la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "facebook",
            "description": "<p>Redsocial de facebook asociada a la productora.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "twitter",
            "description": "<p>Redsocial de twiiter asociada a la productora.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "google",
            "description": "<p>Redsocial de google asociada a la productora.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  'productora_id'    : '1',\n  'usuario_id'    : '1',\n  'nombre'        : \"Ejemplo\"\n  'razon'         : 'RazonEjemplo',\n  'cuit'          :'5148745',\n  'pais'          :'Chile',\n  'provincia'     :'Santiago',\n  'direccion'     :'Ejemplo de direccion',\n  'email'         :'productoraemail@gmail.com',\n  'prefijo'       :'0534',\n  'telefono'      :'58789587',\n  'website'       :'productora.com',\n  'descripcion'   :'la mejor productora',\n  'facebook'      :'Ejemplo',\n  'twitter'       :'Ejemplo',\n  'google'        :'Ejemplo'\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>Id Disciplina creada</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 ProductoraNotSave\n{\n   \"data\":   false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/ProductoraController.php",
    "groupTitle": "Productora"
  },
  {
    "type": "post",
    "url": "/api/v1/productora/competencias Crea un nuevo registro de",
    "title": "competencias de una productora",
    "version": "1.0.0",
    "name": "crearCompetencia",
    "group": "Productora",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "disciplina_id",
            "description": "<p>Id Disciplina</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre de la competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "dominio",
            "description": "<p>Dominio</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "subdominio",
            "description": "<p>SubDominio</p>"
          },
          {
            "group": "Parameter",
            "type": "Float",
            "optional": false,
            "field": "costo",
            "description": "<p>Costo de la competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "Float",
            "optional": false,
            "field": "costo_individual",
            "description": "<p>Costo individual de la competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "titulo",
            "description": "<p>Título de la competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "texto",
            "description": "<p>Texto de la competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "subtitulado",
            "description": "<p>Subtitulado de la competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "descripcion",
            "description": "<p>Descripción de la competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "bases",
            "description": "<p>Bases de la competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "cantidad_integrantes",
            "description": "<p>Cantidad de integrantes de la competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "tipo",
            "description": "<p>Tipo de la competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "facebook",
            "description": "<p>Facebook de la competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "twitter",
            "description": "<p>Twitter de la competencia</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "google",
            "description": "<p>Google de la competencia</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "   {\n    \"productora_id\": 1,\n        \"disciplina_id\" : 1,\n        \"nombre\" : \"Competencia Test\",\n        \"dominio\" : \"dominio.test\",\n        \"subdominio\" : \"sugdominio.test\",\n        \"google\" : \"google test\",\n        \"facebook\" : \"facebook test\",\n        \"twitter\" : \"twitter test\",\n        \"tipo\": \"campeonato\",\n        \"status\": \"activo\",\n        \"cantidad_integrantes\": 10,\n        \"fechas\":[ \n         \"2016-11-01\",\n         \"2016-11-02\",\n         \"2016-11-03\"\n        ],\n        \"ubicaciones\": [\n         \"Caracas\",\n         \"Valcencia\",\n         \"Maracay\"\n        ]\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "Competencia",
            "description": "<p>ID.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\": 3\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"errors\": \"CompetenciaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/CompetenciasController.php",
    "groupTitle": "Productora"
  },
  {
    "type": "post",
    "url": "/api/v1/productora/crear",
    "title": "Crea un nuevo registro de Productora",
    "version": "1.0.0",
    "name": "crearProductora",
    "group": "Productora",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "usuario_id",
            "description": "<p>id del usuario asociado a la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nombre",
            "description": "<p>Nombre de prodcutora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "razon",
            "description": "<p>Razon social de la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cuit",
            "description": "<p>CUIT asociado a la prodcutora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pais",
            "description": "<p>Pais de la prodcutora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ciudad",
            "description": "<p>provincia de la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "direccion",
            "description": "<p>direccion de donde esta ubicada la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "correo",
            "description": "<p>Email asociado a la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "prefijo",
            "description": "<p>Prefijo asociado al telefono de la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "telefono",
            "description": "<p>Telefono de la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "web",
            "description": "<p>pagina web oficial de la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "descripcion",
            "description": "<p>Descripcion sobre la productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "facebook",
            "description": "<p>Redsocial de facebook asociada a la productora.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "twitter",
            "description": "<p>Redsocial de twiiter asociada a la productora.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "google",
            "description": "<p>Redsocial de google asociada a la productora.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  'usuario_id'    : '1',\n  'nombre'        : \"Ejemplo\"\n  'razon'         : 'RazonEjemplo',\n  'cuit'          :'5148745',\n  'pais'          :'Chile',\n  'provincia'     :'Santiago',\n  'direccion'     :'Ejemplo de direccion',\n  'email'         :'productoraemail@gmail.com',\n  'prefijo'       :'0534',\n  'telefono'      :'58789587',\n  'website'       :'productora.com',\n  'descripcion'   :'la mejor productora',\n  'facebook'      :'Ejemplo',\n  'twitter'       :'Ejemplo',\n  'google'        :'Ejemplo'\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>Id Disciplina creada</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\": 1\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 ProductoraNotSave\n{\n   \"errors\": \"ProductoraNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/ProductoraController.php",
    "groupTitle": "Productora"
  },
  {
    "type": "delete",
    "url": "/api/v1/productora/{productora_id}",
    "title": "eliminar registro de Productora",
    "version": "1.0.0",
    "name": "eliminarProductora",
    "group": "Productora",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>id de la productora que se eliminara</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 ProductoraNotSave\n{\n   \"data\":   false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/ProductoraController.php",
    "groupTitle": "Productora"
  },
  {
    "type": "get",
    "url": "/api/v1/productora/{productora_id}/image",
    "title": "Retorna la imagen de la productora",
    "version": "1.0.0",
    "name": "getProductoraImagen",
    "group": "Productora",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Imagen</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"imagen.jpeg\"\n}\n OR\n HTTP/1.1 200 OK\n{\n  \"unknown-productora.jpeg\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Delete\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/ProductoraController.php",
    "groupTitle": "Productora"
  },
  {
    "type": "delete",
    "url": "/api/v1/administradora/transferencias/{transferencia_id} Elimina un",
    "title": "registro de transferencias",
    "version": "1.0.0",
    "name": "EliminarTransferencia",
    "group": "Transaferencias",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "transferencia_id",
            "description": "<p>Id Transferencia</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Transferencia Eliminada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Delete\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/TransferenciasController.php",
    "groupTitle": "Transaferencias"
  },
  {
    "type": "post",
    "url": "/api/v1/administradora/transferencias Crea un nuevo registro de",
    "title": "transferencias",
    "version": "1.0.0",
    "name": "crearTransferencia",
    "group": "Transaferencias",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"multipart/form-data\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "codigo",
            "description": "<p>Codigo</p>"
          },
          {
            "group": "Parameter",
            "type": "Float",
            "optional": false,
            "field": "monto",
            "description": "<p>Monto</p>"
          },
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "recibo",
            "description": "<p>Recibo</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "productora_id =  1,\ncodigo =  abc1,\nmonto = 450.36,\nrecibo = imagen.jpg  || imagen.png || imagen.jpeg || archivo.pdf",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "Transferencia",
            "description": "<p>ID.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\": 3\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"errors\": \"TransferenciaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/TransferenciasController.php",
    "groupTitle": "Transaferencias"
  },
  {
    "type": "post",
    "url": "/api/v1/administradora/transferencias/{transferencia_id}",
    "title": "Actualiza un registro de transferencias",
    "version": "1.0.0",
    "name": "ModificarTransferencia",
    "group": "Transferencia",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"multipart/form-data\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "productora_id",
            "description": "<p>Id Productora</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "codigo",
            "description": "<p>Codigo</p>"
          },
          {
            "group": "Parameter",
            "type": "Float",
            "optional": false,
            "field": "monto",
            "description": "<p>Monto</p>"
          },
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "recibo",
            "description": "<p>Recibo</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "productora_id =  1,\ncodigo =  abc1,\nmonto = 450.36,\nrc = a1\nestado = exitoso\nrecibo = imagen.jpg  || imagen.png || imagen.jpeg || archivo.pdf",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Transferencia Modificada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"data\": false\n   \"errors\": \"TransferenciaNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/TransferenciasController.php",
    "groupTitle": "Transferencia"
  },
  {
    "type": "get",
    "url": "/api/v1/administradora/transferencias",
    "title": "Muestra varios registros de transferencias",
    "version": "1.0.0",
    "name": "MostrarTransaferencias",
    "group": "Transferencia",
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Transaferencias.",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n   \"data\": [\n   {\n    \"id\": 1,\n    \"productora_id\": 3,\n    \"fecha_solicitud\": \"2010-04-25 12:48:57\",\n    \"fecha_solventada\": null,\n    \"nro_operacion\": \"5cbde2ea6bdc8ec2838187a12cd26d54f039f07d\",\n    \"codigo\": \"ed60cf323476b84fd96d754822d8d0fdd4b0383e\",\n    \"monto\": \"738.96\",\n    \"estado\": \"solicitud\",\n    \"rc\": \"a3\",\n    \"recibo\": \"c0c8e12ab4292bd2d5b8ed64816ebdc8f565ac0e\",\n    \"deleted_at\": null,\n    \"created_at\": \"1994-04-12 10:12:59\",\n    \"updated_at\": \"1985-05-22 17:26:18\"\n  },\n     ...\n ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/TransferenciasController.php",
    "groupTitle": "Transferencia"
  },
  {
    "type": "get",
    "url": "/api/v1/administradora/transferencias/{transferencia_id}",
    "title": "Muestra un registro de transferencias",
    "version": "1.0.0",
    "name": "MostrarTransferencia",
    "group": "Transferencia",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "transferencia_id",
            "description": "<p>Id Transferencia</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "json",
            "optional": false,
            "field": "Transferencia",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n  {\n    \"data\": {\n    \"id\": 9,\n    \"productora_id\": 1,\n    \"fecha_solicitud\": \"2016-11-13 01:39:34\",\n    \"fecha_solventada\": null,\n    \"nro_operacion\": \"HJYvtNoLT0hW4Zrf\",\n    \"codigo\": \"abc1\",\n    \"monto\": \"450.65\",\n    \"estado\": null,\n    \"rc\": null,\n    \"recibo\": \"g5YuWtFuIsN2.pdf\",\n    \"deleted_at\": null,\n    \"created_at\": \"2016-11-13 01:39:34\",\n    \"updated_at\": \"2016-11-13 01:39:34\"\n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n   \"data\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/TransferenciasController.php",
    "groupTitle": "Transferencia"
  },
  {
    "type": "put",
    "url": "/api/v1/usuario/{usuario_id}/cambiar-clave",
    "title": "Actualiza un registro de categorias",
    "version": "1.0.0",
    "name": "CambiarClave",
    "group": "Usuario",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Tipo de contenido para el request enviado</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n \"Content-Type\": \"application/json\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "usuario_id",
            "description": "<p>Id Usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "clave_actual",
            "description": "<p>Clave Actual</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "clave_nueva",
            "description": "<p>Clave Nueva</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "confirmacion_clave",
            "description": "<p>Confirmación Clave</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"usuario_id\": 1,\n    \"clave_actual\": \"123456\",\n    \"clave\": \"12345678\",\n    \"clave_confirmation\": \"12345678\",\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>Clave Modificada.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "json",
            "optional": false,
            "field": "json",
            "description": "<p>Retorna un json de estructura <code>{ &quot;errors&quot;: false }</code></p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Save\n{\n   \"data\": false\n   \"errors\": \"ClaveNotSave\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/UsuarioController.php",
    "groupTitle": "Usuario"
  }
] });
