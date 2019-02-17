function UserLogin() {
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
                    alert("success");
                }else if(data == "2"){
                    alert("invalid");
                }else if(data == "0"){
                    alert("database error");
                }else{
                    alert("no execution");
                }
            }
        });
    });

}