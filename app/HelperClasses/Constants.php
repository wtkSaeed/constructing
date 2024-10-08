<?php


namespace App\HelperClasses;


class Constants
{

//    ============================= Roles =================================
    const Manager = "المدير العام";
    const FinancialManager = "المدير المالي";
    const FinancialSectionManager = "مدير قسم الحسابات";
    const FinancialOfficer = "المحاسب";
    const TransferEmployee = "موظف التحويل";
    const SalesManager = "مدير المبيعات";
    const MarketingManager = "مسؤول التسويق";


//    =========================== Permissions =============================
    const ManageEmployeeAccounts = "إدارة حسابات الموظفين";
    const ManageCustomerAccounts = "إدارة حسابات الزبائن";
    const ManageCompanies = "إدارة الشركات";
    const ManageProfiles = "إدارة البروفايلات";
    const ManageCompaniesCards = "إدارة حسابات الشركات";
    const ManageDeposits = "إدارة الدفعات";
    const ReceiveDeposits = "استلام الدفعات";
    const ShowPayoffs = "عرض التسديدات";
    const ReceiveManualPayoffs = "استلام التسديدات اليدوية";
    const ShowMovements = "عرض الحركات";
    const ManageReadyResponses = "ادارة الردود الجاهزة";
    const ManageMtnCompany = "ادارة شركة mtn";
    const ManagePsts = "ادارة المقاسم";
    const ManageGateRequests = "ادارة طلبات البوابات";
    const ShowReports = "عرض التقارير";
    const ShowStatistics = "عرض الاحصائيات";
    const ReceiveQueries = "استلام الاستعلامات";
    const ManageAgent = "ادارة الوكلاء";
	const ManageCustomerPaperSatatus = "تغيير حالة الاوراق";


    const projectStatus = [
        0 =>"cancelled",
        1 => "planned",
        2 => "in progress",
        3 => "late",
        4 => "complete",


    ];

    const requestStatus = [
        0 =>"cancelled",
        1 => "in preview",
        2 => "approved",
        3 => "rejected",
    ];
    const userStatus = [
        0 => "Operator",
        1 => "Manager",
    ];
    const SourceTypes = [
        1 => "بنك",
        2 => "فوراً",
        3 => "نقدي"
    ];
    const CustomerTypes = [
        1 => "زبون عادي",
        4 => "نقطة بيع"
    ];
    const DepositStatus = [
        1 => "قيد الانتظار",
        2 => "ناجح",
        0 => "فاشل"
    ];

    const GateRequestStatus = [
        0 => "قيد الانتظار",
        1 => "مستلم",
        2 => "ناجح",
        3 => "فاشل"
    ];
    const PayoffsStatus = [
        0 =>"فاشل" ,
        1 => "ناجح",
        2 => "قيد الانتظار"
    ];
    const UserStatus = [
        0 =>"معطل " ,
        1 => "فعال",
    ];
    const PaperCompletedStatus = [
        0 =>"غير موجودة " ,
        1 =>"غير مكتملة " ,
        2 => "مكتملة",
    ];
    const DecimalCount = 2;

    const ZadAdditionalAmount = 0;

    const ProfileType = [
        1 => "زبون مفرق",
        2 => "زبون جملة",
        4 => "نقطة بيع",
    ];
    // ===========================  Accounting Sub Type ========================

    const AccountingSubType = [
        1 => "FREE",
        3 => "THREE",
        6 => "SIX",
        12 => "TWELVE",
    ];

    /// ========== BalanceTransferAllowance  ==============
    const  BalanceTransferAllow = 1;
    const  BalanceTransferNotAllow = 0;






///
/// end of syriatel Api


}
