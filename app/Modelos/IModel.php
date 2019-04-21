<?php

namespace App\Modelos;

interface IModel
{
   /*
    * Debe retornar la fecha de la creacion del registro en formato d-m-Y
    * return date
    */

    public function createdAt();

   /*
    * Debe retornar la fceha de la actualizacion del registro en formato d-m-Y
    * return date
    */

    public function updatedAt();

    /*
     * Debe retornar la fceha de eliminacion del registro en formato d-m-Y
     * return date
     */

    public function deletedAt();

    /*
     * Usando los datos pasados por el atributo data se debe verificar si existe dicho elemento,
     * retornar true en caso posivo, de lo contrario falso
     * return boolean
     */
/*
    public function exist(array $data);

   /*
    * Debe retornar la lista de todos los registros de la tabla
    * return lista


    public function getAllList();

   /*
    * Debe retornar la lista de todos los registros de no tienen soft-delete de la tabla
    * return lista


    public function getModelById($id);

    public function getList();

   /*
    * Uusando los datos pasados por el atributo data se debe traer la lista de todos aquellos que cumplan el criterio,
    * el criterio en este caso es un arreglo sobre un campo, por ejemplo nombre = ['gary','oriana','luis','reysmer','mykol','raffaele']
    * debe traer solo aquellos registros que tengan nombre perteneciente a dicha lista
    * return lista


    public function getListWhereIn(array $data);

   /*
    * Usando los datos pasados por el atributo data se debe traer la lista de todos aquellos que cumplan el criterio,
    * el criterio en este caso es un arreglo sobre un campo, por ejemplo nombre = ['gary','oriana','luis','reysmer','mykol','raffaele']
    * debe traer solo aquellos registros que no tengan el nombre perteneciente a dicha lista
    * return lista


    public function getListWhereNotIn(array $data);

    /*
     * Usando los datos pasados por el atributo data se debe buscar en toda la tabla
     * y traer aquellos que coincidan con dicho criterio
     * return lista


    public function search(array $data);
*/
}