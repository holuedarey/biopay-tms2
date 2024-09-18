<?php

namespace App\Http\Controllers\Api;

use App\Contracts\TransferServiceInterface;
use App\Helpers\MyResponse;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class Banks extends Controller
{
/*    public function index(TransferServiceInterface $transferService)
    {
        Log::error(json_encode($transferService::name()));

        start:
        $banks = Bank::whereProvider($transferService::name())->orderBy('name')->get();

        if ($banks->isEmpty()) {
            $res = $transferService->updateBankList();

            if ($res->success) goto start;

            return MyResponse::failed($res->message);
        }

        return MyResponse::success(data: $banks);
    }*/



   public function index(TransferServiceInterface $transferService)
    {
        Log::error(json_encode($transferService::name()));

        start:
        $banks = Bank::whereProvider($transferService::name())->orderBy('name')->get();

        if ($transferService::name() === "SPOUT-") {

              $jsonString = '[
            {
                "bankCode": "796",
                "bankName": "Abia State University MFB"
            },
            {
                "bankCode": "301",
                "bankName": "Jaiz Bank"
            },
            {
                "bankCode": "789",
                "bankName": "U and C MFI"
            },
            {
                "bankCode": "764",
                "bankName": "Unical  mfb"
            },
            {
                "bankCode": "100",
                "bankName": "SunTrust Bank Nigeria Limited"
            },
            {
                "bankCode": "B76",
                "bankName": "Access Money"
            },
            {
                "bankCode": "B78",
                "bankName": "ChamsMobile"
            },
            {
                "bankCode": "B80",
                "bankName": "Eartholeum"
            },
            {
                "bankCode": "B82",
                "bankName": "eTranzact"
            },
            {
                "bankCode": "B84",
                "bankName": "FCMB Easy Account"
            },
            {
                "bankCode": "B86",
                "bankName": "Fidelity Mobile"
            },
            {
                "bankCode": "719",
                "bankName": "UBA Social Banking"
            },
            {
                "bankCode": "B88",
                "bankName": "Fortis Mobie"
            },
            {
                "bankCode": "101",
                "bankName": "PROVIDUS Bank"
            },
            {
                "bankCode": "B90",
                "bankName": "GTMobile"
            },
            {
                "bankCode": "B92",
                "bankName": "KongaPay"
            },
            {
                "bankCode": "B95",
                "bankName": "MoneyBox"
            },
            {
                "bankCode": "C03",
                "bankName": "PAYCOM"
            },
            {
                "bankCode": "B99",
                "bankName": "Palmpay"
            },
            {
                "bankCode": "C02",
                "bankName": "PayAttitude Online"
            },
            {
                "bankCode": "C04",
                "bankName": "ReadCash (Parkway)"
            },
            {
                "bankCode": "C06",
                "bankName": "TagPay"
            },
            {
                "bankCode": "C08",
                "bankName": "VTNetworks"
            },
            {
                "bankCode": "C10",
                "bankName": "ZenithMobile"
            },
            {
                "bankCode": "C12",
                "bankName": "Accelerex Network"
            },
            {
                "bankCode": "C15",
                "bankName": "Cellulant"
            },
            {
                "bankCode": "C18",
                "bankName": "First Apple Limited"
            },
            {
                "bankCode": "C20",
                "bankName": "FSDH"
            },
            {
                "bankCode": "C22",
                "bankName": "Interswitch"
            },
            {
                "bankCode": "C24",
                "bankName": "KADICK Integration"
            },
            {
                "bankCode": "C26",
                "bankName": "NIP Virtual Bank"
            },
            {
                "bankCode": "C28",
                "bankName": "Paystack"
            },
            {
                "bankCode": "C30",
                "bankName": "Rand Merchant Bank"
            },
            {
                "bankCode": "C33",
                "bankName": "XPRESS Payments"
            },
            {
                "bankCode": "A02",
                "bankName": "Meridian Microfinance Bank Ltd"
            },
            {
                "bankCode": "A04",
                "bankName": "Abbey Mortgage MFB"
            },
            {
                "bankCode": "A06",
                "bankName": "Accion Microfinance Bank"
            },
            {
                "bankCode": "A08",
                "bankName": "Adeyemi College Staff MFB"
            },
            {
                "bankCode": "A11",
                "bankName": "Al-Barakah MFB"
            },
            {
                "bankCode": "A13",
                "bankName": "Alert MFB"
            },
            {
                "bankCode": "A15",
                "bankName": "Allworkers MFB"
            },
            {
                "bankCode": "A17",
                "bankName": "AMJU UNIQUE MFB"
            },
            {
                "bankCode": "A19",
                "bankName": "Apeks MFB"
            },
            {
                "bankCode": "A21",
                "bankName": "Arise MFB"
            },
            {
                "bankCode": "A23",
                "bankName": "Astrapolis MFB"
            },
            {
                "bankCode": "A25",
                "bankName": "Baines Credit MFB"
            },
            {
                "bankCode": "A27",
                "bankName": "Baobab MFB"
            },
            {
                "bankCode": "A29",
                "bankName": "BC Cash MFB"
            },
            {
                "bankCode": "A31",
                "bankName": "Bosak MFB"
            },
            {
                "bankCode": "A33",
                "bankName": "Brent Mortgage Bank"
            },
            {
                "bankCode": "A35",
                "bankName": "Brightway MFB"
            },
            {
                "bankCode": "A37",
                "bankName": "CEMCS Microfinance Bank"
            },
            {
                "bankCode": "A39",
                "bankName": "CIT Microfinance Bank"
            },
            {
                "bankCode": "A41",
                "bankName": "Conpro Microfinance Bank"
            },
            {
                "bankCode": "A43",
                "bankName": "Corestep Microfinance Bank"
            },
            {
                "bankCode": "A45",
                "bankName": "Davodani MFB"
            },
            {
                "bankCode": "A47",
                "bankName": "Eagle Flight MFB"
            },
            {
                "bankCode": "A49",
                "bankName": "Edfin MFB"
            },
            {
                "bankCode": "A51",
                "bankName": "EK-Reliable Microfinance Bank"
            },
            {
                "bankCode": "A53",
                "bankName": "Empire Microfinance Bank"
            },
            {
                "bankCode": "A54",
                "bankName": "Empire Trust MFB"
            },
            {
                "bankCode": "A56",
                "bankName": "ESO-E Microfinance Bank"
            },
            {
                "bankCode": "A57",
                "bankName": "Evangel MFB"
            },
            {
                "bankCode": "A59",
                "bankName": "Eyowo MFB"
            },
            {
                "bankCode": "A61",
                "bankName": "Federal University Dutse MFB"
            },
            {
                "bankCode": "A63",
                "bankName": "Fidfund MFB"
            },
            {
                "bankCode": "A65",
                "bankName": "Firmus MFB"
            },
            {
                "bankCode": "A67",
                "bankName": "First Multiple MFB"
            },
            {
                "bankCode": "A69",
                "bankName": "First Royal Microfinance Bank"
            },
            {
                "bankCode": "Z24",
                "bankName": "Standard MFB"
            },
            {
                "bankCode": "Z43",
                "bankName": "Wudil MFB"
            },
            {
                "bankCode": "773",
                "bankName": "Akwa Savings and Loans Ltd"
            },
            {
                "bankCode": "104",
                "bankName": "Parallex Bank"
            },
            {
                "bankCode": "C39",
                "bankName": "MoniePoint"
            },
            {
                "bankCode": "105",
                "bankName": "Premium Trust Bank"
            },
            {
                "bankCode": "106",
                "bankName": "Signature Bank"
            },
            {
                "bankCode": "E07",
                "bankName": "E-NAIRA"
            },
            {
                "bankCode": "A71",
                "bankName": "Fullrange MFB"
            },
            {
                "bankCode": "A73",
                "bankName": "Gateway Mortgage Bank"
            },
            {
                "bankCode": "A75",
                "bankName": "Gowans MFB"
            },
            {
                "bankCode": "063",
                "bankName": "Diamond Bank"
            },
            {
                "bankCode": "A76",
                "bankName": "Greenbank MFB"
            },
            {
                "bankCode": "A80",
                "bankName": "Hackman Microfinance Bank"
            },
            {
                "bankCode": "A82",
                "bankName": "Hala MFB"
            },
            {
                "bankCode": "A84",
                "bankName": "Headway Microfinance Bnak"
            },
            {
                "bankCode": "A85",
                "bankName": "Ibile Microfinance Bank"
            },
            {
                "bankCode": "A87",
                "bankName": "Ikire MFB"
            },
            {
                "bankCode": "A89",
                "bankName": "Imperial Homes Mortgage Bank"
            },
            {
                "bankCode": "A90",
                "bankName": "Infinity Microfnance Bank"
            },
            {
                "bankCode": "A92",
                "bankName": "IRL Microfinance Bank"
            },
            {
                "bankCode": "A93",
                "bankName": "Isaleoyo Microfinance Bank"
            },
            {
                "bankCode": "700",
                "bankName": "PocketMoni"
            },
            {
                "bankCode": "A95",
                "bankName": "Kadpoly Microfinance Bank"
            },
            {
                "bankCode": "A97",
                "bankName": "Kontagora MFB"
            },
            {
                "bankCode": "068",
                "bankName": "STandard Chartered Bank"
            },
            {
                "bankCode": "A99",
                "bankName": "Lafayette Microfinance Bank"
            },
            {
                "bankCode": "B02",
                "bankName": "Lavender Microfinance Bank"
            },
            {
                "bankCode": "B04",
                "bankName": "Lovonus MFB"
            },
            {
                "bankCode": "B06",
                "bankName": "Mainstreet MFB"
            },
            {
                "bankCode": "710",
                "bankName": "PocketMoni - Access"
            },
            {
                "bankCode": "B07",
                "bankName": "Malachy MFB"
            },
            {
                "bankCode": "B09",
                "bankName": "Mayfair MFB"
            },
            {
                "bankCode": "706",
                "bankName": "PocketMoni - Skye"
            },
            {
                "bankCode": "701",
                "bankName": "PocketMoni - Access"
            },
            {
                "bankCode": "B11",
                "bankName": "Megapraise MFB"
            },
            {
                "bankCode": "B13",
                "bankName": "MINT-FINEX MFB"
            },
            {
                "bankCode": "B15",
                "bankName": "MoneyTrust MFB"
            },
            {
                "bankCode": "030",
                "bankName": "Heritage Bank"
            },
            {
                "bankCode": "B18",
                "bankName": "Mutual Trust MFB"
            },
            {
                "bankCode": "B20",
                "bankName": "Ndiora MFB"
            },
            {
                "bankCode": "B22",
                "bankName": "New Dawn MFB"
            },
            {
                "bankCode": "707",
                "bankName": "BabCock Card Scheme"
            },
            {
                "bankCode": "B24",
                "bankName": "New Prudential Bank"
            },
            {
                "bankCode": "B26",
                "bankName": "NIRSAL National MFB"
            },
            {
                "bankCode": "B28",
                "bankName": "NPF MFB"
            },
            {
                "bankCode": "B30",
                "bankName": "Oche MFB"
            },
            {
                "bankCode": "B32",
                "bankName": "Okpoga MFB"
            },
            {
                "bankCode": "000",
                "bankName": "eTranzact Switch"
            },
            {
                "bankCode": "B34",
                "bankName": "Omoluabi Savings and Loans"
            },
            {
                "bankCode": "B36",
                "bankName": "Patrick Gold"
            },
            {
                "bankCode": "044",
                "bankName": "Access Bank plc"
            },
            {
                "bankCode": "232",
                "bankName": "Sterling Bank"
            },
            {
                "bankCode": "214",
                "bankName": "First City Monument Bank Plc"
            },
            {
                "bankCode": "082",
                "bankName": "Keystone Bank"
            },
            {
                "bankCode": "B38",
                "bankName": "Pennywise MFB"
            },
            {
                "bankCode": "057",
                "bankName": "Zenith Bank Plc."
            },
            {
                "bankCode": "B40",
                "bankName": "Petra Microfinance Bank"
            },
            {
                "bankCode": "033",
                "bankName": "United Bank for Africa"
            },
            {
                "bankCode": "B42",
                "bankName": "Platinum Mortgage Bank"
            },
            {
                "bankCode": "058",
                "bankName": "Guaranty Trust Bank PLC"
            },
            {
                "bankCode": "B44",
                "bankName": "Purplemoney MFB"
            },
            {
                "bankCode": "B46",
                "bankName": "Rahama Microfinance Bank"
            },
            {
                "bankCode": "B48",
                "bankName": "Regent Microfinance Bank"
            },
            {
                "bankCode": "B50",
                "bankName": "Renmoney MFB"
            },
            {
                "bankCode": "B52",
                "bankName": "Richway MFB"
            },
            {
                "bankCode": "B54",
                "bankName": "Safe Haven MFB"
            },
            {
                "bankCode": "B56",
                "bankName": "Sagamu MFB"
            },
            {
                "bankCode": "B58",
                "bankName": "Seedvest MFB"
            },
            {
                "bankCode": "B60",
                "bankName": "Stanford MFB"
            },
            {
                "bankCode": "B62",
                "bankName": "Sulsap MFB"
            },
            {
                "bankCode": "B63",
                "bankName": "Think Finance MFB"
            },
            {
                "bankCode": "B65",
                "bankName": "Trust Banc MFB"
            },
            {
                "bankCode": "B66",
                "bankName": "UNAAB MFB"
            },
            {
                "bankCode": "B69",
                "bankName": "VFD MFB"
            },
            {
                "bankCode": "B71",
                "bankName": "Visa Microfinance Bank"
            },
            {
                "bankCode": "B73",
                "bankName": "Xsince Microfinance Bank"
            },
            {
                "bankCode": "B75",
                "bankName": "Yobe MFB"
            },
            {
                "bankCode": "Z32",
                "bankName": "Calabar MFB"
            },
            {
                "bankCode": "Z68",
                "bankName": "FHA Mortgage Bank Ltd"
            },
            {
                "bankCode": "Z79",
                "bankName": "Girei MFB"
            },
            {
                "bankCode": "Z14",
                "bankName": "Nigeria Police Mort.Bank Plc"
            },
            {
                "bankCode": "Z54",
                "bankName": "Okpoga MFB"
            },
            {
                "bankCode": "050",
                "bankName": "ECOBANK"
            },
            {
                "bankCode": "032",
                "bankName": "Union Bank of Nigeria"
            },
            {
                "bankCode": "039",
                "bankName": "STANBIC IBTC Bank"
            },
            {
                "bankCode": "215",
                "bankName": "Unity Bank PLC"
            },
            {
                "bankCode": "011",
                "bankName": "FIRSTBANK"
            },
            {
                "bankCode": "000",
                "bankName": "Skye Bank Plc"
            },
            {
                "bankCode": "035",
                "bankName": "WEMA"
            },
            {
                "bankCode": "070",
                "bankName": "Fidelity Bank"
            },
            {
                "bankName": "FINBANK PLC."
            },
            {
                "bankCode": "755",
                "bankName": "AB MicroFinance Bank"
            },
            {
                "bankCode": "737",
                "bankName": "IMO POLY MFB"
            },
            {
                "bankCode": "766",
                "bankName": "Midland mfb"
            },
            {
                "bankCode": "B77",
                "bankName": "Access Yello and Beta"
            },
            {
                "bankCode": "B79",
                "bankName": "CONTEC Global"
            },
            {
                "bankCode": "B81",
                "bankName": "Ecobank Xpress Account"
            },
            {
                "bankCode": "B83",
                "bankName": "FBNMobile"
            },
            {
                "bankCode": "717",
                "bankName": "Keystone Social Banking"
            },
            {
                "bankCode": "602",
                "bankName": "NIBSS Routed MMO"
            },
            {
                "bankCode": "B85",
                "bankName": "FET"
            },
            {
                "bankCode": "B87",
                "bankName": "Firstmonie Wallet"
            },
            {
                "bankCode": "718",
                "bankName": "Unity eWallet"
            },
            {
                "bankCode": "B89",
                "bankName": "Gomoney"
            },
            {
                "bankCode": "714",
                "bankName": "eTz MFB Global Teller Scheme"
            },
            {
                "bankCode": "B91",
                "bankName": "Hedonmark"
            },
            {
                "bankCode": "B93",
                "bankName": "miMoney"
            },
            {
                "bankCode": "B94",
                "bankName": "Mkudi"
            },
            {
                "bankCode": "B96",
                "bankName": "One Finance"
            },
            {
                "bankCode": "B98",
                "bankName": "Paga"
            },
            {
                "bankCode": "C01",
                "bankName": "Parkway Ready Cahs"
            },
            {
                "bankCode": "C03",
                "bankName": "OPAY"
            },
            {
                "bankCode": "C05",
                "bankName": "Stanbic IBTC @ease wallet"
            },
            {
                "bankCode": "C07",
                "bankName": "TeasyMobile"
            },
            {
                "bankCode": "C09",
                "bankName": "Wema/ALAT"
            },
            {
                "bankCode": "C11",
                "bankName": "Zinternet KongaPay"
            },
            {
                "bankCode": "C13",
                "bankName": "Arca Payments company"
            },
            {
                "bankCode": "C14",
                "bankName": "BIPC"
            },
            {
                "bankCode": "C16",
                "bankName": "Coronation Bank"
            },
            {
                "bankCode": "C17",
                "bankName": "FBNQuest Bank"
            },
            {
                "bankCode": "C19",
                "bankName": "Flutterwave"
            },
            {
                "bankCode": "C21",
                "bankName": "Innovectives Kash"
            },
            {
                "bankCode": "C23",
                "bankName": "ITEX"
            },
            {
                "bankCode": "C25",
                "bankName": "Lagos Building Investment Company"
            },
            {
                "bankCode": "C27",
                "bankName": "Nova Merchant Bank"
            },
            {
                "bankCode": "C29",
                "bankName": "QR Payments"
            },
            {
                "bankCode": "C31",
                "bankName": "TeamApt Limited"
            },
            {
                "bankCode": "C32",
                "bankName": "Venture Garden Nigeria"
            },
            {
                "bankCode": "A01",
                "bankName": "Advans La Fayette Microfinance Bank LTD"
            },
            {
                "bankCode": "A03",
                "bankName": "Verite Microfinance Bank"
            },
            {
                "bankCode": "A05",
                "bankName": "Above Only MFB"
            },
            {
                "bankCode": "A07",
                "bankName": "Addosser MFB"
            },
            {
                "bankCode": "A09",
                "bankName": "AG Mortgage Bank"
            },
            {
                "bankCode": "A10",
                "bankName": "Agosasa MFB"
            },
            {
                "bankCode": "A12",
                "bankName": "Alekun MFB"
            },
            {
                "bankCode": "A14",
                "bankName": "Alhayat MFB"
            },
            {
                "bankCode": "A16",
                "bankName": "Alpha Kapital MFB"
            },
            {
                "bankCode": "A18",
                "bankName": "AMML MFB"
            },
            {
                "bankCode": "A20",
                "bankName": "APPLE MFB"
            },
            {
                "bankCode": "A22",
                "bankName": "Asset Matrix MFB"
            },
            {
                "bankCode": "A24",
                "bankName": "Auchi MFB"
            },
            {
                "bankCode": "A26",
                "bankName": "Balogun Gambari MFB"
            },
            {
                "bankCode": "A28",
                "bankName": "Bayero MFB"
            },
            {
                "bankCode": "A30",
                "bankName": "Boctrust Microfinance Bank"
            },
            {
                "bankCode": "A32",
                "bankName": "Bowen Microfinance Bank"
            },
            {
                "bankCode": "A34",
                "bankName": "Brethren MFB"
            },
            {
                "bankCode": "A36",
                "bankName": "Cashconnect MFB"
            },
            {
                "bankCode": "A38",
                "bankName": "Chikum Microfinance Bank"
            },
            {
                "bankCode": "A40",
                "bankName": "Coastline Microfinance Bank"
            },
            {
                "bankCode": "A42",
                "bankName": "Consumer Microfinance Bank"
            },
            {
                "bankCode": "A44",
                "bankName": "Credit Afrique Microfinance Bank"
            },
            {
                "bankCode": "A46",
                "bankName": "Daylight MFB"
            },
            {
                "bankCode": "A48",
                "bankName": "e-BARCS MFB"
            },
            {
                "bankCode": "A50",
                "bankName": "Ekondo Microfinance Bank"
            },
            {
                "bankCode": "A52",
                "bankName": "Emeralds MFB"
            },
            {
                "bankCode": "A55",
                "bankName": "Esan MFB"
            },
            {
                "bankCode": "A58",
                "bankName": "Evergreen MFB"
            },
            {
                "bankCode": "A60",
                "bankName": "Fast MFB"
            },
            {
                "bankCode": "A62",
                "bankName": "FFS MFB"
            },
            {
                "bankCode": "A64",
                "bankName": "Finatrust MFB"
            },
            {
                "bankCode": "A66",
                "bankName": "First Generation Mortgage Bank"
            },
            {
                "bankCode": "A68",
                "bankName": "First Option MFB"
            },
            {
                "bankCode": "A70",
                "bankName": "First Trust Mortgage Bank"
            },
            {
                "bankCode": "A72",
                "bankName": "Gashua MFB"
            },
            {
                "bankCode": "A74",
                "bankName": "Glory MFB"
            },
            {
                "bankCode": "A77",
                "bankName": "Greenville MFB"
            },
            {
                "bankCode": "A78",
                "bankName": "Grooming MFB"
            },
            {
                "bankCode": "A79",
                "bankName": "GTI Microfinance Bank"
            },
            {
                "bankCode": "A81",
                "bankName": "Haggai Mortgage Bank"
            },
            {
                "bankCode": "A83",
                "bankName": "Hasal MFB"
            },
            {
                "bankCode": "A86",
                "bankName": "Ikenne Microfinance Bank"
            },
            {
                "bankCode": "A88",
                "bankName": "Ilisan MFB"
            },
            {
                "bankCode": "A91",
                "bankName": "Infinity Trust Mortgage Bank"
            },
            {
                "bankCode": "A94",
                "bankName": "Jubilee Life"
            },
            {
                "bankCode": "A96",
                "bankName": "KCMB Microfinance Bank"
            },
            {
                "bankCode": "A98",
                "bankName": "Kuda Microfinance Bank"
            },
            {
                "bankCode": "B01",
                "bankName": "LAPO MFB"
            },
            {
                "bankCode": "B03",
                "bankName": "Legend MFB"
            },
            {
                "bankCode": "B05",
                "bankName": "Mainland MFB"
            },
            {
                "bankCode": "B08",
                "bankName": "Manny MFB"
            },
            {
                "bankCode": "B10",
                "bankName": "MayFresh Mortgage Bank"
            },
            {
                "bankCode": "B12",
                "bankName": "Microvis MFB"
            },
            {
                "bankCode": "B14",
                "bankName": "Molusi MFB"
            },
            {
                "bankCode": "B16",
                "bankName": "Mozfin MFB"
            },
            {
                "bankCode": "B17",
                "bankName": "Mutual Benefits MFB"
            },
            {
                "bankCode": "B19",
                "bankName": "Nargata MFB"
            },
            {
                "bankCode": "B21",
                "bankName": "Neptune MFB"
            },
            {
                "bankCode": "B23",
                "bankName": "New Golden Pastures MFB"
            },
            {
                "bankCode": "B25",
                "bankName": "Nigerian Navy MFB"
            },
            {
                "bankCode": "B27",
                "bankName": "Nnew Women MFB"
            },
            {
                "bankCode": "B29",
                "bankName": "Nurture MFB"
            },
            {
                "bankCode": "B31",
                "bankName": "Ohafia MFB"
            },
            {
                "bankCode": "B33",
                "bankName": "Omiye MFB"
            },
            {
                "bankCode": "B35",
                "bankName": "Page Microfinance Bank"
            },
            {
                "bankCode": "B37",
                "bankName": "PecanTrust MFB"
            },
            {
                "bankCode": "B39",
                "bankName": "Personal Trust MFB"
            },
            {
                "bankCode": "B41",
                "bankName": "Pillar MFB"
            },
            {
                "bankCode": "B43",
                "bankName": "Prestige Microfinance Bank"
            },
            {
                "bankCode": "B45",
                "bankName": "Quickfund MFB"
            },
            {
                "bankCode": "B47",
                "bankName": "Refuge Mortgage Bank"
            },
            {
                "bankCode": "B49",
                "bankName": "Reliance MFB"
            },
            {
                "bankCode": "B51",
                "bankName": "Rephidim MFB"
            },
            {
                "bankCode": "B53",
                "bankName": "Royal Exchange MFB"
            },
            {
                "bankCode": "B55",
                "bankName": "SafeTrust Mortgage Bank"
            },
            {
                "bankCode": "B57",
                "bankName": "Seed Capital MFB"
            },
            {
                "bankCode": "B59",
                "bankName": "Sparkle MFB"
            },
            {
                "bankCode": "B61",
                "bankName": "Stellas MFB"
            },
            {
                "bankCode": "B64",
                "bankName": "Trident MFB"
            },
            {
                "bankCode": "B67",
                "bankName": "Uniben Microfinance Bank"
            },
            {
                "bankCode": "B68",
                "bankName": "UNN MFB"
            },
            {
                "bankCode": "B70",
                "bankName": "Virture Microfinance Bank"
            },
            {
                "bankCode": "B72",
                "bankName": "Wetland Microfinance Bank"
            },
            {
                "bankCode": "B74",
                "bankName": "Yes Microfinance Bank"
            },
            {
                "bankCode": "302",
                "bankName": "TAJ Bank"
            },
            {
                "bankCode": "Z33",
                "bankName": "Coalcamp MFB"
            },
            {
                "bankCode": "Z73",
                "bankName": "Gamawa MFB"
            },
            {
                "bankCode": "Z13",
                "bankName": "Michika MFB"
            },
            {
                "bankCode": "Z65",
                "bankName": "Ogige MFB"
            },
            {
                "bankCode": "Z20",
                "bankName": "Olofin MFB"
            },
            {
                "bankCode": "Z51",
                "bankName": "Umuawulu MFB"
            },
            {
                "bankCode": "076",
                "bankName": "Polaris Bank"
            },
            {
                "bankCode": "303",
                "bankName": "Lotus Bank"
            },
            {
                "bankCode": "103",
                "bankName": "Globus Bank"
            },
            {
                "bankCode": "107",
                "bankName": "Optimus Bank"
            },
            {
                "bankCode": "102",
                "bankName": "TitanTrust Bank"
            }
        ]';
            // Deserializing the JSON string to PHP array
            $data = json_decode($jsonString, true);

            $formattedBanks = [];

// Use foreach to iterate over the array
    foreach ($data as $index => $bank) {
        $formattedBanks[] = [
            'id' => $index + 1, // Auto-assigned ID starting from 1
            'name' => $bank['bankName'] ?? 'Unknown', // Access array keys directly, with default value
            'code' => $bank['bankCode'] ?? 'Unknown', // Access array keys directly, with default value
            'provider' => 'Etransact', // Set provider to Etransact
        ];
    }
            // Return the formatted bank list
            return MyResponse::success(data: $formattedBanks);
        }

        if ($banks->isEmpty()) {
            $res = $transferService->updateBankList();

            if ($res->success) goto start;

            return MyResponse::failed($res->message);
        }

        return MyResponse::success(data: $banks);
    }

}
