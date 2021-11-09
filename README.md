# API List<br>
[GCP Pub/Sub](#gcp-pubsub-api)<br>
[User CRUD & JWT](#user-crud-jwt)<br>
## Notice
[Postman setting](#-postman-setting)<br>
## GCP Pub/Sub API
### - Publisher
<kbd>/api/publish</kbd> *method: post*

\> request example:
```
{
    "data": "123"
}
```

\> response example:
```
{
    "messageIds": [
        "3435086547679358"
    ]
}
```

### - Subscriber
<kbd>/api/pull</kbd> *method: get*

\> response example:
```
123
```

---

## User CRUD & JWT
### - Login

<kbd>/api/auth/login</kbd> *method: post*

###### ⚠︎ 於 postman 設定腳本，使 access token 自動寫入環境變數中，請參考[Postman setting](#-postman-setting)。

\> request example:
```
{
    "username":"aabbcc1234",
    "password":"qwe123"
}
```

\> response example:
```
{
    "status": 1004,
    "message": "LOGIN_SUCCESS",
    "dataGrid": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE2MzY0Mzc5NjcsImV4cCI6MTYzNjQ0MTU2NywibmJmIjoxNjM2NDM3OTY3LCJqdGkiOiI2SVdpMnZEYzJISUlNVTV1Iiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.87N07VGgRNwKckUmWqHuKCo8q9pZksCWfHiOht0VgEI",
        "token_type": "bearer",
        "expires_in": 3600,
        "user": {
            "id": 1,
            "username": "aabbcc1234",
            "name": "abc",
            "email": "abc@aabbcc.info",
            "created_at": "2021-10-22T09:22:01.000000Z",
            "updated_at": "2021-10-22T09:21:17.000000Z"
        }
    }
}
```
### - UserProfile
<kbd>/api/auth/user-profile</kbd> *method: get*
###### ⚠︎ 需要登入權限
\> response example:
```
{
    "status": 1000,
    "message": "SUCCESS",
    "dataGrid": {
        "id": 1,
        "username": "aabbcc1234",
        "name": "abc",
        "email": "abc@aabbcc.info",
        "created_at": "2021-10-22T09:22:01.000000Z",
        "updated_at": "2021-10-22T09:21:17.000000Z"
    }
}
```
### - Refresh Token
<kbd>/api/auth/refresh</kbd> *method: post*
###### ⚠︎ 需要登入權限
\> response example:
```
{
    "status": 1002,
    "message": "UPDATE_SUCCESS",
    "dataGrid": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvYXV0aFwvcmVmcmVzaCIsImlhdCI6MTYzNjQzNzk2NywiZXhwIjoxNjM2NDQxNzU5LCJuYmYiOjE2MzY0MzgxNTksImp0aSI6IkE2NWFmbWhMYTVUZlAzVFYiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.nG7Adb_bWLoozBsHHJ6ZveGTCTrRsC6TK-0ZKASwZJs",
        "token_type": "bearer",
        "expires_in": 3600,
        "user": {
            "id": 1,
            "username": "aabbcc1234",
            "name": "abc",
            "email": "tabc@aabbcc.info",
            "created_at": "2021-10-22T09:22:01.000000Z",
            "updated_at": "2021-10-22T09:21:17.000000Z"
        }
    }
}
```
### - Logout
<kbd>/api/auth/logout</kbd> *method: post*
###### ⚠︎ 需要登入權限
\> response example:
```
{
    "status": 1000,
    "message": 1005,
    "dataGrid": "LOGOUT_SUCCESS"
}
```
### - Register
<kbd>/api/auth/register</kbd> *method: post*

\> request example:
```
{
    "username": "test",
    "password": "qwe123",
    "name": "test",
    "email": "test@fake-email.com"
}
```

\> response example:
```
{
    "status": 1001,
    "message": "CREATE_SUCCESS",
    "dataGrid": {
        "username": "test",
        "name": "test",
        "email": "test@fake-email.com",
        "updated_at": "2021-11-09T06:13:25.000000Z",
        "created_at": "2021-11-09T06:13:25.000000Z",
        "id": 3
    }
}
```
## - Postman Setting
##### 1. 設定環境變數 VARIABLE: `Authorization`
##### 2. 於 Login API Tests 加入以下腳本，在登入時自動在環境變數中設定 JWT Token

```
var body = JSON.parse(responseBody);
postman.setEnvironmentVariable("Authorization", "Bearer " + body.dataGrid.access_token);
```
##### 3. 在需要登入權限的 API (如: userProfile) Headers 加入KEY: `Authorization`, VALUE: `{{Authorization}}`