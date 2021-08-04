
<?php $__env->startSection('mainContent'); ?>
<style>
    th{
        border: 1px solid black;
        text-align: center;
    }
    td{
        text-align: center;
    }
    td.subject-name{
        text-align: left;
        padding-left: 10px !important;
    }
    table.marksheet{
        width: 100%;
        border: 1px solid #828bb2 !important;
    }
    table.marksheet th{
        border: 1px solid #828bb2 !important;
    }
    table.marksheet td{
        border: 1px solid #828bb2 !important;
    }
    table.marksheet thead tr{
        border: 1px solid #828bb2 !important;
    }
    table.marksheet tbody tr{
        border: 1px solid #828bb2 !important;
    }

    .studentInfoTable{
        width: 100%;
        padding: 0px !important;
    }

    .studentInfoTable td{
        padding: 0px !important;
        text-align: left;
        padding-left: 15px !important;
    }
    h4{
        text-align: left !important;
    }
    hr{
        margin: 0px;
    }
    #grade_table th{
        border: 1px solid black;
        text-align: center;
        background: #351681;
        color: white;
    }
    #grade_table td{
        color: black;
        text-align: center !important;
        border: 1px solid black;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.mark_sheet_report'); ?> <?php echo app('translator')->get('lang.student'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.mark_sheet_report'); ?> <?php echo app('translator')->get('lang.student'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php if(session()->has('message-success') != ""): ?>
                    <?php if(session()->has('message-success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session()->get('message-success')); ?>

                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                 <?php if(session()->has('message-danger') != ""): ?>
                    <?php if(session()->has('message-danger')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session()->get('message-danger')); ?>

                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="white-box">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'mark_sheet_report_student', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            
                            <div class="col-lg-3 mt-30-md md_mb_20">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('exam') ? ' is-invalid' : ''); ?>" name="exam">
                                    <option data-display="<?php echo app('translator')->get('lang.select_exam'); ?> *" value=""><?php echo app('translator')->get('lang.select_exam'); ?> *</option>
                                    <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($exam->id); ?>" <?php echo e(isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''); ?>><?php echo e($exam->title); ?></option>
                                       
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('exam')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('exam')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-3 mt-30-md md_mb_20">
                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                    <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                   
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('class')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('class')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-3 mt-30-md md_mb_20" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                                    <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> *" value=""><?php echo app('translator')->get('lang.select_section'); ?> *</option>
                                </select>
                                <?php if($errors->has('section')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('section')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-3 mt-30-md md_mb_20" id="select_student_div">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('student') ? ' is-invalid' : ''); ?>" id="select_student" name="student">
                                    <option data-display="<?php echo app('translator')->get('lang.select_student'); ?> *" value=""><?php echo app('translator')->get('lang.select_student'); ?> *</option>
                                </select>
                                <?php if($errors->has('student')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('student')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>

                            
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search"></span>
                                    <?php echo app('translator')->get('lang.search'); ?>
                                </button>
                            </div>
                        </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
</section>


<?php if(isset($is_result_available)): ?>
<?php 
    $generalSetting= App\SmGeneralSettings::find(1);
    if(!empty($generalSetting)){
        $school_name =$generalSetting->school_name;
        $site_title =$generalSetting->site_title;
        $school_code =$generalSetting->school_code;
        $address =$generalSetting->address;
        $phone =$generalSetting->phone;
        $email =$generalSetting->email;  
    }

?>
  
<style>
        *{
          margin: 0;
          padding: 0;
        }
        body{
          font-size: 12px;
          font-family: 'Poppins', sans-serif;
        }
        .student_marks_table{
          width: 100%;
          margin: 30px auto 0 auto;
          padding-left: 10px;
          padding-right: 5px;
        }
        .text_center{
          text-align: center;
        }
        p{
          margin: 0;
          font-size: 12px;
          text-transform: capitalize;
        }
        ul{
          margin: 0;
          padding: 0;
        }
        li{
          list-style: none;
        }
        td {
        border: 1px solid #726E6D;
        padding: .3rem;
        text-align: center;
      }
      th{
        border: 1px solid #726E6D;
        text-transform: capitalize;
        text-align: center;
        padding: .5rem;
        white-space: nowrap;
      }
      thead{
        font-weight:bold;
        text-align:center;
        color: #415094;
        font-size: 10px
      }
      .custom_table{
        width: 100%;
      }
      table.custom_table thead th {
        padding-right: 0;
        padding-left: 0;
      }
      table.custom_table thead tr > th {
        border: 0;
        padding: 0;
    }
    /* tr:last-child td {
        border: 0 !important;
    }
    tr:nth-last-child(2) td {
        border: 0 !important;
    }
    tr:nth-last-child(3) td {
        border: 0 !important;
    } */
    
    table.custom_table thead tr th .fees_title{
      font-size: 12px;
      font-weight: 600;
      border-top: 1px solid #726E6D;
      padding-top: 10px;
      margin-top: 10px;
    }
    .border-top{
      border-top: 0 !important;
    }
      .custom_table th ul li {
      }
      .custom_table th ul li p {
        margin-bottom: 10px;
        font-weight: 500;
        font-size: 14px;
    }
    /* tbody td p{
      text-align: right;
    } */
    tbody td{
      padding: 0.8rem;
    }
    table{
      border-spacing: 10px;
      width: 65%;
      margin: auto;
    }
    .fees_pay{
      text-align: center;
    }
    .border-0{
      border: 0 !important;
    }
    .copy_collect{
      text-align: center;
      font-weight: 500;
      color: #000;
    }
    
    .copyies_text{
      display: flex;
      justify-content: space-between;
      margin: 30px 0;
    }
    .copyies_text li{
      text-transform: capitalize;
      color: #000;
      font-weight: 500;
      border-top: 1px dashed #ddd;
    }
    .text_left{
        text-align: left;
    }
    .italic_text{
    }
    .student_info{
        
    }
    .student_info li{
        display: flex;
    }
    .info_details{
        display: flex;
        flex-wrap: wrap;
        margin-top: 30px;
        margin-bottom: 30px;
    }
    .info_details li > p{
        flex-basis: 20%;
    }
    .info_details li{
        display: flex;
        flex-basis: 50%;
    }
    .school_name{
        text-align: center;
    }
    .numbered_table_row{
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        align-items: center;
    }
    .numbered_table_row thead{
        border: 1px solid #415094
    }
    .numbered_table_row h3{
        font-size: 24px;
        text-transform: uppercase;
        margin-top: 15px;
        font-weight: 500;
        display: inline-block;
        border-bottom: 2px solid #415094;
    }
    .ingle-report-admit .numbered_table_row td{
       border: 1px solid #726E6D;
       padding: .4rem;
       font-weight: 400;
       color: #415094;
    }
    
    .table#grade_table_new th {
        border: 1px solid #726E6D !important;
        padding: .6rem !important;
        font-weight: 600;
        color: #415094;
        font-size: 10px;
    }
    td.border-top.border_left_hide {
        border-left: 0;
        text-align: left;
        font-weight: 600;
    }
    .devide_td{
        padding: 0;
    }
    .devide_td p{
        border-bottom: 1px solid #415094;
    }
    .ssc_text{
        font-size: 20px;
        font-weight: 500;
        color: #415094;
        margin-bottom: 20px;
    }
    table#grade_table_new td {
    padding: 0 !important;
    font-size: 8px;
}
table#grade_table_new {
    border-bottom: 1px solid #726E6D !important ;
}
.student_info {
    flex: 70% 0 0;
}
.marks_wrap_area {
    display: flex;
    align-items: center;
}
.numbered_table_row {
    display: flex;
    justify-content: center;
    margin-top: 40px;
    align-items: center;
}
      </style>
<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.mark_sheet_report'); ?></h3>
                </div>
            </div>
            <div class="col-lg-8 pull-right">
                <a href="<?php echo e(url('mark-sheet-report/print', [$input['exam_id'], $input['class_id'], $input['section_id'], $input['student_id']])); ?>" class="primary-btn small fix-gr-bg pull-right" target="_blank"><i class="ti-printer"> </i> <?php echo app('translator')->get('lang.print'); ?></a>


            </div> 
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="single-report-admit">
                                <div class="card">
                                    <div class="card-header">
                                            <div class="d-flex">
                                                   
                                                    <div class="offset-2 col-lg-2">
                                                    <img class="logo-img" src="<?php echo e($generalSetting->logo); ?>" alt="">
                                                    </div>
                                                    <div class="col-lg-6 ml-30">
                                                        <h3 class="text-white"> <?php echo e(isset($school_name)?$school_name:'Infix School Management ERP'); ?> </h3> 
                                                        <p class="text-white mb-0"> <?php echo e(isset($address)?$address:'Infix School Address'); ?> </p>
                                                        <p class="text-white mb-0">Email:  <?php echo e(isset($email)?$email:'admin@demo.com'); ?> ,   Phone:  <?php echo e(isset($phone)?$phone:'admin@demo.com'); ?> </p> 
                                                    </div>
                                                    <div class="offset-2">
        
                                                    </div>
                                                </div>
                                        
                                        
                                        
                                    </div>
                                   

                                    
                                    <div class="student_marks_table">
                                            <table class="custom_table">
                                                <thead>
                                                   
                                                    <tr class="numbered_table_row" >
                                                        <td class="border-0">
                                        
                                                        </td>
                                                        <td class="border-0" >
                                                            <div class="school_mark">
                                                                <p class="ssc_text" > <?php echo e($exam_details->title); ?> -  <?php echo e($class_name->class_name); ?>(<?php echo e($section->section_name); ?>)</p> 
                                                                
                                                                <h3>academic transcript</h3>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <!-- first header  -->
                                                        <th colspan="1" class="text_left">
                                        
                                        
                                                            </p>
                                                            <div class="marks_wrap_area">
                                                                <ul class="student_info" >
                                                                    <li><p>Name of Student &nbsp;  : &nbsp; </p> &nbsp; <p class="italic_text">   <?php echo e($student_detail->full_name); ?> </p></li>
                                                                    <li><p>Father's Name &nbsp;  : &nbsp; </p> &nbsp; <p class="italic_text">   <?php echo e($student_detail->parents->fathers_name); ?> </p></li>
                                                                    <li><p>Mother's Name &nbsp;  : &nbsp; </p> &nbsp; <p class="italic_text">  <?php echo e($student_detail->parents->mothers_name); ?> </p></li>
                                                                    <li><p>Name of institution &nbsp;  : &nbsp; </p> &nbsp; <p class="italic_text">  <?php echo e(isset($school_name)?$school_name:'Infix School Management ERP'); ?> </p></li>
                                                                </ul>
                                                                <?php $marks_grade=DB::table('sm_marks_grades')->where('academic_id', App\YearCheck::getAcademicId())->get(); ?>
                                                                <?php if(@$marks_grade): ?>
                                                                <table class="table" id="grade_table_new">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>letter greade</th>
                                                                                <th>class interval</th>
                                                                                <th>grade point</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody> 
                                                                             <?php $__currentLoopData = $marks_grade; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade_d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <tr>
                                                                                <td><?php echo e($grade_d->grade_name); ?></td>
                                                                                <td><?php echo e($grade_d->percent_from); ?>-<?php echo e($grade_d->percent_upto); ?></td>
                                                                                <td><?php echo e($grade_d->gpa); ?></td>
                                                                            </tr>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                    <?php endif; ?>
                                                            </div>
                                                            <div>
                                                                    <ul class="info_details">
                                                                            
                                                                            
                                                                            <li><p>Roll No.   &nbsp; &nbsp; </p> &nbsp; <p>  <strong><?php echo e($student_detail->roll_no); ?></strong>  </p></li>
                                                                            <li><p>Admission No.   &nbsp;  &nbsp; </p> &nbsp; <p>  <strong> <?php echo e($student_detail->admission_no); ?></strong>  </p></li>
                                                                            
                                                                            <li><p>Date of birth   &nbsp;  &nbsp; </p> &nbsp; <p> <strong> <?php echo e($student_detail->date_of_birth != ""? App\SmGeneralSettings::DateConvater($student_detail->date_of_birth):''); ?></strong></p></li>
                                                                        </ul>
                                                            </div>
                                                             
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>

                                            <table class="custom_table">
                                                    <thead>
                                                   
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                          <!-- first header  -->
                                                            <th>SI.NO</th>
                                                            <th colspan="2">Name of subjects</th>
                                                            <th>letter grade</th>
                                                            <th >Greade poient</th>
                                                            <th>GPA <br> Without Additional</th>
                                                            <th>GPA</th>
                                                        </tr>
                                                        <?php
                                                        $main_subject_total_gpa=0;
                                                         $Optional_subject_count=0;
                                                            if($optional_subject!=''){
                                                                $Optional_subject_count=$subjects->count()-1;
                                                            }else{
                                                                $Optional_subject_count=$subjects->count();
                                                            }
                                                        ?>
                                                        <?php $sum_gpa= 0;  $resultCount=1; $subject_count=1; $tota_grade_point=0; $this_student_failed=0; $count=1; ?>
                                                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                                if ($data->subject_id==$optional_subject) { 
                                                                    continue;
                                                                }
                                                        ?>  
                                                        <tr>
                                                        <td class="border-top"><?php echo e($count); ?></td>
                                                            <td colspan="2" class="border-top" style="text-align: left;padding-left: 15px;"><p><?php echo e($data->subject->subject_name); ?></p></td>
                                                        <td class="border-top">
                                                            <p>
                                                                <?php
                                                                    $subject_result=App\CustomResultSetting::getSubjectGpa($student_detail->class_id,$student_detail->section_id,$exam_type_id,$student_detail->id,$data->subject_id);
                                                                    $subject_gpa=App\CustomResultSetting::gpaToGrade($subject_result[$data->subject_id][1]);
                                                                    $main_subject_total_gpa=$main_subject_total_gpa+$subject_result[$data->subject_id][1];
                                                                    echo $subject_gpa;
                                                                ?>
                                                            </p> 
                                                        </td>
                                                            <td class="border-top"><p> 
                                                                <?php
                                                                    $subject_result=App\CustomResultSetting::getSubjectGpa($student_detail->class_id,$student_detail->section_id,$exam_type_id,$student_detail->id,$data->subject_id);
                                                                    echo $subject_result[$data->subject_id][1];
                                                                ?></p></td>

                                                            <?php if($count==1): ?>
                                                            <td rowspan="<?php echo e($Optional_subject_count+1); ?>" class="border-top">
                                                                <p id="main_subject_total_gpa">  </p> 
                                                            </td>
                                                            <td rowspan="<?php echo e($Optional_subject_count+3); ?>" class="border-top">
                                                                <p id="final_result">
                                                                </p>
                                                            </td>
                                                            <?php endif; ?>
                                                            <?php
                                                                $count++
                                                            ?>

                                                        </tr>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                     
                                                      <tr>
                                                         <!-- first td wrap  -->
                                                        <td colspan="6" class="border-top border_left_hide">Additional Subject</td>
                                                      </tr>
                                                      <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <?php
                                                              if ($data->subject_id!=$optional_subject) { 
                                                                  continue;
                                                              }
                                                      ?>  
                                                     
                                                      <tr>
                                                         <!-- first td wrap  -->
                                                      <td class="border-top" style="border-bottom:1px solid black"><?php echo e($count); ?></td>
                                                        <td colspan="2" class="border-top" style="border-bottom:1px solid black"><p><?php echo e($data->subject->subject_name); ?></p></td>
                                                        <td class="border-top" style="border-bottom:1px solid black">
                                                            <p>
                                                                    <?php
                                                                    $subject_result=App\CustomResultSetting::getSubjectGpa($student_detail->class_id,$student_detail->section_id,$exam_type_id,$student_detail->id,$data->subject_id);
                                                                    $subject_gpa=App\CustomResultSetting::gpaToGrade($subject_result[$data->subject_id][1]);
                                                                    echo $subject_gpa;
                                                                ?>
                                                            </p>
                                                        </td>
                                                        <td class="border-top" style="border-bottom:1px solid black">
                                                            <p>
                                                                 <?php
                                                                    $subject_result=App\CustomResultSetting::getSubjectGpa($student_detail->class_id,$student_detail->section_id,$exam_type_id,$student_detail->id,$data->subject_id);
                                                                    echo $subject_result[$data->subject_id][1];
                                                                ?>
                                                            </p>
                                                        </td>
                                                    <td class="border-top devide_td " style="border-bottom:1px solid black"><p>GP above <?php echo e($optional_subject_setup->gpa_above); ?></p> 
                                                        <span>
                                                            <?php
                                                                if($subject_result[$data->subject_id][1]>$optional_subject_setup->gpa_above){
                                                                    $optional_countable_gpa=$subject_result[$data->subject_id][1]-$optional_subject_setup->gpa_above;
                                                                }else{
                                                                    $optional_countable_gpa=0;
                                                                }
                                                                echo  $optional_countable_gpa;
                                                            ?>
                                                        </span>
                                                    </td>
                                                      </tr>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                  </table>


                                                  <script>
                                                        function myFunction(value, subject) {
                                                            if(value !=""){
                                                                var res =  Number( value/subject).toFixed(2) ; 
                                                            }else{
                                                                var res = 0;
                                                            } 
                                                              document.getElementById("main_subject_total_gpa").innerHTML = res; 
                                                          }
                                                
                                                        function myFunction2(value, subject) {
                                                            if(value !=""){
                                                                var res =  Number( value/subject).toFixed(2) ; 
                                                            }else{
                                                                var res = 0;
                                                            } 
                                                              document.getElementById("final_result").innerHTML = res ;
                                                          }

                                                          myFunction(<?php echo e($main_subject_total_gpa); ?>, <?php echo e($Optional_subject_count); ?>);
                                                          myFunction2( <?php echo e($main_subject_total_gpa +$optional_countable_gpa); ?>, <?php echo e($Optional_subject_count); ?>);
                                                        
                                                    </script>



                                                  <table style="width:100%" class="border-0">
                                                        <tbody><tr> 
                                                            <td class="border-0"><p class="result-date" style="text-align:left; float:left; display:inline-block; margin-top:50px; padding-left: 0;">
                                                                    Date of Publication of Result : <b> February 3, 2020, 6:40 am</b>
                                            </p></td>
                                                            <td class="border-0"> 
                                                                <p style="text-align:right; float:right; border-top:1px solid #ddd; display:inline-block; margin-top:50px;">( Exam Controller )</p> 
                                                            </td>
                                                        </tr>
                                                
                                                    </tbody></table>
                                    </div>


                                    
                                    





                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>
            

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dts\resources\views/backEnd/reports/mark_sheet_report_student.blade.php ENDPATH**/ ?>