var Appex = null;

Appex = {
    upload: function(dataid){
        $('input[type=file]').trigger('click');

        $('input[type=file]').change(function() {
            
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
                    var fd = new FormData();
                    var files = $('#file')[0].files[0];
                    fd.append('file',files);

                    $.ajax({
                        type: 'POST',
                        data: fd,
                        url: '../cabinet/media.php',
                        contentType: false,
                        processData: false,
                        success: function(data){
                            console.log(data);
                            
                            if(data == "1"){
                                Appex.Notifier('success','Data Saved','../..','top right','Data Successfuly updated!');
                                $('#imgForm').trigger('reset');
                                Appex.GetDataSets(dataid,'getProfile','profile');
                            }else{
                                Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                                $('#imgForm').trigger('reset');
                            }
                        },
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
    DatePicker: function(){
        $(".datepicker-default").datepicker({
            todayHighlight: !0
        });
        console.log('datepicker clicked');
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
    * @param {String} format format for the input
    * @param {String} domID ID name
    */
    MaskedInput: function(domID,format){
        $("#"+domID+"").mask(""+format+"");
    },
    /**
    * Write XMLrequest for fetching all data
    *
    * @memberOf Appex
    * @param {String} dataSrc File name
    * @param {String} domID ID name
    */
    GetDataSets: function (dataID,dataSrc,domID){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(""+domID+"").innerHTML = xmlhttp.responseText;
            }
        };
        if(dataID == null){
            xmlhttp.open("GET", "../engine/"+dataSrc+".php", true);
            xmlhttp.send();
        }else{
            xmlhttp.open("GET", "../engine/"+dataSrc+".php?dataid="+dataID, true);
            xmlhttp.send();
        }
        console.log(dataSrc+domID+dataID);
    },
    /**
    * Write generic DataTable
    * NOTE: still in further modification
    * @memberOf Appex
    * @param {String} jsonSource json srouce for the table data
    * @param {String} SrcData file source for the modal form and any html elements
    */
    SeTupTable: function(jsonSource,SrcData){
        console.log(jsonSource+'-'+SrcData);
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
            "ordering": false,
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

        Appex.GetDataSets(dataID,dataSrc,domID);
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
    ExportCLR: function(dataID,dataGr){
        $.ajax({
            type:'POST',
            data:'dataID='+dataID+'&Grinfo='+dataGr,
            cache:false,
            url:'../engine/gradespdf.php',
            success: function(data){
                if(data == "1"){
                    Appex.Notifier('success','Data Export Complete','../..','top right','Class record Exported!');
                }else{
                    Appex.Notifier('error','Data Not Complete','../..','top right','Class record not exported, please try again!');
                }
            }
        });
    },
    /**
    * DT for class record "HAAAYS SAMMYGONG YOUR LOGICAL SKILLS IS GOING DOWN :( "
    * NOTE: nag labad pa ako head saon to populate the columns base on dynamic json data... :3
    * @memberOf Appex
    * @param {String} jsonSource json srouce for the table data
    * @param {String} domID file source for the modal form and any html elements
    */
    SeTupCLTable: function(jsonSource,SrcData){
        $('#data-table').dataTable().fnClearTable();
        $("#data-table").dataTable().fnDestroy();

        clientTableData = $('#data-table').DataTable({
            responsive: false,
            bAutoWidth:false,

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
                { "mData": "Data_A", sDefaultContent: ""},
                { "mData": "Data_B", sDefaultContent: ""},
                { "mData": "Data_C", sDefaultContent: ""},
                { "mData": "Data_D", sDefaultContent: ""},
                { "mData": "Data_E", sDefaultContent: ""},
                { "mData": "Data_F", sDefaultContent: ""},
                { sDefaultContent: "" ,
                    "fnCreatedCell": function (nTd, sData, oData) {
                        $(nTd).html('<button value="'+oData.DataID+'" onclick="Appex.GetDataCLr(this.value)" class="btn btn-success btn-xs"><i class="fa fa-book"></i> Open Class Record</button> '+
                        '<button value="'+oData.DataID+'" href="#exp_modalb" data-toggle="modal" onclick="Appex.GetDataModal(this.value,\''+SrcData+'\')" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</button> ');
                    }
                },
            ]
        });
    },
    /**
    * @memberOf Appex
    * @param {String} jsonSource json srouce for the table data
    * @param {String} domID file source for the modal form and any html elements
    * @param {String} dataID id parameter for clr reference
    */
   SeTupCLDt: function(jsonSource,SrcData,dataID){
        $('#data-table').dataTable().fnClearTable();
        $("#data-table").dataTable().fnDestroy();
        clientTableData = $('#data-table').DataTable({
            responsive: true,
            bAutoWidth: true,

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

            "sAjaxSource": "../engine/"+jsonSource+".php?dataid="+dataID,
            "sAjaxDataProp": "",
            "iDisplayLength": 10,
            "scrollCollapse": false,
            "paging": true,
            "searching": true,
            "ordering": false,
            "columns": [

                { "mData": "DataID", sDefaultContent: ""},
                { "mData": "Data_A", sDefaultContent: ""},
                { sDefaultContent: "" ,
                    "fnCreatedCell": function (nTd, sData, oData) {
                        // $(nTd).html('<div class="btn-group m-r-5 m-b-5"><select class="btn btn-success btn-xs attendance_value" onchange="Appex.GetAttendanceVal(this.value,'+oData.DataID+','+dataID+')" data-att="undefined">'+
                        //             '<option class="btn btn-success" value="x" disabled selected>Attendance</option><option value="5">Present</option><option value="0">Absent</option><option value="3">Excused</option>'+
                        //             '</select></div>'+
                        //             '<div class="btn-group m-r-5 m-b-5"><button value="'+oData.DataID+'" onclick="Appex.GetDataSets(\''+oData.DataID+'-'+dataID+'\',\'getTabsClr\',\'studTabs\')" href="#exp_modalr" data-toggle="modal" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View Student Record</button></div>');

                        $(nTd).html('<div class="btn-group m-r-5 m-b-5"><select class="btn btn-success btn-xs period_value" onchange="Appex.GetAttendanceVal(this.value,'+oData.DataID+','+dataID+')" data-att="undefined">'+
                                    '<option class="btn btn-success" value="x" disabled selected>Attendance</option><option value="5">Present</option><option value="0">Absent</option><option value="3">Excused</option>'+
                                    '</select></div>');
                    }
                },
                {sDefaultContent: "",
                    "fnCreatedCell": function (nTd, sData, oData) {
                        $(nTd).html('<input type="text" class="form-control oral_value period_value" onfocus="Appex.GetPointsVal('+"'oral_value'"+','+oData.DataID+','+dataID+')" placeholder="Click here" data-att="undefined" readonly>');
                    }
                },
                {sDefaultContent: "",
                    "fnCreatedCell": function (nTd, sData, oData) {
                        $(nTd).html('<input type="text" class="form-control quiz_value period_value" onfocus="Appex.GetPointsVal('+"'quiz_value'"+','+oData.DataID+','+dataID+')" placeholder="Click here" data-att="undefined" readonly>');
                    }
                },
                {sDefaultContent: "",
                    "fnCreatedCell": function (nTd, sData, oData) {
                        $(nTd).html('<input type="text" class="form-control exam_value period_value" onfocus="Appex.GetPointsVal('+"'exam_value'"+','+oData.DataID+','+dataID+')" placeholder="Click here" data-att="undefined" readonly>');
                    }
                },
                {sDefaultContent: "",
                    "fnCreatedCell": function (nTd, sData, oData) {
                        $(nTd).html('<div class="btn-group m-r-5 m-b-5"><button value="'+oData.DataID+'" onclick="Appex.GetDataSets(\''+oData.DataID+'-'+dataID+'\',\'getTabsClr\',\'studTabs\')" href="#exp_modalr" data-toggle="modal" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View Record</button></div>');
                    }
                }
            ]
        });

    },
    SortStudent: function(){
        $('#sortdt').click(function (e) {
            e.preventDefault();
            var sortSubj = $('#sortSubj').val();

            Appex.Notifier('success','Data Sorted','../..','top right','Data Successfuly sorted!');
            $('#ExpSortform').trigger('reset');
            $("#exp_sort").modal("hide");
            Appex.SeTupTableStud('getStudentdb','getEditStudent',sortSubj);
        });
    },
    /**
    * Write generic DataTable
    * NOTE: still in further modification
    * @memberOf Appex
    * @param {String} jsonSource json srouce for the table data
    * @param {String} SrcData file source for the modal form and any html elements
    * @param {String} dataID file source for the modal form and any html elements
    */
    SeTupTableStud: function(jsonSource,SrcData,dataID){
        console.log(jsonSource+'-'+SrcData);
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

            "sAjaxSource": "../engine/"+jsonSource+".php?subjid="+dataID,
            "sAjaxDataProp": "",
            "iDisplayLength": 10,
            "scrollCollapse": false,
            "paging": true,
            "searching": true,
            "ordering": false,
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
    UpdateInfo: function(){
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
                    var fname = $('#upfname').val();
                    var mname = $('#upmname').val();
                    var lname = $('#uplname').val();
                    var ename = $('#upename').val();
                    var mobile = $('#upmobile').val();
                    var home = $('#uphome').val();
                    var pcity = $('#upcity').val();
                    var gender = $('#upgender').val();
                    var bday = $('#upbday').val();
                    var work = $('#upoffice').val();
                    var dataid = $('#dataid').val();

                    var acctid= $('#acctid').val();
                    var user= $('#upuser').val();
                    var pass= $('#uppass').val();
                    var role= $('#uprole').val();

                    var b = '&mobile='+mobile+'&home='+home+'&city='+pcity+'&sex='+gender+'&bday='+bday+'&work='+work+'&acctid='+acctid+'&user='+user+'&pass='+pass+'&role='+role;
                    var FormVal = 'action=saveprof&dataid='+dataid+'&fname='+fname+'&mname='+mname+'&lname='+lname+'&ename='+ename+b;
                    
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
                                $("#exp_infoForm").modal("hide");
                                Appex.GetDataSets(dataid,'getProfile','profile');
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
                        Appex.SeTupTable('getCourse','getCoursedb');
                    }else{
                        Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                        $('#Expform').trigger('reset');
                    }
                }
            });
        });
    },
    SaveSchool: function(){
        $('#savedt').click(function (e) {
            e.preventDefault();
            var school = $('#school').val();
            var FormVal = 'action=saveschool&school='+school;
            $.ajax({
                type:'POST',
                data:FormVal,
                cache:false,
                url:'../cabinet/exec.php',
                success: function(data){
                    if(data == "1"){
                        Appex.Notifier('success','Data Saved','../..','top right','Data Successfuly added!');
                        $('#Schoolform').trigger('reset');
                        $("#exp_modal").modal("hide");
                        Appex.SeTupTable('getSchool');
                    }else{
                        Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                        $('#Schoolform').trigger('reset');
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
                                Appex.SeTupTable('getCourse','getCoursedb');
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
                                Appex.SeTupTable('getDeptdb','getEditDept');
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
    UpdateSchool: function(){
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
                    var newSchooldesc = $('#upschool').val();
                    var idData = $('#dataid').val();
                    var FormVal = 'action=editschool&newschool='+newSchooldesc+'&idData='+idData;
                    console.log(FormVal);
                    $.ajax({
                        type:'POST',
                        data:FormVal,
                        cache:false,
                        url:'../cabinet/exec.php',
                        success: function(data){
                            if(data == "1"){
                                Appex.Notifier('success','Data Saved','../..','top right','Data Successfuly updated!');
                                $('#Schoolform').trigger('reset');
                                $("#exp_modalb").modal("hide");
                                Appex.SeTupTable('getSchool');
                            }else{
                                Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                                $('#Schoolform').trigger('reset');
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
                        Appex.SeTupTable('getDeptdb','getEditDept');
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
                        Appex.SeTupTable('getDeandb','getEditDean');
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
                        var FormVal = 'action=uploadcsv&classcsv='+subjcsv+'&students='+JSON.stringify(students);
                        console.log(FormVal);
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
    },
    SaveCLr: function(){
        $('#savedt').click(function (e) {
            e.preventDefault();
            var mclsy = $('#mclsy').val();
            var mcltd = $('#mcltd').val();
            var mclsch = $('#mclsch').val();
            var mclt = $('#mclt').val();
            var mclsubj = $('#mclsubj').val();
            var mcldean = $('#mcldean').val();
            var FormVal = 'action=SaveCLr&mclsy='+mclsy+'&mcltd='+mcltd+'&mclsch='+mclsch+'&mclt='+mclt+'&mclsubj='+mclsubj+'&mcldean='+mcldean;
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
                        Appex.SeTupCLTable('getClassdb','getEditCL');
                    }else{
                        Appex.Notifier('error','Data Not Saved','../..','top right','Data was not saved, please try again!');
                        $('#Expform').trigger('reset');
                    }
                }
            });
        });
    },
    EditCLr: function(){
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
                    var upmclid = $('#upmclid').val();
                    var upmclsy = $('#upmclsy').val();
                    var upmcltd = $('#upmcltd').val();
                    var upmclsch = $('#upmclsch').val();
                    var upmclt = $('#upmclt').val();
                    var upmclsubj = $('#upmclsubj').val();
                    var upmcldean = $('#upmcldean').val();
                    var FormVal = 'action=UpCLr&upmclid='+upmclid+'&upmclsy='+upmclsy+'&upmcltd='+upmcltd+'&upmclsch='+upmclsch+'&upmclt='+upmclt+'&upmclsubj='+upmclsubj+'&upmcldean='+upmcldean;
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
                                Appex.SeTupCLTable('getClassdb','getEditCL');
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
    GetCurrSY: function(){
        // console.log(curSy);
        $('#data-table').dataTable().fnClearTable();
        $("#data-table").dataTable().fnDestroy();

        clientTableData = $('#data-table').DataTable({
            responsive: false,
            bAutoWidth:false,

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

            "sAjaxSource": "../engine/getClassdb.php",
            "sAjaxDataProp": "",
            "iDisplayLength": 5,
            "scrollCollapse": false,
            "paging": true,
            "searching": true,
            "ordering": true,
            "columns": [

                { "mData": "DataID", sDefaultContent: ""},
                { "mData": "Data_A", sDefaultContent: ""},
                { "mData": "Data_B", sDefaultContent: ""},
                { "mData": "Data_C", sDefaultContent: ""},
                { "mData": "Data_D", sDefaultContent: ""},
                { "mData": "Data_E", sDefaultContent: ""},
                { "mData": "Data_F", sDefaultContent: ""},
                { sDefaultContent: "" ,
                    "fnCreatedCell": function (nTd, sData, oData) {
                        $(nTd).html('<button value="'+oData.DataID+'" onclick="Appex.MoveArchive(this.value)" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Archive</button> ');
                    }
                },
            ]
        });
    },
    MoveArchive: function(dataID){
        swal({
            title: "Are you sure?",
            text: "Archived data will only have a lifespan of only 90 days!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Move to Archive",
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: true,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    type:'POST',
                    data:'action=clArchive&crid='+dataID,
                    cache:false,
                    url:'../cabinet/exec.php',
                    success: function(data){
                        if(data == "1"){
                            Appex.Notifier('success','Data Saved','../..','top right','Data move to Archive!');
                            Appex.GetCurrSY();
                        }else{
                            Appex.Notifier('error','Data Not Saved','../..','top right','Data move failed, please try again!');
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
    },
    GetDataCLr: function(clrID){
        window.location.href = "clr.php?dataid="+clrID;
    },
    GetAttendanceVal: function(points,student_id,cr_id){
        var period = $('#cr_period').val();
        if(period == 'undefined' || period == '' || period == 'x' ||period == null){
            Appex.Notifier('warning','Warning','../..','top right','Please select period first!');
            $('.period_value').find('option:eq(0)').prop('selected', true);
        }else{
            var FormVal = 'action=SaveAtt&points='+points+'&student_id='+student_id+'&period='+period+'&cr_id='+cr_id;
            $.ajax({
                type:'POST',
                cache: false,
                url: '../cabinet/exec.php',
                data: FormVal,
                success: function(e){
                    console.log(e);
                }
            });
        }       
    },
    GetPointsVal: function(points_type,student_id,cr_id){           
        var period = $('#cr_period').val();
        if(period == 'undefined' || period == '' || period == 'x' ||period == null){
            Appex.Notifier('warning','Warning','../..','top right','Please select period first!');
        }else{
            console.log(period+points_type);
            $("."+points_type+"").on('click',function(e){
                $(this).attr('readonly',false);
            });
    
            $("."+points_type+"").one('blur',function(e){
                var save;
                var points;
                var class_type = $(this).attr('class').split(' ')[1];
                var points = $(this).val();
                
                if(class_type == 'oral_value'){
                    save    = 'SaveOral';
                }else if(class_type == 'exam_value'){
                    save    = 'SaveExam';
                }else if(class_type == 'quiz_value'){
                    save    = 'SaveQuiz';
                }
                
                $(this).attr('readonly',true);
                var FormVal = 'action='+save+'&points='+points+'&student_id='+student_id+'&period='+period+'&cr_id='+cr_id;
                 
                if(points != ''){           
                    $.ajax({
                        type:'POST',
                        cache: false,
                        url: '../cabinet/exec.php',
                        data: FormVal,
                        success: function(e){
                            if(e == 'Saved'){
                                Appex.Notifier('success','Data Saved','../..','top right','Data Successfuly submitted!');
                            }else if(e == 'Updated'){
                                Appex.Notifier('success','Data Saved','../..','top right','Data Successfuly updated!');
                            }                  
                        }     
                    });
                }
            });
        }     
    }
    
}
