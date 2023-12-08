<<<<<<< HEAD
<?php

namespace Controllers\Checkout;

use Controllers\PublicController;
class Error extends PublicController
{
    public function run(): void
    {
        \Utilities\Site::redirectToWithMsg("index.php", "¡Transacción Cancelada!");
    }
}

?>
=======
<?php

namespace Controllers\Checkout;

use Controllers\PublicController;
class Error extends PublicController
{
    public function run(): void
    {
        echo "error";
        die();
    }
}

?>
>>>>>>> c683039474f8ccfd4d0b6db41ed7907aa48490eb
