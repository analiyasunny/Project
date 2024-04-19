<?php 
    //Adding shared header 
    include('shared/auth.php');
    include('shared/header.php'); 
    $title = 'World Languages and Speakers';
?>
<link rel="stylesheet" href="css/site.css">
 <h2>World Languages and Speakers</h2>
 <!-- Creating the form to enter the inputs-->
    <form method="post" action="insert-lang.php" enctype="multipart/form-data">
        <fieldset>
            <label for="Language">Language: *</label>
            <input name="Language" id="Language" required/>
        </fieldset>
        <fieldset>
            <label for="NativeSpeakers">Native Speakers: *</label>
            <input name="NativeSpeakers" id="NativeSpeakers" required/>
        </fieldset>
        <fieldset>
            <label for="Country">Country: *</label>
            <input name="Country" id="Country" required/> 
        </fieldset>
        <fieldset>
            <label for="linguisticage">Linguistic age: *</label>
            <select name="linguisticage" id="linguisticage" required>
            <?php
            try {
            //including shared Database
            include('shared/db.php');

            //running query and storing data results
            $sql = 'SELECT * FROM Lingusticage ORDER BY name';
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $Lingusticage = $cmd->fetchAll();

            // looping through list the of Lingusticage, adding each one to dropdown one at a time
            foreach ($Lingusticage as $Lingusticages) {
               echo '<option>' . $Lingusticages['name'] . '</option>';
            }
            
            //disconnect
            $db = null;
        }
        catch (Exception $err) {
            header('location:error.php');
            exit();
        }
            ?>
        </select> 
           </fieldset>
           <fieldset>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" />
    </fieldset>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
