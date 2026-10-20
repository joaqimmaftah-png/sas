<?php
require_once __DIR__ . '/mysql_compat.php';


if (isset($_GET['action'])) { 
    ///////////////////call apage//////////////////////
    if ($_GET['action'] == 'add_contract') {
        include_once 'authorized/add_contract.php';
    } elseif ($_GET['action'] == 'add_department') {
        include_once 'authorized/add_department.php';
    } elseif ($_GET['action'] == 'add_employee') {
        include_once 'authorized/HR/add_employee.php';
    } elseif ($_GET['action'] == 'profile') {
        include_once 'authorized/HR/employee_profile.php';
    } elseif ($_GET['action'] == 'attendence') {
        include_once 'authorized/HR/track_attendence.php';
    } elseif ($_GET['action'] == 'manage_leave_request') {
        include_once 'authorized/HR/manage_leave_request.php';
    } elseif ($_GET['action'] == 'approve_leave') {
        include_once 'authorized/HR/manage_leave_request.php';
    }elseif ($_GET['action'] == 'decline') {
        include_once 'authorized/HR/manage_leave_request.php';
    }  elseif ($_GET['action'] == 'manage_attendence') {
        include_once 'authorized/HR/manage_attendence.php';
    } elseif ($_GET['action'] == 'manage_attendence') {
        include_once 'authorized/HR/manage_attendence.php';
    }
//        manage appraisal     
    elseif ($_GET['action'] == 'perfomance_appraisal') {
        include_once 'authorized/HR/manage_performance_appraisal.php';
    }  elseif ($_GET['action'] == 'Evaluate') {
        include_once 'authorized/HR/fill_appraisal.php';
    }elseif ($_GET['action'] == 'add_appraisal') {
        include_once 'authorized/HR/add_appraisal.php';
    }
    elseif ($_GET['action'] == 'employee_self_review') {
        include_once 'authorized/HR/appraisal_employee_review.php';
    }
    elseif ($_GET['action'] == 'manage_appraisal') {
        include_once 'authorized/usersystem/manage_appraisal.php';
    }
        elseif ($_GET['action'] == 'fill_review') {
        include_once 'authorized/usersystem/review_appraisal.php';
    }
     elseif ($_GET['action'] == '') {
        include_once 'authorized/usersystem/review_appraisal.php';
    }
//    elseif ($_GET['action'] == 'fill_review') {
//        include_once 'authorized/usersystem/fill_reviews_data.php';
//    }
       
//    END Appraisal
    
    
    
    
    
    elseif ($_GET['action'] == 'delete_emloyee') {
        include_once 'authorized/HR/manage_employee.php';
    } elseif ($_GET['action'] == 'reminder') {
        include_once 'authorized/HR/reminder.php';
    } elseif ($_GET['action'] == 'email') {
        include_once 'authorized/HR/email.php';
    } elseif ($_GET['action'] == 'sms') {
        include_once 'authorized/HR/sms.php';
    } elseif ($_GET['action'] == 'smsgroup') {
        include_once 'authorized/HR/smsgroup.php';
    } elseif ($_GET['action'] == 'emailgroup') {
        include_once 'authorized/HR/emailgroup.php';
    } elseif ($_GET['action'] == 'payroll page') {
        include_once 'authorized/HR/payroll_page.php';
    } elseif ($_GET['action'] == 'deletep') {
        include_once 'authorized/HR/payroll_page.php';
    } elseif ($_GET['action'] == 'Pay Slip') {
        include_once 'authorized/HR/payslip_page.php';
    }
    elseif ($_GET['action'] == 'dashboard') {
        include_once 'authorized/HR/home.php';
    }
    // --- extra HR routes (menu links that had no handler) ---
    elseif ($_GET['action'] == 'view_appraisal') {
        include_once 'authorized/HR/manage_performance_appraisal.php';
    } elseif ($_GET['action'] == 'PaySlips') {
        include_once 'authorized/HR/payslip.php';
    } elseif ($_GET['action'] == 'show_payslip') {
        include_once 'authorized/HR/showpayslip.php';
    } elseif ($_GET['action'] == 'attendance_report') {
        include_once 'authorized/HR/attendance_report.php';
    } elseif ($_GET['action'] == 'Goal Management') {
        include_once 'authorized/HR/goal_mamagement.php';
    }

    //////////////////////action to insert a data into database////////////////////////////
    elseif ($_GET['action'] == 'employee') {
        include_once 'authorized/HR/manage_employee.php';
    } elseif ($_GET['action'] == 'add_employee') {
        include_once 'authorized/HR/add_employee.php';
    } elseif ($_GET['action'] == 'add_contact') {
        include_once 'authorized/HR/contact_info.php';
    } elseif ($_GET['action'] == 'edit') {
        include_once 'authorized/HR/edit_user_profile.php';
    } elseif ($_GET['action'] == 'add_relatives') {
        include_once 'authorized/employee_profile.php';
    } elseif ($_GET['action'] == 'importattendence') {
        include_once 'authorized/import_excel_attendence.php';
    } elseif ($_GET['action'] == 'add_attendant') {
        include_once 'authorized/HR/manage_attendence.php';
    }
////////////////////////////////////////////contents for accounts/////////////////////////////////////////////////////
    elseif ($_GET['action'] == 'accounts_home') {
        include_once 'authorized/accounting/home.php';
    } 
     elseif ($_GET['action'] == 'add_acccounts_sheet') {
        include_once 'authorized/accounting/add_on_accounts_sheet.php';
    } 

///////////////////////////////////mmwanzo store////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////mwisho wa contents za accoun//////////////////////////////////////////
    elseif ($_GET['action'] == 'register_new_part') {
        include_once 'authorized/stock/reqister_new_sparepart.php';
    } elseif ($_GET['action'] == 'register_new_excel') {
        include_once 'authorized/stock/reqister_new_sparepart.php';
    } elseif ($_GET['action'] == 'edit_store') {
        include_once 'authorized/stock/spare_edit.php';
    } elseif ($_GET['action'] == 'add_requesting') {
        include_once 'authorized/stock/page_request_form.php';
    } elseif ($_GET['action'] == 'view_request') {
        include_once 'authorized/stock/view_request.php';
    } elseif ($_GET['action'] == 'send_request') {
        include_once 'authorized/stock/manage_request.php';
    } elseif ($_GET['action'] == 'show by depo') {
        include_once 'authorized/stock/show_stock_by_depo.php';
    } elseif ($_GET['action'] == 'inventory') {
        include_once 'authorized/stock/inventory.php';
    } elseif ($_GET['action'] == 'engine') {
        include_once 'authorized/stock/engine.php';
    } elseif ($_GET['action'] == 'delete engine') {
        include_once 'authorized/stock/engine.php';
    } elseif ($_GET['action'] == 'stock') {
        include_once 'authorized/stock/manage_storing.php';
    } elseif ($_GET['action'] == 'delete images') {
        include_once 'authorized/stock/manage_storing.php';
    }
    /////////////////////////////////////////////////////////////////////////////////////////////
    elseif ($_GET['action'] == 'fs_request') {
        include_once 'authorized/stock/userapp_fs_request.php';
    } elseif ($_GET['action'] == 'depo_stock') {
        include_once 'authorized/stock/depo_stock.php';
    } elseif ($_GET['action'] == 'depo_site') {
        include_once 'authorized/stock/my_depo_site.php';
    } elseif ($_GET['action'] == 'spare_management') {
        include_once 'authorized/stock/spare_management.php';
    }
    ///////////////////////////////////////fleet Management System/////////////////////////////////////////////////////
    elseif ($_GET['action'] == 'home') {
        include_once 'authorized/car_track/home.php';
    } elseif ($_GET['action'] == 'view info') {
        include_once 'authorized/car_track/view_vehicle.php';
    } elseif ($_GET['action'] == 'cars_issues') {
        include_once 'authorized/car_track/car_issues.php';
    } elseif ($_GET['action'] == 'new_issues') {
        include_once 'authorized/car_track/reqister_new_issues.php';
    } elseif ($_GET['action'] == 'register new Car') {
        include_once 'authorized/car_track/register_new_car_info.php';
    } elseif ($_GET['action'] == 'edit car info') {
        include_once 'authorized/car_track/edit_car_info.php';
    } elseif ($_GET['action'] == 'homedelete') {
        include_once 'authorized/car_track/home.php';
    } elseif ($_GET['action'] == 'edit_car_issues') {
        include_once 'authorized/car_track/car_issues_edit.php';
    } elseif ($_GET['action'] == 'close_issue') {
        include_once 'authorized/car_track/car_issues.php';
    } elseif ($_GET['action'] == 'view vehicle issue') {
        include_once 'authorized/car_track/view_car_by_info_pic.php';
    } elseif ($_GET['action'] == 'car history') {
        include_once 'authorized/car_track/car_history.php';
    } elseif ($_GET['action'] == 'view vehicle history') {
        include_once 'authorized/car_track/view_car_history_services.php';
    } elseif ($_GET['action'] == 'vehicle schedule services') {
        include_once 'authorized/car_track/car_schedule_services.php';
    } elseif ($_GET['action'] == 'vehicle Insurance and Road Services') {
        include_once 'authorized/car_track/car_insurance.php';
    } elseif ($_GET['action'] == 'add_car_on_services') {
        include_once 'authorized/car_track/add_car_services.php';
    } elseif ($_GET['action'] == 'service_edit') {
        include_once 'authorized/car_track/car_service_edit.php';
    } elseif ($_GET['action'] == 'service_update') {
        include_once 'authorized/car_track/car_service_update.php';
    } elseif ($_GET['action'] == 'car_licences') {
        include_once 'authorized/car_track/car_licence.php';
    }
    elseif ($_GET['action'] == 'vehicle_rent') {
        include_once 'authorized/car_track/car_rent.php';
    }
    elseif ($_GET['action'] == 'vehicle_account_track') {
        include_once 'authorized/car_track/vehicle_accounts_manage.php';
    }
    
     elseif ($_GET['action'] == 'vehicle_report') {
        include_once 'authorized/car_track/car_history.php';
    }


    ///////////////////////////////////Vehicle fuel management///////////////////////////////////////////////
    elseif ($_GET['action'] == 'vehicle_fuel') {
        include_once 'authorized/vehicle_fuel_management/fuel_issue.php';
    } elseif ($_GET['action'] == 'vehicle_fuel_list') {
        include_once 'authorized/vehicle_fuel_management/home.php';
    }
    elseif ($_GET['action'] == 'deletecar') {
        include_once 'authorized/vehicle_fuel_management/home.php';
    }
    //////////////////////////////////////tpf/////////////////////////////////////////
    
    
      elseif ($_GET['action'] == 'workorder') {
        include_once 'authorized/tpf_process/workorder.php';
    }
     elseif ($_GET['action'] == 'raise_tpf') {
        include_once 'authorized/tpf_process/home.php';
    }
    elseif ($_GET['action'] == 'raise_per_day') {
        include_once 'authorized/tpf_process/raised_per_day.php';
    }
     elseif ($_GET['action'] == 'tpf_process') {
        include_once 'authorized/tpf_process/store_ptf.php';
    }
    elseif ($_GET['action'] == 'delete_tpf') {
        include_once 'authorized/tpf_process/home.php';
    }


////////////////////////////////////////purchase order////////////
    elseif ($_GET['action'] == 'new_order') {
        include_once 'authorized/LPO/add_purchase_order.php';
    }
    elseif ($_GET['action'] == 'add_order_action') {
        include_once 'authorized/LPO/add_order_action.php';
    }
     elseif ($_GET['action'] == 'po_form') {
        include_once 'authorized/LPO/purchase_order_form.php';
    }
    elseif ($_GET['action'] == 'po_form_acc') {
        include_once 'authorized/LPO/purchase_order_form_acc.php';
    }
    elseif ($_GET['action'] == 'po_form_op') {
        include_once 'authorized/LPO/purchase_order_form_op.php';
    }
    
    elseif ($_GET['action'] == 'store_lpo') {
        include_once 'authorized/LPO/home.php';
    } 
     elseif ($_GET['action'] == 'account_lpo') {
        include_once 'authorized/LPO/home_acc.php';
    }
     elseif ($_GET['action'] == 'operation_process') {
        include_once 'authorized/LPO/home_op.php';
    }
    
    elseif ($_GET['action'] == 'submitvocha') {
        include_once 'authorized/LPO/vocher/submit.php';
    }
    
    elseif ($_GET['action'] == 'voucher') {
        include_once 'authorized/LPO/vocher/home.php';
        
        
    }
    elseif ($_GET['action'] == 'view_voucher') {
        include_once 'authorized/LPO/vocher/view_voucher.php';
    }
     elseif ($_GET['action'] == 'lpo_report') {
        include_once 'authorized/LPO/lpo_report.php';
    }
    elseif ($_GET['action'] == 'lpo_supplier') {
        include_once 'authorized/LPO/lpo_supplier.php';
    }
     elseif ($_GET['action'] == 'lpo_edit') {
        include_once 'authorized/LPO/edit_lpo.php';
    }
    elseif ($_GET['action'] == 'weekly_lpo') {
        include_once 'authorized/LPO/show_by_week.php';
    }
    
             elseif ($_GET['action'] == 'po_form2') {
        include_once 'authorized/LPO/second_purchase_form.php';
    }
    
////////////////////////////////////////end purchase order
       elseif ($_GET['action'] == 'hprocess_request') {
        include_once 'authorized/usersystem/hprocess_request.php';
    }
     elseif ($_GET['action'] == 'sprocess_request') {
        include_once 'authorized/usersystem/process_request.php';
    }
    elseif ($_GET['action'] == 'process_request') {
        include_once 'authorized/usersystem/process_request.php';
    }
    elseif($_GET['action'] == 'printing'){
        include_once 'authorized/usersystem/process_request.php';
    }
    
    elseif($_GET['action'] == 'stoock'){
        include_once 'authorized/stock/home.php';
    }
    
      elseif($_GET['action'] == 'stock_report'){
        include_once 'authorized/stock/stock_report.php';
    }
    elseif($_GET['action'] == 'view_edit_request'){
        include_once 'authorized/usersystem/view_edit_you_request.php';
    }
    
    elseif($_GET['action'] == 'grn_report'){
        include_once 'authorized/stock/grn_report.php';
    }
 ///////////////////////////////////////////////////////////////////////cash_request 
    elseif($_GET['action'] == 'cash_request'){
        include_once 'authorized/usersystem/approve_cash_request.php';
    }
    elseif($_GET['action'] == 'cash_account'){
        include_once 'authorized/usersystem/cash_accounts.php';
    }
    elseif($_GET['action'] == 'view_cash_request'){
        include_once 'authorized/usersystem/view_cash_request.php';
    }
    elseif($_GET['action'] == 'delete_request_item'){
        include_once 'authorized/usersystem/my_profile.php';
    }
     elseif($_GET['action'] == 'goods_received_note'){
        include_once 'authorized/usersystem/goods_received_note.php';
    }
    elseif($_GET['action'] == 'view_goods_received_note'){
        include_once 'authorized/usersystem/view_goods_received_note.php';
    }
     elseif($_GET['action'] == 'asset'){
        include_once 'authorized/usersystem/asset_by_category.php';
    }
    
    
    elseif($_GET['action'] == 'home_opmpersonal'){
        include_once 'authorized/opm/home_opmpersonal.php';
    }
    
//    operational monitor////////////////////////////////////////
    elseif($_GET['action'] == 'home_opm'){
        include_once 'authorized/opm/home.php';
    }
     elseif($_GET['action'] == 'view_finding'){
        include_once 'authorized/opm/view_finding.php';
    }
    elseif($_GET['action'] == 'view_action'){
        include_once 'authorized/opm/view_actions.php';
    }
    elseif($_GET['action'] == 'finding'){
        include_once 'authorized/opm/show_actions.php';
    }
    elseif($_GET['action'] == 'view_opp'){
        include_once 'authorized/opm/view_all_actions.php';
    }
    elseif($_GET['action'] == 'view_report'){
        include_once 'authorized/opm/report.php';
    }
    
    ///////////////////////////////RCA////////////////////////////////////////
     elseif($_GET['action'] == 'rca_home'){
        include_once 'authorized/RCA/home.php';
    }
    elseif($_GET['action'] == 'sitedb'){
        include_once 'authorized/RCA/sitedb.php';
    }
    elseif($_GET['action'] == 'rca_report'){
        include_once 'authorized/RCA/report_form.php';
    }
       elseif($_GET['action'] == 'rca_summary'){
        include_once 'authorized/RCA/rca_sumary.php';
    }
    ////////////////////////////quotation////////////////////////////
    
//    elseif($_GET['action'] == 'report'){
//        include_once 'authorized/quotation/home.php';
//    }
    
    elseif($_GET['action'] == 'newquotation'){
        include_once 'authorized/quotation/newquotation.php';
    }
          elseif($_GET['action'] == 'invoice'){
        include_once 'authorized/quotation/addinvoice.php';
    }

         elseif($_GET['action'] == 'quotationpage'){
        include_once 'authorized/quotation/quotationpage.php';
    }
    
             elseif($_GET['action'] == 'invoicepage'){
        include_once 'authorized/quotation/invoicepage.php';
    }
            elseif($_GET['action'] == 'editquotation'){
        include_once 'authorized/quotation/editquotationpage.php';
    }
    
            elseif($_GET['action'] == 'printquotation'){
        include_once 'authorized/quotation/printquotation.php';
    }
    
            elseif($_GET['action'] == 'printinvoice'){
        include_once 'authorized/quotation/printinvoice.php';
    }
    
           elseif($_GET['action'] == 'editinvoicepage'){
        include_once 'authorized/quotation/editinvoicepage.php';
    }
    
          elseif($_GET['action'] == 'updatequotation'){
        include_once 'authorized/quotation/home.php';
    }
    
        elseif($_GET['action'] == 'quotationreport'){
        include_once 'authorized/quotation/quotationreport.php';
        
    }
elseif($_GET['action'] == 'account_report'){
        include_once 'authorized/accounting/home_accounts.php';
    }
elseif($_GET['action'] == 'add_survey_report'){
        include_once 'authorized/work_composition/add_survey_report.php';
    }
elseif($_GET['action'] == 'kprint'){
        include_once 'authorized/work_composition/print_site_survey.php';
    }
elseif($_GET['action'] == 'hq'){
        include_once 'authorized/Attendence/home_HQ.php';
    }
     elseif($_GET['action'] == 'clsa'){
        include_once 'authorized/Attendence/home_CLASS_A.php';
    }
    
     elseif($_GET['action'] == 'lpo_tracker'){
        include_once 'authorized/account_dashboard/lpo_tracker.php';
    }
    
    elseif ($_GET['action'] == 'Verification') {
    include_once 'authorized/Attendence/verification2.php';
}


    elseif ($_GET['action'] == 'leave_report') {
    include_once 'authorized/leave/leave_report.php';
}  
    
  elseif ($_GET['action'] == 'actions_report') {
    include_once 'authorized/opm/actions_report.php';
}

  elseif ($_GET['action'] == 'purchase_order_report') {
    include_once 'authorized/LPO/purchase_order_report.php';
}  


  elseif ($_GET['action'] == 'grn_edit') {
    include_once 'authorized/usersystem/edit_grn.php';
}



  elseif ($_GET['action'] == 'sincro_projects') {
    include_once 'authorized/account_dashboard/projects_list.php';
}


  elseif ($_GET['action'] == 'view_project_tasks') {
    include_once 'authorized/account_dashboard/view_project_tasks.php';
}

elseif($_GET['action']=='daily'){
    include_once 'authorized/account_dashboard/daily_quotation.php';
}


elseif($_GET['action']=='quot_item'){
    include_once 'authorized/account_dashboard/quot_item.php';
}  


elseif($_GET['action']=='daily_approved'){  
    include_once 'authorized/account_dashboard/approved_quotations.php';
}  


elseif($_GET['action']=='quot_notapproved'){
    include_once 'authorized/account_dashboard/notapproved_quotations.php';
}


elseif($_GET['action']=='acc_dashboard'){
    include_once 'authorized/account_dashboard/account_dashboard_report.php';
} 


elseif($_GET['action']=='monthly_lpo'){
    include_once 'authorized/account_dashboard/daily_lpo.php';
}




elseif($_GET['action']=='fuel_management'){  
    include_once 'authorized/vehicle_fuel_management/manage_fuel.php';
}


elseif($_GET['action']=='fuel_history'){  
    include_once 'authorized/vehicle_fuel_management/fuel_history.php';
} 

elseif($_GET['action']=='edit_the_leave'){  
    include_once 'authorized/leave/edit_leave.php';
}

elseif($_GET['action']=='issue_report'){  
    include_once 'authorized/It_Helpdesk/issue_report.php';
}


elseif($_GET['action']=='add_issue'){    
    include_once 'authorized/It_Helpdesk/add_issue.php';
}





 



}
?>
