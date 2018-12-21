<?php

namespace Main;

use Slim\App;
use Main\Controller\IndexController;
use Main\Controller\XcrudAjaxAction;
use Main\Controller\AdminController;
use Main\Controller\ApiController;
class Route
{
    private $slim;

    public function __construct(App $slim)
    {
        $this->slim = $slim;
    }

    public function run()
    {
        $this->slim->get('/', IndexController::class.':getIndex');
        $this->slim->get('/staff', IndexController::class.':getStaff');
        $this->slim->get('/register', IndexController::class.':getRegister');
        $this->slim->get('/print', IndexController::class.':getPrint');
        $this->slim->get('/finish', IndexController::class.':getFinish');
        $this->slim->get('/api/feeds/coupon', IndexController::class.':apiFeedsCoupon');
        $this->slim->get('/d/{id}', IndexController::class.':getDistrictsDetail');
        $this->slim->get('/s/{id}', IndexController::class.':getShow');
        $this->slim->get('/amphures/{id}', IndexController::class.':getAmphuresByID');
        $this->slim->get('/provinces', IndexController::class.':getProvinces');
        $this->slim->get('/districts/{id}', IndexController::class.':getDistrictsByID');
        $this->slim->get('/api/check/privilege', IndexController::class.':apiCheckPrivilege');
        $this->slim->post('/coupon/save', IndexController::class.':postCouponSave');
        $this->slim->post('/coupon/print/save', IndexController::class.':postCouponPrintSave');
        $this->slim->get('/coupon/print/all', IndexController::class.':getCouponPrintAll');
        // xcrud ajax handler
        $this->slim->any('/xcrud/ajax', XcrudAjaxAction::class);



    }
}
