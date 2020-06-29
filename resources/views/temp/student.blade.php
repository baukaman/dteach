@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px">
        <script src="{{ asset('/js/socket.io.js') }}"></script>
        <script src='https://meet.jit.si/external_api.js'></script>

        <div style="display: flex">
            <a class="btn btn-info" href="#" id="lesson-request">мұғалімге қоңырау шалу</a>
            <form method="post" action="/logout" style="color: red; margin-left: 10px">@csrf <a href="#" class="do-submit">Жүйеден шығу</a></form>
        </div>


        <script>
            $(function(){
                var socket = io(location.protocol + '//' + location.hostname + ':3000');

                $('#lesson-request').click(function(){
                    socket.emit('lesson.request');
                });

                socket.on('lesson.accept', function(){
                    var domain = 'meet.jit.si';
                    //var domain = 'jitsi.todaysoft.kz';
                    var options = {
                        roomName: 'daryn-001',
                        parentNode: document.querySelector('#jitsi-meet'),
                        configOverwrite: {
                            defaultLanguage: 'ru'
                        },
                        interfaceConfigOverwrite: {
                            SHOW_JITSI_WATERMARK: false,
                            JITSI_WATERMARK_LINK: '',
                            SHOW_WATERMARK_FOR_GUESTS: false,
                            SHOW_CHROME_EXTENSION_BANNER: false,
                            DEFAULT_REMOTE_DISPLAY_NAME: 'Пользователь',
                            DEFAULT_LOCAL_DISPLAY_NAME: 'Я',
                            TOOLBAR_BUTTONS: [
                                'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
                                'fodeviceselection', 'hangup', 'profile', 'chat', 'recording',
                                'livestreaming', 'etherpad', 'sharedvideo', 'settings', 'raisehand',
                                'videoquality', 'filmstrip', 'invite', 'feedback', 'stats', 'shortcuts',
                                'tileview', 'videobackgroundblur', 'download', 'help', 'mute-everyone',
                                'e2ee'
                            ],
                        }
                    };
                    api = new JitsiMeetExternalAPI(domain, options);
                    /*let totalTime = 0;
                    let timerId = setInterval(function(){
                        if(api && api.getNumberOfParticipants() > 1) {
                            totalTime += 1;
                        }
                    }, 1000);*/

                    api.executeCommand('displayName', 'Тұран Мұрал');
                    api.executeCommand('subject', 'Физика 8 класс');
                    api.addEventListener('videoConferenceLeft', function(){
                        api.dispose();
                        //clearInterval(timerId);
                        //$('#call-info').html("Время:" + totalTime + ", Ид препода: " + 102 + " Ид ученика: " + 58);
                    });
                });
            });
        </script>

        <style>
            .t-box {
                border: 1px solid #1B316D;
                padding: 10px 20px;
            }

        </style>

        <div style="display: flex; margin-top: 5px" class="t-box-container">
            <div class="t-box">
                <div>Keanu Reevs, <span>online</span></div>
                <div>1 tabs</div>
            </div>
            <div class="t-box">
                <div>Matt Daemon, <span>online</span></div>
                <div>2 tabs</div>
            </div>
        </div>

        <form style="max-width: 400px; margin-top: 10px">
            <div class="form-group">
                <input type="text" class="form-control"  placeholder="email" />
            </div>
            <div class="form-group">
                <input type="text" name="fio" class="form-control" placeholder="Аты-Жөні" style="width:300px" />
            </div>
            <button type="button" class="btn btn-success btn-xs">қоңырау шалу</button>
        </form>

        <div id="jitsi-meet" style="height: 500px"></div>
    </div>
@endsection
