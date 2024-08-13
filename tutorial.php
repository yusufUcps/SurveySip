<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embed YouTube Video in Accordion</title>
    
</head>
<body id="default_theme" class="tutorial">
<div class="col-lg-12">
    <div class="card">  
        <div class="card-body">
            <div class="panel-group" id="accordion" style="margin-top: 0;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">video cara membuat survey<i class="fa fa-angle-down"></i></a>
                        </p>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php echo embedYouTubeVideo('COt3fgiKQXo?si=n_pNI-YIFoqSN5HF'); ?>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">video cara membuat kuis<i class="fa fa-angle-down"></i></a>
                        </p>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php echo embedYouTubeVideo('E3QN_uoHysA?si=tiu-jcPaUDOVKPUv'); ?>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">video cara mendapatkan poin <i class="fa fa-angle-down"></i></a>
                        </p>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php echo embedYouTubeVideo('fV2LLgBOKzc?si=5N57BT4nfbjjATi5'); ?>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">video cara melihat survey report<i class="fa fa-angle-down"></i></a>
                        </p>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <?php echo embedYouTubeVideo('z-UPUXGYYqo?si=SnVw7YwggMAsoETb'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
function embedYouTubeVideo($videoId) {
    if (empty($videoId)) {
        return 'Invalid video ID';
    }

    $embedUrl = 'https://www.youtube.com/embed/' . htmlspecialchars($videoId, ENT_QUOTES, 'UTF-8');
    return '<iframe width="560" height="315" src="' . $embedUrl . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}
?>

</body>
</html>
