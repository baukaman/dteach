@extends('layouts.app')

@section('content')
    <script src="{{ asset('/js/socket.io.js') }}"></script>
    <script>
        let socket;

        let showRequest = function(){
            $('#myModal').modal('show');
        }
        $(document).ready(function(){
           socket = io("http://localhost:3000");
           socket.on('lesson.request', showRequest);
           $('#btn-accept-call').click(function(){
               socket.emit('lesson.accept');
               $('#myModal').modal('hide');
               var api;
               $('#modal-call').modal('show').one('hidden.bs.modal', function(){
                   api && api.dispose();
               });

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
               let totalTime = 0;
               let timerId = setInterval(function(){
                   if(api && api.getNumberOfParticipants() > 1) {
                       totalTime += 1;
                   }
               }, 1000);

               api.executeCommand('displayName', 'Бәйдібек Нұрланұлы');
               api.executeCommand('subject', 'Физика 8 класс');
               api.addEventListener('videoConferenceLeft', function(){
                  api.dispose();
                  clearInterval(timerId);
                  $('#call-info').html("Время:" + totalTime + ", Ид препода: " + 102 + " Ид ученика: " + 58);
               });
           });
        });
    </script>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" style="max-width: 448px">
            <div class="modal-content" style="border-radius: 16px; padding: 24px;">
                <div class="modal-box-head boxHead-talk">
                    <i class="icon phone-talk"></i>
                    <h4>Аудиоқоңырау</h4>
                    <button class="btn-plain close-modal" data-dismiss="modal"><img src="img/icons/close-modal.svg" alt=""></button>
                </div>
                <div class="teacher-loading-body">
                    <div class="student-profile">
                        <div class="student-profile-img">
                            <img src="img/main/ellipse-img.svg" alt="">
                        </div>
                        <div class="student-profile-caption">
                            <h4>Тұран Мұрал</h4>
                            <p><img src="img/icons/Star.svg" alt="">4.7</p>
                        </div>
                    </div>
                    <div class="call-theme">
                        <span>Тақырып</span>
                        <p>Жылулық қозғалыс, броундық қозғалыс және диффузия</p>
                    </div>
                    <div class="call-theme">
                        <span>Пән</span>
                        <p>Физика 7-сынып</p>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        <span>Видеоқоңырау</span>
                    </div>
                    <span class="span-cost">1 мин.≈ 60 теңге</span>
                    <button class="btn-plain call-teach" id="btn-accept-call">Қабылдау</button>
                </div>
            </div>
        </div>
    </div>

    <section class="teacher-profile-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="teacher-profile">
                        <div class="teacher-profile-img">
                            <img src="img/main/ellipse-img.svg" alt="">
                        </div>
                        <div class="teacher-profile-caption">
                            <h3>Бәйдібек Нұрланұлы</h3>
                            <p><img src="img/icons/Star.svg" alt="">4.7</p>
                        </div>
                    </div>
                    <div class="teacher-bonus">
                        <div class="teacher-bonus-head">
                            <h3>Daryn бонустар</h3>
                            <p>12 321 d.</p>
                        </div>
                        <div class="teacher-bonus-base">
                            <div class="teacher-bonus-item">
                                <h4>Курста өткізілген уақыт</h4>
                                <p>96сағ. 48мин. 22cек.</p>
                            </div>
                            <div class="teacher-bonus-item pl20">
                                <h4>Сабақтар саны</h4>
                                <p>248</p>
                            </div>
                        </div>
                    </div>
                    <div class="teacher-level">
                        <div class="teacher-level-head">
                            <div class="level-head">
                                3
                            </div>
                            <div class="level-head-caption">
                                <h4>Сіздің дәрежеңіз</h4>
                                <p>Бастаушы</p>
                            </div>
                        </div>
                        <div class="teacher-level-base">
                            <img src="img/icons/icon-info.svg" alt="">
                            <a href="#">Дәрежені қалай көтеруге болады?</a>
                        </div>
                    </div>
                    <div class="teacher-control around-block">
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="img/icons/icon-clock.svg" alt="">
                                    <span>Қоңыраулар тарихы</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="img/icons/icon-pass.svg" alt="">
                                    <span>Парольді өзгерту</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="img/icons/icon-phone.svg" alt="">
                                    <span>8 (812) 213 23-12</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="img/icons/mail.svg" alt="">
                                    <span>komek@daryn.online</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="teacher-control around-block">
                        <form method="POST" action="/logout">
                            @csrf
                        <ul>
                            <li>
                                <a href="/logout" class="do-submit">
                                    <img src="img/icons/logout-red.svg" alt="">
                                    <span>Шығу</span>
                                </a>
                            </li>
                        </ul>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 p0">
                    <div class="profile-content-cover">
                        <div class="profile-content-body">
                            <div class="profile-content-head">
                                <h1>Желіге қосылу</h1>
                                <div class="can-toggle demo-rebrand-2">
                                    <input id="e" type="checkbox" name="status">
                                    <label for="e">
                                        <div class="can-toggle__switch" data-checked="Офлайн" data-unchecked="Онлайн"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="profile-offline profile-status show-status">
                                <div class="girl-img">
                                    <img src="img/main/girl.svg" alt="">
                                </div>
                                <p>Жұмысты бастау үшін жүйені іске қосыңыз</p>
                            </div>
                            <div class="profile-online  profile-status">
                                <div class="ellipse-lg">
                                    <div class="ellipseImg-sm lg-img" data-position="50">
                                        <img src="img/main/ellipse-img.svg" alt="">
                                    </div>
                                    <div class="ellipseImg-sm lg-img" data-position="100">
                                        <img src="img/main/ellipse-img.svg" alt="">
                                    </div>
                                    <div class="ellipseImg-sm lg-img" data-position="80">
                                        <img src="img/main/ellipse-img.svg" alt="">
                                    </div>
                                    <div class="ellipseImg-sm lg-img" data-position="70">
                                        <img src="img/main/ellipse-img.svg" alt="">
                                    </div>
                                    <div class="ellipseImg-sm lg-img" data-position="30">
                                        <img src="img/main/ellipse-img.svg" alt="">
                                    </div>
                                    <div class="ellipse-md">
                                        <div class="ellipseImg-sm md-img" data-position="90">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="ellipseImg-sm md-img" data-position="60">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="ellipseImg-sm md-img" data-position="20">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="ellipseImg-sm md-img" data-position="50">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="ellipseImg-sm md-img" data-position="30">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="ellipseImg-sm md-img" data-position="60">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="ellipseImg-sm md-img" data-position="20">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="ellipseImg-sm md-img" data-position="50">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="ellipse-sm">
                                            <div class="ellipse-img">
                                                <img src="img/main/ellipse-img.svg" alt="">
                                            </div>
                                            <div class="ellipseImg-sm sm-img">
                                                <img src="img/main/ellipse-img.svg" alt="">
                                            </div>
                                            <div class="ellipseImg-sm sm-img">
                                                <img src="img/main/ellipse-img.svg" alt="">
                                            </div>
                                            <div class="ellipseImg-sm sm-img">
                                                <img src="img/main/ellipse-img.svg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4>Физика пәні</h4>
                                <p>Алматы облысы бойынша оқушылар хабарласады</p>
                            </div>
                        </div>
                        <div class="subject-sidebar">
                            <h2>12 желтоқсан</h2>
                            <div class="subject-item-cover">
                                <div class="subject-item">
                                    <h3>Жылулық қозғалыс, броундық қозғалыс және диффузия</h3>
                                    <div class="student-profile">
                                        <div class="student-profile-img">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="student-profile-caption">
                                            <h4>Тұран Мұрал</h4>
                                            <p><img src="img/icons/Star.svg" alt="">4.7</p>
                                        </div>
                                    </div>
                                    <ul class="subject-detail">
                                        <li><p>Ұзақтығы:</p> <span>2мин. 48сек.</span></li>
                                        <li><p>Бонус:</p> <span class="span-green">+ 2 500 d.</span></li>
                                    </ul>
                                </div>
                                <div class="subject-item">
                                    <h3>Жылулық қозғалыс, броундық қозғалыс және диффузия</h3>
                                    <div class="student-profile">
                                        <div class="student-profile-img">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="student-profile-caption">
                                            <h4>Тұран Мұрал</h4>
                                            <p><img src="img/icons/Star.svg" alt="">4.7</p>
                                        </div>
                                    </div>
                                    <ul class="subject-detail">
                                        <li><p>Ұзақтығы:</p> <span>2мин. 48сек.</span></li>
                                        <li><p>Бонус:</p> <span class="span-green">+ 2 500 d.</span></li>
                                    </ul>
                                </div>
                                <div class="subject-item">
                                    <h3>Жылулық қозғалыс, броундық қозғалыс және диффузия</h3>
                                    <div class="student-profile">
                                        <div class="student-profile-img">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="student-profile-caption">
                                            <h4>Тұран Мұрал</h4>
                                            <p><img src="img/icons/Star.svg" alt="">4.7</p>
                                        </div>
                                    </div>
                                    <ul class="subject-detail">
                                        <li><p>Ұзақтығы:</p> <span>2мин. 48сек.</span></li>
                                        <li><p>Бонус:</p> <span class="span-green">+ 2 500 d.</span></li>
                                    </ul>
                                </div>
                                <div class="subject-item">
                                    <h3>Жылулық қозғалыс, броундық қозғалыс және диффузия</h3>
                                    <div class="student-profile">
                                        <div class="student-profile-img">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="student-profile-caption">
                                            <h4>Тұран Мұрал</h4>
                                            <p><img src="img/icons/Star.svg" alt="">4.7</p>
                                        </div>
                                    </div>
                                    <ul class="subject-detail">
                                        <li><p>Ұзақтығы:</p> <span>2мин. 48сек.</span></li>
                                        <li><p>Бонус:</p> <span class="span-green">+ 2 500 d.</span></li>
                                    </ul>
                                </div>
                                <div class="subject-item">
                                    <h3>Жылулық қозғалыс, броундық қозғалыс және диффузия</h3>
                                    <div class="student-profile">
                                        <div class="student-profile-img">
                                            <img src="img/main/ellipse-img.svg" alt="">
                                        </div>
                                        <div class="student-profile-caption">
                                            <h4>Тұран Мұрал</h4>
                                            <p><img src="img/icons/Star.svg" alt="">4.7</p>
                                        </div>
                                    </div>
                                    <ul class="subject-detail">
                                        <li><p>Ұзақтығы:</p> <span>2мин. 48сек.</span></li>
                                        <li><p>Бонус:</p> <span class="span-green">+ 2 500 d.</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="btn-cover">
                                <button class="btn-plain btn-border-blue">Барлық төлемдерді көру</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="footer clearfix">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 icon-social col-md-push-4">
                    <div class="icon-pred"><a href=""><i class="icons ic-ios"></i>iOS</a><a href=""><i
                                class="icons ic-and"></i>Android</a></div>
                    <div><a href=""><i class="icons ic-ins"></i></a><a href=""><i class="icons ic-fb"></i></a><a href=""><i
                                class="icons ic-ytb"></i></a><a href=""><i class="icons ic-vk"></i></a><a href=""><i
                                class="icons ic-whats"></i></a></div>
                </div>
                <div class="col-md-4 right-footer col-md-push-4">
                    <p class="fs-12 text-grey">Дизайн и разработка</p><a href=""><img src="img/logo/logo_bg.png"></a>
                </div>
                <div class="col-md-4 col-md-pull-8">
                    <p>© 2019<a href=""> Bugin Holding</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-call" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 16px; padding: 24px;">
                <div class="modal-box-head boxHead-talk">
                    <i class="icon phone-talk"></i>
                    <h4>Аудиоқоңырау</h4>
                    <button class="btn-plain close-modal" data-dismiss="modal"><img src="img/icons/close-modal.svg" alt=""></button>
                </div>
                <script src='https://meet.jit.si/external_api.js'></script>
                <div id="jitsi-meet" style="height: 500px"></div>
                <div id="call-info"></div>
            </div>
        </div>
    </div>
@endsection
