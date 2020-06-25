<?php

/**
 * YT.PlayerState.ENDED
 * YT.PlayerState.PLAYING
 * YT.PlayerState.PAUSED
 * YT.PlayerState.BUFFERING
 * YT.PlayerState.CUED
 **/
ob_start();
function formatDuration($time)
{
    $time = $time[0] != 0 ? $time[0] . $time[1] . "h" . $time[3] . $time[4] . "m" . $time[6] . $time[7] . "s" : $time[3] . $time[4] . "m" . $time[6] . $time[7] . "s";
    return $time;
}

?>
<script>

    const tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    let player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady(event) {
        event.target.playVideo();

    }

    let done = false;

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            done = true;
            console.log(done);
        }
    }

    function stopVideo() {

    }
</script>
<script type="text/javascript">
    function onStartMedia() {
        console.log('film')
        $.ajax({
            type: "POST",
            url: "./actions/history/deleteOneEpisode.php",
            cache: false,
            data: {'target': target.value},
            success: function (response) {
                console.log(response)
            }
        });

    }

    function onStartSerie() {
        console.log('serie')
        $.ajax({
            type: "POST",
            url: "./actions/history/deleteOneEpisode.php",
            cache: false,
            data: {'target': target.value},
            success: function (response) {
                console.log(response)
            }
        });
    }

</script>
<div>
    <script type="text/javascript">
        function handleChangeEpisode() {
            let e = document.getElementById("episodes").value;
            let s = document.getElementById("saison").value;
            location.href = `index.php?media= <?=$_GET['media'] ?> &saison=${s}  &episode=${e}`
        }

        function handleChangeSaison() {
            let e = document.getElementById("episodes").value;
            let s = document.getElementById("saison").value;
            location.href = `index.php?media= <?=$_GET['media'] ?> &saison=${s}  &episode=${e}`
        }

        function handleStartVideo() {
            console.log('hello')
        }


    </script>
    <div class="row btn-container">
        <div class="col-xs-6 col-sm-6">

            <?php
            if ((isset($mediaInfos['type'])) && $mediaInfos['type'] === 'Serie'):
                echo '<label for="exampleFormControlSelect1">Saisont</label>';
                echo '<select class="form-control" id="exampleFormControlSelect1" id="saison" onchange="handleChangeSaison()">';
                ?>

                <?php
                if (isset($_GET['saison']) && isset($_GET['episode'])) {
                    foreach ($saisons as $saison => $value) {
                        if (intval($_GET['saison']) === intval($value["saison"])) {
                            echo "<option value='" . $value["saison"] . "' selected>" . $value["saison"] . "</option> ";
                        } else {
                            echo "<option value='" . $value["saison"] . "'>" . $value["saison"] . "</option> ";
                        }
                    }
                }
                ?>
                <?php echo '</select>';
            endif;
            ?>
        </div>

        <div class="col-xs-6 col-sm-6">
            <?php
            if ((isset($mediaInfos['type'])) && $mediaInfos['type'] === 'Serie'):
                echo '<label for="exampleFormControlSelect1">Episode</label>';

                echo '<select class="form-control" id="exampleFormControlSelect1" id="saison"
                    id="episodes" onchange="handleChangeEpisode()">';
                ?>
                <?php
                echo '<p>' . $_GET['saison'] . '</p>';
                echo '<p>' . $_GET['episode'] . '</p>';

                if (isset($_GET['saison']) && isset($_GET['episode'])) {
                    foreach ($episodes[intval($_GET['saison']) - 1] as $episode => $value) {
                        $episode = intval($episode);
                        $episode = $episode + 1;
                        if (intval($_GET['episode']) === $episode) {
                            echo "<option value='" . $episode . "' selected>" . $episode . "</option> ";
                        } else {
                            echo "<option value='" . $episode . "'>" . $episode . "</option> ";
                        }
                    }
                }
                ?>

                <?php
                echo '</select>';
            endif; ?>
        </div>


    </div>
    <div class="title" style="text-align: center">
        <?php
        if (isset($_GET['saison']) && isset($_GET['episode'])) {
            $episode = $episodes[intval($_GET['saison']) - 1];
            $episode = $episode[intval($_GET['episode']) - 1];
            echo '<p>' . formatDuration($episode['time']) . '</p>';
            echo '<h1>' . $episode['name'] . '</h1>';

        } else {
            echo '<h1>' . $mediaInfos['title'] . '</h1>';

        }
        ?> </div>
    <div class="container" style="height: 400px; margin-bottom: 10px">

            <iframe
                    id="player"
                    frameborder="0" height="100%" width="100%"
                    src="<?= $mediaInfos['type'] === 'Film' ? $mediaInfos['url'] : $episode['url'] . "?enablejsapi=1" ?>"
            >
            </iframe>

    </div>
    <div class="col-xs-12 col-md-12">
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#description"
                    aria-expanded="false" aria-controls="description">
                Description
            </button>
        </p>

        <div class="collapse" id="description">
            <div class="card-title" style="text-align: center">
                <?php
                if (isset($_GET['saison']) && isset($_GET['episode'])) {
                    $episode = $episodes[intval($_GET['saison']) - 1];
                    $episode = $episode[intval($_GET['episode']) - 1];
                    echo '<h4>' . formatDuration($episode['time']) . '</h4>';
                } else {
                    echo '<h4>' . formatDuration($mediaInfos['time']) . '</h4>';
                }
                ?>
            </div>
            <div class="card card-body">
                <?php
                echo '<p>' . $mediaInfos['summary'] . '<p/>';
                ?>            </div>
        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
