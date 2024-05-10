<?php
require_once("config.php");
?>


<div class="row my-3">
    <div class="col-4">
        <h3>Add New Election</h3>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="election_topic" placeholder="Elction Topic" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="number" name="number_of_candidates" placeholder="No of Candidates" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="text" onfocus="this.type='Date'" name="starting_date" placeholder="Starting Date" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="text" onfocus="this.type='Date'" name="ending_date" placeholder="Ending Date" class="form-control" required />
            </div>
            <input type="submit" value="Add Elction" name="updateBtn" class="btn btn-success" />
        </form>
    </div>

<?php
if(isset($_POST['updateBtn']))
    {
        $election_topic = mysqli_real_escape_string($db, $_POST['election_topic']);
        $number_of_candidates = mysqli_real_escape_string($db, $_POST['number_of_candidates']);
        $starting_date = mysqli_real_escape_string($db, $_POST['starting_date']);
        $ending_date = mysqli_real_escape_string($db, $_POST['ending_date']);
        $inserted_by = $_SESSION['username'];
        $inserted_on = date("Y-m-d");


        $date1=date_create($inserted_on);
        $date2=date_create($starting_date);
        $diff=date_diff($date1,$date2);
        
        
        if((int)$diff->format("%R%a") > 0)
        {
            $status = "InActive";
        }else {
            $status = "Active";
        }

         $query = "UPDATE elections SET election_topic = '$election_topic', no_of_candidates = '$number_of_candidates', starting_date = '$starting_date', ending_date = '$ending_date' WHERE id = '$election_id'";
        if(mysqli_query($db, $query)) {
            // Redirect to the page where the list of elections is displayed
            header("Location: index.php");
            exit(); // Ensure script execution stops after redirection
        } else {
            // Handle error if update fails
        }
    }
        
    ?>