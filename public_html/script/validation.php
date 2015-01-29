<?php
if ($_FILES['audio']['error'][0] != 4)
{  
    $chemin_tmp2 = $_FILES['audio']['tmp_name'][0];
    $name2 = $_FILES['audio']['name'][0];
    $new_chemin2 = "../utilisateurs/audio/$name2";
    
    
    $message = 'Seuls les fichiers MP3 / etc';
    

    $extentions_approve = array('audio/mp3', 'audio/ogg', 'audio/waw');
    
    for($i=0;$i<count($_FILES['audio']['type']);$i++)
    {
        for($y = 0;$y<count($extentions_approve);$y++)
        {
            if($_FILES['audio']['type'][$i] == $extentions_approve[$y])
            {
                move_uploaded_file($chemin_tmp2, $new_chemin2);
                $message = 'musique uploader';
            }
        }
    }
    
    header("Location: ../Sound.php?message=$message");
}
?>