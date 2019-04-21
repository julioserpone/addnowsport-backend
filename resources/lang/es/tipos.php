<?php

return [

    'estatus' => [
        'activo' => 'Activo',
        'inactivo'   => 'Inactivo',
    ],

    'generos' => [
        'female' => 'Femenino', //defino el key en ingles porque se utiliza al momento de registro mediante red social (viene en ingles)
        'male'   => 'Masculino',
    ],

    'cuentas' => [
        'ahorro' => 'Ahorro',
        'corriente' => 'Corriente',
    ],

    'operaciones' => [
        'transferencia' => 'Transferencia',
        'deposito' => 'Depósito',
        'webpay' => 'Webpay',
        'cupon' => 'Cupón',
        'otro' => 'Otro',
    ],

    'movimientos' => [
        'ingreso' => 'Ingreso',
        'egreso' => 'Egreso',
    ],

    'origen_transaccion' => [
        'webpay' => 'WebPay',
        'codigo' => 'Codigo',
        'otro' => 'Otro',
    ],

    'estatus_inscripcion' => [
        'nuevo' => 'Nuevo',
        'pendiente' => 'Pendiente',
        'inscrito' => 'Inscripto',
        'rechazado' => 'Rechazado',
    ],

    'estatus_webpay' => [
        'null' => 'Null',
        'aceptado' => 'Aceptado',
        'rechazado' => 'Rechazado',
    ],

    'proveedores' => [
        'facebook' => 'Facebook',
        'google' => 'Google+',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'psp' => 'PSP'
    ],

    'descuentos' => [
        'voucher' => 'Voucher',
        'descuento' => 'Descuento',
        'free' => 'Free',
        'notacredito' => 'Nota de Crédito',
        'team' => 'Team',
    ],

    'estatus_descuento' => [
        'activo' => 'Activo',
        'inactivo'   => 'Inactivo',
        'utilizado' => 'Inactivo por Uso',
    ],

    'slider' => [
        'home' => 'Home',
        'productora' => 'Productora',
        'competencia' => 'Competencia',
    ],

    'secciones' => [
        'productora' => 'Productora',
        'competencia' => 'Competencia',
        'categoria' => 'Categoria',
        'distancia' => 'Distancia',
        'disciplina' => 'Disciplina',
        'codigo' => 'Codigo',
        'inscripcion' => 'Inscripcion',
    ],

    'competencias' => [
        'competencia' => 'Competencia',
        'campeonato' => 'Campeonato',
    ],

    'ventas' => [
        'nominal' => 'Total Nominal',
        'descuentos' => 'Descuentos',
        'bruto' => 'Bruto',
        'comsiones' => 'Comisiones',
        'notas' => 'Notas De Credito',
        'neto' => 'Total Neto',
    ],

    'transferencias' => [
        'solicitud' => 'Solicitud',
        'exitosa' => 'Exitosa',
        'problemas' => 'Problemas',
    ],

    'rc' => [
        'a1' => 'A-1',
        'a2' => 'A-2',
        'a3' => 'A-3',
        'b1' => 'B-1',
        'b2' => 'B-2',
        'b3' => 'B-3',
        'c1' => 'C-1',
        'c2' => 'C-2',
        'c3' => 'C-3',
    ],

    'imagen' => [
        'Galeria' => 'Galeria',
        'Premio'   => 'Premio',
        'Patrocinador' => 'Patrocinador',
    ],

    'extension' => [
        'jpg' => 'jpg',
        'jpeg' => 'jpeg',
        'png' => 'png',
    ],

];
