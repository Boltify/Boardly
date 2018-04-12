<?php include_once ('app/dbconnect.php'); ?>
<?php include_once ('app/functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $siteName ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css">
</head>
<body>

<div class="header">
    <ul>
        <li><a href="#">Notifications</a></li>
        <li><a href="#">Calendar</a></li>
        <li><a href="#">Timeline</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">jack.bauer@gmail.com <i class="fas fa-angle-down"></i></a>
                <div class="dropdown-content">
                    <a href="#" onclick="document.getElementById('help').style.display='block'">Help</a>
                    <a href="#" onclick="document.getElementById('my-boards').style.display='block'">My boards</a>
                    <a href="#">My team</a>
                    <a href="#">Profile</a>
                    <a href="#">Settings</a>
                    <a href="#">Logout</a>
                </div>
        </li>
    </ul>
</div>
    


<div class="container">
    <div class="actionbar">
	   <button class="button button-dark">New task</button> <button class="button button-light">Filter by status</button> <button class="button button-light">Filter by user</button>
    </div>
</div>

<div class="backdrop">

</div>
    
<div class="container-flex">

<?php
    
    // Retrieve the phases
    $sql = ("SELECT * FROM boardly_phases WHERE board_id = '4'");
        foreach ($db->query($sql) as $row) {
            
            $phaseId = $row[id];

            echo "<div class='column'>";
                echo "<div class='column-phase'><h3>". $row[name] ."</h3>";

                // Retrieve the tasks for each phase
                $sql = ("SELECT * FROM boardly_tasks WHERE phase_id = '$phaseId'");
                    foreach ($db->query($sql) as $row) {
                        
                         $taskId = $row[id];

                        echo "<div class='task priority-". $row[priority] ."' onclick='document.getElementById('4').style.display='block''>
                                 <div class='task-header'>
                                    <p>". $row[title] ."</p>
                                 </div>
                                 <div class='task-footer'>";
                        
                                     $avatar = $db->query("SELECT avatar FROM boardly_users WHERE id = ". $row[assigned_to_id] ."")->fetchColumn();
                                    
                                    echo "<img src='img/". $avatar .".svg'> <span class='task-footer-date'>".  date('j M, Y', strtotime($row['duedate'])) ."</span>
                                 </div>
                              </div>";
                    }

                echo "</div>";
            echo "</div>";   
        }
?>
</div>


<!-- modal Help -->
<div id="help" class="modal">
    <div class="modal-container">
        <div class="modal-column">
            <i class="fas fa-times modal-display-top-right" style="padding: 8px 10px; cursor: pointer;" onclick="document.getElementById('help').style.display='none'"></i>

            <p>This is a test</p>
        </div>
    </div>
    <div class="modal-container">
        <button class="button button-light" onclick="document.getElementById('help').style.display='none'">Cancel</button>
    </div>
</div>
    
<!-- modal My-boards -->
<div id="my-boards" class="modal">
    <div class="modal-container">
        <div class="modal-column">
            <i class="fas fa-times modal-display-top-right" style="padding: 8px 10px; cursor: pointer;" onclick="document.getElementById('my-boards').style.display='none'"></i>
            
            <?php
            echo "<label>My boards</label>";    
                $sql = ("SELECT * FROM boardly_boards WHERE owner_id = '2'");
                foreach ($db->query($sql) as $row) {
                    
                    echo "<input type='text' placeholder='". $row[name] ."'>";
                }
            ?>
            
        </div>
    </div>
    <div class="modal-container">
        <button class="button button-light" onclick="document.getElementById('my-boards').style.display='none'">Cancel</button>
    </div>
</div>
    

<!-- modal general -->
<div id="4" class='modal'>
        <div class='modal-container'>
            <div class='modal-column'>
                <label>Name</label>
                <input type='text' placeholder='Actionplan'>

                <label>Created by</label>
                <input type='text' placeholder='Jack'>

                <label>Description</label>
                <textarea rows='12' cols='50'>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. </textarea>          
            </div>
            <div class='modal-column'>
                <i class='fas fa-times modal-display-top-right' style='padding: 8px 10px; cursor: pointer;' onclick='document.getElementById('id01').style.display='none''></i>

                 <label>Due date</label>
                <input type='text' placeholder='12 apr, 2018'>

                <label>Select status</label>
                <select>
                  <option value='volvo'>Planned</option>
                  <option value='saab'>Issue</option>
                  <option value='mercedes'>Postponed</option>
                  <option value='audi'>Completed</option>
                </select>  

                <label>Select phase</label>
                <select>
                  <option value='volvo'>New request</option>
                  <option value='saab'>Approved</option>
                  <option value='mercedes'>In progress</option>
                  <option value='audi'>Review</option>
                  <option value='audi'>Completed</option>
                </select>
            </div>

        </div>
        <div class='modal-container'>
            <button class='button button-dark'>Save</button> <button class='button button-light' onclick='document.getElementById('id01').style.display='none''>Cancel</button>
        </div>
    </div>


<div class="container">
    <div class="footer">
        <p>Copyright &copy; 2018 Boardly Inc.</p> 
    </div>
</div>


    
<!-- <script type="text/javascript" src="js/modal.js"></script> -->
     
</body>
</html> 

