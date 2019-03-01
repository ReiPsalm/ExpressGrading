var Appex = null;

Appex = {
    /**
    * Write message for notification
    *
    * @memberOf Appex
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
    * Write XMLrequest for modal
    *
    * @memberOf Appex
    * @param {String} dataID Data id
    * @param {String} dataSrc File name
    * @param {String} domID ID name
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
    /**
    * Write XMLrequest for fetching all data
    *
    * @memberOf Appex
    * @param {String} dataSrc File name
    * @param {String} domID ID name
    */
    GetDataSets: function (dataSrc,domID){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(""+domID+"").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "../engine/"+dataSrc+".php", true);
        xmlhttp.send();
    },
    /**
    * Write generic DataTable
    * NOTE: still in further modification
    * @memberOf Appex
    * @param {String} jsonSource json srouce for the table data
    * @param {String} domID file source for the modal form and any html elements
    */
    SeTupTable: function(jsonSource,SrcData){
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
                        $(nTd).html('<button value="'+oData.DataID+'" href="#exp_modalb" data-toggle="modal" onclick="Appex.GetDataModal(this.value,\''+SrcData+'\')" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Edit</button> ');
                    }
                },
            ]
        });
    },
    GetDataModal: function(dataval,SrcData){
        var dataID = dataval;
        var dataSrc = SrcData;
        var domID = 'ExpEditform';

        Appex.GetSetupData(dataID,dataSrc,domID);
        console.log(dataID+' '+dataSrc);
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
    SaveSection: function(){
        $('#savedt').click(function (e) {
            e.preventDefault();
            var section = $('#section').val();
            var FormVal = 'action=savesec&secdesc='+section;
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
                        Appex.SeTupTable('getSecdb','getEditSec');
                    }else{
                        Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                        $('#Expform').trigger('reset');
                    }
                }
            });
        });
    },
    UpdateSection: function(){
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
                    var newSec = $('#upsection').val();
                    var idData = $('#dataid').val();
                    var FormVal = 'action=editsec&newsec='+newSec+'&idData='+idData;
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
                                Appex.SeTupTable('getSecdb','getEditSec');
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
    },
    UpdateDept: function(){
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
                    var newDeptdesc = $('#updeptdesc').val();
                    var idData = $('#dataid').val();
                    var FormVal = 'action=editDept&newDept='+newDeptdesc+'&idData='+idData;
                    console.log(FormVal);
                    $.ajax({
                        type:'POST',
                        data:FormVal,
                        cache:false,
                        url:'../cabinet/exec.php',
                        success: function(data){
                            if(data == "1"){
                                Appex.Notifier('success','Data Saved','../..','top right','Data Successfuly updated!');
                                $('#ExpEditform').trigger('reset');
                                $("#exp_modalb").modal("hide");
                                Appex.SeTupTable('getDeptdb');
                            }else{
                                Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                                $('#ExpEditform').trigger('reset');
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
    },
    SaveStudent: function(){
        $('#savedt').click(function (e) {
            e.preventDefault();
            var studid = $('#studid').val();
            var fname = $('#fname').val();
            var mname = $('#mname').val();
            var lname = $('#lname').val();
            var exname = $('#exname').val();
            var yrlvl = $('#yrlvl').val();
            var course = $('#course').val();
            var FormVal = 'action=savestud&studid='+studid+'&fname='+fname+'&mname='+mname+'&lname='+lname+'&exname='+exname+'&yrlvl='+yrlvl+'&course='+course;
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
                    }else{
                        Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                        $('#Expform').trigger('reset');
                    }
                }
            });
        });
    },
    UpdateStud: function(){
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
                    var studid = $('#upstudid').val();
                    var fname = $('#upfname').val();
                    var mname = $('#upmname').val();
                    var lname = $('#uplname').val();
                    var exname = $('#upexname').val();
                    var yrlvl = $('#upyrlvl').val();
                    var course = $('#upcourse').val();
                    var FormVal = 'action=editstud&studid='+studid+'&fname='+fname+'&mname='+mname+'&lname='+lname+'&exname='+exname+'&yrlvl='+yrlvl+'&course='+course;
                    console.log(FormVal);
                    $.ajax({
                        type:'POST',
                        data:FormVal,
                        cache:false,
                        url:'../cabinet/exec.php',
                        success: function(data){
                            if(data == "1"){
                                Appex.Notifier('success','Data Saved','../..','top right','Data Successfuly updated!');
                                $('#ExpEditform').trigger('reset');
                                $("#exp_modalb").modal("hide");
                                Appex.SeTupTable('getStudentdb','getEditStudent');
                            }else{
                                Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                                $('#ExpEditform').trigger('reset');
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
    },
    SaveDept: function(){
        $('#savedt').click(function (e) {
            e.preventDefault();
            var deptdesc = $('#deptdesc').val();
            var FormVal = 'action=savedept&deptdesc='+deptdesc;
            console.log(FormVal);
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
                        Appex.SeTupTable('getDeptdb');
                    }else{
                        Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                        $('#Expform').trigger('reset');
                    }
                }
            });
        });
    },
    SaveDean: function(){
        $('#savedt').click(function (e) {
            e.preventDefault();
            var fname = $('#fname').val();
            var mname = $('#mname').val();
            var lname = $('#lname').val();
            var ename = $('#ename').val();
            var dept = $('#dept').val();
            var FormVal = 'action=savedean&fname='+fname+'&mname='+mname+'&lname='+lname+'&ename='+ename+'&dept='+dept;
            console.log(FormVal);
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
                    }else{
                        Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                        $('#Expform').trigger('reset');
                    }
                }
            });
        });
    },
    UpdateDean: function(){
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
                    var dataid = $('#dataid').val();
                    var fname = $('#upfname').val();
                    var mname = $('#upmname').val();
                    var lname = $('#uplname').val();
                    var ename = $('#upename').val();
                    var dept = $('#updept').val();
                    var FormVal = 'action=editdean&dataid='+dataid+'&fname='+fname+'&mname='+mname+'&lname='+lname+'&ename='+ename+'&dept='+dept;
                    console.log(FormVal);
                    $.ajax({
                        type:'POST',
                        data:FormVal,
                        cache:false,
                        url:'../cabinet/exec.php',
                        success: function(data){
                            if(data == "1"){
                                Appex.Notifier('success','Data Saved','../..','top right','Data Successfuly updated!');
                                $('#ExpEditform').trigger('reset');
                                $("#exp_modalb").modal("hide");
                                Appex.SeTupTable('getDeandb','getEditDean');
                            }else{
                                Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                                $('#ExpEditform').trigger('reset');
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