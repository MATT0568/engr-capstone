<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <?php include('validate.php'); ?>
</head>
<body>
  <?php include('../connect.php'); ?>
  <?php include('navigation.php'); ?>
  <!-- form for filling out project info -->
  <div class="container">
    <form method="post" action="" id="form1">
      <fieldset>
        <ul>
               <p><b>Please enter your project details:</b></p>
               <div class="row">
                 <div class="col-xl-5">
                 <label for="name" class="col-form-label">Academic Year:</label><input type="text" name="year" placeholder="17/18" step="any" class="form-control" role="input" aria-required="true" required/>
                 </div>
                 <div class="col-xl-5">
                 <label for="name" class="col-form-label">Sponsor:</label><select name="sponsor_id" aria-required="true" class="form-control" role="input">
                   <?php
                     $sql = 'SELECT * FROM SPONSOR';
                     $result = $conn->query($sql);
                     echo '<option label=" "></option>';
                     while ($row = $result->fetch_array()){
                       echo "<option value=\"" . $row['SPONSOR_ID'] . "\">". $row['ORGANIZATION'] . "</option>";
                     }
                   ?>
               </select></div></div>

              <div class="row">
                <div class="col-xl-5">
                  <label for="name" class="col-form-label">Mentor:</label><input type="text" name="mentor" placeholder="mentor" class="form-control" role="input" aria-required="true"/>
                </div>
                <div class="col-xl-5">
                  <label for="name" class="col-form-label">Department:</label><select name="department_id" aria-required="true" class="form-control" role="input" required>
                     <?php
                       $sql = 'SELECT * FROM DEPARTMENT';
                       $result = $conn->query($sql);
                       echo '<option label=" "></option>';
                       while ($row = $result->fetch_array()){
                         echo "<option value=\"" . $row['DEPARTMENT_ID'] . "\">". $row['NAME'] . "</option>";
                       }
                     ?></select>
                </div>
             </div>

              <div class="row">
                <div class="col-xl-5">
                  <label for="name" class="col-form-label">Faculty Advisor:</label><input type="text" name="faculty_advisor" placeholder="faculty advisor" class="form-control" role="input" aria-required="true"/>
                </div>
                <div class="col-xl-5">
                  <label for="name" class="col-form-label">Status:</label><select name="status_id" aria-required="true" class="form-control" role="input" required>
                     <?php
                       $sql = 'SELECT * FROM STATUS';
                       $result = $conn->query($sql);
                       echo '<option label=" "></option>';
                       while ($row = $result->fetch_array()){
                         echo "<option value=\"" . $row['STATUS_ID'] . "\">". $row['PROJECT_STATUS'] . "</option>";
                       }
                     ?>
                 </select>
               </div>
              </div>

               <div class="row">
                 <div class="col-xl-5">
                   <label for="name" class="col-form-label">Project Type:</label><input type="text" name="project_type" placeholder="project type" class="form-control" role="input" aria-required="true"/>
                 </div>
                 <div class="col-xl-5">
                   <label for="name" class="col-form-label">Project Number:</label><input type="text" name="project_number" placeholder="project number" class="form-control" role="input" aria-required="true" required/>
                 </div>
               </div>

               <div class="row">
                 <div class="col-xl-10">
                   <label for="name" class="col-form-label">Project Name:</label><input type="text" name="project_name" placeholder="project name" class="form-control" role="input" aria-required="true" required/>
                 </div>
               </div>

               <div class="row">
                 <div class="col-xl-5">
                   <label for="name" class="col-form-label">Index Code:</label><input type="number" name="index_code" placeholder="1234" step="any" class="form-control" role="input" aria-required="true"/>
                 </div>
                 <div class="col-xl-5">
                   <label for="name" class="col-form-label">Donation Received:</label><input type="number" name="donation" placeholder="5000" class="form-control" role="input" aria-required="true"/>
                 </div>
               </div>

               <div class="row">
                 <div class="col-xl-5">
                   <label for="name" class="col-form-label">Budget:</label><input type="number" name="capstone_budget" placeholder="5000" class="form-control" role="input" aria-required="true" required/>
                 </div>
                 <div class="col-xl-5">
                   <label for="name" class="col-form-label">Amount Spent:</label><input type="number" name="amount_spent" placeholder="0" class="form-control" role="input" aria-required="true" value="<?php print 0; ?>" required/>
                 </div>
               </div>

               <div class="row">
                 <div class="col-xl-10">
                   <label for="name" class="col-form-label">Supplemental Funding:</label><input type="number" name="supplemental_funding" placeholder="0" class="form-control" role="input" aria-required="true"value="<?php print 0; ?>"/>
                 </div>
               </div>

               <div class="row form-check form-check-inline">
                 <div class="form-check"><label for="name" class="col-form-label"><span>Service Learning?:&nbsp;</span><input class="checkbox" type="checkbox" id="checkbox" name="is_service_learning" value="0"/></label>
                     <?php
                       if(isset($_POST['is_service_learning'])){
                          $is_service_learning = 1;
                       }
                       else{
                          $is_service_learning = 0;
                       }
                     ?>
                 </div>

                 <div class="form-check"><label for="name" class="col-form-label"><span>Sternheimer?:&nbsp;</span><input type="checkbox" id="checkbox" name="is_sternheimer" value="0"/></label>
                     <?php
                       if(isset($_POST['is_sternheimer'])){
                          $is_sternheimer = 1;
                       }
                       else{
                          $is_sternheimer = 0;
                       }
                     ?>
                 </div>
                 <div class="form-check"><label for="name" class="col-form-label"><span>Business Collaboration?:&nbsp;</span><input type="checkbox" id="checkbox" name="is_partner" value="0"/></label>
                     <?php
                       if(isset($_POST['is_partner'])){
                          $is_partner = 1;
                       }
                       else{
                          $is_partner = 0;
                       }
                     ?>
                 </div>
                 <div class="form-check"><label for="name" class="col-form-label"><span>US Citizenship?:&nbsp;</span><input type="checkbox" id="checkbox" name="is_citizenship_required" value="0"/></label>
                     <?php
                       if(isset($_POST['is_citizenship_required'])){
                          $is_citizenship_required = 1;
                       }
                       else{
                          $is_citizenship_required = 0;
                       }
                     ?>
                 </div>
               </div>
               <div class="row checkboxes form-check form-check-inline">
                 <div class="form-check"><label for="name" class="col-form-label"><span>IP Assignment?:&nbsp;</span><input type="checkbox" id="checkbox" name="is_ip_assignment" value="0"/></label>
                     <?php
                       if(isset($_POST['is_ip_assignment'])){
                          $is_ip_assignment = 1;
                       }
                       else{
                          $is_ip_assignment = 0;
                       }
                     ?>
                 </div>
                 <div class="form-check"><label for="name" class="col-form-label"><span>IP Disclosure?:&nbsp;</span><input type="checkbox" id="checkbox" name="is_ip_disclosure" value="0"/></label>
                     <?php
                       if(isset($_POST['is_ip_disclosure'])){
                          $is_ip_disclosure = 1;
                       }
                       else{
                          $is_ip_disclosure = 0;
                       }
                     ?>
                 </div>
                 <div class="form-check"><label for="name" class="col-form-label"><span>Non Disclosure Agreement?:&nbsp;</span><input type="checkbox" id="checkbox" name="is_nondisclosure_agreement" value="0"/></label>
                     <?php
                       if(isset($_POST['is_nondisclosure_agreement'])){
                          $is_nondisclosure_agreement = 1;
                       }
                       else{
                          $is_nondisclosure_agreement = 0;
                       }
                     ?>
                 </div>
             </div>
           <div class="row">
             <div class="col-xl-10">
               <label for="name" class="col-form-label">Note:</label><textarea type="text" name="note" class="form-control" rows=6 role="input" aria-required="true"></textarea>
             </div>
           </div>
           <div class="row">
             <div class="col-xl-5">
               <div class="col-form-label"><button name="Submit" type="submit" class="btn btn-primary">Submit</button></div>
             </div>
           </div>
       </ul>
       <br/>
     </fieldset>
   </form>


  <?php
  // takes form data and inserts it into the database
    if (isset($_POST['Submit'])) {
      $sponsor_id = intval($_POST['sponsor_id']);
      $project_name = $conn->real_escape_string($_POST['project_name']);
      $project_number = $conn->real_escape_string($_POST['project_number']);
      $project_type = $conn->real_escape_string($_POST['project_type']);
      $note = $conn->real_escape_string($_POST['note']);
      $department_id = intval($_POST['department_id']);
      $mentor = $conn->real_escape_string($_POST['mentor']);
      $faculty_advisor = $conn->real_escape_string($_POST['faculty_advisor']);
      $index_code = intval($_POST['index_code']);
      $donation = intval($_POST['donation']);
      $year = $conn->real_escape_string($_POST['year']);
      $status_id = intval($_POST['status_id']);
      $capstone_budget = intval($_POST['capstone_budget']);
      $amount_spent = intval($_POST['amount_spent']);
      $supplemental_funding = intval($_POST['supplemental_funding']);
      $stid=$conn->prepare("INSERT INTO PROJECT(sponsor_id, project_name, project_number, project_type, note, department_id, mentor, faculty_advisor, index_code, donation, year, status_id, is_service_learning, is_ip_assignment, is_ip_disclosure, is_sternheimer, capstone_budget, amount_spent, supplemental_funding, is_partner, is_citizenship_required, is_nondisclosure_agreement) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $stid->bind_param('issssissiisiiiiiiiiiii', $sponsor_id, $project_name, $project_number, $project_type, $note, $department_id, $mentor, $faculty_advisor, $index_code, $donation, $year, $status_id, $is_service_learning, $is_ip_assignment, $is_ip_disclosure, $is_sternheimer, $capstone_budget, $amount_spent, $supplemental_funding, $is_partner, $is_citizenship_required, $is_nondisclosure_agreement) or die($stid->error);
      $stid->execute();
      $stid->fetch();
    }
  ?>
</div>
</body>
</html>
