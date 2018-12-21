<?php

namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Valitron\Validator;

class IndexController extends BaseController
{

    public function getIndex(Request $req, Response $res)
    {
        $db = $this->ci->medoo;
        return $this->ci->view->render($res, 'index.twig');
    }

    public function getStaff(Request $req, Response $res)
    {
        $db = $this->ci->medoo;
        return $this->ci->view->render($res, 'staff.twig');
    }

    public function getRegister(Request $req, Response $res)
    {
        $db = $this->ci->medoo;
        $amphures = $db->select("amphures", "*");
        $districts = $db->select("districts", "*");
        $coupon = $db->select('coupon', '*', [
            "OR" => [
                "pers_idcard" => $req->getQueryParam('user'),
                "MemberCardNo" => $req->getQueryParam('user')
            ]
        ]);
        $provinces = $db->select("provinces", "*");
        return $this->ci->view->render($res, 'register.twig',['amphures'=>$amphures,'districts'=>$districts,'coupons'=>$coupon,'user'=> $req->getQueryParam('user'),'provinces'=>$provinces]);
    }

    public function getPrint(Request $req, Response $res)
    {
        $db = $this->ci->medoo;
        $coupon = $db->select('coupon','*', [
            "OR" => [
                "pers_idcard" => $req->getQueryParam('user'),
                "MemberCardNo" => $req->getQueryParam('user')
            ]
        ]);
        foreach ($coupon as &$value) {
            $c = $db->count('print','*',['print_coupon_id'=>$value['coupon_id']]);;
            $db->update("coupon", [
                "printCount" => $c+1
            ], [
                "coupon_id" => $value['coupon_id']
            ]);
        }

        if ($req->getQueryParam('cptype') == 'all') {
            $coupon = $db->select('coupon','*', [
                "OR" => [
                    "pers_idcard" => $req->getQueryParam('user'),
                    "MemberCardNo" => $req->getQueryParam('user')
                ]
            ]);
        } else if ($req->getQueryParam('cptype') == 'n'){
            $coupon = $db->select('coupon','*', [
                "OR" => [
                    "pers_idcard" => $req->getQueryParam('user'),
                    "MemberCardNo" => $req->getQueryParam('user')
                ] ,
                'AND' => [
                    'printStatus' => 'N'
                ]
            ]);
        } else if ($req->getQueryParam('cptype') == 'y'){
            $coupon = $db->select('coupon','*', [
                "OR" => [
                    "pers_idcard" => $req->getQueryParam('user'),
                    "MemberCardNo" => $req->getQueryParam('user')
                ] ,
                'AND' => [
                    'printStatus' => 'Y'
                ]
            ]);
        } else {
            $coupon = $db->select('coupon','*', [
                "OR" => [
                    "pers_idcard" => $req->getQueryParam('user'),
                    "MemberCardNo" => $req->getQueryParam('user')
                ]
            ]);
        }

        return $this->ci->view->render($res, 'print.twig',['coupons'=>$coupon,'user'=>$req->getQueryParam('user')]);
    }

    public function getFinish(Request $req, Response $res)
    {
        $db = $this->ci->medoo;
        $coupon = $db->select('coupon','*', [
            "OR" => [
                "pers_idcard" => $req->getQueryParam('user'),
                "MemberCardNo" => $req->getQueryParam('user')
            ]
        ]);
        return $this->ci->view->render($res, 'finish.twig',['coupons'=>$coupon,'user'=>$req->getQueryParam('user')]);
    }

    public function postCouponSave(Request $req, Response $res)
    {
        $db = $this->ci->medoo;
        $db->update("coupon", [
            "FirstName" => $req->getParsedBodyParam('first_name'),
            "LastName" => $req->getParsedBodyParam('last_name'),
            "Pers_PhoneNumber" => $req->getParsedBodyParam('phone'),
            "pers_idcard" => $req->getParsedBodyParam('idcard'),
            "Addr_Address1" => $req->getParsedBodyParam('address'),
            "Addr_Address2" => $req->getParsedBodyParam('moo'),
            "Addr_Address3" => $req->getParsedBodyParam('soi'),
            "Addr_Address4" => $req->getParsedBodyParam('rd'),
            "addr_province" => $req->getParsedBodyParam('p'),
            "addr_subdistrict" => $req->getParsedBodyParam('d'),
            "addr_district" => $req->getParsedBodyParam('a'),
            "Addr_PostCode" => $req->getParsedBodyParam('zipcode'),
            "gender" => $req->getParsedBodyParam('gender'),
            "bod" => $req->getParsedBodyParam('birth_of_date'),
            "pers_status" => $req->getParsedBodyParam('pers_status'),
            "children_under" => $req->getParsedBodyParam('children_under'),
            "EmailAddress" => $req->getParsedBodyParam('email')
        ], [
            "coupon_id" => $req->getParsedBodyParam('coupon_id')
        ]);
    }


    public function apiFeedsCoupon(Request $req, Response $res)
    {
        $json_url = 'http://203.155.71.244/crm/xmldatasource/mssql/mc.php';
        $json = file_get_contents($json_url);
        $data = json_decode($json, TRUE);
        foreach ($data as  $value) {
            echo 'Person ID : ' .$value['pers_PersonID']. ' / Wave item ' .$value['cp_waveitem']. ' / Pers IDCard' .$value['pers_idcard']. '<br>';
            $this->syncCoupon($value);
        }
    }

