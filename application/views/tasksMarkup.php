    <div class="box2 floatRight width400">
        <div class="widthAuto dropDown rounded">
            <ul>
                <?php 
                    echo "<li>" . img(array('src'=>'application/views/resources/images/grid.png','width'=>'16')) . "Tasks Index</li>";
                    
                    foreach($tasks as $task){
                        echo "<li>";
                        echo anchor('tasks/read/id/'.$task->id,
                            img(array(
                                'src'=>base_url('application/views/resources/images/task.png'),
                                'border'=>'0',
                                'alt'=>'task','width'=>'16')).$task->name);
                        echo anchor('tasks/delete/id/'.$task->id,
                            img(array(
                                'src'=>base_url('application/views/resources/images/remove.png'),
                                'border'=>'0',
                                'alt'=>'remove task','class'=>'imgButton floatRight',)),array("class"=>"deleteButton"));
                        
                        echo "</li>";
                    }
                ?> 
            </ul>
            <br />
            
            <button id="addTask" class="smallLink">Add Task</button>

        </div>
    </div>
