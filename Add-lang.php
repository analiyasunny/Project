<?php 
    include('shared/header.php'); 
    $title = 'World Languages and Speakers';
?>
 <h2>World Languages and Speakers</h2>
    <form method="post" action="insert-lang.php">
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
            <input name="linguisticage" id="linguisticage" required>
            <?php
            include('shared/db.php');
            ?>
           </fieldset>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
