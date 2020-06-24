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


<?php
ob_start();
require './model/Tools.php';
?>


<script>
    type = "text/javascript" >
        function handleChangeEpisode() {
            let e = document.getElementById("episodes").value;
            let s = document.getElementById("saison").value;
            location.href = `index.php?media= <?= $_GET['media'] ?> &saison=${s}  &episode=${e}`
        }

    function handleChangeSaison() {
        let e = document.getElementById("episodes").value;
        let s = document.getElementById("saison").value;
        location.href = `index.php?media= <?= $_GET['media'] ?> &saison=${s}  &episode=${e}`
    }

    function handleStartVideo() {
        console.log('hello')
    }


</script>

<
select
id = "episodes"
onchange = "handleChangeEpisode()" >
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
< /select>

< select
id = "saison"
onchange = "handleChangeSaison()" >
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
< /select>

< div
class
= "col-xs-12 col-md-6" >
< div
class
= "title" ><?php
if (isset($_GET['saison']) && isset($_GET['episode'])) {
    $episode = $episodes[intval($_GET['saison']) - 1];
    $episode = $episode[intval($_GET['episode']) - 1];
    echo '<p>' . $episode['time'] . '</p>';
    echo '<p>' . $episode['name'] . '</p>';

}
?> < /div>
< div
type = "button"
onclick = "handleStartVideo()" >
< iframe
id = "player"
frameborder = '0'
allow = 'encrypted-media;'
allowfullscreen
height = "100%"
width = "100%"
src = "<?= $mediaInfos['type'] ? $mediaInfos['trailer_url'] : $episode['url'] . "?autoplay=true" ?>"
>
< /iframe>
< /div>
< /div>
< /div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
