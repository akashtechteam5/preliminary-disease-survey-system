<html>
<head>
<title>CFRMMS ADMIN</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
body{
    margin: 0;
}
.footer_new {
    position:fixed;
    background: #333;
    color: white;
    padding: 10px 0px;
    bottom: 0;
    width: 100%;
}
.wrapper.b-t.bg-light {
    text-align: center;
}

.req:after{
    content:"*" ;
    color:red    
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}
.error-msg {
    color: #D8000C;
    background-color: #FFBABA;
    padding: 5px;
}
.success-msg {
    color: #270;
    background-color: #DFF2BF;
    padding: 5px;
}
table.list_table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
}

table.list_table td, table.list_table th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

table.list_table tr:nth-child(even) {
  background-color: #dddddd;
}

table.list_table td, table.list_table th{
    border: 1px solid;
    padding: 9px;
}
li.dropdown {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
</head>
<body id="body_bg">
<ul>
  <li><a class="active" href="<?php echo base_url().'supercontrol/home'; ?>">Home</a></li>
                                    
    <?php if($_SESSION['user_type']=="level_3") {  ?>                              
    <li><a href="<?php echo base_url().'supercontrol/admin_registration'?>">Admin Registration</a></li>                                
                                  
  <li><a href="<?php echo base_url().'supercontrol/admin_cc_registration'?>">Camp Registration</a></li>

  <li><a href="<?php echo base_url().'supercontrol/admin_add_area'?>">Add Area</a></li>
  <!--<li><a href="<?php echo base_url().'supercontrol/admin_add_cat'?>">Add Category</a></li>-->
  <li><a href="<?php echo base_url().'supercontrol/admin_add_item'?>">Add Item</a></li>
  <?php }  ?>  
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Report</a>
    <div class="dropdown-content">
      <a href="<?php echo base_url().'supercontrol/camp_list'?>">CAMP List</a>
      <a href="<?php echo base_url().'supercontrol/item_list'?>">Item List</a>
      <a href="<?php echo base_url().'supercontrol/missing_item'?>">Missing Item Report</a>
    </div>
  </li>
  <li style="float: right;"><a href="<?php echo base_url().'login/logout'?>">Logout</a></li>
</ul>
