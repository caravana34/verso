<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $this->customlib->getAppName(); ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="theme-color" content="#5190fd" />
        <?php 
            $logoresult = $this->customlib->getLogoImage();
            if (!empty($logoresult['mini_logo'])) {
                $mini_logo = base_url() . 'uploads/hospital_content/logo/' . $logoresult['mini_logo']; 
            }else{
                $mini_logo = base_url() . 'backend/images/s-favican.png';
            }
         ?>
        <link href="<?php echo $mini_logo; ?>" rel="shortcut icon" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/style-main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/jquery.mCustomScrollbar.min.css">
        <?php
            $this->load->view('layout/theme');
            ?>
        <?php
            if ($this->customlib->getRTL() == "yes") {
                ?>
            <!-- Bootstrap 3.3.5 RTL -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/bootstrap-rtl/css/bootstrap-rtl.min.css"/> <!-- Theme RTL style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/AdminLTE-rtl.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/ss-rtlmain.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/skins/_all-skins-rtl.min.css" />
        <?php }?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/all.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/morris/morris.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/custom_style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/datepicker/css/bootstrap-datetimepicker.css">
        <!--file dropify-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/dropify.min.css">
        <!--file nprogress-->
        <link href="<?php echo base_url(); ?>backend/dist/css/nprogress.css" rel="stylesheet">
        <!--print table-->
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/buttons.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <!--print table mobile support-->
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>backend/dist/datatables/css/rowReorder.dataTables.min.css" rel="stylesheet">
        
        <script src="<?php echo base_url(); ?>backend/custom/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.js"></script>
        <script src="<?php echo base_url(); ?>backend/datepicker/date.js"></script>
        <script src="<?php echo base_url(); ?>backend/dist/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/js/school-custom.js"></script>
        
        
        <!-- fullCalendar -->
        <link rel="stylesheet" href="<?php echo base_url() ?>backend/fullcalendar/dist/fullcalendar.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>backend/fullcalendar/dist/fullcalendar.print.min.css" media="print">
        <link rel="stylesheet" href="<?php echo base_url() ?>backend/plugins/select2/select2.min.css">        
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/backend/dist/css/bootstrap-select.min.css">
        <link rel="canonical" href="https://quilljs.com/standalone/snow/">
        
        <!-- quill by bad_dev -->
        <link type="application/atom+xml" rel="alternate" href="https://quilljs.com/feed.xml" title="Quill - Your powerful rich text editor" />


        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" />

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" />

        <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css" />
        
        <style>
            
            .standalone-container {
/*                 margin: 50px auto;
                max-width: 720px; */
              }
              #snow-container {
                height: 350px;
              }
            
            .form-control {
                border-radius: 10px !important;
                box-shadow: none;
                border-color: #373838 !important;
            }
            .modal-header{
                background: linear-gradient(to right,#0000004d ,#cbcaca 100%) !important;
                color:#444;
                
            }
          
          .skin-blue .main-header .navbar{
           background:linear-gradient(#b7b5b3, #7c7b7a);
          }
          
          .modal-header h4{
            color:#444 !important;
          }
          
            .btn-primary {
                background-color: #cbcaca  !important;
                color: #444444;
            }
            
            .btn-info {
                background-color: #cbcaca  !important;
                border-color: #288cf1;
                color: #444444;
            }
            .select2-container--default .select2-selection--single{
                 border-radius: 10px !important;
                 border-color: #000 !important;
            }
            
            .button.dt-button, div.dt-button, a.dt-button{
                font-size: 18px !important;
            }
            
            .btn-group-xs>.btn, .btn-xs{
                font-size: 18px !important;
            }
            
            .btn-default{
                background-color: transparent  !important;
            }
            
            .dataTables_wrapper .dataTables_length{
                font-size: large !important;
            }
            
            textarea {
              width: 100%;
/*               min-height: 150px !important; */
              padding: 6px 10px !important;
              box-sizing: border-box;
              border: 2px solid #ccc;
              border-radius: 4px;
              background-color: #f8f8f8;
              font-size: 16px;
              resize: vertical;
            }
          
          .main-header .sidebar-session {
            color:#fff !important;
            
          }
          
          .skin-blue .main-header .navbar .sidebar-toggle {
            color:#fff !important;
            
          }
          
          .navbar-nav {
            color:#444 !important;
          }
          
          .skin-blue .main-header .navbar .nav>li>a {
            color:#fff !important;
          }
          
          .skin-blue .sidebar a {
            color: #ffffff;
            font-family: 'Roboto-Bold';
/*                 text-shadow: 0.1em 0.1em 3em black; */
          }
          
          
        .skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
            color: #fff;
            background:#1563b0;
            border-left-color: #fff;
          }
          
              .skin-blue .treeview-menu>li.active>a, .skin-blue .treeview-menu>li>a:hover {
                  color: #fff;
                  background:#1563b0;
              }


          .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {}
          
          
        </style>
    </head>
    <script type="text/javascript">
        var baseurl = "<?php echo base_url(); ?>";
        var chk_validate = "<?php echo $this->config->item('SHLK') ?>";
    </script>
  
    <body class="hold-transition skin-blue fixed sidebar-mini"> 
        <?php
        if ($this->config->item('SHLK') == "") {
            ?>
            <div class="topaleart" style="display:none">
                <div class="slidealert">
                    <div class="alert alert-dismissible topaleart-inside">
                        <p class="palert">Alert! You are using unregistered version of Smart Hospital. Please <a  href="#" class="purchasemodal">click here</a> to register your purchase code for Smart Hospital.</p>
                    </div>
                </div>
            </div>
            <?php
}
?>
        <script type="text/javascript">
          
            function collapseSidebar() {
                if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
                    sessionStorage.setItem('sidebar-toggle-collapsed', '');
                } else {
                    sessionStorage.setItem('sidebar-toggle-collapsed', '1');
                }
            }

            function checksidebar() {
                if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
                    var body = document.getElementsByTagName('body')[0];
                    body.className = body.className + ' sidebar-collapse';
                }
            }
            checksidebar();

            function capitalizeFirstLetter(string) {
                  return string.charAt(0).toUpperCase() + string.slice(1);
            }
            
        </script>
        <?php
