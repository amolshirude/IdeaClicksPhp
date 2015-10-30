<html>
    <head>
        <title>Edit Campaign</title>    
    </head>
    <body>
        <form name="updateCampaign" action="updateCampaign" method="post">
            <input type="hidden" name="campaign_id" value="<?php echo $Campaign['Campaign']['campaign_id']; ?>">
            <label>Campaign Name</label><br>
            <input type="text" name="campaign_name" value="<?php echo $Campaign['Campaign']['campaign_name']; ?>" id="campaign_name"/><br>
            <label>Start Date</label><br>
            <input name="start_date" type="datetime-local" value="<?php echo $Campaign['Campaign']['start_date']; ?>" ><br>
            <label>End Date</label><br>
            <input name="end_date" type="datetime-local" value="<?php echo $Campaign['Campaign']['end_date']; ?>" ><br>
            <input type="submit" style="height:25px; width:60px; background-color: #0a0" value="Update">
        </form>    
    </body>
</html>