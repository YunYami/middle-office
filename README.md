# 古珀中台对外服务

#### 介绍
古珀中台对外服务

#### 结构说明

```
src
├── Clients
│   ├── Client.php # 顶级父类，实现基础方法，其它扩展项目需要继承本类
├── Config 
│   ├── Config.php # 配置类，封装密钥和key
├── Exceptions
│   ├── ClientException.php # 接口异常，根据自身需要扩展
├── Route
│   ├── Route.php # 
├── Utils
│   ├── Utils.php # 工具类
├── Listeners # 事件监听器
├── VO # 值对象
│   ├── RequestHeader.php # 封装业务间传递的对象
└── SDK.php # 错误信息
```


#### 安装教程

1.  pull 代码
2.  composer install


#### 特技

1.	若需要扩展其它中台应用，在/src层级下创建目录，然后主类继承/src/Clients/Client
2.	签名header调用/src/VO/RequestHader中的getHeader()
3.	对外提供定制接口的路由，在/src/Route/Route中扩展
4.	ak和ac统一通过/src/Config/Config类来填充

#### sdk导入
```sh
composer require gupo/middle-office
```