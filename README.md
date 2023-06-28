# 古珀中台对外服务

#### 介绍
古珀中台对外服务

#### 结构说明

```
src
├── Clients
│   ├── Client.php 				# 顶级父类，实现基础方法，其它扩展项目需要继承本类
├── App						# 应用目录，每个应用中心创建一个目录
├── Config 
│   ├── Config.php	 			# 配置类，封装密钥和key
├── Exceptions
│   ├── ClientException.php 			# 接口异常，根据自身需要扩展
├── Route					# 需要提供指定函数的路由，根据自身创建目录
├── Utils
│   ├── Utils.php				# 工具类
├── VO 						# 值对象
│   ├── RequestHeader.php			# 封装业务间传递的对象
└── SDK.php					# 错误信息
```


#### 安装教程

1.  pull 代码
2.  composer install


#### 代码格式化
-	提交代码前使用pint库进行格式化
```sh
.\vendor\bin\pint --preset psr12
```

#### 特技

1.	若需要扩展其它中台应用，在/src/App层级下创建目录，然后主类继承/src/Clients/Client
2.	签名header调用/src/VO/RequestHader中的getHeader()
3.	对外提供定制接口的路由，在/src/Route/下创建自己中心的目录，并扩展
4.	ak和ac统一通过/src/Config/Config类来填充

#### sdk导入
```sh
composer require gupo/middle-office
```