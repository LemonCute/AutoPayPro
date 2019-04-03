<?php
$config = array(
    //应用ID,您的APPID。
    'app_id' => "2019031963591323",

    //商户私钥，您的原始格式RSA私钥
    'merchant_private_key' => "MIIEpAIBAAKCAQEAmmzsLflneggcCrJcFMg8zPbRg4DIu59smEl2nqS/ARbsGpWm
mlpfhgIIi004rWwsqmCyeD4wKI6AA2uYPV5yIsm5EEEMP7we9se3y5K7wMbjAa2t
pZNUofbmLDAy9oF80MHO50sozLcscfaokQwCJZVZFUD9WeRQenSYA76M8fT9Y4HR
ywyH5r3DeLMEKtJoZhC1uddEENg6s740EV8YEVmliTzef6ACL4zsLqNUHhwFDBJe
JNSuMBXZHveqwOjlUSWdywu/8KOe43OTDCmJkgfgbjEINYL9xObp7RovT7MwLin6
ugXVB0SiM7BQhEAalf16KWJc2E0FuMLgNZPLCQIDAQABAoIBAEKuY/GaL0dvdwRb
bg1/RVnP/jpFgugZeB/uIO1yABQtXLhCBJXEDllkSWI1bxLbkhHj/UyUteDdX4Oa
kzt0q94/sszE+dAPoGM5bDDYZIBioSVZZJEJpFLntQ5Bpc/xq/7MoVYYiz6Snft7
4d/4CnlGGxhlXsDRKLsn23hKcLwNPQh9qvGc830Hb5LBWxAD7fMxvumz+uLOkNjY
QvwblNKu6CN7qPFF2SzRDOhlBn3IE0ZbCglo6lydabCF4RWZvwZqTuHsPyaJjuRU
RkMVRXHXZ5Vqw4isfjj64+t8pAs1gqh8wViWmHjVI8F5/2pnXjbdjaX+oE1lHcJ8
2NeTPC0CgYEAzdUOWN/MzWZL1/B4Bb+gJHg0Kp3q80DNhqORbkRlkPVPlHx+tBgK
KsojqcrjAkeWiJFnUW587E8LLBadV57igj5Zy9Ra53DpYgzUNStuksBR7rFcnJrR
346kWLe+nM6cePqrVQAy8DsrCczD7mSwap3koWlQ/tgnjel+1xm5wGMCgYEAwBBU
s7wzR6sywz9YbEXqs2MO+a1qPkdgPSV8pMKqeSFzkM54YQR590BD5ElWN5i2WDV2
InJFKQmrpGmBJVF9//9TW4coiTqCF7tNI9MlpqHUiz7CDD5khji15hqoObdzo9VI
hB2tSbRSJa5PQoVlnd/fj6bMlfg1gXA9B+I8RKMCgYEAgbhvtVU+hoic7fewPLc7
HyDeh6lExI+nt93oLt1OQWBJCiS32Zp49eS1OzIRhYNGfMVenvSKKIfcW6nY+bq5
uCnBf/NSYyBHBbNeHjBEHJq2SD9hRZVRBZqpOvx6VerktF4OkqBwefRgOGnjZZ/x
iw/9Yji0ghgKPabVeIzPA08CgYEArsgtzMLgB8CMGZJz7VRTGZxz7FMb9EEQG5UZ
sPZWHJWMjaLXebKRK6iYIA99HmsixXMhZoeG2KmsQZqhpExc1bKNMSX2hatw6BfT
Q17LTLDIs08RWAMPh/Xj0ts/bAa+fcGClHhNUl1+xDu0dVzf9KPe1uN8Gp4eUwTJ
BXukTPECgYBiB3t8EFm33djGzFmOdLJAGeqtVE9qza4xmDOyY8C4Q9O2yyfSzCiM
cKop3jabBE4WioLiUPj9aYZdemxBNJ8DwIpOtpgY4CI5KxdqDtDkRXUJhLuqyVws
2uOzvWy4AKLOUwwXOwTmRJivcHE58wKKKgE6MDK7/tFGEA1c+PjlkA==",

    //异步<通知>地址  后台返回
//    'notify_url' => "http://lcke.top/pay/notify_url.php",
    'notify_url' => "http://localhost:8888/AutoPayPro/alipayPHP/notify_url.php",

    //同步<跳转>     页面返回支付结果
    'return_url' => "http://localhost:8888/AutoPayPro/alipayPHP/return_url.php",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type' => "RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAl/gG7TqijKSg3prMBSIcSsS/aqTe4zxgP+VvbnUBZXL0WaSGpsuJ7ffXl3XKweNz+L8qAX7bwfU6+1pjSrzhX0HGCeYhoP+ScHniu+P0eHGNRWqHHJ0LcJ9B+oRfAMFBx6gqMaCGT59dCnXqxXZlMNGrA4EL1RbzUtnqpT2S043rJIk3/ZBq9XatQOCabuHAWG/TM1MxhxyiBPWRAZhbeDhQWfTkV+MkJUPt+A7cEvPSYB343yi78GPtbIobkTrzGElHbv7BSrBzTSTjqk9Fun4bMuOK5kE7R4iQSo/l1E5O8iur+CLKuiR7Ml2Kfr8Veh7AacjBvBBdka925x5HFQIDAQAB",


);