    public function apiCheckPrivilege(Request $req, Response $res) {
        $db = $this->ci->medoo;
        $arr = array();
        $coupon = $db->select('coupon','*', [
            "OR" => [
                "pers_idcard" => $req->getQueryParam('user'),
                "MemberCardNo" => $req->getQueryParam('user')
            ]
        ]);
        if ($coupon) {
            $arr['code'] = 1;
        } else {
            $arr['code'] = 0;
        }
        return $res->withJson($arr);
    }

    public function postCouponPrintSave(Request $req, Response $res) {
        $db = $this->ci->medoo;
        $arr = array();


        $db->insert("print", [
            "print_coupon_id" => $req->getParsedBodyParam('cid'),
            "print_notes" => $req->getParsedBodyParam('notes')
        ]);
        $db->update("coupon", [
            "printLastTime" =>  date("Y-m-d H:i:s"),
            "printStatus" => "Y"
        ], [
            "coupon_id" => $req->getParsedBodyParam('cid')
        ]);
        return $res->withJson($arr);
    }

    public function getCouponPrintAll(Request $req, Response $res) {
        $db = $this->ci->medoo;
        $arr = array();

        $db->update("coupon", [
            "printLastTime" =>  date("Y-m-d H:i:s"),
            "printStatus" => "Y"
        ], [
            "OR" => [
                "pers_idcard" => $req->getQueryParam('user'),
                "MemberCardNo" => $req->getQueryParam('user')
            ]
        ]);
        $coupon = $db->select('coupon','*', [
            "OR" => [
                "pers_idcard" => $req->getQueryParam('user'),
                "MemberCardNo" => $req->getQueryParam('user')
            ]
        ]);
        foreach ($coupon as &$value) {

            $db->insert("print", [
                "print_coupon_id" => $value['coupon_id'],
                "print_notes" => 'Print All'
            ]);
            $c = $db->count('print','*',['print_coupon_id'=>$value['coupon_id']]);;
            $db->update("coupon", [
                "printCount" => $c+1
            ], [
                "coupon_id" => $value['coupon_id']
            ]);
        }

        return $res->withJson($arr);
    }

    public function getTopicById(Request $req, Response $res) {
        $db = $this->ci->medoo;
        $category = $db->select('topic_category','*');
        $topicList = $db->get('topic', [
            '[>]guest' => ['guest_id' => 'id'],
            '[>]province' => ['province' => 'PROVINCE_ID'],
            '[>]topic_category' => ['topic_category_id' => 'topic_category_id']
        ], '*', [
            'AND' => [
                'topic.topic_id' => $req->getAttribute('id')
            ],
            'ORDER' => ['topic.topic_id' => 'DESC'],
            'LIMIT' => 20000
        ]);
        return $this->ci->view->render($res, 'topic.twig',['category'=>$category,'topic'=>$topicList]);
    }

    function syncCoupon ($arr) {
        $db = $this->ci->medoo;
        if (!$db->get('coupon','*',['pers_PersonID'=>$arr['pers_PersonID']])) {
            $db->insert('coupon', [
                'pers_PersonID' => $arr['pers_PersonID'],
                'cp_waveitem' => $arr['cp_waveitem'],
                'cp_coupon' => $arr['cp_coupon'],
                'cp_billtotal' => $arr['cp_billtotal'],
                'pers_idcard' => $arr['pers_idcard'],
                'MemberCardNo' => $arr['MemberCardNo'],
                'FirstName' => $arr['FirstName'],
                'LastName' => $arr['LastName'],
                'Pers_PhoneNumber' => $arr['Pers_PhoneNumber'],
                'Mobile' => $arr['Mobile'],
                'EmailAddress' => $arr['EmailAddress'],
                'Addr_Address1' => $arr['Addr_Address1'],
                'Addr_Address2' => $arr['Addr_Address2'],
                'Addr_Address3' => $arr['Addr_Address3'],
                'Addr_Address4' => $arr['Addr_Address4'],
                'Addr_Address5' => $arr['Addr_Address5'],
                'addr_subdistrict' => $arr['addr_subdistrict'],
                'addr_district' => $arr['addr_district'],
                'addr_province' => $arr['addr_province'],
                'Addr_PostCode' => $arr['Addr_PostCode'],
                'cardtype' => $arr['cardtype']
            ]);
        }
    }

    public function getAmphuresByID(Request $req, Response $res)
    {
        $db = $this->ci->medoo;
        $provinces = $db->select("amphures", "*", ['PROVINCE_ID' => $req->getAttribute('id')]);
        return $res->withJson($provinces);
    }
    public function getDistrictsByID(Request $req, Response $res)
    {
        $db = $this->ci->medoo;
        $districts = $db->select("districts", "*", ['AMPHUR_ID' => $req->getAttribute('id')]);
        return $res->withJson($districts);
    }
    public function getDistrictsDetail(Request $req, Response $res)
    {
        $db = $this->ci->medoo;
        $districts = $db->get("districts", "*", ['DISTRICT_ID' => $req->getAttribute('id')]);
        return $res->withJson($districts);
    }
}
