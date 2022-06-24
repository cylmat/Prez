<?php

// https://afsy.fr/avent/2013/02-principes-stupid-solid-poo

interface UrlGeneratorInterface
{
    public function generate($name, $parameters = array());
    public function match($pathinfo);
    public function getRouteCollection();
}



/************************************************************************/

interface UrlGeneratorInterface
{
    public function generate($name, $parameters = array());
}

interface UrlMatcherInterface
{
    public function match($pathinfo);
}

interface RouterInterface extends UrlMatcherInterface, UrlGeneratorInterface
{
    public function getRouteCollection();
}
