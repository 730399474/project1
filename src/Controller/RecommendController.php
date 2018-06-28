<?php
/**
 * Created by PhpStorm.
 * User: liwenye
 * Date: 2018/6/27 0027
 * Time: 23:20
 */

namespace Controller;
use FastD\Http\ServerRequest;
use Logic\RecommendLogic;


class RecommendController extends BaseController
{
    /**
     * @param ServerRequest $request
     * @return \Service\ApiResponse
     */
    public function index(ServerRequest $request)
    {
        $uid = 1;//$_SESSION['uid'];
        $id = $request->getParam("id");
        return $this->response(RecommendLogic::getInstance()->index($uid, $id),true);
    }
}