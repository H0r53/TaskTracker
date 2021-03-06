<?php
#region validate session & query
session_start();
include_once("Utilities/SessionManager.php");
if(SessionManager::getAccountID() == 0)
{
    header("location: login.php");
}
include "DAL/roles.php";
include "DAL/notifications.php";
include "DAL/notificationtypes.php";
include "DAL/rolestopermissions.php";
include "DAL/messages.php";
include_once("DAL/accounts.php");
if($_SERVER["REQUEST_METHOD"] == "GET")
{
    if(isset($_GET['msg']))
        $alertmsg = $_GET['msg'];
    //existing roles being edited
    if(isset($_GET['cmd']) && isset($_GET['roleid']))
    {
        if($_GET['cmd'] == "edit" && is_numeric($_GET['roleid']))
        {
            $editrole = new Roles();
            $editrole->load($_GET['roleid']);
            $editroleid = $editrole->getRoleID();
            $editrolename = $editrole->getRole();
            $editdescription = $editrole->getDescription();
        }
    }
}
#endregion
/*
 * For Post Back (Submit)
 */
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $returnValue = true;
    if($_POST['dataRoleName'] == "")
    {
        $returnValue = false;
    }
    else
    {
        $rolename = $_POST['dataRoleName'];
    }
    if($_POST['txtDescription'] == "")
    {
        $returnValue = false;
    }
    else
    {
        $description = $_POST['txtDescription'];
    }
    if($returnValue)
    {
        if(isset($_POST["editroleid"]) && $_POST["editroleid"] > 0)
        {
            $rid = $_POST["editroleid"];
            if(is_numeric($rid))
            {
                $role = new Roles();
                $role->load($rid);
                $role->setRole($rolename);
                $role->setDescription($description);
                $role->save();
                header("location:ViewRole.php?roleid=$rid");
            }
        }
        else
        {
            $role = new Roles();
            $role->load(0);
            $role->setRole($rolename);
            $role->setDescription($description);
            $role->save();
            $rid = $role->getRoleID();
            header("location:ViewRole.php?roleid=$rid");
        }
    }
    else
    {
        header("location:CreateRole.php?msg=validate");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<?php include "navbar.php" ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <?php if(isset($editroleid)) { ?>
                    Edit <?php echo $editrolename ?> Role
                <?php } else { ?>
                    Create Role
                <?php } ?>
            </li>
        </ol>

        <div class="row">

            <div class="col-lg-8">
                <?php if(isset($alertmsg)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4> <?php  echo $alertmsg; ?> </h4>
                    </div>
                <?php } ?>
                <div class="card">
                    <div class="card-header"><i class="icon-organization m-auto"></i>
                        <?php if(isset($editroleid)) { ?>
                            <div class="row">
                                <div class="col-sm-9">
                                    Edit <?php echo $editrolename ?> Role
                                </div>
                                <div class="col-sm-3">

                                </div>
                            </div>

                        <?php } else { ?>
                            Create Role
                        <?php } ?>

                    </div>
                    <div class="card-body">

                        <form id="formCreateRole" method="post" onsubmit="return doValidation()">
                            <div class="form-group">
                                <label for="dataRoleName">Role name</label>
                                <input id="inputRoleName" class="form-control" name="dataRoleName" type="text" aria-describedby="nameHelp" placeholder="Enter role name" value="<?php if(isset($editrolename)) echo $editrolename ?>">
                            </div>
                            <div class="form-group">
                                <label for="txtDescription">Description</label>
                                <textarea id="inputDescription" name="txtDescription" class="form-control" rows="5"><?php if(isset($editdescription)) echo $editdescription ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <?php if(isset($editroleid)) { ?>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-6">
                                                <button class="btn btn-primary btn-block" type="submit">Save Changes</button>
                                            </div>
                                            <div class="col-6">
                                                <a class="btn btn-secondary btn-block" href="ViewRole.php?roleid=<?php echo $editroleid ?>">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-6">
                                                <button class="btn btn-primary btn-block" type="submit" onsubmit="">Create Role</button>
                                            </div>
                                            <div class="col-6">
                                                <a class="btn btn-secondary btn-block" href="index.php">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <input type="hidden" name="editroleid" value="<?php if(isset($editroleid)) echo $editroleid ?>">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Role To Permission Statistics
                    </div>
                    <div class="card-body">
                        <?php
                        $rtpl = Rolestopermissions::loadall();
                        $v = 0;
                        $w = 0;
                        $x = 0;
                        $y = 0;
                        $z = 0;
                        foreach($rtpl as $r){

                            if($r->getRoleID() == 1)
                            {
                                $v = $v + 1;
                            }
                            if($r->getRoleID() == 2)
                            {
                                $w = $w + 1;
                            }
                            if($r->getRoleID() == 3)
                            {
                                $x = $x + 1;
                            }
                            if($r->getRoleID() == 4)
                            {
                                $y = $y + 1;
                            }
                            if($r->getRoleID() == 5)
                            {
                                $z = $z + 1;
                            }
                        }
                        ?>
                        <div id="donut-example"></div>
                        <script>
                            Morris.Donut({
                                element: 'donut-example',
                                data: [
                                    {label: "Administrator", value: <?php echo $v; ?>},
                                    {label: "Developer", value: <?php echo $w; ?>},
                                    {label: "Project Manager", value: <?php echo $x; ?>},
                                    {label: "Quality Assurance", value: <?php echo $y; ?>},
                                    {label: "Client Role", value: <?php echo $z; ?>},
                                ]
                            });
                        </script>
                    </div>
                </div>
             </div>
        </div>

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
</div>
    <?php include "footer.php"?>
    <?php include "modal.php"?>
    <?php include "scripts.php" ?>

<script>
    function doValidation() {
        var isValid = true;
        var projectName = $("#inputRoleName").val();
        var description = $("#inputDescription").val();

        if(projectName.length > 0)
        {
            $("#inputRoleName").addClass("is-valid");
            $("#inputRoleName").removeClass("is-invalid");
        }
        else
        {
            $("#inputRoleName").addClass("is-invalid");
            $("#inputRoleName").removeClass("is-valid");
            isValid = false;
        }
        if(description.length > 0)
        {
            $("#inputDescription").addClass("is-valid");
            $("#inputDescription").removeClass("is-invalid");
        }
        else
        {
            $("#inputDescription").addClass("is-invalid");
            $("#inputDescription").removeClass("is-valid");
            isValid = false;
        }

        return isValid;
    }
</script>
</body>

</html>
