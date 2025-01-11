<?php

require_once __DIR__ . '/BaseCommand.php';

class ChangeDirectoryCommand extends BaseCommand {
    public function execute(array $args): void
    {
        $path = array_shift($args);
        FileSystem::getInstance()->changeDirectory($path);
    }
}