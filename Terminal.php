<?php

require_once __DIR__ . '/FileSystem.php';
require_once __DIR__ . '/commands/CreateCommand.php';
require_once __DIR__ . '/commands/DeleteCommand.php';
require_once __DIR__ . '/commands/MoveCommand.php';
require_once __DIR__ . '/commands/EditCommand.php';
require_once __DIR__ . '/commands/ChangeDirectoryCommand.php';
require_once __DIR__ . '/commands/ShowCommand.php';
require_once __DIR__ . '/commands/HelpCommand.php';

$fileSystem = new FileSystem();

echo "Welcome to the simulated terminal!\n";
echo "Available commands: create, delete, move, edit, show, enter, help, exit\n";

$commands = [
    'create' => new CreateCommand(),
    'delete' => new DeleteCommand(),
    'move' => new MoveCommand(),
    'edit' => new EditCommand(),
    'help' => new HelpCommand(),
    'enter' => new ChangeDirectoryCommand(),
    'show' => new ShowCommand(),
    'exit' => new class extends BaseCommand {

        public function execute(array $args)
        {
            exit;
        }
    }
];

while (true) {
    echo "Terminal> ";
    $input = trim(fgets(STDIN));
    $parts = explode(' ', $input);

    $command = array_shift($parts);

    if(array_key_exists($command, $commands)){
        $commands[$command]->execute($parts);
    }else{
        echo "Unknown command: $command\n";
    }
}