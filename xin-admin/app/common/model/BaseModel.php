<?php

namespace app\common\model;

use app\common\library\RequestJson;
use think\exception\HttpResponseException;
use think\Model;
use think\Response;

class BaseModel extends Model
{
    use RequestJson;
    /**
     * 错误信息
     */
    private string $errorMsg = '';

    public function getErrorMsg(): string
    {
        return $this->errorMsg;
    }

    public function setErrorMsg($str = '')
    {
        return $this->errorMsg = $str;
    }

    public static function onBeforeWrite(Model $model): void
    {
        if(env('WEB_NAME') && env('WEB_NAME') == 'xin_test'){
            $response = Response::create([
                'success' => false,
                'msg' => '演示站已禁止此操作',
                'showType' => 1,
                'status' => 200
            ], 'json', 200);
            throw new HttpResponseException($response);
        }
    }

    public static function onBeforeDelete(Model $model): void
    {
        if(env('WEB_NAME') && env('WEB_NAME') == 'xin_test'){
            $response = Response::create([
                'success' => false,
                'msg' => '演示站已禁止此操作,',
                'showType' => 1,
                'status' => 200
            ], 'json', 200);
            throw new HttpResponseException($response);
        }
    }

    /**
     * 新增前
     * @param Model $model
     * @return void
     */
    public static function onBeforeInsert(Model $model): void
    {

    }

    /**
     * 新增后
     * @param Model $model
     * @return void
     */
    public static function onAfterInsert(Model $model): void
    {

    }

    /**
     * 字段值增长
     * @param int|bool|array $where
     * @param string $field
     * @param float $step
     * @return mixed
     */
    protected function setInc(int|bool|array $where, string $field, float $step = 1): mixed
    {
        if (is_numeric($where)) {
            $where = [$this->getPk() => (int)$where];
        }
        return $this->where($where)->inc($field, $step)->update();
    }

    /**
     * 字段值消减
     * @param int|bool|array $where
     * @param string $field
     * @param float $step
     * @return mixed
     */
    protected function setDec(int|bool|array $where, string $field, float $step = 1): mixed
    {
        if (is_numeric($where)) {
            $where = [$this->getPk() => (int)$where];
        }
        return $this->where($where)->dec($field, $step)->update();
    }


}