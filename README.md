# TaskTracerCLI 
# this is a challenge from https://roadmap.sh/projects/task-tracker

# i did the challenge in the repository https://github.com/Dicksonsilayo/TaskTracerCLI 

# this is commandline interface program that simulate a task tracker activity where user can do the following

# 1 adding new task 
# user can add a new task by typing the command 

php Tasks.php add "the name of the task"

# 2 updating task
php Tasks.php update "id to update" "the new description"

# 3 deleteing task
php Tasks.php delete "id to delete"

# 4 mark a task to in progress 
php Tasks.php startTask "id of the task"

# 5  mark task as done
php Tasks .php finishTask "id of the task to mark as done"

# 6 list all the tasks
php Tasks.php listAll

# 7 list all the tasks that are in progress
php Tasks.php listInProgress

# 8 list all the tasks that are done 
php Tasks.php listDone

# 9  list all the tasks that are not done
php Tasks.php listAllNotDone