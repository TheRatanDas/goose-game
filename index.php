<!DOCTYPE html>
<html>
<head>
<title>GOOSE GAME</title>
<link rel="stylesheet" href="page/goose_game2/css/reset.css" type="text/css">
<link rel="stylesheet" href="page/goose_game2/css/main.css" type="text/css">
<link rel="stylesheet" href="page/goose_game2/css/orientation_utils.css" type="text/css">
<link rel="stylesheet" href="page/goose_game2/css/ios_fullscreen.css" type="text/css">
<link rel='shortcut icon' type='image/x-icon' href='./favicon.ico' />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,minimal-ui" />
<meta name="msapplication-tap-highlight" content="no" />
<script type="text/javascript" src="page/goose_game2/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="page/goose_game2/js/createjs.min.js"></script>
<script type="text/javascript" src="page/goose_game2/js/howler.min.js"></script>
<script type="text/javascript" src="page/goose_game2/js/screenfull.js"></script>
<script type="text/javascript" src="page/goose_game2/js/platform.js"></script>
<script type="text/javascript" src="page/goose_game2/js/ios_fullscreen.js"></script>
<script type="text/javascript" src="page/goose_game2/js/ctl_utils.js"></script>
<script type="text/javascript" src="page/goose_game2/js/sprite_lib.js"></script>
<script type="text/javascript" src="page/goose_game2/js/settings.js"></script>
<script type="text/javascript" src="page/goose_game2/js/game_settings.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CLang.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CPreloader.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CMain.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CModeSelection.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CDiceButton.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CToggle.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CGfxButton.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CTextButton.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CMenu.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CGame.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CDices.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CPlayers.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CSquares.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CInterface.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CPlayersInterface.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CHelpPanel.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CEndPanel.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CErrorMsgBox.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CMsgBox.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CTeamChoose.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CColourChoose.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CCreditsPanel.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CAreYouSurePanel.js"></script>
<script type="text/javascript" src="page/goose_game2/js/CCTLText.js"></script>
</head>
<body ondragstart="return false;" ondrop="return false;">
<div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>
<script>
            $(document).ready(function () {
                var oMain = new CMain({
                        house_penalities:3,             // HOUSE PENALITIES TURNS
                        prison_penalities:999,          // PRISON PENALITIES TURNS
                        maze_time:5000,                 // HOW MANY SECONDS (IN MS) BETWEEN EACH ANIMATION FOR THE MAZE 
                        logo_time:9000,                 // HOW MANY SECONDS (IN MS) BETWEEN EACH ANIMATION FOR THE LOGO
                        audio_enable_on_startup:true, //ENABLE/DISABLE AUDIO WHEN GAME STARTS 
                        fullscreen:false,                // SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                        check_orientation:false          // SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES

                });
                $(oMain).on("start_session", function (evt) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeStartSession();
                    }
                });

                $(oMain).on("end_session", function (evt) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeEndSession();
                    }
                });

                $(oMain).on("start_level", function (evt, iLevel) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeStartLevel({level: iLevel});
                    }
                });

                $(oMain).on("restart_level", function (evt, iLevel) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeRestartLevel({level: iLevel});
                    }
                });

                $(oMain).on("end_level", function (evt, iLevel) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeEndLevel({level: iLevel});
                    }
                });

                $(oMain).on("save_score", function (evt, iScore, szMode) {
                    trace("save score "+iScore)
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeSaveScore({score: iScore, mode: szMode});
                    }
                });

                $(oMain).on("show_interlevel_ad", function (evt) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeShowInterlevelAD();
                    }
                });

                $(oMain).on("share_event", function (evt, iScore) {
                    
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeShareEvent({img: TEXT_SHARE_IMAGE,
                            title: TEXT_SHARE_TITLE,
                            msg: TEXT_SHARE_MSG1 + iScore + TEXT_SHARE_MSG2,
                            msg_share: TEXT_SHARE_SHARE1 + iScore + TEXT_SHARE_SHARE1});
                    }
                });


                if (isIOS()) {
                    setTimeout(function () {
                        sizeHandler();
                    }, 200);
                } else {
                    sizeHandler();
                }
            });

        </script>
<div class="check-fonts">
<p class="check-font-1">test 1</p>
</div>
<canvas id="canvas" class='ani_hack' width="1360" height="640"> </canvas>
<div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
<div id="block_game" style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%; display:none"></div>
</body>
</html>
