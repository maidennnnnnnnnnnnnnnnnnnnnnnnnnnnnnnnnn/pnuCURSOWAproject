<?php

require_once __DIR__ . '/../FileSystem.php';

abstract class BaseCommand
{
    public abstract function execute(array $args);

}