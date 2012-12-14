<div class="content">
    <div class="header">
        <span>TASK MANAGER</span>
    </div>
    <!--Include Hourpicker-->
    <script type="text/javascript" src="<?php echo base_url().'application/views/resources/js/jquery-ui-timepicker-addon.js';?>" ></script> 
    <script type="text/javascript">
$(function() {
		var     name = $( "#name" ),
			hour = $( "#hour" ),
			date = $( "#date" ),
                        note = $("#note"),
			allFields = $( [] ).add( name ).add( hour ).add( date ).add( note ),
			tips = $( ".validateTips" );
                //Add Datepicker
                date.datepicker();
                //Add Hourpicker
                hour.timepicker({
                    controlType: 'select',
                    timeFormat: 'hh:mm tt'
                });
                
                $("form").submit(function(){
                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );

                    bValid = bValid && checkLength( name, "name", 3, 16 );
                    bValid = bValid && checkLength( hour, "hour", 6, 80 );
                    bValid = bValid && checkLength( date, "date", 2, 10 );

                    if ( bValid ) {
                            $( "#result" ).append( "<tr>" +
                                    "<td>" + name.val() + "</td>" + 
                                    "<td>" + email.val() + "</td>" + 
                                    "<td>" + password.val() + "</td>" +
                            "</tr>" ); 

                    }else{
                        return false;
                    } 
                });

                //Add new task Dialog    
		$( "#dialogForm" ).dialog({
			autoOpen: false,
			height: 420,
			width: 330,
			modal: true,
			close: function() {
			}
		});
                
                $("#addTask").button({
                    icons:{primary: "ui-icon-circle-plus"}
                });
                $("#completedTasks").button({
                    icons:{primary: "ui-icon-check"}
                })
                
		$("#addTask")
			.button()
			.click(function() {
				$( "#dialogForm" ).dialog( "open" );
			});
                        
                //Remove Task
                $("#dialogConfirm").dialog({
                    autoOpen: false,
                    modal: true
                })
                
                $(".deleteButton").click(function(e){
                   e.preventDefault();
                   var targetUrl = $(this).attr('href');

                   
                    $("#dialogConfirm").dialog({
                      buttons : {
                        "Yes" : function() {
                          window.location.href = targetUrl;
                        },
                        "No" : function() {
                          $(this).dialog("close");
                        }
                      }
                    });
                   $("#dialogConfirm").dialog("open");
                   
                });
                //Mark Task As read
                $("#completeTask").click(function(e){
                    e.preventDefault();
                    var targetUrl = $(this).attr('href');
                    
                    $.get(targetUrl);
                    $(this).parent().fadeOut('slow');
                });
                
                //Tooltips
                $('.extra').tooltip();
                
                //Task Content drop down
                $(".tasks .item .note").hide();
                $(".item").click(function(){
                     $('.note',this).slideToggle(300);
                })
	});
    </script>   
    
    <!--Remove Task Modal Confirmation-->
    <div id="dialogConfirm" title="Delete Task ?">
        <p>
            <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            Are you sure you want to delete this task ?
        </p>
    </div>
    
    <!--Add Task Modal Form-->
    <div id="dialogForm" title="Add new task">

            <form method="post" action="tasks/create">

                            <p>
                                    Name<br />
                                    <input type="text" size="32" name="name" id="name"/>
                            </p>

                            <p>
                                    Hour<br />
                                    <input type="text" size="32" name="hour" id="hour"/>
                            </p>

                            <p>
                                    Date<br />
                                    <input type="text" size="32" name="date" id="date"/>
                            </p>

                            <p>
                                    Note<br />
                                    <textarea rows="5" cols="30"  name="note" id="note"></textarea>
                            </p>
                                    <button type="submit" id="submitTask">Add task</button>

            </form>

    </div>
    <!--//End Modal Form-->
    
    <!--User Menu-->
    <div class="floatLeft">
        <div class="dropDown rounded">
            <ul>
                <li>Welcome, <?php print $this->session->userdata('username'); ?></li>
                <li>
                    <?php
                        echo anchor('Profile',
                                    img(array(
                                        'src'=>base_url('application/views/resources/images/agent.png'),
                                        'border'=>'0',
                                        'alt'=>'Profile')).'Profile'); 
                     ?>
                </li>
                <li>
                    <?php
                        echo anchor('Settings',
                            img(array(
                                'src'=>base_url('application/views/resources/images/configuration.png'),
                                'border'=>'0',
                                'alt'=>'Settings')).'Settings');
                    ?>
                </li>
                <li>
                    <?php
                        echo anchor('tasks',
                            img(array(
                                'src'=>base_url('application/views/resources/images/home.png'),
                                'border'=>'0',
                                'alt'=>'Sign out')).'Home');
                    ?>
                </li>
                <li>
                    <?php
                        echo anchor('logout',
                            img(array(
                                'src'=>base_url('application/views/resources/images/shut-down.png'),
                                'border'=>'0',
                                'alt'=>'Sign out')).'Sign out');
                    ?>
                </li>
                
            </ul>
        </div>
    </div>
    <!--//End User Menu-->
    
    <!--Tasks CRUD-->
    <div class="box2 floatRight width400 ">
        <div class="tasks">
                <?php 
                    echo "<div class='item'>" . img(array('src'=>'application/views/resources/images/grid.png','width'=>'16')) . "Tasks Index</div>";
                    
                    foreach($tasks as $task){
                        echo "<div class='item'>";
                        //Task Name and Icon

                        echo    img(array(
                                'src'=>base_url('application/views/resources/images/task.png'),
                                'border'=>'0',
                                'alt'=>'task','width'=>'16')).$task->name;
                        //Delete Img Button
                        echo anchor('tasks/delete/id/'.$task->id,
                            img(array(
                                'src'=>base_url('application/views/resources/images/remove.png'),
                                'border'=>'0',
                                'alt'=>'remove task','class'=>'imgButton floatRight',)),array("class"=>"deleteButton"));
                        //Mark as done button
                        echo anchor('tasks/done/id/'.$task->id,
                            img(array(
                                'src'=>base_url('application/views/resources/images/tick.png'),
                                'border'=>'0',
                                'alt'=>'remove task','class'=>'imgButton floatRight')),array('id'=>'completeTask'));
                        echo "<span class='extra rounded' title='Finish time'>" . $task->hour .'&nbsp;'.$task->date . "</span><br />";
                        echo "<div class='note'>$task->content</div>";
                        echo "</div>";
                        
                    }
                ?> 
            <br />
            
            <button id="addTask" class="smallLink">Add Task</button>
            <a href="tasks/completed" id="completedTasks" class="smallLink">Completed</a>
            </div>
    </div>

    <!--//End Tasks CRUD-->

</div>


