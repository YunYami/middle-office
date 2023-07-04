# 古珀中台对外服务

#### 介绍
-	古珀中台对外服务
-	本库作为公共组件使用，不参杂业务端业务代码
-	业务端sdk需要导入本库

#### 结构说明

```
src
├── Clients
│   ├── Client.php 				# 顶级父类，业务端需要继承奔雷
├── Config 
│   ├── Config.php	 			# 配置类，封装密钥和key
├── Exceptions
│   ├── ClientException.php 			# 接口异常
├── Error					# 异常信息
├── Utils
│   ├── Utils.php				# 工具类
├── VO 						# 值对象（Value Object）
│── ├── RequestHeader.php			# 封装业务间传递的对象
```


#### 安装教程

1.  pull 代码
2.  composer install


#### 代码格式化
-	提交代码前使用pint库进行格式化
```sh
.\vendor\bin\pint --preset psr12
```

#### 注意事项
-	依赖本库的独立项目，需要在根目录下面的config目录下创建middleoffice.php的配置文件
-	若是其它中台项目sdk依赖本库，不需要创建
-	若是中台独立项目依赖本库，但不需要使用Config类，那么也不需要创建
-	middleoffice.php格式如下：
```php
<?php

return [
    'id' => env('AUTH_CENTER_APP_ID'),
    'app_id' => env('AUTH_CENTER_APP_KEy'),
    'app_secret' => env('AUTH_CENTER_APP_SECRET'),
];
```


#### 使用说明

一、sdk调用流程
1.	使用本库，需在主类继承/src/Clients/Client
2.	签名header调用/src/VO/RequestHader中的getHeader()
3.	ak和ac统一通过/src/Config/Config类来填充
4.	请求均使用client类中提供的get或post函数发起

二、日志写入流程
1.	调用LogModuel/Logs类中的writeLog()方法
2.	配置用户中心的日志写入的请求链接放在env中，如:log_url = http://uat-api.group-ds.com/bmo-auth-api/api/v2/request/log/create

#### sdk导入
```sh
composer require gupo/middle-office
```