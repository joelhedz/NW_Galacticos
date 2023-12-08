<<<<<<< HEAD
<?php

namespace Controllers;

class Error extends PublicController
{
    public function run() :void
    {
        $layout = "layout.view.tpl";

        if(\Utilities\Security::isLogged())
        {
            $layout = "privatelayout.view.tpl";
            \Utilities\Nav::setNavContext();
        }

        http_response_code(400);
        \Views\Renderer::render(
            "error",
            array("page_title"=>"¡No se encuentra el recurso solicitado!"),
            $layout
        );
    }
}


?>
=======
<?php

namespace Controllers;

class Error extends PublicController
{
    public function run(): void
    {
        $error_code = \Utilities\Context::getContextByKey("ERROR_CODE");
        $error_code = $error_code === "" ? 404 : $error_code;
        $error_msg = "Ocurrió algo inesperado";
        switch ($error_code) {
            case 404:
                $error_msg = "No se encuentra el recurso solicitado.";
                break;
            case $error_code >= 500:
                $error_msg = "Algo inesperado ocurrio en nuestro servicio.";
                break;
        }
        http_response_code($error_code);
        \Views\Renderer::render(
            "error",
            [
                "CLIENT_ERROR_CODE" => $error_code,
                "CLIENT_ERROR_MSG" => $error_msg
            ]
        );
    }
}
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
