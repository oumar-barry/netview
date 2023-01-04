<?php require APP_ROOT ."/includes/header.php"  ?>
            
    <div class="main-container">
        <?php 
            
           echo $videoPlayer;
           

        ?>
    </div>    

    
<?php require APP_ROOT ."/includes/footer.php"  ?>    
<script > initVideo('<?= $video->getId() ?>'); </script>   