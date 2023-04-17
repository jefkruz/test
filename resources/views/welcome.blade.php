<html>
<body>

<div id="root"></div>
</body>

<script src="https://resource.zegocloud.com/prebuilt/crypto-js.js"></script>
<script src="https://resource.zegocloud.com/prebuilt/prebuiltToken.js"></script>
<script src="https://zegocloud.github.io/zegocloud_prebuilt_webrtc/ZegoPrebuilt/index.umd.js"></script>
<script>
    const roomID = '{{$room}}';
    const userID = '{{$id}}';
    const userName = '{{$name}}';
    const appID = 1686596269;
    const serverSecret = "afbd900ca5b6d0985dd40f4b203e8c66";




    const TOKEN = generatePrebuiltToken(1686596269,"afbd900ca5b6d0985dd40f4b203e8c66",roomID,userID,userName);

    const zp = ZegoUIKitPrebuilt.create(TOKEN);
    zp.joinRoom({
        container : document.querySelector("#root"),
    });
</script>
</html>
