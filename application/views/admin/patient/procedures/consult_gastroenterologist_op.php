<div class="content-wrapper" style="min-height: 1331px;">
  <section class="content">
    <div class="box box-primary">
      <div class="box border0 mb0">
        <div class="nav-tabs-custom border0 mb0" id="tabs">
          <div class="scrtabs-tab-container" style="visibility: visible;">
            <div class="scrtabs-tab-scroll-arrow scrtabs-js-tab-scroll-arrow-left" style="display: block;"><span class="fa fa-chevron-left"></span></div>
            <div class="scrtabs-tabs-fixed-container" style="width: 1256px;">
              <div class="scrtabs-tabs-movable-container" style="width: 1629px;">
                <ul class="nav nav-tabs navlistscroll">
                  <li class="active"><a href="#overview" data-toggle="tab" aria-expanded="true"><i class="fa fa-th"></i> Visión General</a></li>
                  <li>
                    <a href="#nurse_note" data-toggle="tab" aria-expanded="true"><i class="fas fa-sticky-note"></i> Notas de Enfermería</a>
                  </li>
                  <li>
                    <a href="#medication" class="medication" data-toggle="tab" aria-expanded="true"><i class="fa fa-medkit" aria-hidden="true"></i>Signos vitales</a>
                  </li>

                  <li>
                    <a href="#prescription" data-toggle="tab" aria-expanded="true"><i class="far fa-calendar-check"></i> Prescription</a>
                  </li>

                  <li class="">
                    <a href="#consultant_register" data-toggle="tab" aria-expanded="true"><i class="fas fa-file-prescription"></i> Consultant Register</a>
                  </li>

                  
                  <li>
                    <a href="#operationtheatre" class="operationtheatre" data-toggle="tab" aria-expanded="true"><i class="fas fa-cut" aria-hidden="true"></i> Operations</a>

                  </li>


                  <li>
                    <a href="#charges" data-toggle="tab" aria-expanded="true"><i class="fas fa-donate"></i> Charges</a>
                  </li>

                  <li>
                    <a href="#payment" data-toggle="tab" aria-expanded="true"><i class="fas fa-hand-holding-usd"></i> Payments</a>
                  </li>
                  <li>
                    <a href="#live_consult" class="live_consult" data-toggle="tab" aria-expanded="true"><i class="fa fa-video-camera ftlayer"></i> Live Consultation</a>
                  </li>
                  <li>
                    <a href="#bed_history" class="bed_history" data-toggle="tab" aria-expanded="true"><i class="fas fa-procedures"></i> Bed History</a>
                  </li>


                  <li>
                    <a href="#timeline" data-toggle="tab" aria-expanded="true"><i class="far fa-calendar-check"></i> Timeline</a>
                  </li>




                  <li>
                    <a href="#treatment_history" data-toggle="tab" aria-expanded="true"><i class="fas fa-hourglass-half"></i> Treatment History</a>
                  </li>


                </ul>
              </div>
            </div>
            <div class="scrtabs-tab-scroll-arrow scrtabs-js-tab-scroll-arrow-right" style="display: block;"><span class="fa fa-chevron-right"></span></div>
          </div>

          <div class="tab-content">
            <div class="tab-pane tab-content-height active" id="overview">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 border-r">
                  <div class="box-header border-b mb10 pl-0 pt0">
                    <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Alisha Knowles (896)</h3>
                    <div class="pull-right">
                      <div class="editviewdelete-icon pt8">
                        <a class="" href="#" onclick="getRecord('87')" data-toggle="tooltip" title="Profile"><i class="fa fa-reorder"></i>
                              </a>
                        <a class="" href="#" onclick="getEditRecord('87')" data-toggle="tooltip" title="Edit Profile"><i class="fa fa-pencil"></i>
                                      </a>

                        <a class="patient_discharge" href="#" data-toggle="tooltip" title="Patient Discharge"><i class="fa fa-hospital-o"></i>
                                      </a>


                        <a class="" href="#" onclick="deleteIpdPatient('87')" data-toggle="tooltip" title="Delete Patient"><i class="fa fa-trash"></i>
                                      </a>


                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 ptt10">

                      <img width="115" height="115" class="profile-user-img img-responsive img-rounded" src="https://demo.smart-hospital.in/uploads/patient_images/no_image.png?1698356486">

                    </div>
                    <!--./col-lg-5-->
                    <div class="col-lg-9 col-md-8 col-sm-12">
                      <table class="table table-bordered mb0">
                        <tbody>
                          <tr>
                            <td class="bolds">Gender</td>
                            <td>Female</td>
                          </tr>
                          <tr>
                            <td class="bolds">Age</td>
                            <td>42 Year 2 Month 18 Days</td>
                          </tr>
                          <tr>
                            <td class="bolds">Guardian Name</td>
                            <td>Lucas Knowles</td>
                          </tr>

                          <tr>
                            <td class="bolds">Phone</td>
                            <td>7248525252</td>
                          </tr>


                        </tbody>
                      </table>
                    </div>
                    <!--./col-lg-7-->
                  </div>
                  <!--./row-->
                  <hr class="hr-panel-heading hr-10">
                  <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                      <div class="align-content-center pt25">
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <td class="bolds">Case ID</td>
                              <td>4991</td>
                            </tr>
                            <tr>
                              <td class="bolds">IPD No</td>
                              <td>IPDN87</td>
                            </tr>
                            <tr>
                              <td class="white-space-nowrap bolds" width="40%">Admission Date</td>
                              <td>10/28/2023 12:26 PM</td>
                            </tr>
                            <tr>
                              <td class="bolds">Bed</td>
                              <td>TF - 106 - General Ward Male - 3rd Floor</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="chart-responsive text-center">
                        <div class="chart">
                          <canvas id="pieChart" style="height: 193px; width: 196px;" width="196" height="193"><span></span></canvas>
                        </div>

                        <p class="font12 mb0 font-medium">Credit Limit: $20000</p>
                        <p class="font12 mb0 font-medium text-danger">Used Credit Limit: $225</p>
                        <p class="font12 mb0 font-medium text-success-xl">Balance Credit Limit: $19775</p>
                      </div>
                    </div>
                  </div>
                  <hr class="hr-panel-heading hr-10">
                  <p><b><i class="fa fa-tag"></i> Known Allergies</b></p>

                  <ul class="list-pl-3">
                    <li>
                      <div>Fast Food</div>
                    </li>
                  </ul>

                  <hr class="hr-panel-heading hr-10">
                  <p><b><i class="fa fa-tag"></i> Finding</b></p>
                  <ul class="list-pl-3">

                    <li>
                      Stomach pain Typhoid fever and paratyphoid fever have similar symptoms̵. People usually have a sustained fever (one that doesn’t come and go) that can be as high as 103–104°F (39–40°C). Diarrhea or constipation Some people with typhoid fever or paratyphoid
                      fever develop a rash of flat, rose-colored spots. </li>

                  </ul>

                  <hr class="hr-panel-heading hr-10">
                  <p><b><i class="fa fa-tag"></i> Symptoms</b></p>
                  <ul class="list-pl-3">

                    <li>
                      <div>Thirst Thirst is the feeling of needing to drink something. It occurs whenever the body is dehydrated for any reason. Any condition that can result in a loss of body water can lead to thirst or exces</div>
                    </li>
                  </ul>
                  <hr class="hr-panel-heading hr-10">
                  <div class="box-header mb10 pl-0">
                    <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Consultant Doctor</h3>
                    <div class="pull-right">
                      <div class="editviewdelete-icon pt8">
                        <a href="#" class=" dropdown-toggle adddoctor" onclick="get_doctoripd('87')" title="Add Doctor" data-toggle="tooltip"><i class="fa fa-plus"></i>  
                                           </a>
                      </div>
                    </div>
                  </div>
                  <div class="staff-members">
                    <div class="media">
                      <div class="media-left">
                        <a href="https://demo.smart-hospital.in/admin/staff/profile/4">
                                                          <img src="https://demo.smart-hospital.in/uploads/staff_images/4.jpg?1698356486" class="member-profile-small media-object"></a>
                      </div>
                      <div class="media-body">

                        <h5 class="media-heading"><a href="https://demo.smart-hospital.in/admin/staff/profile/4">Sansa Gomez (9008)</a>


                        </h5>
                      </div>
                    </div>
                    <!--./media-->

                  </div>
                  <!--./staff-members-->


                  <div class="box-header mb10 pl-0">
                    <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Nurse Notes</h3>
                    <div class="pull-right">

                    </div>
                  </div>
                  <div class="timeline-header no-border pb1">
                    <div id="timeline_list">
                      <ul class="timeline timeline-inverse">

                        <li class="time-label">
                          <span class="bg-blue">   
                                                  10/28/2023 12:35 PM</span>
                        </li>
                        <li>
                          <i class="fa fa-list-alt bg-blue"></i>
                          <div class="timeline-item">



                            <h3 class="timeline-header text-aqua"> April Clinton ( 9020 ) </h3>

                            <div class="timeline-body">
                              Note<br>Take medicine after meal everyday .
                            </div>

                            <div class="timeline-body">
                              Comment<br> Take medicine after meal everyday .
                            </div>



                          </div>
                        </li>

                        <li><i class="fa fa-clock-o bg-gray"></i></li>

                      </ul>
                    </div>
                  </div>
                  <hr>
                  <div class="box-header mb10 pl-0">
                    <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Timeline</h3>
                    <div class="pull-right">

                    </div>
                  </div>
                  <div class="timeline-header no-border">
                    <div id="timeline_list">
                      <ul class="timeline timeline-inverse">

                        <li class="time-label">
                          <span class="bg-blue">    
                                                  10/28/2023</span>
                        </li>
                        <li>
                          <i class="fa fa-list-alt bg-blue"></i>
                          <div class="timeline-item">
                            <span class="time"></span>
                            <span class="time"></span>


                            <h3 class="timeline-header text-aqua"> Urgent Appointment </h3>
                            <div class="timeline-body">
                              Urgent Appointment
                            </div>
                          </div>
                        </li>

                        <li><i class="fa fa-clock-o bg-gray"></i></li>

                      </ul>
                    </div>
                  </div>
                </div>
                <!--./col-lg-6-->
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="row">
                    <div class="col-md-6 project-progress-bars">
                      <div class="row">
                        <div class="col-md-12 mtop5">
                          <div class="topprograssstart">
                            <h5 class="text-uppercase mt5 bolds">IPD Payment/Billing<span class="pull-right text-gray-light"><i class="fas fa-procedures"></i></span>
                            </h5>
                            <p class="text-muted bolds mb4">90.20%<span class="pull-right"> $1150.00/$1275.00</span></p>
                            <div class="progress-group">
                              <div class="progress progress-minibar">
                                <div class="progress-bar progress-bar-aqua" style="width: 90.20%"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--./row-->
                    </div>
                    <!--./col-lg-6-->

                    <div class="col-md-6 project-progress-bars">
                      <div class="row">
                        <div class="col-md-12 mtop5">
                          <div class="topprograssstart">
                            <h5 class="text-uppercase mt5 bolds">Pharmacy Payment/Billing<span class="pull-right text-gray-light"><i class="fas fa-mortar-pestle"></i></span>
                            </h5>
                            <p class="text-muted bolds mb4">84.62%<span class="pull-right"> $550/$650.00</span></p>
                            <div class="progress-group">
                              <div class="progress progress-minibar">
                                <div class="progress-bar progress-bar-aqua" style="width: 84.62%"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--./col-lg-6-->

                  </div>
                  <!--./row-->
                  <div class="row">

                    <div class="col-md-6 project-progress-bars">
                      <div class="row">
                        <div class="col-md-12 mtop5">
                          <div class="topprograssstart">
                            <h5 class="text-uppercase mt5 bolds">Pathology Payment/Billing<span class="pull-right text-gray-light"><i class="fas fa-flask"></i></span>
                            </h5>
                            <p class="text-muted bolds mb4">100.00%<span class="pull-right"> $187.50/$187.50</span></p>
                            <div class="progress-group">
                              <div class="progress progress-minibar">
                                <div class="progress-bar progress-bar-aqua" style="width: 100.00%"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--./row-->
                    </div>
                    <!--./col-lg-6-->

                    <div class="col-md-6 project-progress-bars">
                      <div class="row">
                        <div class="col-md-12 mtop5">
                          <div class="topprograssstart">
                            <h5 class="text-uppercase mt5 bolds">Radiology Payment/Billing<span class="pull-right text-gray-light"><i class="fas fa-microscope"></i></span>
                            </h5>
                            <p class="text-muted bolds mb4">100.00%<span class="pull-right"> $192.00/$192.00</span></p>
                            <div class="progress-group">
                              <div class="progress progress-minibar">
                                <div class="progress-bar progress-bar-aqua" style="width: 100.00%"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--./col-lg-6-->
                  </div>
                  <!--./row-->
                  <div class="row">

                    <div class="col-md-6 project-progress-bars">
                      <div class="row">
                        <div class="col-md-12 mtop5">
                          <div class="topprograssstart">
                            <h5 class="text-uppercase mt5 bolds">Blood Bank Payment/Billing<span class="pull-right text-gray-light"><i class="fas fa-tint"></i></span>
                            </h5>
                            <p class="text-muted bolds mb4">100.00%<span class="pull-right"> $121.00/$121.00</span></p>
                            <div class="progress-group">
                              <div class="progress progress-minibar">
                                <div class="progress-bar progress-bar-aqua" style="width: 100.00%"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--./row-->
                    </div>
                    <!--./col-lg-6-->

                    <div class="col-md-6 project-progress-bars">
                      <div class="row">
                        <div class="col-md-12 mtop5">
                          <div class="topprograssstart">
                            <h5 class="text-uppercase mt5 bolds">Ambulance Payment/Billing<span class="pull-right text-gray-light"><i class="fas fa-ambulance"></i></span>
                            </h5>
                            <p class="text-muted bolds mb4">100.00%<span class="pull-right"> $195.00/$195.00</span></p>
                            <div class="progress-group">
                              <div class="progress progress-minibar">
                                <div class="progress-bar progress-bar-aqua" style="width: 100.00%"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--./col-lg-6-->
                  </div>
                  <!--./row-->
                  <div class="box-header pl-0">
                    <h3 class="text-uppercase bolds mt0 mb0 ptt10 pull-left font14">Medication</h3>
                    <div class="pull-right">
                    </div>
                  </div>

                  <div class="box-header pl-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered mb0">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Medicine Name</th>
                            <th>Dose</th>
                            <th>Time</th>
                            <th>Remark</th>
                          </tr>
                          <tr>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>10/28/2023</td>
                            <td>Alprovit</td>
                            <td>1 ((ML))</td>
                            <td> 01:55 PM</td>
                            <td></td>
                          </tr>

                        </tbody>
                      </table>
                    </div>

                  </div>
                  <hr class="hr-panel-heading hr-10">
                  <div class="box-header pl-0">
                    <h3 class="text-uppercase bolds mt0 mb0 ptt10 pull-left font14">Prescription</h3>
                    <div class="pull-right">

                    </div>
                  </div>
                  <div class="box-header pl-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered   mb0">
                        <thead>
                          <tr>
                            <th>Prescription No</th>
                            <th>Date</th>
                            <th>Finding</th>

                          </tr>
                        </thead>
                        <tbody>

                          <tr>
                            <td>IPDP257</td>
                            <td>10/05/2023</td>
                            <td>Stomach pain Typhoid fever and paratyphoid fever have similar symptoms̵. People usually have a sustained fever (one that doesn’t come and go) that can be as high as 103–104°F (39–40°C). Diarrhea or constipation Some people
                              with typhoid fever or paratyphoid fever develop a rash of flat, rose-colored spots.</td>

                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                  <hr class="hr-panel-heading hr-10">
                  <div class="box-header pl-0">
                    <h3 class="text-uppercase bolds mt0 ptt10 mb0 pull-left font14">Consultant Register</h3>
                    <div class="pull-right">

                    </div>
                  </div>
                  <div class="box-header pl-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered  mb0">
                        <thead>
                          <tr>
                            <th>Applied Date</th>
                            <th>Consultant Doctor</th>
                            <th>Instruction</th>
                            <th>Instruction Date</th>


                          </tr>
                        </thead>
                        <tbody>

                          <tr>
                            <td>10/27/2023 12:37 PM</td>
                            <td>Sansa Gomez (9008)</td>
                            <td>Take medicine after meal everyday also eat one egg daily at morning time.</td>
                            <td>10/28/2023</td>
                          </tr>


                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="box-header pl-0">
                    <h3 class="text-uppercase bolds mt0 mb0 ptt10 pull-left font14">Lab Investigation</h3>
                    <div class="pull-right">
                    </div>
                  </div>
                  <div class="box-header pl-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered  mb0" data-export-title="Lab Investigation">
                        <thead>
                          <tr>
                            <th>Test Name</th>
                            <th>Lab</th>
                            <th>Sample Collected</th>
                            <td><strong>Expected Date</strong></td>
                            <th>Approved By</th>

                          </tr>
                        </thead>
                        <tbody id="">
                          <tr>
                            <td>Abdomen X-rays<br> (AX)
                            </td>
                            <td>Pathology</td>
                            <td><label>
                                   Belina Turner (9005)                                 </label>

                              <br>
                              <label for="">Pathology : </label> In-House Pathology Lab <br> 10/26/2023
                            </td>

                            <td>
                              10/27/2023
                            </td>
                            <td class="text-left">
                              <label for="">Approved By : </label> Sansa Gomez (9008) <br> 10/28/2023
                            </td>

                          </tr>
                          <tr>
                            <td>Magnetic resonance imaging <br> ((MRI) )</td>
                            <td>Radiology</td>
                            <td><label>
                                   John  Hook (9006)                                 </label>

                              <br>
                              <label for="">Radiology : </label> In-House Radiology Lab <br> 10/26/2023
                            </td>

                            <td>
                              10/28/2023
                            </td>
                            <td class="text-left">
                              <label for="">Approved By : </label> Sansa Gomez (9008) <br> 10/28/2023
                            </td>

                          </tr>
                        </tbody>
                      </table>

                    </div>
                  </div>

                  <hr class="hr-panel-heading hr-10">
                  <div class="box-header mb10 pl-0">
                    <h3 class="text-uppercase bolds mt0 mb0 ptt10 pull-left font14">Operation</h3>
                    <div class="pull-right">

                    </div>
                  </div>
                  <div class="box-header mb10 pl-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered  mb0">
                        <thead>
                          <tr>
                            <th>Reference No</th>
                            <th>Operation Date</th>
                            <th>Operation Name</th>
                            <th>Operation Category</th>
                            <th>OT Technician</th>
                          </tr>
                        </thead>
                        <tbody>

                          <tr>
                            <td>OTREF188</td>
                            <td>10/28/2023 09:30 PM</td>
                            <td>Cataract extraction and most other ophthalmological procedures</td>
                            <td>Ophthalmology</td>
                            <td>Usman</td>
                          </tr>

                        </tbody>
                      </table>
                    </div>

                  </div>

                  <hr class="hr-panel-heading hr-10">


                  <div class="box-header mb10 pl-0">
                    <h3 class="text-uppercase bolds mt0 mb0 ptt10 pull-left font14">Charges</h3>
                    <div class="pull-right">

                    </div>
                  </div>
                  <div class="box-header mb10 pl-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered  mb0">
                        <thead class="white-space-nowrap">
                          <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Charge Type</th>
                            <th>Charge Category</th>
                            <th>Qty</th>

                            <th class="text-right">Amount ($)</th>

                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>10/27/2023 12:38 PM
                            </td>
                            <td style="text-transform: capitalize;">IPD Charge
                              <div class="bill_item_footer text-muted"><label> </label> </div>
                            </td>
                            <td style="text-transform: capitalize;">IPD</td>
                            <td style="text-transform: capitalize;">
                              Admission and Discharge.
                            </td>
                            <td style="text-transform: capitalize;">5 Day</td>

                            <td class="text-right">780.00</td>

                          </tr>


                          <tr>
                            <td>10/28/2023 07:38 PM
                            </td>
                            <td style="text-transform: capitalize;">Operation service
                              <div class="bill_item_footer text-muted"><label> </label> </div>
                            </td>
                            <td style="text-transform: capitalize;">Operations</td>
                            <td style="text-transform: capitalize;">
                              Operation Services
                            </td>
                            <td style="text-transform: capitalize;">3 g/dl</td>

                            <td class="text-right">495.00</td>

                          </tr>








                        </tbody>



                      </table>
                    </div>
                  </div>
                  <div class="box-header mb10 pl-0">
                    <h3 class="text-uppercase bolds mt0 mb0 ptt10 mb0 pull-left font14">Payment</h3>
                    <div class="pull-right">

                    </div>
                  </div>
                  <div class="box-header mb10 pl-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered  mb0">
                        <thead>
                          <tr>
                            <th>Transaction ID</th>
                            <th>Date</th>
                            <th>Note</th>
                            <th>Payment Mode</th>
                            <th class="text-right">Paid Amount ($)</th>

                          </tr>
                        </thead>
                        <tbody>

                          <tr>
                            <td>TRANID7297</td>
                            <td>10/28/2023 10:30 PM</td>
                            <td></td>
                            <td style="text-transform: capitalize;">Transfer to Bank Account<br> </td>
                            <td class="text-right">1150.00</td>


                          </tr>


                        </tbody>













                      </table>
                    </div>
                    <!--./table-responsive-->
                  </div>
                  <div class="box-header mb10 pl-0">
                    <h3 class="text-uppercase bolds mt0 mb0 ptt10 pull-left font14">Live Consultation</h3>
                    <div class="pull-right">

                    </div>
                  </div>
                  <div class="box-header mb10 pl-0">
                    <div class="table-responsive">
                    </div>
                  </div>


                  <div class="box-header mb10 pl-0">
                    <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Treatment History</h3>
                    <div class="pull-right">
                    </div>
                  </div>
                  <div class="box-header mb10 pl-0">
                    <div class="table-responsive">
                    </div>
                  </div>
                  <div class="box-header mb10 pl-0">
                    <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Bed History</h3>
                    <div class="pull-right">

                    </div>
                  </div>
                  <div class="box-header mb10 pl-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered ">
                        <thead>
                          <tr>
                            <th>Bed Group</th>
                            <th>Bed </th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Active Bed</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="mailbox-name">General Ward Male</td>
                            <td class="mailbox-name">TF - 106</td>
                            <td class="mailbox-name">10/28/2023 12:26 PM</td>
                            <td class="mailbox-name"></td>
                            <td class="mailbox-name">Yes</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!--./col-lg-6-->
              </div>
              <!--./row-->
            </div>
            <!--#/overview-->


            <div class="tab-pane tab-content-height " id="nurse_note">
              <div class="box-tab-header">
                <h3 class="box-tab-title">Nurse Notes</h3>
                <div class="box-tab-tools">

                  <a href="#" class="btn btn-sm btn-primary dropdown-toggle addnursenote" onclick="holdModal('add_nurse_note')" data-toggle="modal"><i class="fas fa-plus"></i> Add Nurse Note</a>


                </div>
              </div>
              <!--./box-tab-header-->


              <div class="download_label">Alisha Knowles (896) IPD Details</div>

              <div id="">
                <ul class="timeline timeline-inverse">

                  <li class="time-label">
                    <span class="bg-blue">   
                                                  10/28/2023 12:35 PM</span>
                  </li>
                  <li>
                    <i class="fa fa-list-alt bg-blue"></i>
                    <div class="timeline-item">
                      <span class="time">

                                                                  <a class="btn btn-default btn-xs" data-toggle="tooltip" title="" onclick="delete_record('https://demo.smart-hospital.in/admin/patient/deleteIpdnursenote/113/87', 'Record Deleted Successfully')" data-original-title="Delete">
                                                                      <i class="fa fa-trash"></i>
                                                                  </a>
                                                                  </span>


                      <span class="time">
                                                                  <a onclick="addcommentNursenote('113',87)" class="defaults-c text-right" data-toggle="tooltip" title="" data-original-title="Comment">
                                                                  <i class="fa fa-comment"></i>
                                                                  </a>
                                                                  </span>
                      <span class="time">
                                                                  <a onclick="editNursenote('113')" class="defaults-c text-right" data-toggle="tooltip" title="" data-original-title="Edit">
                                                                          <i class="fa fa-pencil"></i>
                                                                  </a>
                                                                  </span>



                      <h3 class="timeline-header text-aqua"> April Clinton ( 9020 ) </h3>

                      <div class="timeline-body">
                        <b>Note</b><br>Take medicine after meal everyday .
                      </div>
                      <div class="timeline-body">
                        <b>Comment</b><br> Take medicine after meal everyday .
                      </div>



                    </div>
                  </li>

                  <li><i class="fa fa-clock-o bg-gray"></i></li>

                </ul>
              </div>
            </div>
            <div class="tab-pane tab-content-height" id="consultant_register">
              <div class="box-tab-header">
                <h3 class="box-tab-title">Consultant Register</h3>
                <div class="box-tab-tools">
                  <a href="#" class="btn btn-sm btn-primary dropdown-toggle addconsultant" onclick="holdModal('add_instruction')" data-toggle="modal"><i class="fas fa-plus"></i> Consultant Register</a>

                </div>
              </div>
              <!--./box-tab-header-->


              <div class="download_label">Alisha Knowles Consultant Register</div>
              <div class="table-responsive">
                <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper no-footer">
                  <div class="dt-buttons btn-group btn-group2"> <a class="btn btn-default dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="DataTables_Table_1" href="#" title="Copy"><span><i class="fa fa-files-o"></i></span></a> <a class="btn btn-default dt-button buttons-excel buttons-html5"
                      tabindex="0" aria-controls="DataTables_Table_1" href="#" title="Excel"><span><i class="fa fa-file-excel-o"></i></span></a> <a class="btn btn-default dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_1"
                      href="#" title="CSV"><span><i class="fa fa-file-text-o"></i></span></a> <a class="btn btn-default dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_1" href="#" title="PDF"><span><i class="fa fa-file-pdf-o"></i></span></a>                    <a class="btn btn-default dt-button buttons-print" tabindex="0" aria-controls="DataTables_Table_1" href="#" title="Print"><span><i class="fa fa-print"></i></span></a> </div>
                  <div id="DataTables_Table_1_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search..." aria-controls="DataTables_Table_1"></label></div>
                  <table class="table table-striped table-bordered  example dataTable no-footer" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Applied Date: activate to sort column ascending" style="width: 0px;">Applied Date</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Consultant Doctor: activate to sort column ascending" style="width: 0px;">Consultant Doctor</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Instruction: activate to sort column ascending" style="width: 0px;">Instruction</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Instruction Date: activate to sort column ascending" style="width: 0px;">Instruction Date</th>
                        <th class="text-right noExport sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 0px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>



                      <tr role="row" class="odd">
                        <td>10/27/2023 12:37 PM</td>
                        <td>Sansa Gomez (9008)</td>
                        <td>Take medicine after meal everyday also eat one egg daily at morning time.</td>
                        <td>10/28/2023</td>

                        <td class="text-right">

                          <a onclick="editConsultantRegister('120')" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit">
                                                                          <i class="fa fa-pencil"></i>
                                                                  </a>
                          <a class="btn btn-default btn-xs" data-toggle="tooltip" title="" onclick="delete_record('https://demo.smart-hospital.in/admin/patient/deleteIpdPatientConsultant/120', 'Record Deleted Successfully')" data-original-title="Delete">
                                                                      <i class="fa fa-trash"></i>

                                                                  </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="dataTables_info" id="DataTables_Table_1_info" role="status" aria-live="polite">Records: 1 to 1 of 1</div>
                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_1_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_1" data-dt-idx="0" tabindex="0" id="DataTables_Table_1_previous"><i class="fa fa-angle-left"></i></a><span><a class="paginate_button current" aria-controls="DataTables_Table_1" data-dt-idx="1" tabindex="0">1</a></span>
                    <a
                      class="paginate_button next disabled" aria-controls="DataTables_Table_1" data-dt-idx="2" tabindex="0" id="DataTables_Table_1_next"><i class="fa fa-angle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane tab-content-height" id="prescription">
              <div class="box-tab-header">
                <h3 class="box-tab-title">Prescription</h3>
                <div class="box-tab-tools">
                  <a href="#" class="btn btn-sm btn-primary dropdown-toggle addprescription" data-toggle="modal"><i class="fas fa-plus"></i> Add Prescription</a>
                </div>
              </div>
              <!--./box-tab-header-->

              <div class="download_label">Alisha Knowles IPD Details</div>
              <div class="table-responsive">
                <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper no-footer">
                  <div class="dt-buttons btn-group btn-group2"> <a class="btn btn-default dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="DataTables_Table_2" href="#" title="Copy"><span><i class="fa fa-files-o"></i></span></a> <a class="btn btn-default dt-button buttons-excel buttons-html5"
                      tabindex="0" aria-controls="DataTables_Table_2" href="#" title="Excel"><span><i class="fa fa-file-excel-o"></i></span></a> <a class="btn btn-default dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_2"
                      href="#" title="CSV"><span><i class="fa fa-file-text-o"></i></span></a> <a class="btn btn-default dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_2" href="#" title="PDF"><span><i class="fa fa-file-pdf-o"></i></span></a>                    <a class="btn btn-default dt-button buttons-print" tabindex="0" aria-controls="DataTables_Table_2" href="#" title="Print"><span><i class="fa fa-print"></i></span></a> </div>
                  <div id="DataTables_Table_2_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search..." aria-controls="DataTables_Table_2"></label></div>
                  <table class="table table-striped table-bordered  example dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="Prescription No: activate to sort column ascending" style="width: 0px;">Prescription No</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 0px;">Date</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="Finding: activate to sort column ascending" style="width: 0px;">Finding</th>
                        <th class="text-right noExport sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 0px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>



                      <tr role="row" class="odd">
                        <td>IPDP257</td>
                        <td>10/05/2023</td>
                        <td>Stomach pain Typhoid fever and paratyphoid fever have similar symptoms̵. People usually have a sustained fever (one that doesn’t come and go) that can be as high as 103–104°F (39–40°C). Diarrhea or constipation Some people with
                          typhoid fever or paratyphoid fever develop a rash of flat, rose-colored spots.</td>
                        <td class="text-right">
                          <a href="#prescription" class="btn btn-default btn-xs" onclick="view_prescription('257', '87','no')" data-toggle="tooltip" title="View Prescription">
                                                                      <i class="fas fa-file-prescription"></i>
                                                                  </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="dataTables_info" id="DataTables_Table_2_info" role="status" aria-live="polite">Records: 1 to 1 of 1</div>
                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_2_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_2" data-dt-idx="0" tabindex="0" id="DataTables_Table_2_previous"><i class="fa fa-angle-left"></i></a><span><a class="paginate_button current" aria-controls="DataTables_Table_2" data-dt-idx="1" tabindex="0">1</a></span>
                    <a
                      class="paginate_button next disabled" aria-controls="DataTables_Table_2" data-dt-idx="2" tabindex="0" id="DataTables_Table_2_next"><i class="fa fa-angle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Timeline -->

            <div class="tab-pane tab-content-height" id="timeline">
              <div class="box-tab-header">
                <h3 class="box-tab-title">Timeline</h3>
                <div class="box-tab-tools">
                  <a href="#" class="btn btn-sm btn-primary dropdown-toggle addtimeline" onclick="holdModal('myTimelineModal')" data-toggle="modal"><i class="fa fa-plus"></i> Add Timeline</a>
                </div>
              </div>
              <!--./box-tab-header-->

              <div class="download_label">Alisha Knowles IPD Details</div>
              <div class="timeline-header no-border">
                <div id="timeline_list">
                  <ul class="timeline timeline-inverse">

                    <li class="time-label">
                      <span class="bg-blue">    
                                                  10/28/2023</span>
                    </li>
                    <li>
                      <i class="fa fa-list-alt bg-blue"></i>
                      <div class="timeline-item">
                        <span class="time"><a class="defaults-c text-right" data-toggle="tooltip" title="" onclick="delete_timeline('126')" data-original-title="Delete"><i class="fa fa-trash"></i></a></span>
                        <span class="time"><a onclick="editTimeline('126')" class="defaults-c text-right" data-toggle="tooltip" title="" data-original-title="Edit">
                                                                          <i class="fa fa-pencil"></i>
                                                                      </a></span>


                        <h3 class="timeline-header text-aqua"> Urgent Appointment </h3>
                        <div class="timeline-body">
                          Urgent Appointment
                        </div>
                      </div>
                    </li>

                    <li><i class="fa fa-clock-o bg-gray"></i></li>

                  </ul>
                </div>
              </div>
            </div>


            <div class="tab-pane tab-content-height" id="live_consult">
              <div class="box-tab-header">
                <h3 class="box-tab-title">Live Consultation</h3>
                <div class="box-tab-tools">

                </div>
              </div>
              <!--./box-tab-header-->
              <div class="download_label">Alisha Knowles IPD Details</div>
              <div class="table-responsive">
                <div id="DataTables_Table_4_wrapper" class="dataTables_wrapper no-footer">
                  <div class="dt-buttons btn-group btn-group2"> <a class="btn btn-default dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="DataTables_Table_4" href="#" title="Copy"><span><i class="fa fa-files-o"></i></span></a> <a class="btn btn-default dt-button buttons-excel buttons-html5"
                      tabindex="0" aria-controls="DataTables_Table_4" href="#" title="Excel"><span><i class="fa fa-file-excel-o"></i></span></a> <a class="btn btn-default dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_4"
                      href="#" title="CSV"><span><i class="fa fa-file-text-o"></i></span></a> <a class="btn btn-default dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_4" href="#" title="PDF"><span><i class="fa fa-file-pdf-o"></i></span></a>                    <a class="btn btn-default dt-button buttons-print" tabindex="0" aria-controls="DataTables_Table_4" href="#" title="Print"><span><i class="fa fa-print"></i></span></a> </div>
                  <div id="DataTables_Table_4_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search..." aria-controls="DataTables_Table_4"></label></div>
                  <table class="table table-striped table-bordered  example dataTable no-footer" id="DataTables_Table_4" role="grid" aria-describedby="DataTables_Table_4_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Consultation Title: activate to sort column ascending" style="width: 0px;">Consultation Title</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 0px;">Date</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Created By : activate to sort column ascending" style="width: 0px;">Created By </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Created For: activate to sort column ascending" style="width: 0px;">Created For</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Patient: activate to sort column ascending" style="width: 0px;">Patient</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 0px;">Status</th>
                        <th class="text-right noExport sorting" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 0px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>


                      <tr class="odd">
                        <td valign="top" colspan="7" class="dataTables_empty">
                          <div align="center">No data available in table <br> <br><img src="https://smart-hospital.in/shappresource/images/addnewitem.svg" width="150"><br><br> <span class="text-success bolds"><i class="fa fa-arrow-left"></i> Add new record or search with different criteria.</span>
                            <div></div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="dataTables_info" id="DataTables_Table_4_info" role="status" aria-live="polite">Records: 0 to 0 of 0</div>
                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_4_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_4" data-dt-idx="0" tabindex="0" id="DataTables_Table_4_previous"><i class="fa fa-angle-left"></i></a><span></span><a class="paginate_button next disabled" aria-controls="DataTables_Table_4"
                      data-dt-idx="1" tabindex="0" id="DataTables_Table_4_next"><i class="fa fa-angle-right"></i></a></div>
                </div>
              </div>
            </div>

            <div class="tab-pane tab-content-height" id="bed_history">
              <div class="box-tab-header">
                <h3 class="box-tab-title">Bed History</h3>
                <div class="box-tab-tools">
                </div>
              </div>
              <div class="download_label"></div>
              <div class="table-responsive">
                <div id="DataTables_Table_5_wrapper" class="dataTables_wrapper no-footer">
                  <div class="dt-buttons btn-group btn-group2"> <a class="btn btn-default dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="DataTables_Table_5" href="#" title="Copy"><span><i class="fa fa-files-o"></i></span></a> <a class="btn btn-default dt-button buttons-excel buttons-html5"
                      tabindex="0" aria-controls="DataTables_Table_5" href="#" title="Excel"><span><i class="fa fa-file-excel-o"></i></span></a> <a class="btn btn-default dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_5"
                      href="#" title="CSV"><span><i class="fa fa-file-text-o"></i></span></a> <a class="btn btn-default dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_5" href="#" title="PDF"><span><i class="fa fa-file-pdf-o"></i></span></a>                    <a class="btn btn-default dt-button buttons-print" tabindex="0" aria-controls="DataTables_Table_5" href="#" title="Print"><span><i class="fa fa-print"></i></span></a> </div>
                  <div id="DataTables_Table_5_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search..." aria-controls="DataTables_Table_5"></label></div>
                  <table class="table table-striped table-bordered  example dataTable no-footer" id="DataTables_Table_5" role="grid" aria-describedby="DataTables_Table_5_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_5" rowspan="1" colspan="1" aria-label="Bed Group: activate to sort column ascending" style="width: 0px;">Bed Group</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_5" rowspan="1" colspan="1" aria-label="Bed : activate to sort column ascending" style="width: 0px;">Bed </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_5" rowspan="1" colspan="1" aria-label="From Date: activate to sort column ascending" style="width: 0px;">From Date</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_5" rowspan="1" colspan="1" aria-label="To Date: activate to sort column ascending" style="width: 0px;">To Date</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_5" rowspan="1" colspan="1" aria-label="Active Bed: activate to sort column ascending" style="width: 0px;">Active Bed</th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr role="row" class="odd">
                        <td class="mailbox-name">General Ward Male</td>
                        <td class="mailbox-name">TF - 106</td>
                        <td class="mailbox-name">10/28/2023 12:26 PM</td>
                        <td class="mailbox-name"></td>
                        <td class="mailbox-name">Yes</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="dataTables_info" id="DataTables_Table_5_info" role="status" aria-live="polite">Records: 1 to 1 of 1</div>
                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_5_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_5" data-dt-idx="0" tabindex="0" id="DataTables_Table_5_previous"><i class="fa fa-angle-left"></i></a><span><a class="paginate_button current" aria-controls="DataTables_Table_5" data-dt-idx="1" tabindex="0">1</a></span>
                    <a
                      class="paginate_button next disabled" aria-controls="DataTables_Table_5" data-dt-idx="2" tabindex="0" id="DataTables_Table_5_next"><i class="fa fa-angle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane tab-content-height" id="medication">
              <div class="box-tab-header">
                <h3 class="box-tab-title">Medication</h3>
                <div class="box-tab-tools">
                  <a href="#" class="btn btn-sm btn-primary dropdown-toggle addmedication" onclick="addmedicationModal()" data-toggle="modal"><i class="fa fa-plus"></i> Add Medication Dose</a>
                </div>
              </div>
              <!--./box-tab-header-->

              <div class="download_label">Alisha Knowles IPD Details</div>
              <div class="table_inner">
                <table class="table table-striped table-bordered  mb0">
                  <thead>
                    <tr>
                      <th class="hard_left">Date </th>
                      <th class="next_left table_inner_tdwidth">Medicine Name</th>

                      <th class="table_inner_tdwidth">Dose1</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="hard_left">10/28/2023<br>(Saturday)</td>
                      <td class="next_left">Alprovit</td>
                      <td class="dosehover">Time: 01:55 PM<span><a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Edit" onclick="medicationDoseModal(598)"><i class="fa fa-pencil"></i></a></span><span><a class="btn btn-default btn-xs delete_record_dosage" data-toggle="tooltip" data-original-title="Delete" data-record-id="598"><i class="fa fa-trash"></i></a></span><br>1
                        (ML)</td>
                      <td class="dosehover"> <a href="#" class="btn btn-sm btn-primary dropdown-toggle addmedication" onclick="medicationModal('1','1','10/28/2023')" data-toggle="modal"><i class="fa fa-plus"></i>

                                                      </a>
                      </td>
                    </tr>

                  </tbody>

                </table>


              </div>

            </div>
            <div class="tab-pane tab-content-height" id="operationtheatre">
              <div class="box-tab-header">
                <h3 class="box-tab-title">Operations</h3>
                <div class="box-tab-tools">
                  <a data-toggle="modal" onclick="holdModal('add_operationtheatre')" class="btn btn-primary btn-sm addoperationtheatre"><i class="fa fa-plus"></i> Add Operation</a>
                </div>
              </div>
              <!--./box-tab-header-->
              <div class="download_label">Alisha Knowles IPD Details</div>
              <div class="table_inner">
                <div id="DataTables_Table_6_wrapper" class="dataTables_wrapper no-footer">
                  <div class="dt-buttons btn-group btn-group2"> <a class="btn btn-default dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="DataTables_Table_6" href="#" title="Copy"><span><i class="fa fa-files-o"></i></span></a> <a class="btn btn-default dt-button buttons-excel buttons-html5"
                      tabindex="0" aria-controls="DataTables_Table_6" href="#" title="Excel"><span><i class="fa fa-file-excel-o"></i></span></a> <a class="btn btn-default dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_6"
                      href="#" title="CSV"><span><i class="fa fa-file-text-o"></i></span></a> <a class="btn btn-default dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_6" href="#" title="PDF"><span><i class="fa fa-file-pdf-o"></i></span></a>                    <a class="btn btn-default dt-button buttons-print" tabindex="0" aria-controls="DataTables_Table_6" href="#" title="Print"><span><i class="fa fa-print"></i></span></a> </div>
                  <div id="DataTables_Table_6_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search..." aria-controls="DataTables_Table_6"></label></div>
                  <table class="table table-striped table-bordered  example dataTable no-footer" id="DataTables_Table_6" role="grid" aria-describedby="DataTables_Table_6_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_6" rowspan="1" colspan="1" aria-label="Reference No: activate to sort column ascending" style="width: 0px;">Reference No</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_6" rowspan="1" colspan="1" aria-label="Operation Date: activate to sort column ascending" style="width: 0px;">Operation Date</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_6" rowspan="1" colspan="1" aria-label="Operation Name: activate to sort column ascending" style="width: 0px;">Operation Name</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_6" rowspan="1" colspan="1" aria-label="Operation Category: activate to sort column ascending" style="width: 0px;">Operation Category</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_6" rowspan="1" colspan="1" aria-label="OT Technician: activate to sort column ascending" style="width: 0px;">OT Technician</th>
                        <th class="text-right noExport sorting" tabindex="0" aria-controls="DataTables_Table_6" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 0px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>








                      <tr role="row" class="odd">
                        <td>OTREF188</td>
                        <td>10/28/2023 09:30 PM</td>
                        <td>Cataract extraction and most other ophthalmological procedures</td>
                        <td>Ophthalmology</td>
                        <td>Usman</td>
                        <td class="text-right">
                          <a href="#" data-toggle="tooltip" title="Show" class="btn btn-default btn-xs" data-target="#view_ot_modal" onclick="viewdetail(&quot;188&quot;)">  <i class="fa fa-reorder"></i> </a>
                          <a onclick="editot('188')" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit">
                                                                      <i class="fa fa-pencil"></i>
                                                              </a>
                          <a onclick="deleteot('188')" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Delete">
                                                              <i class="fa fa-trash"></i>
                                                              </a>

                        </td>
                      </tr>
                    </tbody>

                  </table>
                  <div class="dataTables_info" id="DataTables_Table_6_info" role="status" aria-live="polite">Records: 1 to 1 of 1</div>
                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_6_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_6" data-dt-idx="0" tabindex="0" id="DataTables_Table_6_previous"><i class="fa fa-angle-left"></i></a><span><a class="paginate_button current" aria-controls="DataTables_Table_6" data-dt-idx="1" tabindex="0">1</a></span>
                    <a
                      class="paginate_button next disabled" aria-controls="DataTables_Table_6" data-dt-idx="2" tabindex="0" id="DataTables_Table_6_next"><i class="fa fa-angle-right"></i></a>
                  </div>
                </div>

              </div>
            </div>

            <!--Charges-->

            <div class="tab-pane tab-content-height" id="charges">
              <div class="box-tab-header">
                <h3 class="box-tab-title">Charges</h3>
                <div class="box-tab-tools">
                  <a href="#" class="btn btn-sm btn-primary dropdown-toggle addcharges" onclick="holdModal('myChargesModal')" data-toggle="modal"><i class="fa fa-plus"></i> Add Charges</a>

                </div>
              </div>
              <!--./box-tab-header-->

              <div class="download_label">Charges</div>
              <div class="table-responsive">
                <div id="DataTables_Table_7_wrapper" class="dataTables_wrapper no-footer">
                  <div class="dt-buttons btn-group btn-group2"> <a class="btn btn-default dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="DataTables_Table_7" href="#" title="Copy"><span><i class="fa fa-files-o"></i></span></a> <a class="btn btn-default dt-button buttons-excel buttons-html5"
                      tabindex="0" aria-controls="DataTables_Table_7" href="#" title="Excel"><span><i class="fa fa-file-excel-o"></i></span></a> <a class="btn btn-default dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_7"
                      href="#" title="CSV"><span><i class="fa fa-file-text-o"></i></span></a> <a class="btn btn-default dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_7" href="#" title="PDF"><span><i class="fa fa-file-pdf-o"></i></span></a>                    <a class="btn btn-default dt-button buttons-print" tabindex="0" aria-controls="DataTables_Table_7" href="#" title="Print"><span><i class="fa fa-print"></i></span></a> </div>
                  <div id="DataTables_Table_7_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search..." aria-controls="DataTables_Table_7"></label></div>
                  <table class="table table-striped table-bordered  example dataTable no-footer" id="DataTables_Table_7" role="grid" aria-describedby="DataTables_Table_7_info">
                    <thead class="white-space-nowrap">
                      <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_7" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 0px;">Date</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_7" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 0px;">Name</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_7" rowspan="1" colspan="1" aria-label="Charge Type: activate to sort column ascending" style="width: 0px;">Charge Type</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_7" rowspan="1" colspan="1" aria-label="Charge Category: activate to sort column ascending" style="width: 0px;">Charge Category</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_7" rowspan="1" colspan="1" aria-label="Qty: activate to sort column ascending" style="width: 0px;">Qty</th>
                        <th class="text-right sorting" tabindex="0" aria-controls="DataTables_Table_7" rowspan="1" colspan="1" aria-label="Standard Charge ($) : activate to sort column ascending" style="width: 0px;">Standard Charge ($) </th>
                        <th class="text-right sorting" tabindex="0" aria-controls="DataTables_Table_7" rowspan="1" colspan="1" aria-label="TPA Charge ($): activate to sort column ascending" style="width: 0px;">TPA Charge ($)</th>
                        <th class="text-right sorting" tabindex="0" aria-controls="DataTables_Table_7" rowspan="1" colspan="1" aria-label="Tax: activate to sort column ascending" style="width: 0px;">Tax</th>
                        <th class="text-right sorting" tabindex="0" aria-controls="DataTables_Table_7" rowspan="1" colspan="1" aria-label="Applied Charge ($): activate to sort column ascending" style="width: 0px;">Applied Charge ($)</th>
                        <th class="text-right sorting" tabindex="0" aria-controls="DataTables_Table_7" rowspan="1" colspan="1" aria-label="Amount ($): activate to sort column ascending" style="width: 0px;">Amount ($)</th>
                        <th class="text-right noExport sorting" tabindex="0" aria-controls="DataTables_Table_7" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 0px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>





                      <tr role="row" class="odd">
                        <td>10/27/2023 12:38 PM
                        </td>
                        <td style="text-transform: capitalize;">IPD Charge
                          <div class="bill_item_footer text-muted"><label> </label> </div>
                        </td>
                        <td style="text-transform: capitalize;">IPD</td>
                        <td style="text-transform: capitalize;">
                          Admission and Discharge.
                        </td>
                        <td style="text-transform: capitalize;">5 Day</td>
                        <td class="text-right">120.00</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">(30.00%) 180.00</td>
                        <td class="text-right">600.00</td>
                        <td class="text-right">780.00</td>
                        <td class="text-right white-space-nowrap">
                          <a href="javascript:void(0);" class="btn btn-default btn-xs print_charge" data-toggle="tooltip" title="" data-record-id="5285" data-original-title="Print" data-loading-text="Please Wait..">
                                                              <i class="fa fa-print"></i>
                                                              </a>

                          <a href="javascript:void(0);" class="btn btn-default btn-xs edit_charge" data-loading-text="Please Wait.." data-toggle="tooltip" data-record-id="5285" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a href="javascript:void(0);" data-record-id="5285" class="btn btn-default btn-xs delete-charge" data-toggle="tooltip" title="" data-original-title="Delete">
                                                                      <i class="fa fa-trash"></i>
                                                                  </a>




                        </td>
                      </tr>
                      <tr role="row" class="even">
                        <td>10/28/2023 07:38 PM
                        </td>
                        <td style="text-transform: capitalize;">Operation service
                          <div class="bill_item_footer text-muted"><label> </label> </div>
                        </td>
                        <td style="text-transform: capitalize;">Operations</td>
                        <td style="text-transform: capitalize;">
                          Operation Services
                        </td>
                        <td style="text-transform: capitalize;">3 g/dl</td>
                        <td class="text-right">150.00</td>
                        <td class="text-right">0.00</td>
                        <td class="text-right">(10.00%) 45.00</td>
                        <td class="text-right">450.00</td>
                        <td class="text-right">495.00</td>
                        <td class="text-right white-space-nowrap">
                          <a href="javascript:void(0);" class="btn btn-default btn-xs print_charge" data-toggle="tooltip" title="" data-record-id="5286" data-original-title="Print" data-loading-text="Please Wait..">
                                                              <i class="fa fa-print"></i>
                                                              </a>

                          <a href="javascript:void(0);" class="btn btn-default btn-xs edit_charge" data-loading-text="Please Wait.." data-toggle="tooltip" data-record-id="5286" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a href="javascript:void(0);" data-record-id="5286" class="btn btn-default btn-xs delete-charge" data-toggle="tooltip" title="" data-original-title="Delete">
                                                                      <i class="fa fa-trash"></i>
                                                                  </a>




                        </td>
                      </tr>
                      <tr class="box box-solid total-bg odd" role="row">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total : </td>
                        <td class="text-right">$1275.00 <input type="hidden" id="charge_total" name="charge_total" value="1275">
                        </td>
                        <td></td>
                      </tr>
                    </tbody>



                  </table>
                  <div class="dataTables_info" id="DataTables_Table_7_info" role="status" aria-live="polite">Records: 1 to 3 of 3</div>
                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_7_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_7" data-dt-idx="0" tabindex="0" id="DataTables_Table_7_previous"><i class="fa fa-angle-left"></i></a><span><a class="paginate_button current" aria-controls="DataTables_Table_7" data-dt-idx="1" tabindex="0">1</a></span>
                    <a
                      class="paginate_button next disabled" aria-controls="DataTables_Table_7" data-dt-idx="2" tabindex="0" id="DataTables_Table_7_next"><i class="fa fa-angle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane tab-content-height" id="payment">
              <div class="box-tab-header">
                <h3 class="box-tab-title">Payment</h3>
                <div class="box-tab-tools">
                  <a href="#" class="btn btn-sm btn-primary dropdown-toggle addpayment" onclick="addpaymentModal()" data-toggle="modal"><i class="fa fa-plus"></i> Add Payment</a>

                </div>
              </div>
              <!--./box-tab-header-->

              <div class="download_label">Payment</div>
              <div class="table-responsive">
                <div id="DataTables_Table_8_wrapper" class="dataTables_wrapper no-footer">
                  <div class="dt-buttons btn-group btn-group2"> <a class="btn btn-default dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="DataTables_Table_8" href="#" title="Copy"><span><i class="fa fa-files-o"></i></span></a> <a class="btn btn-default dt-button buttons-excel buttons-html5"
                      tabindex="0" aria-controls="DataTables_Table_8" href="#" title="Excel"><span><i class="fa fa-file-excel-o"></i></span></a> <a class="btn btn-default dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_8"
                      href="#" title="CSV"><span><i class="fa fa-file-text-o"></i></span></a> <a class="btn btn-default dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_8" href="#" title="PDF"><span><i class="fa fa-file-pdf-o"></i></span></a>                    <a class="btn btn-default dt-button buttons-print" tabindex="0" aria-controls="DataTables_Table_8" href="#" title="Print"><span><i class="fa fa-print"></i></span></a> </div>
                  <div id="DataTables_Table_8_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search..." aria-controls="DataTables_Table_8"></label></div>
                  <table class="table table-striped table-bordered  example dataTable no-footer" id="DataTables_Table_8" role="grid" aria-describedby="DataTables_Table_8_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_8" rowspan="1" colspan="1" aria-label="Transaction ID: activate to sort column ascending" style="width: 0px;">Transaction ID</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_8" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 0px;">Date</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_8" rowspan="1" colspan="1" aria-label="Note: activate to sort column ascending" style="width: 0px;">Note</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_8" rowspan="1" colspan="1" aria-label="Payment Mode: activate to sort column ascending" style="width: 0px;">Payment Mode</th>
                        <th class="text-right sorting" tabindex="0" aria-controls="DataTables_Table_8" rowspan="1" colspan="1" aria-label="Paid Amount ($): activate to sort column ascending" style="width: 0px;">Paid Amount ($)</th>
                        <th class="text-right noExport sorting" tabindex="0" aria-controls="DataTables_Table_8" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 0px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>




                      <tr role="row" class="odd">
                        <td>TRANID7297</td>
                        <td>10/28/2023 10:30 PM</td>
                        <td></td>
                        <td style="text-transform: capitalize;">Transfer to Bank Account<br> </td>
                        <td class="text-right">1150.00</td>

                        <td class="text-right">



                          <a href="javascript:void(0)" class="btn btn-default btn-xs print_trans" data-record-id="7297" data-loading-text="Please Wait.." data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></a>
                          <a href="javascript:void(0);" class="btn btn-default btn-xs editpayment" data-toggle="tooltip" title="" data-payment-amount="1150.00" data-record-id="7297" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                          <a href="javascript:void(0);" onclick="deletePayment('7297')" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>

                        </td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr class="box box-solid total-bg">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="" class="text-right">Total : $1,150.00 </td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="dataTables_info" id="DataTables_Table_8_info" role="status" aria-live="polite">Records: 1 to 1 of 1</div>
                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_8_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_8" data-dt-idx="0" tabindex="0" id="DataTables_Table_8_previous"><i class="fa fa-angle-left"></i></a><span><a class="paginate_button current" aria-controls="DataTables_Table_8" data-dt-idx="1" tabindex="0">1</a></span>
                    <a
                      class="paginate_button next disabled" aria-controls="DataTables_Table_8" data-dt-idx="2" tabindex="0" id="DataTables_Table_8_next"><i class="fa fa-angle-right"></i></a>
                  </div>
                </div>
              </div>
              <!--./table-responsive-->
            </div>
            <!--#/Bill payment -->
            <!--- treatment history tab---->
            <div class="tab-pane tab-content-height" id="treatment_history">
              <div class="box-tab-header">
                <h3 class="box-tab-title">Treatment History</h3>
                <div class="box-tab-tools">

                </div>
              </div>
              <!--./box-tab-header-->

              <div class="download_label">Treatment History</div>
              <div class="table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                  <div class="top">
                    <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search..." aria-controls="DataTables_Table_0"></label></div>
                  </div>
                  <div>
                    <div class="dt-buttons btn-group btn-group2"> <a class="btn btn-default dt-button buttons-copy buttons-html5 btn-copy" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="Copy"><span><i class="fa fa-files-o"></i></span></a> <a class="btn btn-default dt-button buttons-excel buttons-html5 btn-excel"
                        tabindex="0" aria-controls="DataTables_Table_0" href="#" title="Excel"><span><i class="fa fa-file-excel-o"></i></span></a> <a class="btn btn-default dt-button buttons-csv buttons-html5 btn-csv" tabindex="0" aria-controls="DataTables_Table_0"
                        href="#" title="CSV"><span><i class="fa fa-file-text-o"></i></span></a> <a class="btn btn-default dt-button buttons-pdf buttons-html5 btn-pdf" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="PDF"><span><i class="fa fa-file-pdf-o"></i></span></a>                      <a class="btn btn-default dt-button buttons-print btn-print" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="Print"><span><i class="fa fa-print"></i></span></a> </div>
                    <div class="dataTables_length" id="DataTables_Table_0_length"><label><select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class=""><option value="100">100</option><option value="-1">All</option></select></label></div>
                  </div>
                  <div id="DataTables_Table_0_processing" class="dataTables_processing" style="display: none;"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span> </div>
                  <div>
                    <table class="table table-striped table-bordered  treatmentlist dataTable no-footer" data-export-title="Treatment History" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 0px;">
                      <thead>
                        <tr role="row">
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 0px;" aria-label="IPD No: activate to sort column ascending">IPD No</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 0px;" aria-label="Symptoms: activate to sort column ascending">Symptoms</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 0px;" aria-label="Consultant: activate to sort column ascending">Consultant</th>
                          <th class="text-right dt-body-right sorting_disabled" rowspan="1" colspan="1" style="width: 0px;" aria-label="Bed">Bed</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="odd">
                          <td valign="top" colspan="4" class="dataTables_empty">
                            <div align="center">No data available in table <br> <br><img src="https://smart-hospital.in/shappresource/images/addnewitem.svg" width="150"><br><br> <span class="text-success bolds"><i class="fa fa-arrow-left"></i> Add new record or search with different criteria.</span>
                              <div></div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Records: 0 to 0 of 0</div>
                  <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" id="DataTables_Table_0_previous"><i class="fa fa-angle-left"></i></a><span></span><a class="paginate_button next disabled" aria-controls="DataTables_Table_0"
                      data-dt-idx="1" tabindex="0" id="DataTables_Table_0_next"><i class="fa fa-angle-right"></i></a></div>
                </div>
              </div>
              <!--./table-responsive-->
            </div>
            <!--#/Bill payment -->

            <!--- end treatmenthistory tab-->
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!--./box box-primary-->

  </section>
</div>