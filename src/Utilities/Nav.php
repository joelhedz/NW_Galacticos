<<<<<<< HEAD
<?php

    namespace Utilities;


    class Nav
    {
        private function __construct()
        {
            
        }

        private function __clone()
        {
            
        }
        
        public static function setNavContext()
        {
            $adminNAVIGATION = array();
            $clientNAVIGATION = array();

            $userID = \Utilities\Security::getUserId();
            $usuario = \Dao\Security\Security::getUsuariobyId($userID);

            //TODA LA NAVEGACIÓN PARA EL O LOS ADMINS
            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\Admin")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_admin",
                    "nav_icon"=>"",
                    "nav_label"=>"Inicio"
                );
            }

            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\Usuarios")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_usuarios",
                    "nav_icon"=>"",
                    "nav_label"=>"Usuarios"
                );
            }
            
            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\RolesUsuarios")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_rolesusuarios",
                    "nav_icon"=>"",
                    "nav_label"=>"Roles para Usuarios Administrativos"
                );
            }

            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\Roles")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_roles",
                    "nav_icon"=>"",
                    "nav_label"=>"Roles Administrativos"
                );
            }

            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\FuncionesRoles")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_funcionesroles",
                    "nav_icon"=>"",
                    "nav_label"=>"Funciones para Roles Administrativos"
                );
            }
            
            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\Productos")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_productos",
                    "nav_icon"=>"",
                    "nav_label"=>"Catálogo de Productos"
                );
            }

            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\Pedidos")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_pedidos",
                    "nav_icon"=>"",
                    "nav_label"=>"Pedidos Pendientes"
                );
            }

            if (\Utilities\Security::isAuthorized($userID, "Controllers\Admin\Ventas")) 
            {
                $adminNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=admin_ventas",
                    "nav_icon"=>"",
                    "nav_label"=>"Historial de Ventas"
                );
            }

            //TODA LA NAVEGACIÓN PARA LOS CLIENTES

            if($usuario["UsuarioTipo"] === "PBL")
            {   
                $clientNAVIGATION[] = array(
                    "nav_url"=>"index.php",
                    "nav_icon"=>"fas fa-home mx-2",
                    "nav_label"=>"Inicio"
                );

                $clientNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=mnt_catalogo&PageIndex=1",
                    "nav_icon"=>"fas fa-list-alt mx-2",
                    "nav_label"=>"Productos"
                );

                $clientNAVIGATION[] = array(
                    "nav_url"=>"index.php?page=mnt_carrito",
                    "nav_icon"=>"fas fa-shopping-cart mx-2",
                    "nav_label"=>"Carrito"
                );
            }

            \Utilities\Context::setContext("ADMINNAVIGATION", $adminNAVIGATION);
            \Utilities\Context::setContext("CLIENTNAVIGATION", $clientNAVIGATION);
        } 

    }
?>
=======
<?php

namespace Utilities;

class Nav
{
    public static function setPublicNavContext()
    {
        $tmpNAVIGATION = Context::getContextByKey("PUBLIC_NAVIGATION");
        if ($tmpNAVIGATION === "") {
            $navigationData = self::getNavFromJson()["public"];
            $saveToSession = intval(Context::getContextByKey("DEVELOPMENT")) !== 1;
            Context::setContext("PUBLIC_NAVIGATION", $navigationData, $saveToSession);
        }
    }
    public static function setNavContext()
    {
        $tmpNAVIGATION = Context::getContextByKey("NAVIGATION");
        if ($tmpNAVIGATION === "") {
            $tmpNAVIGATION = [];
            $userID = Security::getUserId();
            $navigationData = self::getNavFromJson()["private"];
            foreach ($navigationData as $navEntry) {
                if (Security::isAuthorized($userID, $navEntry["id"], 'MNU')) {
                    $tmpNAVIGATION[] = $navEntry;
                }
            }
            $saveToSession = intval(Context::getContextByKey("DEVELOPMENT")) !== 1;
            Context::setContext("NAVIGATION", $tmpNAVIGATION, $saveToSession);
        }
    }

    public static function invalidateNavData()
    {
        Context::removeContextByKey("NAVIGATION_DATA");
        Context::removeContextByKey("NAVIGATION");
        Context::removeContextByKey("PUBLIC_NAVIGATION");
    }

    private static function getNavFromJson()
    {
        $jsonContent = Context::getContextByKey("NAVIGATION_DATA");
        if ($jsonContent === "") {
            $filePath = 'nav.config.json';
            if (!file_exists($filePath)) {
                throw new \Exception(sprintf('%s does not exist', $filePath));
            }
            if (!is_readable($filePath)) {
                throw new \Exception(sprintf('%s file is not readable', $filePath));
            }
            $jsonContent = file_get_contents($filePath);
            $saveToSession = intval(Context::getContextByKey("DEVELOPMENT")) !== 1;
            Context::setContext("NAVIGATION_DATA", $jsonContent, $saveToSession);
        }
        $jsonData = json_decode($jsonContent, true);
        return $jsonData;
    }

    private function __construct()
    {
    }
    private function __clone()
    {
    }
}
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
