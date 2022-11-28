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
<hr>
<hr>

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


