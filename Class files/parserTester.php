<?php

function __autoload($class)
{
	require_once $class . '.php';
}

print_r(urlParser::wikiParser());

?>