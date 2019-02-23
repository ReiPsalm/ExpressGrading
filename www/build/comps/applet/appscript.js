var Appex = null;

Appex = {
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
    Notifier: function (type,title,path,position,setmsg){
        Lobibox.notify(type,{
            title: title,
            size: 'mini',
            rounded: false,
            soundPath: path+'/library/plugins/lobibox-master/sounds/',
            soundExt: '.ogg',
            delayIndicator: false,
            position: position,
            icon: true,
            sound: true,
            msg: setmsg
        });//lobibox end
    },
    /**
    * Write XMLreqyest for modal
    *
    * @memberOf notif
    * @param {String} type be default|info|warning|error|success}
    * @param {String} title Notification title
    * @param {String} path audio path INTERNAL: build/library EXTERNAL: ../../
    * @param {String} position be top left|top right|top center|bottom left|bottom right|bottom center
    * @param {String} setmsg Notification message
    */
    GetSetupData: function (dataID,dataSrc,domID){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(""+domID+"").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "../engine/"+dataSrc+".php?dataid="+dataID, true);
        xmlhttp.send();
    },
    SeTupTable: function(jsonSource){
        $('#data-table').dataTable().fnClearTable();
        $("#data-table").dataTable().fnDestroy();
    
        clientTableData = $('#data-table').DataTable({
            responsive: true,
            bAutoWidth:false,
            dom:"Bfrtip",
            buttons:[{extend:"csv",className:"btn-sm"}],
    
            "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
                oSettings.jqXHR = $.ajax( {
                    "dataType": 'json',
                    "type": "GET",
                    "url": sSource,
                    "cache": false,
                    "data": aoData,
                    "success": function (data) {
                        clientList = data;
                        console.log(clientList);
                        fnCallback(clientList);
                    }
                });
            },
    
            "sAjaxSource": "../engine/"+jsonSource+".php",
            "sAjaxDataProp": "",
            "iDisplayLength": 10,
            "scrollCollapse": false,
            "paging": true,
            "searching": true,
            "ordering": true,
            "columns": [
    
                { "mData": "DataID", sDefaultContent: ""},
                { "mData": "DataDesc", sDefaultContent: ""},
                { sDefaultContent: "" ,
                    "fnCreatedCell": function (nTd, sData, oData) {
                        $(nTd).html('<button value="'+oData.DataID+'" href="#exp_modalb" data-toggle="modal" onclick="Appex.GetDataCourse(this.value)" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Edit</button> ');
                    }
                },
            ]
        });
    },
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
                        Appex.Notifier('info','Error Login','build','top right','User does not exist!');
                        $('#Expform').trigger('reset');
                    }else if(data == "0"){
                        Appex.Notifier('warning','Data collpase','build','top right','Please restart the application');
                    }else{
                        Appex.Notifier('error','Action unkown','build','top right','Please try again!');
                    }
                }
            });
        });
    
    },
    SaveCourse: function(){
        $('#savedt').click(function (e) {
            e.preventDefault();
            var course = $('#course').val();
            var FormVal = 'action=savecourse&course='+course;
            $.ajax({
                type:'POST',
                data:FormVal,
                cache:false,
                url:'../cabinet/exec.php',
                success: function(data){
                    if(data == "1"){
                        Appex.Notifier('success','Data Saved','../..','top right','Data Successfuly added!');
                        $('#Expform').trigger('reset');
                        $("#exp_modal").modal("hide");
                        Appex.SeTupTable('getCourse');
                    }else{
                        Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                        $('#Expform').trigger('reset');
                    }
                }
            });
        });
    },
    GetDataCourse: function(dataval){
        var dataID = dataval;
        var dataSrc = 'getCoursedb';
        var domID = 'ExpEditform';

        Appex.GetSetupData(dataID,dataSrc,domID);
        // console.log("DataID: "+dataID);
    },
    UpdateCourse: function(){
        $('#editdt').click(function (e) {
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Your data will be changed!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, update it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: true,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    var newCoursedesc = $('#upcourse').val();
                    var idData = $('#dataid').val();
                    var FormVal = 'action=editcourse&newcourse='+newCoursedesc+'&idData='+idData;
                    console.log(FormVal);
                    $.ajax({
                        type:'POST',
                        data:FormVal,
                        cache:false,
                        url:'../cabinet/exec.php',
                        success: function(data){
                            if(data == "1"){
                                Appex.Notifier('success','Data Saved','../..','top right','Data Successfuly updated!');
                                $('#Expform').trigger('reset');
                                $("#exp_modalb").modal("hide");
                                Appex.SeTupTable('getCourse');
                            }else{
                                Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                                $('#Expform').trigger('reset');
                            }
                        }
                    });
                }else{
                    $("#exp_modalb").modal("hide");
                    $('#ExpEditform').trigger('reset');
                    swal("Cancelled", "You cancelled your action.", "error");
                }
            });
            /*end swal*/
        });
    }
}