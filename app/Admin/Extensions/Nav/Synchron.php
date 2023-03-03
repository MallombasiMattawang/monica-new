<?php

namespace App\Admin\Extensions\Nav;

class Synchron
{
    public function __toString()
    {
        return <<<HTML
<li>
                    <a href="#" class="bg-purple"><i class="fa fa-cogs"></i> Synchronize </a>
                </li>

HTML;
    }
}
