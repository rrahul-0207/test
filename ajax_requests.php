<?php
require_once('assets/init.php');
use Aws\S3\S3Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

if(isset($_POST['submit']))
{
    if($_POST['submit']=='fetch_cities'){
        $city_array=Wo_GetCityArray($_POST['state_id']);
        
        foreach($city_array as $city_ids=>$city):
        ?>
        <option value="<?php echo $city_ids;?>" ><?php echo $city;?></option>
        <?php
        endforeach;
    }
}



?>
