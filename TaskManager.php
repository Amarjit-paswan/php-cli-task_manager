<?php 
class Task{

    //Declare public properties for each task
    public $id;
    public $description;
    public $status;
    public $createdAt;
    public $updatedAt;


    //Constructor to intialize task
    public function __construct($id,$description,$status,$createdAt,$updatedAt)
    {
        $this->id = $id;
        $this->description = $description;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;

    }

   
}

// Task Manager Class
class TaskManager{

    //Files where tasks are saved
    private $file = 'tasks.json';

    //Array to hold all task objects
    private $tasks = [];

    //Constructor : Loads tasks json file into memory
    public function __construct()
    {
        //Check file exists
        if(file_exists($this->file)){
            
            //fetch content form json file
            $json = file_get_contents($this->file);

            $this->tasks = json_decode($json,true);
            $this->tasks = array_map(function($task){
                return new Task(...$task);
            },$this->tasks);
        }
    }

    //Add a new task
    public function addTask($description){
        $id = count($this->tasks) + 1;
        $date = date('Y-m-d H:i:s');
        $task = new Task($id,$description,'todo',$date,$date);
        $this->tasks[] = $task;
        $this->saveTask();

        echo "Task added successfully";
    }

    //Delete a Task by its Id
    public function deleteTask($id){
        foreach($this->tasks as $key => $task){
            if($task->id == $id){
                unset($this->tasks[$key]);
                $this->saveTask();
                echo "Task Deleted Successfully";
                return true;
            }
            
        }
    }

    // Mark task as done by Id
    public function markDone($id){
        foreach($this->tasks as $key => $task){
            if($task->id == $id){
                $this->tasks[$key]->status = 'done';
                $this->tasks[$key]->updatedAt = date('Y-m-d H:i:s');
                $this->saveTask();
                echo "Task Updated Successfully";
                return true;
            }
        }
    }

    //Mark task as mark-in-progress by Id
    public function markProgress($id){
        foreach($this->tasks as $key => $task){
            if($task->id == $id){
                $this->tasks[$key]->status = "mark-in-progress";
                $this->tasks[$key]->updatedAt = date('Y-m-d H:i:s');
                $this->saveTask();
                echo "Task Status updated into progress Successfully";
                return true;
            }

        }
    }

    //List only that tasks that are marked as 'done'
    public function donelist(){
         echo "-------------------------------------------------------\n";
        echo " id | description | status | createdAt | updatedAt \n";
        echo "-------------------------------------------------------\n";

        foreach($this->tasks as $key => $task){
            if($task->status == 'done'){
                echo $task->id . " | ". $task->description. " | ". $task->status. " | ". $task->createdAt. " | ". $task->updatedAt . "\n";
            }
        }
        echo "-------------------------------------------------------";

    }
    //List only that tasks that are marked as 'mark-in-proress'
    public function inprogress_list(){
         echo "-------------------------------------------------------\n";
        echo " id | description | status | createdAt | updatedAt \n";
        echo "-------------------------------------------------------\n";

        foreach($this->tasks as $key => $task){
            if($task->status == 'mark-in-progress'){
                echo $task->id . " | ". $task->description. " | ". $task->status. " | ". $task->createdAt. " | ". $task->updatedAt . "\n";
            }
        }
        echo "-------------------------------------------------------";

    }

    //Update task description by its Id
    public function update($description,$id){
        foreach($this->tasks as $key => $task){
            if($task->id == $id){
                $this->tasks[$key]->description = $description;
                $this->tasks[$key]->updatedAt = date('Y-m-d H:i:s');
                $this->saveTask();

                echo "Task Updated Successfully";
            }
        }


    }

    //Show list of  Uncompleted task
    public function todolist(){
        echo "-------------------------------------------------------\n";
        echo " id | description | status | createdAt | updatedAt \n";
        echo "-------------------------------------------------------\n";

        foreach($this->tasks as $key => $task){
            if($task->status == 'todo'){
                  echo $task->id . " | ". $task->description. " | ". $task->status. " | ". $task->createdAt. " | ". $task->updatedAt . "\n";
            }
        }
        echo "-------------------------------------------------------";

    }

    //Show list of all tasks
    public function showlist(){
        echo "-------------------------------------------------------\n";
        echo " id | description | status | createdAt | updatedAt \n";
        echo "-------------------------------------------------------\n";

        foreach($this->tasks as $key => $task){
            echo $task->id . " | ". $task->description. " | ". $task->status. " | ". $task->createdAt. " | ". $task->updatedAt . "\n";
        }

        echo "-------------------------------------------------------";


    }

    //Save all tasks into JSON file
    public function saveTask(){
        $data = array_map(function($task){
            return [
                'id' => $task->id,
                'description' => $task->description,
                'status' => $task->status,
                'createdAt' => $task->createdAt,
                'updatedAt' => $task->updatedAt,
            ];
        },$this->tasks);

        $json = json_encode($data, JSON_PRETTY_PRINT);

        //Upload content into json file
        file_put_contents($this->file,$json);
    }
}



?>