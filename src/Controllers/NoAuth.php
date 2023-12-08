<<<<<<< HEAD
<?php
namespace Controllers;

class NoAuth extends PublicController
{
    public function run() :void
    {
        if (\Utilities\Security::isLogged())
        {
            \Utilities\Nav::setNavContext();
            if (\Utilities\Context::getContextByKey("PRIVATE_LAYOUT") !== "") 
            {
                \Views\Renderer::render(
                    "noauth",
                    array(),
                    \Utilities\Context::getContextByKey("PRIVATE_LAYOUT")
                );
            } 
            else 
            {
                \Views\Renderer::render("noauth", array());
            }
        } 
        else 
        {
            \Views\Renderer::render("noauth", array());
        }
    }
}
?>
=======
<?php
namespace Controllers;

class NoAuth extends PublicController
{
    public function run() :void
    {
        if (\Utilities\Security::isLogged()){
            if (\Utilities\Context::getContextByKey("PRIVATE_LAYOUT") !== "") {
                \Views\Renderer::render(
                    "noauth",
                    array(),
                    \Utilities\Context::getContextByKey("PRIVATE_LAYOUT")
                );
            } else {
                \Views\Renderer::render("noauth", array());
            }
        } else {
            \Views\Renderer::render("noauth", array());
        }
    }
}
?>
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