$logoresult = $this->customlib->getLogoImage();
if (!empty($logoresult["image"])) {
    $logo_image = base_url() . "uploads/hospital_content/logo/" . $logoresult["image"];
} else {
    $logo_image = base_url() . "uploads/hospital_content/logo/s_logo.png";
}
if (!empty($logoresult["mini_logo"])) {
    $mini_logo = base_url() . "uploads/hospital_content/logo/" . $logoresult["mini_logo"];
} else {
    $mini_logo = base_url() . "uploads/hospital_content/logo/smalllogo.png";
}
?>
        <div class="wrapper">
            <header class="main-header" id="alert">
                <a href="<?php echo base_url(); ?>admin/admin/dashboard" class="logo">
                    <span style="background-color:#fff" class="logo-mini"><img width="31" height="auto" src="<?php echo $mini_logo.img_time(); ?>" alt="<?php echo $this->customlib->getAppName() ?>" /></span>
                    <span style="background-color:#fff" class="logo-lg"><img  src="<?php echo $logo_image.img_time(); ?>" alt="<?php echo $this->customlib->getAppName() ?>" /></span>
                </a>
                <nav style="" class="navbar navbar-static-top" role="navigation">
                    <a href="#"  onclick="collapseSidebar()"  class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-3">
                        <span href="#" class="sidebar-session">
                            <?php echo $this->setting_model->getCurrentHospitalName(); ?>
                        </span>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-9 col-xs-9">
                        <div class="pull-right">
                            <?php if (($this->rbac->hasPrivilege('patient', 'can_view'))) {?>
                                <form class="navbar-form navbar-left search-form" role="search"  action="<?php echo site_url('admin/admin/search'); ?>" method="POST">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="input-group" style="padding-top:3px;">
                                        <input type="text" name="search_text" class="form-control search-form search-form3" placeholder="<?php echo $this->lang->line('search_by_name'); ?>">
                                        <span class="input-group-btn">
                                            <button type="submit" name="search" id="search-btn" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            <?php }?>
                            <div class="navbar-custom-menu">
                                 <?php if ($this->rbac->hasPrivilege('language_switcher', 'can_view')) {
                                        ?>
                                    <div class="langdiv">
                                      <select class="languageselectpicker" onchange="set_languages(this.value)"  type="text" id="languageSwitcher" >

                                           <?php $this->load->view('admin/language/languageSwitcher')?>

                                        </select>
                                    </div>
                                    <?php
                                        }?> 
                                <ul class="nav navbar-nav headertopmenu">
                                    <?php 
                                    if ($this->rbac->hasPrivilege('notification_center', 'can_view')) {
                                            $systemnotifications = $this->notification_model->getCountUnreadNotification();

                                             ?>
                                            <li class="cal15">
                                                
                                                <a href="<?php echo base_url() . "admin/systemnotification" ?>">
                                                    <i class="fa fa-bell-o"></i>
                                                    <?php 

                                          echo ($systemnotifications->count > 0) ? "<span class='label label-warning'>".$systemnotifications->count."</span>" : "";
                                                   
                                                    ?>
                                                </a>
                                            </li>
                                    <?php 
                                }
                                ?>
                                    
                                    <?php if ($this->rbac->hasPrivilege('bed_status', 'can_view')) {?>
<!--                                         <li class="">
                                            <a data-target="modal" href="#" id='beddata' data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('loading'); ?>" onclick="getbedstatus()">
                                                <i class="fas fa-bed cal15"></i> 
                                                <span class="spanDM"><?php echo $this->lang->line('bed_status'); ?></span>
                                            </a>
                                    </li> -->
                                    <?php } if ($this->module_lib->hasActive('chat')) { ?>
                                     <li class="cal15">
                                        <a data-placement="bottom" data-toggle="tooltip" title="" href="<?php echo site_url('admin/chat')?>" data-original-title="<?php echo $this->lang->line('chat'); ?>" class="todoicon"><i class="fa fa-whatsapp"></i>  <?php  echo chat_couter() > 0 ? "<span class='label label-warning'>".chat_couter()."</span>": "" ?></a>
                                    </li> 
                                    <?php
                                }

                                  if ($this->module_lib->hasActive('calendar_to_do_list')) {
                                      if ($this->rbac->hasPrivilege('calendar_to_do_list', 'can_view')) {
                                          ?>
                                            <li class="cal15"><a href="<?php echo base_url() ?>admin/calendar/events" title="<?php echo $this->lang->line('calendar') ?>"><i class="fa fa fa-calendar"></i></a></li>
                                            <?php
                                                  }
                                                  }
                                                  ?>
                                    <?php
                                      if ($this->module_lib->hasActive('calendar_to_do_list')) {
                                          if ($this->rbac->hasPrivilege('calendar_to_do_list', 'can_view')) {
                                              ?>
                                            <li class="dropdown">
                                                <a href="#" title="<?php echo $this->lang->line('task') ?>" class="dropdown-toggle todoicon" data-toggle="dropdown">
                                                    <i class="fa fa-check-square-o"></i>
                                                    <?php
$userdata = $this->customlib->getUserData();

        $count = $this->customlib->countincompleteTask($userdata["id"]);
        if ($count > 0) {
            ?>

                                                        <span class="todo-indicator"><?php echo $count ?></span>
                                                    <?php }?>
                                                </a>
                                                <ul class="dropdown-menu menuboxshadow widthMo250">

                                                    <li class="todoview plr10 ssnoti"><?php echo $this->lang->line('today_you_have'); ?> <?php echo $count; ?> <?php echo $this->lang->line('pending_task'); ?><a href="<?php echo base_url() ?>admin/calendar/events" class="pull-right pt0"><?php echo $this->lang->line('view_all'); ?></a></li>
                                                    <li>
                                                        <ul class="todolist">
                                                            <?php
$tasklist = $this->customlib->getincompleteTask($userdata["id"]);
        foreach ($tasklist as $key => $value) {
            ?>
                                                                <li><div class="checkbox">
                                                                        <label><input type="checkbox" id="newcheck<?php echo $value["id"] ?>" onclick="markc('<?php echo $value["id"] ?>')" name="eventcheck"  value="<?php echo $value["id"]; ?>"><?php echo $value["event_title"] ?></label>
                                                                    </div></li>
                                                            <?php }?>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <?php
}
}
?>

                                    <?php
