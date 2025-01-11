<?php

require_once __DIR__ . '/BaseCommand.php';

class ShowCommand extends BaseCommand
{
    public function execute(array $args)
    {
        $name = array_shift($args);
        FileSystem::getInstance()->show($name);
    }

}