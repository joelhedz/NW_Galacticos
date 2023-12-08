<<<<<<< HEAD
<?php

    namespace Dao\Security;

    if (version_compare(phpversion(), '7.4.0', '<')) {
            define('PASSWORD_ALGORITHM', 1);  //BCRYPT
    } 
    else 
    {
        define('PASSWORD_ALGORITHM', '2y');  //BCRYPT
    }

    use Exception;

    class Security extends \Dao\Table
    {
        public static function getAll()
        {
            return self::obtenerRegistros("SELECT * FROM usuarios ORDER BY UsuarioTipo;;", array());
        }

        static public function insertUsuarioFromCliente($UsuarioEmail, $UsuarioNombre, $UsuarioPswd)
        {
            if (!\Utilities\Validators::IsValidEmail($UsuarioEmail)) 
            {
                throw new Exception("Correo no es válido");
            }
            if (!\Utilities\Validators::IsValidPassword($UsuarioPswd)) 
            {
                throw new Exception("Contraseña debe ser almenos 8 caracteres, 1 número, 1 mayúscula, 1 símbolo especial");
            }

            $usuario = self::_usuarioStruct();
            //Tratamiento de la Contraseña
            $hashedPassword = self::_hashPassword($UsuarioPswd);

            unset($usuario["UsuarioId"]);
            unset($usuario["UsuarioFching"]);
            unset($usuario["UsuarioPswdChg"]);

            $usuario["UsuarioEmail"] = $UsuarioEmail;
            $usuario["UsuarioNombre"] = $UsuarioNombre;
            $usuario["UsuarioPswd"] = $hashedPassword;
            $usuario["UsuarioPswdEst"] = Estados::ACTIVO;
            $usuario["UsuarioPswdExp"] = date('Y-m-d', time() + 7776000);  //(3*30*24*60*60) (m d h mi s)
            $usuario["UsuarioEst"] = Estados::ACTIVO;
            $usuario["UsuarioActCod"] = hash("sha256", $UsuarioEmail.time());
            $usuario["UsuarioTipo"] = UsuarioTipo::PUBLICO;

            $sqlIns = "INSERT INTO `usuarios` (`UsuarioEmail`, `UsuarioNombre`, `UsuarioPswd`,
                `UsuarioFching`, `UsuarioPswdEst`, `UsuarioPswdExp`, `UsuarioEst`, `UsuarioActCod`,
                `UsuarioPswdChg`, `UsuarioTipo`)
                VALUES
                ( :UsuarioEmail, :UsuarioNombre, :UsuarioPswd,
                now(), :UsuarioPswdEst, :UsuarioPswdExp, :UsuarioEst, :UsuarioActCod,
                now(), :UsuarioTipo);";

            return self::executeNonQuery($sqlIns, $usuario);
        }

        static public function insertUsuarioFromAdmin($UsuarioEmail, $UsuarioNombre, $UsuarioPswd, $UsuarioTipo)
        {
            if (!\Utilities\Validators::IsValidEmail($UsuarioEmail)) 
            {
                throw new Exception("Correo no es válido");
            }
            
            if (!\Utilities\Validators::IsValidPassword($UsuarioPswd)) 
            {
                throw new Exception("Contraseña debe ser almenos 8 caracteres, 1 número, 1 mayúscula, 1 símbolo especial");
            }      
            
            $usuario = self::_usuarioStruct();
            //Tratamiento de la Contraseña
            $hashedPassword = self::_hashPassword($UsuarioPswd);

            unset($usuario["UsuarioId"]);
            unset($usuario["UsuarioFching"]);
            unset($usuario["UsuarioPswdChg"]);

            $usuario["UsuarioEmail"] = $UsuarioEmail;
            $usuario["UsuarioNombre"] = $UsuarioNombre;
            $usuario["UsuarioPswd"] = $hashedPassword;
            $usuario["UsuarioPswdEst"] = Estados::ACTIVO;
            $usuario["UsuarioPswdExp"] = date('Y-m-d', time() + 7776000);  //(3*30*24*60*60) (m d h mi s)
            $usuario["UsuarioEst"] = Estados::ACTIVO;
            $usuario["UsuarioActCod"] = hash("sha256", $UsuarioEmail.time());
            $usuario["UsuarioTipo"] = $UsuarioTipo;

            $sqlIns = "INSERT INTO `usuarios` (`UsuarioEmail`, `UsuarioNombre`, `UsuarioPswd`,
                `UsuarioFching`, `UsuarioPswdEst`, `UsuarioPswdExp`, `UsuarioEst`, `UsuarioActCod`,
                `UsuarioPswdChg`, `UsuarioTipo`)
                VALUES
                ( :UsuarioEmail, :UsuarioNombre, :UsuarioPswd,
                now(), :UsuarioPswdEst, :UsuarioPswdExp, :UsuarioEst, :UsuarioActCod,
                now(), :UsuarioTipo);";

            return self::executeNonQuery($sqlIns, $usuario);
        }

        static public function updateUsuarioAdmin($UsuarioId, $UsuarioEmail, $UsuarioNombre, $UsuarioEst,
        $UsuarioTipo)
        {
            if (!\Utilities\Validators::IsValidEmail($UsuarioEmail)) 
            {
                throw new Exception("Correo no es válido");
            }

            $usuario = self::_usuarioStruct();

            unset($usuario["UsuarioPswd"]);
            unset($usuario["UsuarioFching"]);   
            unset($usuario["UsuarioPswdEst"]);  
            unset($usuario["UsuarioPswdExp"]);  
            unset($usuario["UsuarioEst"]);     
            unset($usuario["UsuarioActCod"]);   
            unset($usuario["UsuarioPswdChg"]); 

            $usuario["UsuarioId"] = $UsuarioId;
            $usuario["UsuarioEmail"] = $UsuarioEmail;
            $usuario["UsuarioNombre"] = $UsuarioNombre;
            $usuario["UsuarioEst"] = $UsuarioEst;
            $usuario["UsuarioActCod"] = hash("sha256", $UsuarioEmail.time());
            $usuario["UsuarioTipo"] = $UsuarioTipo;

            $sqlIns = "UPDATE `usuarios` SET UsuarioEmail=:UsuarioEmail, UsuarioNombre=:UsuarioNombre, 
            UsuarioEst=:UsuarioEst, UsuarioActCod=:UsuarioActCod, UsuarioTipo=:UsuarioTipo WHERE UsuarioId=:UsuarioId";

            return self::executeNonQuery($sqlIns, $usuario);
        }

        static public function updateUsuarioWithPswdAdmin($UsuarioId, $UsuarioEmail, $UsuarioNombre, $UsuarioPswd, 
        $UsuarioEst, $UsuarioTipo)
        {
            if (!\Utilities\Validators::IsValidEmail($UsuarioEmail)) 
            {
                throw new Exception("Correo no es válido");
            }
            
            if (!\Utilities\Validators::IsValidPassword($UsuarioPswd)) 
            {
                throw new Exception("Contraseña debe ser almenos 8 caracteres, 1 número, 1 mayúscula, 1 símbolo especial");
            }      
            
            $usuario = self::_usuarioStruct();
            //Tratamiento de la Contraseña
            $hashedPassword = self::_hashPassword($UsuarioPswd);

            unset($usuario["UsuarioFching"]);
            unset($usuario["UsuarioPswdChg"]);

            $usuario["UsuarioId"] = $UsuarioId;
            $usuario["UsuarioEmail"] = $UsuarioEmail;
            $usuario["UsuarioNombre"] = $UsuarioNombre;
            $usuario["UsuarioPswd"] = $hashedPassword;
            $usuario["UsuarioPswdEst"] = Estados::ACTIVO;
            $usuario["UsuarioPswdExp"] = date('Y-m-d', time() + 7776000);  //(3*30*24*60*60) (m d h mi s)
            $usuario["UsuarioEst"] = $UsuarioEst;
            $usuario["UsuarioActCod"] = hash("sha256", $UsuarioEmail.time());
            $usuario["UsuarioTipo"] = $UsuarioTipo;

            $sqlIns = "UPDATE `usuarios` SET `UsuarioEmail`=:UsuarioEmail, `UsuarioNombre`=:UsuarioNombre, 
            `UsuarioPswd`=:UsuarioPswd, `UsuarioPswdEst`=:UsuarioPswdEst, `UsuarioPswdExp`=:UsuarioPswdExp, 
            `UsuarioEst`=:UsuarioEst, `UsuarioActCod`=:UsuarioActCod, `UsuarioPswdChg`=now(), `UsuarioTipo`=:UsuarioTipo
            WHERE UsuarioId=:UsuarioId;";
            return self::executeNonQuery($sqlIns, $usuario);
        }

        public static function deleteUsuarioAdmin($UsuarioId)
        {
            $delsql = "DELETE FROM usuarios WHERE UsuarioId=:UsuarioId;";
            return self::executeNonQuery
            (
                $delsql,
                array("UsuarioId" => $UsuarioId)
            );
        }

        public static function getUsuariobyId($UsuarioId)
        {
            $sqlstr = "SELECT * FROM usuarios WHERE UsuarioId = :UsuarioId LIMIT 1;";
            return self::obtenerUnRegistro($sqlstr, array("UsuarioId"=>$UsuarioId));
        }

        static public function getUsuarioByEmail($UsuarioEmail)
        {
            $sqlstr = "SELECT * FROM `usuarios` where `UsuarioEmail` = :UsuarioEmail ;";
            $params = array("UsuarioEmail"=>$UsuarioEmail);

            return self::obtenerUnRegistro($sqlstr, $params);
        }

        public static function getUsuarioDifferbyEmail($UsuarioId, $UsuarioEmail)
        {
            $sqlstr = "SELECT * FROM usuarios WHERE UsuarioId!=:UsuarioId AND UsuarioEmail=:UsuarioEmail";
            return self::obtenerRegistros($sqlstr, array("UsuarioId"=>$UsuarioId, "UsuarioEmail"=>$UsuarioEmail));
        }
        
        static private function _saltPassword($UsuarioPswd)
        {
            return hash_hmac(
                "sha256",
                $UsuarioPswd,
                \Utilities\Context::getContextByKey("PWD_HASH")
            );
        }

        static private function _hashPassword($password)
        {
            return password_hash(self::_saltPassword($password), PASSWORD_ALGORITHM);
        }

        static public function verifyPassword($raw_password, $hash_password)
        {
            return password_verify(
                self::_saltPassword($raw_password),
                $hash_password
            );
        }

        static private function _usuarioStruct()
        {
            return array(
                "UsuarioId"      => "",
                "UsuarioEmail"    => "",
                "UsuarioNombre"     => "",
                "UsuarioPswd"     => "",
                "UsuarioFching"   => "",
                "UsuarioPswdEst"  => "",
                "UsuarioPswdExp"  => "",
                "UsuarioEst"      => "",
                "UsuarioActCod"   => "",
                "UsuarioPswdChg"  => "",
                "UsuarioTipo"     => "",
            );
        }

        static public function getFeature($FuncionId)
        {
            $sqlstr = "SELECT * FROM funciones WHERE FuncionId=:FuncionId;";
            $featuresList = self::obtenerRegistros($sqlstr, array("FuncionId"=>$FuncionId));
            return count($featuresList) > 0;
        }

        static public function addNewFeature($FuncionId, $FuncionDsc, $FuncionEst, $FuncionTipo)
        {
            $sqlins = "INSERT INTO `funciones` (`FuncionId`, `FuncionDsc`, `FuncionEst`, `FuncionTipo`)
                VALUES (:FuncionId , :FuncionDsc , :FuncionEst , :FuncionTipo);";

            return self::executeNonQuery(
                $sqlins,
                array(
                    "FuncionId" => $FuncionId,
                    "FuncionDsc" => $FuncionDsc,
                    "FuncionEst" => $FuncionEst,
                    "FuncionTipo" => $FuncionTipo
                )
            );
        }

        static public function getFeatureByUsuario($UsuarioId, $FuncionId)
        {
            $sqlstr = "SELECT * from funcionesroles a INNER JOIN rolesusuarios b ON a.RolId = b.RolId 
            WHERE a.FuncionRolEst = 'ACT' AND b.UsuarioId=:UsuarioId AND a.FuncionId=:FuncionId LIMIT 1;";
            $resultados = self::obtenerRegistros(
                $sqlstr,
                array(
                    "UsuarioId"=> $UsuarioId,
                    "FuncionId" => $FuncionId
                )
            );
            return count($resultados) > 0;
        }

        static public function getRol($RolId)
        {
            $sqlstr = "SELECT * FROM roles WHERE RolId=:RolId;";
            $featuresList = self::obtenerRegistros($sqlstr, array("RolId" => $RolId));
            return count($featuresList) > 0;
        }

        static public function addNewRol($RolId, $RolDsc, $RolEst)
        {
            $sqlins = "INSERT INTO `roles` (`RolId`, `RolDsc`, `RolEst`)
            VALUES (:RolId, :RolDsc, :RolEst);";

            return self::executeNonQuery(
                $sqlins,
                array(
                    "RolId" => $RolId,
                    "RolDsc" => $RolDsc,
                    "RolEst" => $RolEst
                )
            );
        }
        
        static public function getRolesByUsuario($UsuarioId, $RolId)
        {
            $sqlstr = "SELECT * FROM roles a INNER JOIN 
            rolesusuarios b ON a.RolId = b.RolId WHERE a.RolEst = 'ACT'
            AND b.UsuarioId=:UsuarioId AND a.RolId=:RolId LIMIT 1;";
            $resultados = self::obtenerRegistros(
                $sqlstr,
                array(
                    "UsuarioId" => $UsuarioId,
                    "RolId" => $RolId
                )
            );
            return count($resultados) > 0;
        }

        static public function getFuncionesByRolesUsuario($UsuarioId, $RolId)
        {
            $sqlstr = "SELECT * FROM roles a INNER JOIN 
            rolesusuarios b ON a.RolId = b.RolId WHERE a.RolEst = 'ACT'
            AND b.UsuarioId=:UsuarioId AND a.RolId=:RolId LIMIT 1;";
            $resultados = self::obtenerRegistros(
                $sqlstr,
                array(
                    "UsuarioId" => $UsuarioId,
                    "RolId" => $RolId
                )
            );
            return count($resultados) > 0;
        }

        static public function searchUsuarios($UsuarioBusqueda)
        {
            $sqlstr = "SELECT * FROM usuarios WHERE UsuarioEmail LIKE :UsuarioBusqueda
            OR UsuarioNombre LIKE :UsuarioBusqueda OR UsuarioFching LIKE :UsuarioBusqueda 
            OR UsuarioPswdEst LIKE :UsuarioBusqueda OR UsuarioPswdExp LIKE :UsuarioBusqueda 
            OR UsuarioEst LIKE :UsuarioBusqueda OR UsuarioTipo LIKE :UsuarioBusqueda ORDER BY UsuarioTipo;";
            
            return self::obtenerRegistros($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%"));
        }

        private function __construct()
        {

        }
        private function __clone()
        {

        }
    }
