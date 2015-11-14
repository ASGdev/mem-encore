<?php

    // Include the DirectoryLister class
    require_once('resources/DirectoryLister.php');

    // Initialize the DirectoryLister object
    $lister = new DirectoryLister();



        //Initialize the directory array
        if (isset($_GET['dir'])) {
            $dirArray = $lister->listDirectory($_GET['dir']);
        }
        else {
        $dirArray = $lister->listDirectory('cards/');
        }
?>
                    <?php if($lister->getSystemMessages()): ?>
                <?php foreach ($lister->getSystemMessages() as $message): ?>
                    <div class="alert alert-<?php echo $message['type']; ?>">
                        <?php echo $message['text']; ?>
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>



                <?php foreach($dirArray as $name => $fileInfo): ?>

                   
                    <?php if ((0 === strpos($fileInfo['url_path'], '?dir=')) || (0 === strpos($fileInfo['url_path'], 'http:'))) : ?>
                        <a href="<?php echo $fileInfo['url_path']; ?>" class="clearfix" data-name="<?php echo $name; ?>">
                            <div class="ui-card ui-card-folder" data-name="<?php echo $name; ?>" data-href="<?php echo $fileInfo['url_path']; ?>">
                                <?php
                                    if($name == ".."){
                                        echo "Return";
                                    }
                                    else {
                                        echo $name;
                                    }

                                ?>

                            </div>
                        </a>

                    <?php else : ?>
                        <a href="?#" onclick="init('<?php echo $fileInfo['url_path']; ?>')" class="clearfix" data-name="<?php echo $name; ?>">
                            <div class="ui-card ui-card-file" data-name="<?php echo $name; ?>" data-href="<?php echo $fileInfo['url_path']; ?>">
                                <?php
                                    echo $name;
                                ?>

                            </div>
                        </a>
                    <?php endif; ?>
                           
                <?php endforeach; ?>



    
