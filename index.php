<!DOCTYPE html>

<?php

$ini = parse_ini_file('app.ini');
$fare = $ini['fare'];
$starttime = $ini['start_time'];
$maxcount = $ini['max_count'];
$closed = $ini['closed'];

if ($closed === "1")
{
    header('Location: closed.php');
    exit;
    
}

include 'db.php';


session_start();
$_SESSION['save'] = true;

date_default_timezone_set("Asia/Tokyo");
$currtime = date("YmdHis"); 

$starttime = str_replace(' ', '', $starttime);

 if ((int)$currtime < (int)$starttime)
 {
    header('Location: wait.php');
    exit;
 }
 
 
 //waitlist automation
 $sqlout = $conn->query("SELECT count(*) FROM `raindropsbooking` WHERE cancelled = 0 and waitlist = 0");
$row = mysqli_fetch_row($sqlout);
$totalcount = $row[0] ;

$showwait = ($totalcount>=$maxcount)?1:0;
$conn->close();
?>
<html>
    <head>
        <link rel="stylesheet" href="chess.css">        
        <title>Chess Club (Raindrops)</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    </head>
    <body>
        <br>
        <div class="container-fluid bg-dark"><br>
            <div class="dataentry">
            <h1 class="text-primary">Chess Club (Raindrops)</h1>
            <h2 class="text-primary" >Please enter the details</h2>
            <hr class="text-light">
            <?php
                if ($showwait===1)
                {
                echo '<h3><span style="border: 1px solid black; padding: 10px;background-color: yellow;">We have reached the maximum limit. We are accepting entries for Waitlist. 
                Waitlist will be confirmed against cancellations.<br> </span></h3>';
                }
            ?>
                <form action="process_reservation.php" method="post">
                    <label for="childname"  class="labelleftmargin">Full name</label>
                    <input type="text" id="childname" name="childname" minlength="3" maxlength="45" class="ss" required >
                    <label class="labelinfo">Enter the name of the child </label>
                    <div class="fieldlinebreak"><br></div>

                    <label for="gender"  class="labelleftmargin">Gender</label>
                    <input name="gender" type="radio" id="gender" value="M" checked=checked"/> <label>Male</label>
                    <input name="gender" type="radio" id="gender" value="F" />  <label>Female</label>
                    <label class="labelinfo"></label>
                    <div class="fieldlinebreak"><br></div>

                    <label for="dateofbirth"  class="labelleftmargin">Date of Birth</label>
                    <input type="date" id="dateofbirth" name="dateofbirth" required >
                    <label class="labelinfo"></label>
                    <div class="fieldlinebreak"><br></div>

                    <br>
                    <label for="parentname"  class="labelleftmargin">Parent name</label>
                    <input type="text" id="parentname" name="parentname" minlength="3" maxlength="45" required >
                    <label class="labelinfo">Enter the name of Parent</label>
                    <div class="fieldlinebreak"><br></div>

                    <label for="email" class="labelleftmargin">Email</label>
                    <input type="email" id="email" name="email" minlength="10" maxlength="100" required>
                    <label class="labelinfo">Enter an valid email of parent.</label>
                    <div class="fieldlinebreak"><br></div>
                    
                    <label for="email" class="labelleftmargin">Confirm Email</label>
                    <input type="email" id="emailconfirm" name="emailconfirm" minlength="10" maxlength="100" onpaste="return false;" required>
                    <div class="fieldlinebreak"><br></div>
                    
                    <label for="phone" class="labelleftmargin">Phone number</label>
                    <input type="text" id="phone" name="phone" required maxlength="20">
                    <label class="labelinfo">Phone number of parent.</label>
                    <div class="fieldlinebreak"><br></div>

            
                    <div class="fieldlinebreak"><br></div>
            
                    <input type="hidden" name="waitlist" value="<?php echo $showwait; ?>">
                    <input type="submit" onclick="return validate();" value="Save" id="btnSave" class="buttonleftmargin btn btn-primary">  
                    <hr class="text-light">
                    <br>
                    <span class="text-light">
                        <p>
                        Age : 5 to 12<br>
                        Time: Every Thursday 7 to 8 pm<br> 
                        Location: Ojima 4-1-1-103 , Nishi Ojima Danchi (RAINDROPS)<br>
                        Start Date:  11th Dec <br>
                        <br>
                        Chess board will be provided.<br>

                        <br>
                        <span class="chessinfo">
                        Chess is more than just a game — it’s a fun workout for the mind! When children learn chess, they develop sharper memory, better concentration, and powerful problem-solving skills. Every move teaches patience, planning, and the confidence to make decisions.<br>
                        Whether your child is a beginner or already curious, chess builds creativity and strategic thinking in a playful and exciting way. With each game, kids learn to think ahead, stay calm under pressure, and celebrate both winning and learning.
                        </span>
                    </span>
                </form>        
            </div>
        </div>
        
    </body> 
    
    <script>
    
        function validate(){
            let e1 = document.getElementById("email").value;
            let e2 = document.getElementById("emailconfirm").value;
            if(e1 !== e2){
                alert("email not matching");
                return false;
            }

        }
    
 </script>
    
</html>