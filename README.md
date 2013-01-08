# 人工智能与专辑系统 课程作业 2010051933

demo系统地址：[http://xinjian.li/ai](http://xinjian.li/ai)

本次作业两部分的源代码均以GPL协议开放源代码于我的Github仓库上

+ ID3 算法的PHP实现 
    + [https://github.com/horsley/ai-id3](https://github.com/horsley/ai-id3)
+ PHP实现用产生式系统设计的简单的专家系统（含ID3算法演示）
    + [https://github.com/horsley/exp-sys](https://github.com/horsley/exp-sys)

本系统前端开发测试环境为：Chrome 23 + Win7，未测试在其他平台其他浏览器中的兼容性。
## 动物识别系统
- - -

### 冲突消解策略
本系统采用针对性原则进行冲突消解，默认选用针对性更高的规则最先应用。此外，当有相同结论的多条规则里有其中一条被成功应用后其他规则将会被标记为略过，提高效率。

### 用户界面说明
用户界面采用web方式与用户进行交互，全站使用ajax与后端进行数据交互，前端页面使用了bootstrap框架和JQuery

### 综合数据库说明
综合数据库以事实原子为单位形成数组作为ExpSys类的实例的一个私有属性

### 规则库说明

###### 存储
默认规则库文件存放在web目录中的data子目录，文件名为rules.default.json，系统运行时用户添加删除和修改的规则只在当前会话有效，存放在服务器SESSION中，不影响默认规则库，但是默认规则库还是可以手工修改的，要注意符合JSON的格式。

###### 格式
规则以JSON格式文本存储，每个规则使用一个JSON对象，规则库则为规则对象数组的JSON；
规则中的条件和结论都是数组。
    
默认规则库如下

    [
        {
    		"name":"R1",
    		"conditions":["有毛发"],
    		"results":["是哺乳动物"]
    	},
    	{
    		"name":"R2",
    		"conditions":["有奶"],
    		"results":["是哺乳动物"]
    	},
    	{
    		"name":"R3",
    		"conditions":["有羽毛"],
    		"results":["是鸟"]
    	},
    	{
    		"name":"R4",
    		"conditions":["会飞", "生蛋"],
    		"results":["是鸟"]
    	},
    	{
    		"name":"R5",
    		"conditions":["吃肉"],
    		"results":["是食肉动物"]
    	},
    	{
    		"name":"R6",
    		"conditions":["有锋利牙齿", "有爪", "眼向前方"],
    		"results":["是食肉动物"]
    	},
    	{
    		"name":"R7",
    		"conditions":["是哺乳动物", "有蹄"],
    		"results":["是有蹄类动物"]
    	},
    	{
    		"name":"R8",
    		"conditions":["是哺乳动物", "反刍"],
    		"results":["是有蹄类动物"]
    	},
    	{
    		"name":"R9",
    		"conditions":["是哺乳动物", "是食肉动物", "有黄褐色", "有暗斑点"],
    		"results":["是豹"]
    	},
    	{
    		"name":"R10",
    		"conditions":["是哺乳动物", "是食肉动物", "有黄褐色", "有黑色条纹"],
    		"results":["是虎"]
    	},
    	{
    		"name":"R11",
    		"conditions":["是有蹄类动物", "有长脖子", "有长腿", "有暗斑点"],
    		"results":["是长颈鹿"]
    	},
    	{
    		"name":"R12",
    		"conditions":["是有蹄类动物", "有黑色条纹"],
    		"results":["是斑马"]
    	},
    	{
    		"name":"R13",
    		"conditions":["是鸟", "不会飞", "有长脖子", "有长腿", "有黑白两色"],
    		"results":["是鸵鸟"]
    	},
    	{
    		"name":"R14",
    		"conditions":["是鸟", "不会飞", "会游泳", "有黑白两色"],
    		"results":["是企鹅"]
    	},
    	{
    		"name":"R15",
    		"conditions":["是鸟", "善飞"],
    		"results":["是信天翁"]
    	}
    ]
    
## 项目目录结构
+ 根目录
    + data 数据文件存放目录 
        + id3.7-3.php ID3演示用的书本例子7.3的数据 
        + id3.7-4.php ID3演示用的书本例子7.4的数据
        + rules.default.json 动物推理系统的默认规则库
    + include 系统基础框架
        + init.php 应用入口文件
        + template.php 模板引擎类
    + library 应用类库
        + AI_ID3.class.php ID3算法类
        + DS_Tree.class.php 树形数据结构的实现
        + ExpSys.class.php 专家系统的实现
        + functions.php 函数库
    + static 静态资源(css/js/img)
    + template 内容块模版目录
    + ajax.php 全站ajax提交接收入口
    + index.php 首页入口
    + README.md 本文档
