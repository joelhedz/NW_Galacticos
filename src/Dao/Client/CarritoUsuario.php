<?php

namespace Dao\Client;

class CarritoUsuario extends \Dao\Table
{
    public static function comprobarProductoEnCarritoUsuario($UsuarioId, $ProdId)
    {
        $sqlstr = "SELECT * FROM carritocompraclienteregistrado WHERE UsuarioId = :UsuarioId AND ProdId = :ProdId;";
<<<<<<< HEAD
        return self::obtenerUnRegistro($sqlstr, array("UsuarioId"=>intval($UsuarioId), "ProdId"=>$ProdId));
=======
        return self::obtenerUnRegistro($sqlstr, array("UsuarioId" => intval($UsuarioId), "ProdId" => $ProdId));
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
    }

    public static function insertarProductoCarritoUsuario($UsuarioId, $ProdId, $ProdCantidad, $ProdPrecioVenta)
    {
        $insstr = "INSERT INTO carritocompraclienteregistrado VALUES (:UsuarioId, :ProdId, :ProdCantidad, :ProdPrecioVenta, NOW())";
<<<<<<< HEAD
        return self::executeNonQuery($insstr, array("UsuarioId"=>intval($UsuarioId), "ProdId"=>$ProdId, "ProdCantidad"=>$ProdCantidad, "ProdPrecioVenta"=>$ProdPrecioVenta));
=======
        return self::executeNonQuery($insstr, array("UsuarioId" => intval($UsuarioId), "ProdId" => $ProdId, "ProdCantidad" => $ProdCantidad, "ProdPrecioVenta" => $ProdPrecioVenta));
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
    }

    public static function sumarProductoInventarioAnonimo($ProdId, $ProdCantidad)
    {
        $updstr = "UPDATE productos SET ProdStock = ProdStock + :ProdCantidad WHERE ProdId = :ProdId";
<<<<<<< HEAD
        return self::executeNonQuery($updstr, array("ProdId"=>intval($ProdId), "ProdCantidad"=>$ProdCantidad));
=======
        return self::executeNonQuery($updstr, array("ProdId" => intval($ProdId), "ProdCantidad" => $ProdCantidad));
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
    }

    public static function restarProductoInventarioUsuario($ProdId, $ProdCantidad)
    {
        $updstr = "UPDATE productos SET ProdStock = ProdStock - :ProdCantidad WHERE ProdId = :ProdId";
<<<<<<< HEAD
        return self::executeNonQuery($updstr, array("ProdId"=>intval($ProdId), "ProdCantidad"=>$ProdCantidad));
=======
        return self::executeNonQuery($updstr, array("ProdId" => intval($ProdId), "ProdCantidad" => $ProdCantidad));
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
    }

    public static function deleteProductoCarritoUsuario($UsuarioId, $ProdId)
    {
        $delsql = "DELETE FROM carritocompraclienteregistrado WHERE UsuarioId = :UsuarioId AND ProdId = :ProdId;";
        return self::executeNonQuery(
            $delsql,
<<<<<<< HEAD
            array("UsuarioId" => intval($UsuarioId), "ProdId"=>$ProdId)
=======
            array("UsuarioId" => intval($UsuarioId), "ProdId" => $ProdId)
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
        );
    }

    public static function getProductosCarritoUsuario($UsuarioId)
    {
<<<<<<< HEAD
        $sqlstr = "SELECT cr.*, p.ProdNombre, (cr.ProdCantidad * cr.ProdPrecioVenta) as 'TotalProducto', m.MediaDoc, m.MediaPath FROM carritocompraclienteregistrado cr INNER JOIN productos p on cr.ProdId = p.ProdId INNER JOIN media m on m.ProdId = p.ProdId WHERE UsuarioId = :UsuarioId GROUP BY cr.ProdId;"; 
        return self::obtenerRegistros($sqlstr, array("UsuarioId"=>intval($UsuarioId)));
=======
        $sqlstr = "SELECT cr.*, p.ProdNombre, (cr.ProdCantidad * cr.ProdPrecioVenta) as 'TotalProducto', m.MediaDoc, m.MediaPath FROM carritocompraclienteregistrado cr INNER JOIN productos p on cr.ProdId = p.ProdId INNER JOIN media m on m.ProdId = p.ProdId WHERE UsuarioId = :UsuarioId GROUP BY cr.ProdId;";
        return self::obtenerRegistros($sqlstr, array("UsuarioId" => intval($UsuarioId)));
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
    }

    public static function getTotalCarrito($UsuarioId)
    {
<<<<<<< HEAD
        $sqlstr = "SELECT SUM(cr.ProdCantidad * cr.ProdPrecioVenta) as 'Total' FROM carritocompraclienteregistrado cr INNER JOIN productos p on cr.ProdId = p.ProdId WHERE UsuarioId = :UsuarioId"; 
        return self::obtenerUnRegistro($sqlstr, array("UsuarioId"=>intval($UsuarioId)));
    }
}
?>
=======
        $sqlstr = "SELECT SUM(cr.ProdCantidad * cr.ProdPrecioVenta) as 'Total' FROM carritocompraclienteregistrado cr INNER JOIN productos p on cr.ProdId = p.ProdId WHERE UsuarioId = :UsuarioId";
        return self::obtenerUnRegistro($sqlstr, array("UsuarioId" => intval($UsuarioId)));
    }
}
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
