var express = require('express'),
        app = express(),
        server = require('http').createServer(app),
        io = require('socket.io').listen(server),
        mysql = require('mysql'),
        users = {};

var usuario;
var conexion = definirConexion(mysql);
conexion = verificarConexion(conexion);
server.listen(8890);

/* *****************************************************
 *  Conexión *
 *  **************************************************** */
io.sockets.on('connection', function (socket) {

    socket.on('new_user', function (data, callback) {
        if (data in users) {
            callback(false);
            updateUsuarios();
        } else {
            callback(true);
            socket.usuario_remitente = data;
            buscarUsuario(conexion, socket.usuario_remitente, function (error, usuario) {
                if (error !== null) {
                    throw error;
                } else {
                    users[socket.usuario_remitente] = usuario;
                    users[socket.usuario_remitente][0]['socket_id'] = socket.id;
                    updateUsuarios();
                }
            });

        }
    });

    socket.on('cargar_mensajes', function (data, callback) {
        buscarMensajes(conexion, data, function (error, mensajes) {
            if (error !== null) {
                callback(false);
                throw error;
            } else {
                callback(true);
                updateMensajes(mensajes);
            }
        });
    });


    function updateUsuarios() {
        io.sockets.emit('usernames', users);
    }
    
    function updateMensajes(mensajes) {
        io.sockets.emit('load_old_msgs', mensajes);
    }

    socket.on('send_message', function (data, callback) {
        var mensajeModel = {mensaje: data.mensaje.trim(), remitente: data.remitente,
        destinatario: data.destinatario};
        var params = {url: data.url};
//        var ind_msg_vacio = mensajeModel.mensaje.indexOf(' ');
        if (mensajeModel.mensaje !== '') {
            if(mensajeModel.remitente !== ''){
                if(mensajeModel.destinatario !== ''){
                    io.sockets.emit('save_ajax', {'params': params, 'messageModel': mensajeModel});
                    console.log('Se envió el mensaje personalizado');
                }else{
                    callback('Error! Usuario destinatario no valido.');
                }
            }else{
                callback('Error! Usuario remitente no valido.');
            }
        } else {
            callback('Error! Por favor ingrese un mensaje');
        }
    });

    socket.on('disconnect', function (data) {
        console.log(data);
        if (!socket.usuario_remitente) {
            return;
        } else {
            delete users[socket.usuario_remitente];
            updateUsuarios();
        }
    });

});


/* *****************************************************
 *  Funciones *
 *  **************************************************** */

function definirConexion(mysql) {
    var conexion = mysql.createConnection({
        host: 'localhost',
        user: 'pspdev',
        password: 'pspdev',
        database: 'psp_dev'
    });
    return conexion;
}

function verificarConexion(conexion) {
    conexion.connect(function (err) {
        if (!err) {
            console.log("Se estableció la conexión");
        } else {
            console.log("Error no se estableció la conexión");
        }
    });
    return conexion;
}

function buscarMensajes(conexion, data, callback) {
    var sql = 'SELECT * FROM mensajes WHERE (usuario_remitente = ' + data.remitente
            + ' AND usuario_destinatario = ' + data.destinatario + ')' 
            + ' OR (usuario_remitente = ' + data.destinatario
            + ' AND usuario_destinatario = '+ data.remitente + ')' 
            + ' ORDER BY created_at LIMIT 100';
    conexion.query(sql, function (error, filas) {
        if (!error) {
            return callback(null, filas);
        } else {
            return callback(error, null);
        }

    });
}

function buscarUsuario(conexion, id, callback) {
    conexion.query('SELECT * FROM usuarios WHERE id = ' + id + ' LIMIT 1',
            function (error, filas) {
                if (!error) {
                    return callback(null, filas);
                } else {
                    return callback(error, null);
                }
            });
}

