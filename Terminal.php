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

while (true) {
    echo "Terminal> ";
    $input = trim(fgets(STDIN));
    $parts = explode(' ', $input);

    $command = $parts[0] ?? null;

    switch ($command) {
        case 'create':
            (new CreateCommand($fileSystem, $parts[1] ?? ''))->execute();
            break;

        case 'delete':
            (new DeleteCommand($fileSystem, $parts[1] ?? ''))->execute();
            break;

        case 'move':
            (new MoveCommand($fileSystem, $parts[1] ?? '', $parts[2] ?? '/'))->execute();
            break;

        case 'edit':
            (new EditCommand($fileSystem, $parts[1] ?? '', $parts[2] ?? ''))->execute();
            break;

        case 'show':
            (new ShowCommand($fileSystem, $parts[1] ?? ''))->execute();
            break;

        case 'enter':
            (new ChangeDirectoryCommand($fileSystem, $parts[1] ?? '/'))->execute();
            break;

        case 'exit':
            echo "Exiting terminal...\n";
            exit;

        case 'help':
            (new HelpCommand($fileSystem))->execute();
            break;

        default:
            echo "Unknown command: $command\n";
            break;
    }
}