?>
=======
<?php
namespace Dao\Security;

if (version_compare(phpversion(), '7.4.0', '<')) {
        define('PASSWORD_ALGORITHM', 1);  //BCRYPT
} else {
    define('PASSWORD_ALGORITHM', '2y');  //BCRYPT
}
/*
usercod     bigint(10) AI PK
useremail   varchar(80)
username    varchar(80)
userpswd    varchar(128)
userfching  datetime
userpswdest char(3)
userpswdexp datetime
userest     char(3)
useractcod  varchar(128)
userpswdchg varchar(128)
usertipo    char(3)

 */

use Exception;

class Security extends \Dao\Table
{
    static public function getUsuarios($filter = "", $page = -1, $items = 0)
    {
        $sqlstr = "";
        if ($filter == "" && $page == -1 && $items == 0) {
            $sqlstr = "SELECT * FROM usuario;";
        } else {
            //TODO: Terminar consultas FACET
            if ($page = -1 and $items = 0) {
                $sqlstr = sprintf("SELECT * FROM usuarios %s;", $filter);
            } else {
                $offset = ($page -1 * $items);
                $sqlstr = sprintf(
                    "SELECT * FROM usuarios %s limit %d, %d;",
                    $filter,
                    $offset,
                    $items
                );
            }
        }
        return self::obtenerRegistros($sqlstr, array());
    }

