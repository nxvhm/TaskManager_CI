<div class="content">
    <div class="header">
        <span>TASKMANAGER</span>
    </div>
    <blockquote class="box rounded marginAuto">
        <span>Sign In</span> <br />
        <!--Render Login Form-->
        <?php
        
            $attr = array('class'=>'silver', 'id'=>'registerForm');    //Attributes for form
            
            $userAttr = array(
                'name'=>'username',
                'size'=>'28',
                'maxlength'=>'16',
                'class'=>'rounded',
            );
            $passAttr = array(
                'name'=>'password',
                'size'=>'28',
                'maxlength'=>'16',
                'class'=>'rounded',
            );
            $buttonAttr = array(
                'class'=>'button1 rounded',
                'name'=>'submit',
                'type'=>'submit',
                'content'=>'Login',
            );
            echo form_open('login', $attr);
            
            echo form_label('Username', 'username');
            echo form_input($userAttr);
            echo form_error('username'); // show an error message next to each form field,
            
            echo form_label('Password', 'password');
            echo form_password($passAttr);
            echo form_error('password');
            echo form_button($buttonAttr);
            echo '&nbsp;&nbsp;'.anchor('register', 'Create Account',array('class'=>'button2 rounded'));

            echo form_close();
        ?>
        <!--//Render Login Form-->
    </blockquote>
    <br />
    <div class="message2 rounded">
        
            <span class="ui-icon ui-icon-info floatLeft"></span>
            <p>
                <span style="border-bottom: 1px dashed white">
                    Demo user: demouser,pass: demo
                </span>
            </p>
            
        
    </div>
</div>


