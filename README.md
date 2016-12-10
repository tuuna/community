# community

> A website that you can get the activity info easily with Yii2 Advanced template

## 功能介绍

- 主要提供社团活动信息的发布，社团活动的报名，社团活动的关注评论。

- 角色权限分为
  - 普通用户:报名，点赞，关注，评论活动
    - 活动号：发布活动信息，上传活动图片，获取用户报名信息以及评论
      - 超级管理员:包括活动号审核的一切权限
  
## 技能分布

- 主要使用了Yii2的高级模板，权限管理使用了Yii-admin来控制，后台模板为AdminATL
- 使用七牛云的图床保存图片
- 使用Redis缓存以及点赞等高并发处理
- 事件控制邮件的发送
- api
