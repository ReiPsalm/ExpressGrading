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
    * @param {String} placeholder Select placeholder
    * @param {String} domcl class name
    */
    SelectSearch: function(placeholder,domcl){
        $("."+domcl+"").select2({
            placeholder: ""+placeholder+"",
            width: 'resolve'
        });
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
    /**
    * DT for subject "HAAAYS SAMMYGONG YOUR LOGICAL SKILLS IS GOING DOWN :( "
    * NOTE: nag labad pa ako head saon to populate the columns base on dynamic json data... :3
    * @memberOf Appex
    * @param {String} jsonSource json srouce for the table data
    * @param {String} domID file source for the modal form and any html elements
    */
    SeTupCLTable: function(jsonSource,SrcData){
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
                { "mData": "Data_A", sDefaultContent: ""},
                { sDefaultContent: "" ,
                    "fnCreatedCell": function (nTd, sData, oData) {
                        $(nTd).html('<button value="'+oData.DataID+'" href="#exp_modalb" data-toggle="modal" onclick="Appex.GetDataModal(this.value,\''+SrcData+'\')" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Edit</button> ');
                    }
                },
            ]
        });
    },
    UpdateSubj: function(){
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
                    var subj = $('#upsubj').val();
                    var secid = $('#upSec').val();
                    var FormVal = 'action=upsubj&dataid='+dataid+'&subj='+subj+'&secid='+secid;
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
                                Appex.SeTupTable('getSubjdb','getEditsubj');
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
    SaveSubj: function(){
        $('#savedt').click(function (e) {
            e.preventDefault();
            var subj = $('#upsubj').val();
            var secid = $('#Sec').val();
            var FormVal = 'action=savesubj&subj='+subj+'&secid='+secid;
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
                        Appex.SeTupTable('getSubjdb','getEditsubj');
                    }else{
                        Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                        $('#Expform').trigger('reset');
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
            var yrlvl = $('#yrlvl').val();
            var subj = $('#subj').val();
            var course = $('#course').val();
            var FormVal = 'action=savestud&studid='+studid+'&fname='+fname+'&yrlvl='+yrlvl+'&subj='+subj+'&course='+course;
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
                        Appex.SeTupTable('getStudentdb','getEditStudent');
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
                    var yrlvl = $('#upyrlvl').val();
                    var subj = $('#upsubj').val();
                    var course = $('#upcourse').val();
                    var FormVal = 'action=editstud&studid='+studid+'&fname='+fname+'&yrlvl='+yrlvl+'&subj='+subj+'&course='+course;
                    
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
    },
    UploadMl: function(){
        $('#csvdt').click(function (e) {
            e.preventDefault();
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv)$/;
            if (regex.test($("#csvUpload").val().toLowerCase())) {
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var students = new Array();
                        var rows = e.target.result.split("\r\n");
                        for (var i = 0; i < rows.length; i++) {
                            var cells = rows[i].split(",");
                            if (cells.length > 1) {
                                var student = {};
                                student.Id = cells[0];
                                student.Name = cells[1];
                                student.Level = cells[2];
                                student.Course = cells[3];
                                students.push(student);
                            }
                        }
                        
                        var subjcsv = $('#subjcsv').val();
                        var FormVal = 'action=uploadcsv&subjcsv='+subjcsv+'&students='+JSON.stringify(students);
                        $.ajax({
                            type:'POST',
                            data:FormVal,
                            cache:false,
                            url:'../cabinet/exec.php',
                            success: function(data){
                                // console.log(JSON.stringify(students));
                                if(data == data){
                                    Appex.Notifier('success','Data Saved','../..','top right','Data Successfuly added!');
                                    $('#ExpMLform').trigger('reset');
                                    $("#exp_modalc").modal("hide");
                                    Appex.SeTupTable('getStudentdb','getEditStudent');
                                }else if(data == "0"){
                                    Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                                    $('#ExpMLform').trigger('reset');
                                }
                            }
                        });
                    }
                    reader.readAsText($("#csvUpload")[0].files[0]);
                } else {
                    alert("This browser does not support HTML5.");
                }
            } else {
                alert("Please upload a valid CSV file.");
            }
        });
    }
}