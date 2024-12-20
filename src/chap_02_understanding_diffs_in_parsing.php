<?php

$bar = 'baz';

$foo = new class
{
    public function __construct()
    {
        $this->baz = ['bada' => function () {
            return 'boom';
        }];
    }
};

// PHP 5: $foo->{$bar['bada']}()
// PHP 7: ($foo->$bar)['bada']()
echo $foo->$bar['bada']();
// boom