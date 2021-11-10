<?php

namespace App\Traits;

trait BaseRepositoryTrait
{
    /**
     * 取得單一資料，僅能用簡單條件
     *
     * @param mixed $selectArr ex:['id', 'user_id']
     * @param array $whereArr ex: [['agent_id', 1], ['user_id', [1, 2, 3]]]
     *      多條件時不能使用[key => value]模式
     * @param mixed $lock [null, 'share', 'forUpdate']
     * @return object
     */
    public function getOne(array $selectArr = ['*'], array $whereArr = [], $lock = null): ?object
    {
        $obj = $this->model->select(...$selectArr);
        $this->setWhere($obj, $whereArr);
        if (!empty($lock)) {
            $this->setLock($obj, $lock);
        }
        return $obj->first();
    }

    /**
     * 取得所有資料，僅能用簡單條件
     *
     * @param array $selectArr ex:['id', 'user_id']
     * @param array $whereArr ex: [['agent_id', 1], ['user_id', [1, 2, 3]]]
     *      多條件時不能使用[key => value]模式
     * @param mixed $lock [null, 'share', 'forUpdate']
     * @return array|null|object
     */
    public function getAll(array $selectArr = ['*'], array $whereArr = [], $lock = null)
    {
        $obj = $this->model->select(...$selectArr);
        $this->setWhere($obj, $whereArr);
        if (!empty($lock)) {
            $this->setLock($obj, $lock);
        }
        return $obj->get();
    }

    /**
     * 更新資料
     *
     * @param array $updateData
     * @param array $whereArr
     * @return int
     */
    public function update(array $updateData, array $whereArr): int
    {
        return $this->model->where($whereArr)->update($updateData);
    }

    /**
     * 刪除資料
     *
     * @param array $whereArr
     * @return bool
     */
    public function delete(array $whereArr): bool
    {
        return $this->model->where($whereArr)->delete();
    }

    /**
     * 設定 WHERE 條件
     *
     * @param object $object
     * @param array $whereArr
     * @return void
     */
    private function setWhere(object &$object, array $whereArr)
    {
        foreach ($whereArr as $key => $where) {
            //當鍵值是字串 預設情況['bet_id' => '123']  ['id' => [1, 2, 3]]
            if (is_string($key)) {
                //內容是陣列則用in
                if (is_array($where)) {
                    $object->whereIn($key, $where);
                } else {
                    $object->where($key, $where);
                }
                continue;
            }

            //其餘當鍵值是數字
            if (is_array($where)) {
                $this->setWhere($object, $where);
            } else {
                //第二個參數是陣列 預設情況['id', [1, 2, 3]]
                if (isset($whereArr[1]) && is_array($whereArr[1])) {
                    $object->whereIn($where, $whereArr[1]);
                    break;
                } elseif (isset($whereArr[2]) && is_array($whereArr[2])) {
                    //第三個參數是陣列 預設情況['id', 'not', [1, 2, 3]]
                    $object->whereNotIn($where, $whereArr[2]);
                    break;
                } else {
                    //參數全單個 預設情況['id', '>=', 20]
                    $object->where(...$whereArr);
                    break;
                }
            }
        }
    }

    /**
     * 設定 Lock 模式
     *
     * @param object $object
     * @param mixed $lock
     * @return void
     */
    private function setLock(object &$object, $lock)
    {
        switch ($lock) {
            case 'share':
                $object->sharedLock();
                break;
            case 'forUpdate':
                $object->lockForUpdate();
                break;
        }
    }
}
