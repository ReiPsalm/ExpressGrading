var Appex = null, notif = null;

/**
* Write message for notification
*
* @memberOf notif
* @param {String} type be default|info|warning|error|success}
* @param {String} title Notification title
* @param {String} path audio path INTERNAL: build/library EXTERNAL: ../../
* @param {String} position be top left|top right|top center|bottom left|bottom right|bottom center
* @param {String} setmsg Notification message
*/
(function($) {
    nofif = {
        Ringer: function (type,title,path,position,setmsg){
            Lobibox.notify(type,{
                title: title,
                size: 'mini',
                rounded: false,
                soundPath: path+'/plugins/lobibox-master/sounds/',
                soundExt: '.ogg',
                delayIndicator: false,
                position: position,
                icon: true,
                sound: true,
                msg: setmsg
            });//lobibox end
        }
    }
    Appex = {
        UserLogin: function () {
            $('#login').click(function (e) {
                e.preventDefault();
                var uname = $('#username').val();
                var upass = $('#password').val();
                var FormVal = 'action=login&uname='+uname+'&upass='+upass;
        
                $.ajax({
                    type:'POST',
                    data:FormVal,
                    cache:false,
                    url:'build/comps/cabinet/exec.php',
                    success: function(data){
                        if(data == "1"){
                            window.location.href = "build/comps/view/home.php";
                            // alert("success");
                        }else if(data == "2"){
                            notif.Ringer('info','Error Login','build/library','top right','User does not exist!');
                        }else if(data == "0"){
                            notif.Ringer('warning','Data collpase','build/library','top right','Please restart the application')
                        }else{
                            notif.Ringer('error','Action unkown','build/library','top right','Please try again!')
                        }
                    }
                });
            });
        
        },
        CourseMod: function(){
    
        }
    }
}(jQuery));