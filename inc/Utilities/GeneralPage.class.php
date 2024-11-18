<?php

Class GeneralPage {

    static function header()    { ?>
        
        <html>

        <script
            src="https://code.jquery.com/jquery-3.7.0.js"
           
            integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
            crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="styles/testtrade.css" />
        <link rel="stylesheet" type="text/css" href="styles/testtradeGraph.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu%20Condensed">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Outfit">
        <title> Test Trader </title>
        
        <body>
        <div class="shell">
        
    <?php }

    static function footer()    { ?>
        
        <div class="footerSeparator"></div>
        <div>
    </body>
    <?php }

    static function nav()   { ?>
        
        <div class='navContainer'>
                <!-- <div class= 'navImg'> -->
                    
                <!-- </div> -->
                <img class='navImg' src='images/TestTrade.svg'>
                <div class="navBar">
                    <ul class="navBarElements">
                        <li><a href='View Stocks'>View Stocks</a></li>
                        <li><a href='Learn More'>Learn More</a></li>
                        <li><a href='Notes'>Notes</a></li>
                        <li><a href='signup.php'>Sign up</a></li>
                        <li><a href='login.php'>Login</a></li>
                    </ul>
                </div>
            </div>

    <?php }

    static function bodyBound() { ?>
        
        <!DOCTYPE html>
<html>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/testtrade.css" />
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Ubuntu%20Condensed">
          <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Montserrat">
    <body>
        
        
        <div class="shell">
            <!-- <img class='navImg' src='images/TestTrade.svg'>  -->
            <div class='navContainer'>
                <!-- <div class= 'navImg'> -->
                    
                <!-- </div> -->
                <img class='navImg' src='images/TestTrade.svg'>
                <div class="navBar">
                    <ul class="navBarElements">
                        <li><a href='View Stocks'>View Stocks</a></li>
                        <li><a href='Learn More'>Learn More</a></li>
                        <li><a href='Notes'>Notes</a></li>
                        <li><a href='signup.php'>Sign up</a></li>
                        <li><a href='login.php'>Login</a></li>
                    </ul>
                </div>
            </div>
            <div class="mainContent">
                <div class="descText left">
                    <h1>Start building your portfolio today</h1>
                    <p>Testtrade portfolios gives you the opportunity to test the 
                        waters of the market. You can simulate trade with your own 
                        portfolio as if you were a stock trader without any risk. 
                        It is perfect for beginner investors who don't yet have 
                        the confidence to trade, but want to experience it.</p>
                </div>
                <div class="descText right">
                    <h1>Analysis with Testcharts</h1>
                    <p>Testcharts is our own in-house developped charting tool. 
                        It allows you to analyze a multitide of stocks simultaneously 
                        in a variety of ways, to fit your investment needs. </p>
                </div>
            </div>
        </div>
    </body>
</html>
    <?php }

    
    static function signup($usernameExists, $usernameEntered, $user){ ?>

<script
            src="https://code.jquery.com/jquery-3.7.0.js"
           
            integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
            crossorigin="anonymous"></script>

            <script type="text/javascript">

$(document).ready(function(){

    // let usernameExists = 
    
    <?php if($usernameExists){ ?>
        let usernameEntered = <?php echo json_encode($usernameEntered);?>;
        console.log(usernameEntered);
        console.log("afteruser");
        $('#email').css("border-color","red");
        $('#email').val("lol");
        $('.signUpErrorText').text(usernameEntered);

<?php }?>
    // if(usernameExists){
        //set the style and other elements
    //     $('#email').css("border-color","red");
    
    // }

    // let userExists = document.body.dataset.usernameExists
    passwordSameOnce = false;
    let v = 0;
    $("#password").on('keyup', function(){
       
        $("#password").css("border-color","green")
        if($("#password").val() != $('#confirmPassword').val()){
            if(passwordSameOnce == true){
                $('#confirmPassword').css("border-color","red");
            }
            // $('#confirmPassword').css("border-color","red");
        } else {
            $('#confirmPassword').css("border-color","green");
            passwordSameOnce = true;
        }
    });

    $("#confirmPassword").on('keyup', function(){
        $("#password").css("border-color","green")
        if($("#password").val() != $('#confirmPassword').val()){
            $('#confirmPassword').css("border-color","red");
        } else {
            $('#confirmPassword').css("border-color","green");
            passwordSameOnce = true;
        }
    });
});
</script>
        <div class='separator'></div>
        <div id='contentGradient'>
        <div id='contentContainer'>
        <form action='signup.php' method="post">
            
            <div id='signUpContainer'>

            <div class="signUpItemContainer">
                <div class='signUpTitleContainer'>
                <p class="signUpTitleText">Sign up with</p>
                <p class="signUpTitleText signUpTitleBold">TESTTRADE</p>
                </div>
                
            </div>
            <div class="signUpItemContainer">
                <p class="signUpText">Email</p>
                <input name="email" class="signUpItems" type="text" id='email' required>
                <p class="signUpText signUpErrorText"></p>
            </div>
            
            <div class="signUpItemContainer">
                <p class="signUpText">Username</p>
                <input name="username" class="signUpItems" value="<?php echo $user->getUsername();?>" type="text" id='username' required >
            </div>
            <div class="signUpItemContainer">
                <p class="signUpText">Password</p>
                <input name="password" class="signUpItems" value="<?php echo $user->getPass();?>"type="text" id='password' required >
            </div>
            <div class="signUpItemContainer">
                <p class="signUpText">Confirm Password</p>
                <input name="confPass" class="signUpItems" value="<?php echo $user->getPass();?>"type="text" id='confirmPassword' required >
            </div>
            <div class="signUpItemContainer">
                <p class="signUpText">First Name</p>
                <input name="fn" class="signUpItems" value="<?php echo $user->getFirstName();?>" type="text" id='firstname' required >
            </div>
            <div class="signUpItemContainer">
                <p class="signUpText">Last Name</p>
                <input name="ln" class="signUpItems" value="<?php echo $user->getLastName();?>"type="text" id='lastname' required ></input>
            </div>
            <div class="signUpItemContainer">
                <p class="signUpText">Date of Birth</p>
                <input name="bday" class="signUpItems" value="<?php echo $user->getDateOfBirth();?>" type="date" id='DOfB' required>
            </div>
            <div class="signUpItemContainer">
            <input type="submit" class="signUpButton" value="Finish Account">
            </div>
            
        </div>
    
        </form>
        </div>
    </div>
        

    <?php }

    static function generalContainer($graph) { ?>
        
        <div class='separator'></div>
        <div id='contentGradient'>
        <div id='contentContainer'>

        <?php

        $graph->displayGraph();
        ?>
        <!-- <p>wtf</p> -->
        <!-- <p>Okay what</p> -->
        </div>
        </div>
    <?php } 

    static function login($error) { ?>


                <div class='separator'></div>
        <div id='contentGradient'>
        <div id='contentContainer'>
        <form action='login.php' method="get">
            
            <div id='signUpContainer'>

            <div class="signUpItemContainer">
                <div class='signUpTitleContainer'>
                <p class="signUpTitleText">Log in with</p>
                <p class="signUpTitleText signUpTitleBold">TESTTRADE</p>
                </div>
                
            </div>
            <div class="signUpItemContainer">
                <p class="signUpText">Email</p>
                <input name="email" class="signUpItems" type="text" id='email' required>
            </div>
            
            <div class="signUpItemContainer">
                <p class="signUpText">Password</p>
                <input name="pass" class="signUpItems" type="text" id='password' required >
            </div>
            <div class="signUpItemContainer">
            <input type="submit" class="signUpButton" value="Log In">
            <p class="signUpError"><?php echo $error?></p>
            </div>
            
        </div>
    
        </form>
        </div>
    </div>
    <?php }

    static function searchStock(){ ?>
        
        <div class='separator'></div>
        <div id='contentGradient'>
        <div id='contentContainer'>

        </div>
        </div>
    <?php }

    static function signUpDirect($option){ ?>
        <div class='separator'></div>
        <div id='contentGradient'>
        <div id='contentContainer'>
        <form action='signup.php' method="post">
            
            <div id='signUpContainer'>

            <div class="signUpItemContainer">
                <div class='signUpTitleContainer'>
                <p class="signUpTitleText">Your </p>
                <p class="signUpTitleText signUpTitleBold">TESTTRADE </p>
                <p class="signUpTitleText">  account</p>
                <p class="signUpTitleTextVar accountNameStyle"> <?php echo $option;?> </p>
                <p class="signUpTitleTextVar">has been created!</p>
                <p class="signUpTitleText">Log in </p>
                <a href="<?php $host = $_SERVER['HTTP_HOST']; echo "https://$host/mockstock/login.php";?>" class="signUpTitleText signUpTitleBold underline">HERE </a>
                </div>
               
            </div>
        </form>
        </div>
        </div>
    <?php }

}

?>