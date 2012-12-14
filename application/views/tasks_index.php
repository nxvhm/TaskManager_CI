<div class="content">
    <div class="header">
        <span>TASKMANAGER</span>
    </div>
    <blockquote class="box rounded marginAuto">
        sign in <br />
        <!--Render Login Form-->
        <?php
        echo validation_errors();
        
            $attr = array('class'=>'silver', 'id'=>'loginForm');    //Attributes for form
            $userAttr = array(
                'name'=>'username',
                'value'=>'Username',
                'size'=>'28',
                'maxlength'=>'16',
                'class'=>'rounded',
            );
            $passAttr = array(
                'name'=>'password',
                'value'=>'Password',
                'size'=>'28',
                'maxlength'=>'16',
                'class'=>'rounded',
            );
            $buttonAttr = array(
                'class'=>'button1 rounded',
                'name'=>'submit',
                'type'=>'submit',
                'content'=>'login',
            );
            echo form_open('login', $attr);
            echo form_input($userAttr);
            echo form_password($passAttr);
            echo form_button($buttonAttr) . '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
           // echo form_label('Sign Up',array('class'=>'link', 'name'=>'signup'))
            echo anchor('register', 'Create Account',array('class'=>'button2 rounded'));
            echo form_close();
        ?>
        <!--//Render Login Form-->
    </blockquote>
</div>


