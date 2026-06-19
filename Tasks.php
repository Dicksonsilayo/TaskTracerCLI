<?php

class TaskTracker{
    private $file = "tasks.json";
public function __construct()
{
  if(!file_exists($this->file)){
    file_put_contents($this->file,json_encode([],JSON_PRETTY_PRINT));


  } 

}
private function readTasks(){
    $data=file_get_contents($this->file);
    return json_decode($data,true);
}
private function saveTasks($tasks){
    file_put_contents($this->file,json_encode($tasks,JSON_PRETTY_PRINT));
}


private function getNextId($tasks){
    if(empty($tasks))
    {
        return 1;

    }
        $ids = array_column($tasks, 'id');

    if (empty($ids)) {
        return 1;
    }

    return max(array_column($tasks,'id'))+1;


}



public function add($description){
    $tasks=$this->readTasks();

    $task=[
    "id" => $this->getNextId($tasks),
    "description"=> $description,
    "status"=>"to do",
    "created_at"=>date("y-m-d H:i:s"),
    "updated_at"=>date("y-m-d H:i:s")

    ];
    $tasks[]=$task;
    $this->saveTasks($tasks);
  echo "Task added successfully (ID: {$task['id']})\n";


 }
public function update($id,$description){
    $tasks=$this->readTasks();
    foreach($tasks as &$task){
        if($task['id']==$id){
            $task['description']=$description;
            $task['udated_at']=date("Y-m-d H:i:s");
            $this->saveTasks($tasks);
              echo "Task updated successfully (ID: {$task['id']})\n";
              return;
        }
    }
   echo "task with id {$id} not found ";

}
 public function delete($id){

       $tasks=$this->readTasks();
       foreach($tasks as $key=>$task){
        if($task['id']==$id){
            unset($tasks[$key]);
            $this->saveTasks(array_values($tasks));
            echo "task with id {$id} has been deleted successfully\n\n";
            return;
        }
       }
    }
  public function markAsInProgress($id,$status){
$tasks=$this->readTasks();
foreach($tasks as &$task){
    if($task['id']==$id){
        $task['status']='in progress';
        $task['updated_at']=date("Y-m-d H:i:s");
        $this->saveTasks(array_values($tasks));
            echo "task with id {$id} is now in progress\n\n";
            return;
    }
}
  }
public function markDone($id)
{
    $tasks = $this->readTasks();

    foreach ($tasks as &$task) {

        if ($task['id'] == $id) {

            $task['status'] = "done";
            $task['updated_at'] = date("Y-m-d H:i:s");

            $this->saveTasks($tasks);

            echo "Task with ID {$id} is marked as done.\n";
            return;
        }
    }

    echo "Task with ID {$id} not found.\n";
}
    }

    



  $tracker= new TaskTracker();
  $command= $argv[1] ?? null;
  switch("$command"){
    case "add":
              if (!isset($argv[2])) {
            echo "Usage: php task.php add \"Task Description\"\n";
            exit;
        }
        $tracker->add($argv[2]);
        break;
         case "update":
        if (!isset($argv[2], $argv[3])) {
            echo "Usage: php task.php update ID \"New Description\"\n";
            exit;
        }
        $tracker->update($argv[2], $argv[3]);
        break;

    case "delete":
        if (!isset($argv[2])) {
            echo "Usage: php task.php delete ID\n";
            exit;
        }
        $tracker->delete($argv[2]);
        break;
        case "startTask":
                $tracker->markAsInProgress($argv[2], $argv[3]);
        break;
        case "finishTask":
            $tracker->markDone($argv[2]);

    default:
        echo "\nTask Tracker Commands:\n\n";
  }
?>