    static public function newUsuario($email, $password)
    {
        if (!\Utilities\Validators::IsValidEmail($email)) {
            throw new Exception("Correo no es válido");
        }
        if (!\Utilities\Validators::IsValidPassword($password)) {
            throw new Exception("Contraseña debe ser almenos 8 caracteres, 1 número, 1 mayúscula, 1 símbolo especial");
        }

        $newUser = self::_usuarioStruct();
        //Tratamiento de la Contraseña
        $hashedPassword = self::_hashPassword($password);

        unset($newUser["usercod"]);
        unset($newUser["userfching"]);
        unset($newUser["userpswdchg"]);

        $newUser["useremail"] = $email;
        $newUser["username"] = "John Doe";
        $newUser["userpswd"] = $hashedPassword;
        $newUser["userpswdest"] = Estados::ACTIVO;
        $newUser["userpswdexp"] = date('Y-m-d', time() + 7776000);  //(3*30*24*60*60) (m d h mi s)
        $newUser["userest"] = Estados::ACTIVO;
        $newUser["useractcod"] = hash("sha256", $email.time());
        $newUser["usertipo"] = UsuarioTipo::PUBLICO;

        $sqlIns = "INSERT INTO `usuario` (`useremail`, `username`, `userpswd`,
            `userfching`, `userpswdest`, `userpswdexp`, `userest`, `useractcod`,
            `userpswdchg`, `usertipo`)
            VALUES
            ( :useremail, :username, :userpswd,
            now(), :userpswdest, :userpswdexp, :userest, :useractcod,
            now(), :usertipo);";

