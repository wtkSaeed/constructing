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
    const CompanyStatus = [
        0 => "معطلة",
        1 => "فعالة",
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


const voucherValues = '{
    "code": 0,
    "message": "Success.",
    "vouchersList": [
        {
            "totalAmount": 105,
            "voucherAmount": 100,
            "voucherId": 5
        },
        {
            "totalAmount": 115,
            "voucherAmount": 110,
            "voucherId": 6
        },
        {
            "totalAmount": 157,
            "voucherAmount": 150,
            "voucherId": 7
        },
        {
            "totalAmount": 200,
            "voucherAmount": 191,
            "voucherId": 8
        },
        {
            "totalAmount": 209,
            "voucherAmount": 200,
            "voucherId": 9
        },
        {
            "totalAmount": 235,
            "voucherAmount": 225,
            "voucherId": 10
        },
        {
            "totalAmount": 261,
            "voucherAmount": 250,
            "voucherId": 11
        },
        {
            "totalAmount": 300,
            "voucherAmount": 287,
            "voucherId": 12
        },
        {
            "totalAmount": 313,
            "voucherAmount": 300,
            "voucherId": 13
        },
        {
            "totalAmount": 400,
            "voucherAmount": 383,
            "voucherId": 14
        },
        {
            "totalAmount": 418,
            "voucherAmount": 400,
            "voucherId": 15
        },
        {
            "totalAmount": 470,
            "voucherAmount": 450,
            "voucherId": 16
        },
        {
            "totalAmount": 500,
            "voucherAmount": 479,
            "voucherId": 17
        },
        {
            "totalAmount": 522,
            "voucherAmount": 500,
            "voucherId": 18
        },
        {
            "totalAmount": 600,
            "voucherAmount": 575,
            "voucherId": 19
        },
        {
            "totalAmount": 626,
            "voucherAmount": 600,
            "voucherId": 20
        },
        {
            "totalAmount": 658,
            "voucherAmount": 630,
            "voucherId": 63
        },
        {
            "totalAmount": 783,
            "voucherAmount": 750,
            "voucherId": 21
        },
        {
            "totalAmount": 835,
            "voucherAmount": 800,
            "voucherId": 22
        },
        {
            "totalAmount": 939,
            "voucherAmount": 900,
            "voucherId": 23
        },
        {
            "totalAmount": 1000,
            "voucherAmount": 958,
            "voucherId": 24
        },
        {
            "totalAmount": 1043,
            "voucherAmount": 1000,
            "voucherId": 25
        },
        {
            "totalAmount": 1252,
            "voucherAmount": 1200,
            "voucherId": 26
        },
        {
            "totalAmount": 1565,
            "voucherAmount": 1500,
            "voucherId": 27
        },
        {
            "totalAmount": 2034,
            "voucherAmount": 1950,
            "voucherId": 28
        },
        {
            "totalAmount": 2100,
            "voucherAmount": 2013,
            "voucherId": 29
        },
        {
            "totalAmount": 2400,
            "voucherAmount": 2301,
            "voucherId": 30
        },
        {
            "totalAmount": 2500,
            "voucherAmount": 2396,
            "voucherId": 58
        },
        {
            "totalAmount": 2700,
            "voucherAmount": 2588,
            "voucherId": 31
        },
        {
            "totalAmount": 3200,
            "voucherAmount": 3068,
            "voucherId": 32
        },
        {
            "totalAmount": 4200,
            "voucherAmount": 4026,
            "voucherId": 33
        },
        {
            "totalAmount": 4700,
            "voucherAmount": 4506,
            "voucherId": 34
        },
        {
            "totalAmount": 5000,
            "voucherAmount": 4793,
            "voucherId": 35
        },
        {
            "totalAmount": 5500,
            "voucherAmount": 5273,
            "voucherId": 36
        },
        {
            "totalAmount": 6500,
            "voucherAmount": 6232,
            "voucherId": 71
        },
        {
            "totalAmount": 7100,
            "voucherAmount": 6807,
            "voucherId": 37
        },
        {
            "totalAmount": 7500,
            "voucherAmount": 7190,
            "voucherId": 47
        },
        {
            "totalAmount": 8100,
            "voucherAmount": 7766,
            "voucherId": 38
        },
        {
            "totalAmount": 8500,
            "voucherAmount": 8149,
            "voucherId": 56
        },
        {
            "totalAmount": 9000,
            "voucherAmount": 8628,
            "voucherId": 72
        },
        {
            "totalAmount": 10000,
            "voucherAmount": 9587,
            "voucherId": 39
        },
        {
            "totalAmount": 10500,
            "voucherAmount": 10067,
            "voucherId": 51
        },
        {
            "totalAmount": 11000,
            "voucherAmount": 10546,
            "voucherId": 40
        },
        {
            "totalAmount": 12000,
            "voucherAmount": 11505,
            "voucherId": 41
        },
        {
            "totalAmount": 13000,
            "voucherAmount": 12464,
            "voucherId": 57
        },
        {
            "totalAmount": 13600,
            "voucherAmount": 13039,
            "voucherId": 42
        },
        {
            "totalAmount": 15000,
            "voucherAmount": 14381,
            "voucherId": 43
        },
        {
            "totalAmount": 16700,
            "voucherAmount": 16011,
            "voucherId": 44
        },
        {
            "totalAmount": 17000,
            "voucherAmount": 16299,
            "voucherId": 73
        },
        {
            "totalAmount": 18000,
            "voucherAmount": 17257,
            "voucherId": 74
        },
        {
            "totalAmount": 19100,
            "voucherAmount": 18312,
            "voucherId": 45
        },
        {
            "totalAmount": 20000,
            "voucherAmount": 19175,
            "voucherId": 53
        },
        {
            "totalAmount": 22000,
            "voucherAmount": 21093,
            "voucherId": 75
        },
        {
            "totalAmount": 25000,
            "voucherAmount": 23969,
            "voucherId": 46
        },
        {
            "totalAmount": 30000,
            "voucherAmount": 28763,
            "voucherId": 48
        },
        {
            "totalAmount": 33000,
            "voucherAmount": 31639,
            "voucherId": 76
        },
        {
            "totalAmount": 38500,
            "voucherAmount": 36912,
            "voucherId": 52
        },
        {
            "totalAmount": 45000,
            "voucherAmount": 43144,
            "voucherId": 54
        },
        {
            "totalAmount": 50000,
            "voucherAmount": 47938,
            "voucherId": 77
        },
        {
            "totalAmount": 60000,
            "voucherAmount": 57526,
            "voucherId": 49
        },
        {
            "totalAmount": 65000,
            "voucherAmount": 62320,
            "voucherId": 59
        },
        {
            "totalAmount": 75000,
            "voucherAmount": 71907,
            "voucherId": 50
        },
        {
            "totalAmount": 80000,
            "voucherAmount": 76701,
            "voucherId": 55
        },
        {
            "totalAmount": 99000,
            "voucherAmount": 94918,
            "voucherId": 78
        }
    ]
}';

///
/// end of syriatel Api


}
