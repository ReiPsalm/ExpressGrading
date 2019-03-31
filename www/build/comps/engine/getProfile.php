<?php
include_once "../engine/loader.php";
$Users->id = $_GET['dataid'];
$getData = $Users->Getuser();
$row = $getData->fetchArray(SQLITE3_ASSOC);
?>
<!-- begin profile-section -->
<div class="profile-section">
    <!-- begin profile-left -->
    <div class="profile-left">
        <!-- begin profile-image -->
        <div class="profile-image">
            <img src="../../library/img/<?php echo $row['ins_img']; ?>" />
            <i class="fa fa-user hide"></i>
        </div>
        <!-- end profile-image -->
        <div class="m-b-10">
            <form method="post" id="imgForm" enctype="multipart/form-data">
                <input type="file" id="file" name="file" style="visibility:hidden;" />
                <button type="button" name="upimg" value="<?php echo $_GET['dataid'] ?>" onclick="Appex.upload(this.value)" class="btn btn-warning btn-block btn-sm">Change Picture <i class="fa fa-camera"></i></button>
            </form>
            <button value="<?php echo $_GET['dataid'] ?>" onclick="Appex.GetDataModal(this.value,'getEditProfile')" href="#exp_infoForm" data-toggle="modal" class="btn btn-info btn-block btn-sm">Update Info <i class="fa fa-pencil"></i></button>
        </div>
    </div>
    <!-- end profile-left -->
    <!-- begin profile-right -->
    <div class="profile-right">
        <!-- begin profile-info -->
        <div class="profile-info">
            <!-- begin table -->
            <div class="table-responsive">
                <table class="table table-profile">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                <h4>
                                    <?php echo $row['ins_fname']; ?>
                                    <?php echo $row['ins_mname']; ?>
                                    <?php echo $row['ins_lname']; ?>
                                </h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="highlight">
                            <td class="field">Role</td>
                            <td><?php echo $row['user_role']; ?></td>
                        </tr>
                        <tr class="divider">
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td class="field">Mobile</td>
                            <td><?php echo $row['ins_mobile']; ?></td>
                        </tr>
                        <tr>
                            <td class="field">Home</td>
                            <td><?php echo $row['ins_address']; ?></td>
                        </tr>
                        <tr>
                            <td class="field">City</td>
                            <td><?php echo $row['ins_city']; ?></td>
                        </tr>
                        <tr>
                            <td class="field">Office</td>
                            <td><?php echo $row['ins_office']; ?></td>
                        </tr>
                        <tr>
                            <td class="field">Birthday</td>
                            <td><?php echo $row['ins_bday']; ?></td>
                        </tr>
                        <tr>
                            <td class="field">Gender</td>
                            <td><?php echo $row['ins_gender']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- end table -->
        </div>
        <!-- end profile-info -->
    </div>
    <!-- end profile-right -->
</div>
<!-- end profile-section -->