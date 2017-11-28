<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2017/11/28
 * Time: 14:38
 */

namespace Logic;


use Exception\TestException;
use Model\TestModel;

class TestLogic extends BaseLogic
{
    public function getTest($id)
    {
        $test = TestModel::getTest($id);

        if(!$test){
            TestException::TestNotFound();
        }

        return $test;
    }

    public function getAskList($test_id)
    {
        $where = ["test_id"=>$test_id,"ORDER"=>['ask_no'=>"ASC"]];

        $ask = TestModel::listAsk($where);

        if(!$ask){
            return [];
        }

        $ask_ids = [];
        $ask_index = [];
        foreach ($ask as $v)
        {
            $ask_ids[] = $v['id'];
            $ask_index[$v['id']] = $v;
        }

        $option_where = ["ask_id"=>$ask_ids];

        $options = TestModel::listOption($option_where);

        foreach ($options as $option)
        {
            $ask_index[$option['ask_id']]['option'][] = $option;
        }

        return array_values($ask_index);
    }

    public function randAnswer($test_id)
    {
        $where = ["test_id"=>$test_id];
        $answer = TestModel::listAnswer($where);
//        var_dump($answer);exit;
        if(!$answer)
        {
            return [];
        }

        return $answer[array_rand($answer)];
    }
}