# 古珀中台对外服务

#### 介绍
古珀中台对外服务

#### 结构说明

```
src
├── Clients
│   ├── Client.php 				# 顶级父类，实现基础方法，其它扩展项目需要继承本类
├── Config 
│   ├── Config.php	 			# 配置类，封装密钥和key
├── Exceptions
│   ├── ClientException.php 			# 接口异常，根据自身需要扩展
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

#### 使用说明

1.	使用本库，需在主类继承/src/Clients/Client
2.	签名header调用/src/VO/RequestHader中的getHeader()
3.	ak和ac统一通过/src/Config/Config类来填充
4.	请求均使用client类中提供的get或post函数发起

#### sdk导入
```sh
composer require gupo/middle-office
```