# categories 获取京东筛选项

# 地址
POST /category

# 参数
`url` 地址；必需；
`excludes` 排除筛选；可选；用英文逗号分隔，如：颜色,人群；

#返回
````
[
  {
    "key": "品牌",
    "values": [{"href": "23333", "value": "华为"}, {"href": "23333", "value": "小米"}]
  },
  {
    "key": "价格",
    "values": [{"href": "23333", "value": "0-139"}, {"href": "23333", "value": "139-555"}]
  }
]
````
