# register.php
```json
method="POST"
send={
    "userName":"henry",
    "userPwd":"henryPwd",
    "userEmail":"henry@gmail.com"
}
response={
    "state":200,
    "message":"OK"
}
```
# login.php
```json
method="POST"
send={
    "userName":"henry",
    "userPwd":"henryPwd"
}
response={
    "state":200,
    "message":"OK"
}
```
# logout.php
```json
method="POST"
send={}
response={}
```
# getSession.php
```json
method="GET"
response={
    "state":200,
    "userName":"henry",
    "userId":1,
    "message":"OK"
}
```
<hr>
<hr>

# getCart.php

method="POST"

"key" : []

"return" : [ ('success'|'failed') ]

# putInCart.php
```json
method="POST"
send={
    "purchaseNum":5,//購物車中此商品購買數量
    "purchaseState":"InCart",//狀態欄 購物車中:InCart
    "productId":1//商品ID
}
response={
    "state":200,
    "message":"訊息"
}
```
# placeOrder.php 
一個商品，結帳

# showProduct.php
```json
method="GET"
response={
    "state":200,
    "data":[
        {
            "id":1, //商品ID
            "url":"https://i.imgur.com/OS3lebp.png",    //商品圖片網址
            "name":"微積分",    //商品名稱
            "price":"300"   //商品價錢
        },{"id":2,"url":"https://i.imgur.com/OS3lebp.png","name":"微積分2","price":"100"}    //多個商品的資料
    ]
}
```
# delProduct
```json
method="POST"
send={
    "productId":1 //要刪除商品的ID
}
response={
    "state":200,
    "message":"就一些訊息"
}
```

# setProduct.php
```json
method="POST"
send={
    "productId":"", //商品ID，若為 新增商品 設 空字串
    "productName":"微積分2", //(商品名稱)
    "productNum":10, //(商品數量)
    "productImg":"https://i.imgur.com/OS3lebp.png", //照片網址
    "productText":"牛逼了我的天", //賣家的話
    "productLabel":"", //商品分類
    "productNewRate":4, //商品新舊程度(0~5)
    "productInfo":"一杓三花淡奶，全是科技與很活", //商品介紹
    "productCost":300 //價錢
}
response={
    "state":200, // 400=> 沒登入,200 => OK,500 => 後端爛了or有資料沒送到後端
    "message":"就一些訊息"
}
```
# showProductDetail.php
```json
method="POST"
send={
    "id":4
}
response={
    "state":200,
    "message":"OK",
    "data":{
        "id":4, //商品ID
        "url":"https://i.imgur.com/OS3lebp.png", //照片網址
        "name":"微積分2", //(商品名稱)
        "price":300, //價錢
        "new":4, //商品新舊程度(0~5)
        "num":10, //(商品數量)
        "text":"牛逼了我的天", //賣家的話
        "info":"一杓三花淡奶，全是科技與很活", //商品介紹
    }
}
```

# chatTalk.php

```json
method="POST"
send={
    "userIdTo":1, //對方的user_id
    "chatText":"你媽死了"   //聊天的訊息
}
response={
    "state":200,
    "message":"OK"
}

```

# chatHistory.php

```json
method="POST"
send={
    "userId":2, // 對方的userId
    "timeFrom":"2022-01-01 00:00:00",   //搜尋時間區間起點，若設為""則默認為'1000-01-01 00:00:00'
    "timeTo":"2022-12-31 00:00:00"      //搜尋時間區間終點，若設為""則默認為'9999-12-31 23:59:59'
}
response={ 
    "chatData": [   //只會回傳符 "合搜尋條件" 且 "最新" 的20筆資料(若沒有輔合的項目可能回傳空陣列，超過20筆的資料也不傳)，由新到舊排列
        {
            "userIdFrom": "1",
            "userIdTo": "2",
            "chatText": "登入送坦克",
            "chatTime": "2022-12-12 10:09:51",
            "chatId": "5"
        },
        {
            "userIdFrom": "2",
            "userIdTo": "1",
            "chatText": "六四天安門",
            "chatTime": "2022-12-12 10:09:08",
            "chatId": "4"
        }
    ],
    "state": 200,
    "message": "OK"
}

# chatHistory.php

```json
method="POST"
send={
    "userId":2, // 對方的userId
    "time":"2022-01-01 00:00:00",   //搜尋時間區間起點，若設為""則默認為'1000-01-01 00:00:00'
    "top":0
}
response={ 
    "chatData": [   //只會回傳符 "合搜尋條件" 且 "最新" 的20筆資料(若沒有輔合的項目可能回傳空陣列，超過20筆的資料也不傳)，由新到舊排列
        {
            "userIdFrom": "1",
            "userIdTo": "2",
            "chatText": "登入送坦克",
            "chatTime": "2022-12-12 10:09:51",
            "chatId": "5"
        },
        {
            "userIdFrom": "2",
            "userIdTo": "1",
            "chatText": "六四天安門",
            "chatTime": "2022-12-12 10:09:08",
            "chatId": "4"
        }
    ],
    "state": 200,
    "message": "OK"
}