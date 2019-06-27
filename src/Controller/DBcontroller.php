<?php

namespace Drupal\revise\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\revise\service\HelloServices;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;


class DBController extends ControllerBase
{
private $helloGenerator;

public function __construct(HelloServices $x) {
    $this->helloGenerator = $x;
}
public function say() {
    $hello = $this->helloGenerator->sayHello('pallavi');

    return new Response($hello);
}

public static function create(ContainerInterface $container) {
    $x = $container->get('revise.say_hello');
    return new static ($x);
}
}