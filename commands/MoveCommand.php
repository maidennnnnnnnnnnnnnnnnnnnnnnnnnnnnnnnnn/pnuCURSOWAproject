<?php

require_once __DIR__ . '/BaseCommand.php';

class MoveCommand extends BaseCommand {
    public function execute(array $args) {
        $name = array_shift($args);
        $newPath = array_shift($args);
        FileSystem::getInstance()->move($name, $newPath);
    }
}