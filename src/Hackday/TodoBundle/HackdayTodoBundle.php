<?php

namespace Hackday\TodoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HackdayTodoBundle extends Bundle
{
    public function getParent()
    {
        return "HackdayScaffoldBundle";
    }

}
