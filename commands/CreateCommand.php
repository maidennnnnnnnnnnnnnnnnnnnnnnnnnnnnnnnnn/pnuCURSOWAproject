<?php

require_once __DIR__ . '/BaseCommand.php';

class CreateCommand extends BaseCommand {

    public function execute(array $args) {
        $name = array_shift($args);
        if (str_ends_with($name, '/')) {
            $folderName = rtrim($name, '/');
            FileSystem::getInstance()->createFolder($folderName);
        } else {
            FileSystem::getInstance()->createFile($name);
        }
    }
}