        return self::executeNonQuery($sqlIns, $newUser);

    }

    static public function getUsuarioByEmail($email)
    {
        $sqlstr = "SELECT * from `usuario` where `useremail` = :useremail ;";
        $params = array("useremail"=>$email);

        return self::obtenerUnRegistro($sqlstr, $params);
    }

    static private function _saltPassword($password)
    {
        return hash_hmac(
            "sha256",
            $password,
            \Utilities\Context::getContextByKey("PWD_HASH")
        );
    }

    static private function _hashPassword($password)
    {
        return password_hash(self::_saltPassword($password), PASSWORD_ALGORITHM);
    }

    static public function verifyPassword($raw_password, $hash_password)
    {
        return password_verify(
            self::_saltPassword($raw_password),
            $hash_password
        );
    }


    static private function _usuarioStruct()
    {
        return array(
            "usercod"      => "",
            "useremail"    => "",
            "username"     => "",
            "userpswd"     => "",
            "userfching"   => "",
            "userpswdest"  => "",
            "userpswdexp"  => "",
            "userest"      => "",
            "useractcod"   => "",
            "userpswdchg"  => "",
            "usertipo"     => "",
        );
    }

    static public function getFeature($fncod)
    {
        $sqlstr = "SELECT * from funciones where fncod=:fncod;";
        $featuresList = self::obtenerRegistros($sqlstr, array("fncod"=>$fncod));
        return count($featuresList) > 0;
    }

    static public function addNewFeature($fncod, $fndsc, $fnest, $fntyp )
    {
        $sqlins = "INSERT INTO `funciones` (`fncod`, `fndsc`, `fnest`, `fntyp`)
            VALUES (:fncod , :fndsc , :fnest , :fntyp );";

        return self::executeNonQuery(
            $sqlins,
            array(
                "fncod" => $fncod,
                "fndsc" => $fndsc,
                "fnest" => $fnest,
                "fntyp" => $fntyp
            )
        );
    }

    static public function getFeatureByUsuario($userCod, $fncod)
    {
        $sqlstr = "select * from
        funciones_roles a inner join roles_usuarios b on a.rolescod = b.rolescod
        where a.fnrolest = 'ACT' and b.roleuserest='ACT' and b.usercod=:usercod
        and a.fncod=:fncod limit 1;";
        $resultados = self::obtenerRegistros(
            $sqlstr,
            array(
                "usercod"=> $userCod,
                "fncod" => $fncod
            )
        );
        return count($resultados) > 0;
    }

    static public function getRol($rolescod)
    {
        $sqlstr = "SELECT * from roles where rolescod=:rolescod;";
        $featuresList = self::obtenerRegistros($sqlstr, array("rolescod" => $rolescod));
        return count($featuresList) > 0;
    }

    static public function addNewRol($rolescod, $rolesdsc, $rolesest)
    {
        $sqlins = "INSERT INTO `roles` (`rolescod`, `rolesdsc`, `rolesest`)
        VALUES (:rolescod, :rolesdsc, :rolesest);";

        return self::executeNonQuery(
            $sqlins,
            array(
                "rolescod" => $rolescod,
                "rolesdsc" => $rolesdsc,
                "rolesest" => $rolesest
            )
        );
    }

    static public function isUsuarioInRol($userCod, $rolescod)
    {
        $sqlstr = "select * from roles a inner join
        roles_usuarios b on a.rolescod = b.rolescod where a.rolesest = 'ACT'
        and b.usercod=:usercod and a.rolescod=:rolescod limit 1;";
        $resultados = self::obtenerRegistros(
            $sqlstr,
            array(
                "usercod" => $userCod,
                "rolescod" => $rolescod
            )
        );
        return count($resultados) > 0;
    }

    static public function getRolesByUsuario($userCod)
    {
        $sqlstr = "select * from roles a inner join
        roles_usuarios b on a.rolescod = b.rolescod where a.rolesest = 'ACT'
        and b.usercod=:usercod;";
        $resultados = self::obtenerRegistros(
            $sqlstr,
            array(
                "usercod" => $userCod
            )
        );
        return $resultados;
    }

    static public function removeRolFromUser($userCod, $rolescod)
    {
        $sqldel = "UPDATE roles_usuarios set roleuserest='INA' 
        where rolescod=:rolescod and usercod=:usercod;";
        return self::executeNonQuery(
            $sqldel,
            array("rolescod"=>$rolescod, "usercod"=>$userCod)
        );
    }

    static public function removeFeatureFromRol($fncod, $rolescod)
    {
        $sqldel = "UPDATE funciones_roles set roleuserest='INA'
        where fncod=:fncod and rolescod=:rolescod;";
        return self::executeNonQuery(
            $sqldel,
            array("fncod" => $fncod, "rolescod" => $rolescod)
        );
    }
    static public function getUnAssignedFeatures($rolescod)
    {
        
    }
    static public function getUnAssignedRoles($userCod)
    {

    }
    private function __construct()
    {
    }
    private function __clone()
    {
    }
}


?>
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