$file   = "";
$result = $this->customlib->getUserData();

$image = $result["image"];
$role  = $result["user_type"];
$id    = $result["id"];
if (!empty($image)) {

    $file = "uploads/staff_images/" . $image;
} else {

    $file = "uploads/staff_images/no_image.png";
}
?>
                                    <li class="dropdown user-menu">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                            <img src="<?php echo base_url() . $file.img_time(); ?>" class="topuser-image" alt="User Image">
                                        </a>
                                        <ul class="dropdown-menu dropdown-user menuboxshadow">
                                            <li>
                                                <div class="sstopuser">
                                                    <div class="ssuserleft">
                                                        <a href="<?php echo base_url() . "admin/staff/profile/" . $id ?>"><img src="<?php echo base_url() . $file.img_time(); ?>" alt="User Image"></a>
                                                    </div>

                                                    <div class="sstopuser-test">
                                                        <h4 style="text-transform: capitalize;"><?php echo $this->customlib->getAdminSessionUserName(); ?></h4>
                                                        <h5><?php echo $role; ?></h5>
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="sspass">
                                                        <a href="<?php echo base_url() . "admin/staff/profile/" . $id ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('my_profile'); ?>"><i class="fa fa-user"></i><?php echo $this->lang->line('profile'); ?></a>
                                                        <a class="pl25" href="<?php echo base_url(); ?>admin/admin/changepass" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('change_password') ?>"><i class="fa fa-key"></i><?php echo $this->lang->line('password'); ?></a> <a class="pull-right" href="<?php echo base_url(); ?>site/logout"><i class="fa fa-sign-out fa-fw"></i><?php echo $this->lang->line('logout'); ?></a>
                                                    </div>
                                                </div><!--./sstopuser-->
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
<script>
    function defoult(id){
      var defoult=  $('#languageSwitcher').val();
        $.ajax({
            type: "POST",
            url: base_url + "admin/language/defoult_language/"+id,
            data: {},
            success: function (data) {
                successMsg("<?php echo $this->lang->line('status_change_successfully'); ?>");
              $('#languageSwitcher').html(data);

            }
        });

        window.location.reload('true');        
    }
 
    function set_languages(lang_id){
        $.ajax({
            type: "POST",
            url: base_url + "admin/language/user_language/"+lang_id,
            data: {},
            success: function (data) {
                successMsg("<?php echo $this->lang->line('status_change_successfully'); ?>");
                 window.location.reload('true');

            }
        });
    }
  
//    window.addEventListener("load", startTime);
</script>
            <?php $this->load->view('layout/sidebar');?>