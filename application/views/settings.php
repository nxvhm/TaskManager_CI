<div class="content">
    <div class="header">
        <span>TASK MANAGER</span>
    </div>
    <!--//End Modal Form-->
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
    
    <div class="box2 floatRight width400">
        <div class="widthAuto dropDown rounded">
            <ul>
                <?php 
                    echo "<li>" . img(array('src'=>'application/views/resources/images/grid.png','width'=>'16')) . "Settings</li>";
                ?> 
            </ul>
            <br />
            
            <button id="addTask" class="smallLink">Add Task</button>

        </div>
    </div>

</div>


