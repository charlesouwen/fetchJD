# commodityInfo 商品详情

# 地址
GET /commodityInfo

# 参数
`id` 商品id；必须；

# 返回
````
{
  "brand": "APPLE",
  "classInfo": {"key": "655", "value": "手机"},
  "props": [
    {"title": "颜色", "value": "黄色"},
    {"title": "网络", "value": "4G"},
    ...
  ]
}
````