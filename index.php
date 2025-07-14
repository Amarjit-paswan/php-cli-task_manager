<?php 

//----------------------------
// Load TaskManager class file
//----------------------------
require 'TaskManager.php';

//------------------------------
// Create TaskManager instance
//-----------------------------
$taskManager = new TaskManager();

//-----------------------------
// Check user passed a command
//-----------------------------
if(count($argv) > 1){

    // Get the command e.g (add, delete, list etc.)
    $command = $argv[1];

    //----------------------------
    // Switch based on command
    //----------------------------
    switch($command){

        // Add a new task
        case 'add':
            // Usage: php index.php add "Buy milk"
            $taskManager->addTask($argv[2]);
        break;

        // Delete a task by Id
        case 'delete':
            // Usage: php index.php delete 1
            $taskManager->deleteTask($argv[2]);
        break;

        // Mark task as done by Id
        case 'mark-done':
            // Usage: php index.php mark-done 1
            $taskManager->markDone($argv[2]);
        break;

        // Update a task description by its Id
        case 'update':
            // Usage: php index.php update "remove milk" 1
            $taskManager->update($argv[2],$argv[3]);
        break;

        // Show all lists
        case 'list':
            // Usage: php index.php list
            $taskManager->showlist();
        break;

        // Mark task as 'mark-in-progress' by Id
        case 'mark-in-progress':
            // Usage: php index.php mark-in-progress 1
            $taskManager->markProgress($argv[2]);
        break;

        // Show only completed tasks
        case 'done-list':
            //Usage: php index.php donelist
            $taskManager->donelist();
        break;

        // Show only uncompleted tasks
        case 'todo-list':
            // Usage: php index.php list todo
            $taskManager->todolist();
        break;

        // Show only progress tasks
        case 'in-progress-list':
            // Usage: php index.php in-progress-list 
            $taskManager->inprogress_list();
        break;

        //Handle unknown command
        default:
            echo "no command";
    }
}else{
    // No command provided
    echo "no arguments";
}


?>