<?php

namespace App\Enums;

class StatusCodeEnum
{
    /**
     * 系統錯誤
     */
    const SYSTEM_ERROR = -1;

    /**
     * 成功
     */
    const SUCCESS = 1000;

    /**
     * 創建成功
     */
    const CREATE_SUCCESS = 1001;

    /**
     * 更新成功
     */
    const UPDATE_SUCCESS = 1002;

    /**
     * 刪除成功
     */
    const DELETE_SUCCESS = 1003;

    /**
     * 登入成功
     */
    const LOGIN_SUCCESS = 1004;

    /**
     * 登出成功
     */
    const LOGOUT_SUCCESS = 1005;

    /**
     * 失敗
     */
    const FAIL = 2000;

    /**
     * 創建失敗
     */
    const CREATE_FAIL = 2001;

    /**
     * 更新失敗
     */
    const UPDATE_FAIL = 2002;

    /**
     * 刪除失敗
     */
    const DELETE_FAIL = 2003;

    /**
     * 參數驗證失敗
     */
    const VALIDATION_FAIL = 2004;

    /**
     * 憑證驗證失敗
     */
    const TOKEN_FAIL = 2005;

    /**
     * 權限驗證失敗
     */
    const AUTHORITY_FAIL = 2006;
}
